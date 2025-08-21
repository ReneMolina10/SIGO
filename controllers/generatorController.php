<?php

class generatorController extends Controller{

	private $_m="generator"; //Nombre del modelo principal
	private $_c; //Nombre de este controlador principal
	private $_nomPlural;
	private $_nomSingular;
	private $_columnas;
	private $_bd = array();
	private $_db; // <--- MULTI_BD
	private $_tablas = array();
	private $_form = array();
	private $_reports = array();
	private $_arraySQL = array();
	private $_btnsTabla = array();
	private $_btnsBarra = array();
	private $_clase;
	private $_codigoJS;
	private $_template = array();
	private $_graficas = array();
	private $_nameCrudTable = null;


	public function __construct($generator,$bd,$tablas,$form,$btnsTabla=array(),$btnsBarra=array(),$clase="",$reports="",$codigoJS="",$template=array(), $graficas=array() ) {
		parent::__construct();
		$this->forzarLogin();

		$this->_registry = Registry::getInstancia(); // <--- MULTI_BD
		if(isset($bd["conexion"]) )
        	$this->_db = $this->_registry->_db[ $bd["conexion"] ]; // <--- MULTI_BD
        else
        	$this->_db = $this->_registry->_db['local']; // <--- MULTI_BD

        //echo "---------------------->Ok: ".$bd["conexion"]." --";	
	
		//Los valores recibidos por boostrap.php son almacenados en propiedades.
		$this->_c = $generator;
		$this->_bd = $bd;
		$this->_form = $form;
		$this->_reports = $reports;
		$this->_tablas = $tablas;
		$this->_btnsTabla = $btnsTabla;
		$this->_btnsBarra = $btnsBarra;
		$this->_codigoJS = $codigoJS;
		$this->_nomSingular = $bd['nomSingular'];
		$this->_nomPlural = $bd['nomPlural'];
		$this->_template = $template;
		$this->_graficas = $graficas;

		if(!isset($this->_bd["btnOpciones"]) ) $this->_bd["btnOpciones"] = true;



		//se carga el Modelo "generatorModel.php"
		$this->_m = $this->loadModel($this->_m);



		//Se envian valores enviandos por boostrap.php y son enviandos al Model
		$this->_m->setInfo($this->_bd);

		$this->_m->setForm($this->_form);


		$this->_m->setTablas($this->_tablas);

		$this->_m->setTemplate($this->_template);



		//$this->_columnas = $this->getColumnas();




		$this->_clase = $clase;
		
	}


	public function exec($m="index", ...$p){

			//echo "----$m ----";

			//print_r($p);
			//$x  = "3,6";

			//$m= $m."(".$p[0].",".$p[1].")";

			//echo "-- $m --";

//			$this->_clase->$m;
			//$p = "";
			//array_unshift($p,$this->_view);

			call_user_func_array(array($this->_clase, $m), $p);

			//echo "--- $x --";
	}

	public function get_datos_form($id='0',$idIdioma='0', $duplicar = 0, $filtro = 0)
	{
		
		//$this->_acl->acceso('edit-'.$this->_c);
		// 1) Reemplazo [IDPADRE] dentro de cada sub‐form de los crud-table
		
		// 1) Reemplazo [IDPADRE] en cualquier campo oculto
		foreach ($this->_form as &$campo) {
			if (
				isset($campo['tipo'], $campo['value'])
				&& $campo['tipo'] === 'oculto'
				&& $campo['value'] === '[IDPADRE]'
			) {
				$campo['value'] = intval($filtro);
			}
		}
		unset($campo);

		$cont = 0;
		foreach ($this->_form as $campo) {

			//Si el componente tiene la propiedad datosSQL, obtengo los datos con la consulta SQL
			if(isset($campo['datosSQL'])){
				$datos_sql = array();
				$datos_sql = $this->_m->getInfoInput( str_replace('[IDEDITAR]',$id,$campo['datosSQL'] ) );
				if($this->_form[$cont]['tipo'] == "select")
					array_unshift($datos_sql, array('ID' => '','CAMPO' => "Seleccione..."));
				$this->_form[$cont]['datos'] = $datos_sql; 
			}

			//Si el componente tiene la propiedad sql, almaceno las consultas SQL en un array (usado en componentes Ajax)
			if(isset($campo['sql'])){
				$this->_arraySQL[ $campo['campo'] ] = $campo['sql'];
			}

			$cont++;
		} //foreach
		//print_r($this->_form);
		
		if(@$this->_bd["idIdioma"]!="" and @$this->_bd["idIdGrupoIdioma"]!="" ){
			$idiomas = $this->_m->getIdiomas();
				if($idIdioma=='0') $idIdioma=1;
				$this->_view->assign('idiomas',$idiomas);
				$this->_view->assign('ididioma',$idIdioma);
				$this->_view->assign('idgrupoidioma',$id);
			
				//getInfoByIdGrupoIdioma
				$datos = $this->_m->getInfoById($id,$idIdioma,$this->_c,$duplicar);
				/*
				echo "<pre>";
				print_r($datos);
				echo "</pre>";
				*/
				if($datos==1){ 
					//echo "-------------------> Si HAY"; 
					$datos = array();
					$datos["id_grupo_idioma"] = $id;
					$datos["id_idioma"]=$idIdioma;
					//$datos["id"] = "";
				}
				if(!isset( $datos["id"]) ) $datos["id"] = "0";
				$datos["id_grupo_idioma"] = $id;
				$datos["id_idioma"]=$idIdioma;
				//echo "-------------------> a NO HAY"; 
				$datos = $this->data_untransform($datos);
				$this->_view->assign('d',$datos);

		}else{

			if($id!='0' AND !empty($id))
			{	
				$datos = $this->_m->getInfoById($id,0,$this->_c,$duplicar);



				if(count($datos)==0) {
					echo "Acción no permitida.";
					exit;
				}else{
					// $datos = $this->data_untransform($datos);
					$this->_view->assign('d',$datos);
				}
			}
			
		}
	}


	public function editar($id=0,$idIdioma='0', $duplicar = 0,$filtro=0,$nameCrudTable=null)
	{	
		

		//print_r($this->_form);

		$this->_view->assign('filtro',$filtro);
		$this->_view->assign('parentId', $id);
		$this->_view->assign('nameCrudTable', $nameCrudTable);
		$this->_nameCrudTable = $nameCrudTable;
		
		$this->_view->assign('subtitulo',$this->_nomSingular.": ".$id); //<-- al parecer no se esta usando
		$this->_view->assign('csseditar',$this->_bd["cssEditar"]);
		$this->_view->assign('codigoJS',$this->_codigoJS);

		$this->_view->assign('nomsingular',$this->_nomSingular);
		$this->_view->assign('nomplural',$this->_nomPlural); //<-- al parecer no se esta usando
		$this->_view->assign('controlador',$this->_c);
		$this->_view->assign('BASE_URL',BASE_URL);
		$this->_view->assign('BASE_URL_VIEW',BASE_URL_VIEW);
		//$this->_view->assign('datosf',$this->_form);	

		//usado en el componete crud-table
		 // 3) PRECÁLCULO de columnas para **cada** crud-table incrustado en el padre
		//    Guardamos en un array $columnas_per_sub[nameCrudTable] => [...columnas]
		
		// antes de entrar al bucle, guarda el contexto “padre”
		$origBd     = $this->_bd;
		$origForm   = $this->_form;
		$origTablas = $this->_tablas;
		$columnas_per_sub = [];


		foreach ($this->_form as $el) {
			// --- restaura contexto padre ---
			$this->_bd     = $origBd;
			$this->_form   = $origForm;
			$this->_tablas = $origTablas;
			$this->_m->setInfo  ($this->_bd);
			$this->_m->setForm  ($this->_form);
			$this->_m->setTablas($this->_tablas);
			if (isset($el['tipo']) && $el['tipo'] === 'crud-table') {
				// --- contexto hijo ---
				$this->_bd     = $el['bd'];
				$this->_form   = $el['form'];
				$this->_tablas = $el['tablas'];

				// aquí plantamos el default para btnOpciones
				if (!isset($this->_bd['btnOpciones'])) {
					$this->_bd['btnOpciones'] = true;
				}
				
				// informa al modelo
				$this->_m->setInfo   ($this->_bd);
				$this->_m->setForm   ($this->_form);
				$this->_m->setTablas ($this->_tablas);

				// Reemplazo [IDPADRE] en el SQLDeplegar si existe
				if (!empty($this->_bd['sqlDeplegar'])) {
					$sql = str_replace(
						'[IDPADRE]',
						intval($id),  // <-- aquí
						$this->_bd['sqlDeplegar']
					);
					$this->_m->setInfo(array_merge($this->_bd, ['sqlDeplegar'=>$sql]));
				}
				// Obtengo las columnas (o bien bd['columnas'], o por esquema)
				$cols = !empty($this->_bd['columnas'])
					? $this->_bd['columnas']
					: $this->getColumnas();
					//print_r($el['name_crud_table']);
				$columnas_per_sub[$el['name_crud_table']] = $cols;
			}
		}
		//print_r($columnas_per_sub);
		$this->_view->assign('columnas_per_sub', $columnas_per_sub);

		
		

		// 4) Si NO estoy editando un sub-Generator concreto:
		if (!$nameCrudTable) {
			
			// Calculo y asigno las columnas del grid padre
			$this->_columnas = $this->getColumnas();					
			$this->_view->assign('columnas', $this->_columnas);
			if( isset($this->_form) )
				$this->get_datos_form($id, $idIdioma, $duplicar, $filtro);
		}

		// 5) Ahora asigno al form global (del padre)
		$this->_view->assign('datosf', $this->_form);
		
		 // 6) Si la URL trae un nameCrudTable, sobreescribo el contexto para ese hijo
		if ($nameCrudTable) {
			foreach ($this->_form as $el) {
				if (
					isset($el['tipo'], $el['name_crud_table']) &&
					$el['tipo']==='crud-table' &&
					$el['name_crud_table']===$nameCrudTable
				) {
					// a) Sobrescribo BD / FORM / TABLAS
					$this->_bd     = $el['bd'];
					$this->_form   = $el['form'];
					$this->_tablas = $el['tablas'];

					// b) Reemplazo [IDPADRE] en sqlDeplegar
					if (!empty($this->_bd['sqlDeplegar'])) {
						$this->_bd['sqlDeplegar'] = str_replace(
							'[IDPADRE]',
							intval($id),
							$this->_bd['sqlDeplegar']
						);
					}

					if (isset($el['template']) && is_array($el['template'])) {
						$this->_template = $el['template'];
						$this->_view->assign('template', $this->_template);
					}

					// c) Informo al modelo
					$this->_m->setInfo  ($this->_bd);
					$this->_m->setForm  ($this->_form);
					$this->_m->setTablas($this->_tablas);

					// d) **¡Aquí llamamos a get_datos_form con el sub-form ya sobrescrito!**
					if( isset($this->_form) )
					$this->get_datos_form($id, $idIdioma, $duplicar, $filtro);

					// d) Recalculo y reasigno columnas SOLO de este sub-Generator
					$this->_columnas = $this->getColumnas();
					$this->_view->assign('columnas', $this->_columnas);

					// e) Reasigno datosf para que el form muestre solo los campos del hijo
					$this->_view->assign('datosf', $this->_form);					
					break;
				}
			}
		}


		
		$this->_view->renderizar('editar',true);
	}


	//carga los datos en el form
	public function editar_modal($idFiltro=0)
	{	
		// 1) Recupero los parámetros de POST
		$id_reg          = $_POST['id_reg']       ?? 0;
		$idIdioma        = $_POST['id_idioma']    ?? 0;
		$duplicar        = $_POST['duplicar']     ?? 0;
		$filtro          = $_POST['filtro']       ?? 0;
		$nameCrudTable   = @$_POST['name_crud_table'];
		
		// 3) PRECÁLCULO de columnas para **cada** crud-table incrustado en el padre
		//    Guardamos en un array $columnas_per_sub[nameCrudTable] => [...columnas]
		$origBd     = $this->_bd;
		$origForm   = $this->_form;
		$origTablas = $this->_tablas;
		$columnas_per_sub = [];
		foreach ($this->_form as $el) {
			// --- restaura contexto padre ---
			$this->_bd     = $origBd;
			$this->_form   = $origForm;
			$this->_tablas = $origTablas;
			$this->_m->setInfo  ($this->_bd);
			$this->_m->setForm  ($this->_form);
			$this->_m->setTablas($this->_tablas);
			if (isset($el['tipo']) && $el['tipo'] === 'crud-table') {
				// --- contexto hijo ---
				$this->_bd     = $el['bd'];
				$this->_form   = $el['form'];
				$this->_tablas = $el['tablas'];

				// aquí plantamos el default para btnOpciones
				if (!isset($this->_bd['btnOpciones'])) {
					$this->_bd['btnOpciones'] = true;
				}
				
				// informa al modelo
				$this->_m->setInfo   ($this->_bd);
				$this->_m->setForm   ($this->_form);
				$this->_m->setTablas ($this->_tablas);

				// Reemplazo [IDPADRE] en el SQLDeplegar si existe
				if (!empty($this->_bd['sqlDeplegar'])) {
					$sql = str_replace(
						'[IDPADRE]',
						intval($id),  // <-- aquí
						$this->_bd['sqlDeplegar']
					);
					$this->_m->setInfo(array_merge($this->_bd, ['sqlDeplegar'=>$sql]));
				}
				// Obtengo las columnas (o bien bd['columnas'], o por esquema)
				$cols = !empty($this->_bd['columnas'])
					? $this->_bd['columnas']
					: $this->getColumnas();
					//print_r($el['name_crud_table']);
				$columnas_per_sub[$el['name_crud_table']] = $cols;
			}
		}

		$this->_view->assign('columnas_per_sub', $columnas_per_sub);

		// 4) Si NO estoy editando un sub-Generator concreto:
		//entra cuand padre edit tiene modal como e hijo tiene crud-table
		if (!$nameCrudTable) {
			// Calculo y asigno las columnas del grid padre
			$this->_columnas = $this->getColumnas();
			$this->_view->assign('columnas', $this->_columnas);
			if( isset($this->_form) )
				$this->get_datos_form($id_reg, $idIdioma, $duplicar, $filtro);
		}

		// 5) Ahora asigno al form global (del padre)
		$this->_view->assign('datosf', $this->_form);

		// 2) Si es un sub-Generator, override **antes** de get_datos_form()
		//entra cuand padre edit esta en complet_page e hijo tiene crud-table
		if ($nameCrudTable) {
			foreach ($this->_form as $el) {
				if (
					isset($el['tipo'], $el['name_crud_table']) &&
					$el['tipo']             === 'crud-table'                &&
					$el['name_crud_table']  === $nameCrudTable
				) {
					// a) Sobrescribo BD, form y tablas
					$this->_bd     = $el['bd'];
					$this->_form   = $el['form'];
					$this->_tablas = $el['tablas'];

					// b) Reemplazo [IDPADRE] en SQL si aplica
					if (!empty($this->_bd['sqlDeplegar'])) {
						$this->_bd['sqlDeplegar'] = str_replace(
							'[IDPADRE]',
							intval($filtro),
							$this->_bd['sqlDeplegar']
						);
					}

					if (isset($el['template']) && is_array($el['template'])) {
						$this->_template = $el['template'];
						$this->_view->assign('template', $this->_template);
					}

					// c) Informo al modelo
					$this->_m->setInfo  ($this->_bd);
					$this->_m->setForm  ($this->_form);
					$this->_m->setTablas($this->_tablas);

					// d) **¡Aquí llamamos a get_datos_form con el sub-form ya sobrescrito!**
					if( isset($this->_form) )
					$this->get_datos_form($id_reg, $idIdioma, $duplicar, $filtro);

					// d) Recalculo y reasigno columnas SOLO de este sub-Generator
					$this->_columnas = $this->getColumnas();
					$this->_view->assign('columnas', $this->_columnas);

					// e) Reasigno datosf para que el form muestre solo los campos del hijo
					$this->_view->assign('datosf', $this->_form);					
					break;
				}
			}
		}

		//traigo los datos guardados, si existe el formulario en el archivo generator 
		if(isset($this->_form))
			$this->get_datos_form($id_reg, $idIdioma, $duplicar,$filtro);
		$this->_view->assign('filtro',$filtro);
		$this->_view->assign('parentId', $id_reg);
		$this->_view->assign('nameCrudTable',  $nameCrudTable);
		$this->_view->assign('ventana_modal',true); //Para evitar que se carguen librerías que ya están en el index (ejem: app.js)
		$this->_view->assign('csseditar',$this->_bd["cssEditar"]);
		$this->_view->assign('codigoJS',$this->_codigoJS);
		$this->_view->assign('controlador',$this->_c);
		$this->_view->assign('datosf',$this->_form);
		$this->_view->assign('BASE_URL',BASE_URL);
		$this->_view->assign('BASE_URL_VIEW',BASE_URL_VIEW);
		$this->_view->renderizar('form',true,true);

	}

	public function detalles($id_reg='0')
	{
		//$this->_acl->acceso('see-'.$this->_c);
		if($id_reg!='0')
		{	
			//traigo los datos guardados, si existe el formulario en el archivo generator 
			if(isset($this->_form))
				$this->get_datos_form($id_reg);
			//$datos = $this->_m->getInfoById($id_reg,0,$this->_c);
			//$this->_m->putLog($this->_c, 4, $id_reg);
			//print_r($datos);
			//$this->_view->assign('d',$datos);			

			$this->_view->assign('detalles',"readonly");
			$this->_view->assign('csseditar',$this->_bd["cssEditar"]);

			$this->_view->assign('nomsingular',$this->_nomSingular);
			$this->_view->assign('nomplural',$this->_nomPlural);
			$this->_view->assign('controlador',$this->_c);

			$this->_view->assign('datosf',$this->_form);
			$this->_view->assign('BASE_URL',BASE_URL);
			$this->_view->assign('BASE_URL_VIEW',BASE_URL_VIEW);
			$this->_view->renderizar('editar',true);
		}
	}

	public function detalles_modal()
	{
		//$this->_acl->acceso('see-'.$this->_c);

		$id_reg = $_POST['id_reg'];
		$idIdioma = $_POST['id_idioima'];
		$duplicar = $_POST['duplicar'];
		if($id_reg!='0')
		{
			//traigo los datos guardados, si existe el formulario en el archivo generator 
			if(isset($this->_form))
				$this->get_datos_form($id_reg, $idIdioma, $duplicar);
			//$datos = $this->_m->getInfoById($id_reg,0,$this->_c);
			//$this->_m->putLog($this->_c, 4, $id_reg);
			
			//$this->_view->assign('d',$datos); //valores en BD
			$this->_view->assign('ventana_modal',true); //Para evitar que se carguen librerías que ya están en el index (ejem: app.js)
			$this->_view->assign('detalles',"readonly");
			$this->_view->assign('csseditar',$this->_bd["cssEditar"]);

			$this->_view->assign('nomsingular',$this->_nomSingular);
			$this->_view->assign('nomplural',$this->_nomPlural);
			$this->_view->assign('controlador',$this->_c);

			$this->_view->assign('datosf',$this->_form); //Envió los datos del formulario (no los datos ingresados por el usuario)
			$this->_view->assign('BASE_URL',BASE_URL);
			$this->_view->assign('BASE_URL_VIEW',BASE_URL_VIEW);
			$this->_view->renderizar('detalles',true,true);
		}
	}

	public function guardar(){
		//$this->_acl->acceso('edit-'.$this->_c);
		//print_r($_FILES);
		
		//si existen campos tipo file
		if(!empty($_FILES)) 
			$post = array_merge($_POST, $_FILES);
		else
			$post = $_POST;
		
		// 1) ¿Es un guardado de sub‐Generator?
		$nameCrudTable = $post['name_crud_table'] ?? null;
		if ($nameCrudTable) {
			// Recorremos la definición de form padre para encontrar el hijo
			foreach ($this->_form as $el) {
				if (
					isset($el['tipo'], $el['name_crud_table']) &&
					$el['tipo']==='crud-table' &&
					$el['name_crud_table']===$nameCrudTable
				) {
					// — Sobrescribimos BD, form y tablas —
					$this->_bd     = $el['bd'];
					$this->_form   = $el['form'];
					$this->_tablas = $el['tablas'];

					// — Informamos al modelo —
					$this->_m->setInfo  ($this->_bd);
					$this->_m->setForm  ($this->_form);
					$this->_m->setTablas($this->_tablas);
					break;
				}
			}
		}

		//Aplico función que modifica los datos antes de guardarlos 
		//$post = $this->data_transform($post);

		$res = $this->_m->putInfo($post, $this->_c);
		$response = array();
		//if(is_numeric($res))
		if(($res))
		{
			$response["id"] = $res;
			$response["msg"] = "Guardado con el id ";
		}
		else
		{
			$response["id"] = 0;
			$response["msg"] = $res;
		}

	

		ob_end_clean();
		echo json_encode($response);

	}

	public function reporte($id)
	{
		$res = $this->_m->getInfoInput($this->_reports[$id]["sql"]);
		$this->excell($res);
	}

	public function index($filtro='')
	{




		//$this->_acl->acceso('see-'.$this->_c);
		
		//Este IF no es necesario, se puede evitar, es solo para precargar el formulario en ventana modal la primera vez que se abra
		if(isset($this->_template['editForm'])){
			//Verifico si el formulario será en pantalla completa o en ventana modal
			if($this->_template['editForm'] == 'modal'){
				//$this->get_datos_form($id, $idIdioma, $duplicar);
				$this->_view->assign('datosf',$this->_form);
			}
		}
		//$res = $this->_m->getInfo();

		//$paginador = new Paginador();
		//$this->_view->assign('idt',$this->_bd["idDeplegar"]);
		//$x =  $paginador->paginar($res, $pagina,15);  
		//$this->_view->assign('info',$x);
		//$columnas = array('0' => 'ID', '1' => 'PAGINA', '2' => 'columns');
		//print_r($this->_columnas);
		$this->_view->assign('filtro'  ,  $filtro);
		$this->_columnas = $this->getColumnas();
		$this->_view->assign('columnas',  $this->_columnas);
		$this->_view->assign('reports'  , $this->_reports ); 
		//$this->_view->assign('btnsTabla',$this->_btnsTabla);
		//$this->_view->assign('btnsBarra',$this->_btnsBarra);

		//print_r($paginador->paginar($res, $pagina,10));
		//$this->_view->assign('paginacion', $paginador->getView('prueba', $this->_c.'/index'));
		
		$tablaResponsiva = (isset($this->_bd['tablaResponsiva']) ? $this->_bd['tablaResponsiva'] : 'true');
		//$tablaScrollX    = (isset($this->_bd['tablaScrollX']) ? $this->_bd['tablaScrollX'] : 'false');
		$tablaScrollX    = (isset($this->_bd['tablaScrollX']) ? (bool)$this->_bd['tablaScrollX'] : false);
		$urlbarra        = (isset($this->_bd['urlbtnregresar']) ? $this->_bd['urlbtnregresar'] : ''); 
		$checkbox_column = (isset($this->_bd['checkbox_column']) ? $this->_bd['checkbox_column'] : false); 
		
		$this->_view->assign('codigoJS',$this->_codigoJS);
		$this->_view->assign('graficas'  , $this->_graficas );
		$this->_view->assign('checkbox_column',$checkbox_column);
		$this->_view->assign('urlbarra',$urlbarra);
		$this->_view->assign('csseditar',@$this->_bd["cssEditar"]);
		$this->_view->assign('tablaScrollX',$tablaScrollX);
		$this->_view->assign('tablaResponsiva',$tablaResponsiva);
		$this->_view->assign('nomsingular',$this->_nomSingular);
		$this->_view->assign('nomplural'  ,$this->_nomPlural  );
		$this->_view->assign('controlador',$this->_c          );
		$this->_view->assign('template',$this->_template);
		$this->_view->assign('bd',$this->_bd);
		$this->_view->assign('BASE_URL',BASE_URL);



		//$this->_view->assign('total',count($res));
		$this->_view->renderizar('index',true);

	}



	public function eliminar($id = null, $return = false, $nameCrudTable = null)
	{
		//$this->_acl->acceso('delete-'.$this->_c);
		//$id = (int)$id; //El ID podrá ser cadena
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id = (int)$_POST['id']; 
			$nameCrudTable = $_POST['name_crud_table'];
		}
		$res ="";
		$mensaje_error = "";

		// 2) Si es un sub‐generator válido, sobreescribo BD/form/tablas
		if ($nameCrudTable) {
			foreach ($this->_form as $el) {
				if (
					isset($el['tipo'], $el['name_crud_table']) &&
					$el['tipo'] === 'crud-table' &&
					$el['name_crud_table'] === $nameCrudTable
				) {
					$this->_bd     = $el['bd'];
					$this->_form   = $el['form'];
					$this->_tablas = $el['tablas'];
					// actualizo contexto del modelo
					$this->_m->setInfo  ($this->_bd);
					$this->_m->setForm  ($this->_form);
					$this->_m->setTablas($this->_tablas);
					$controllador = $nameCrudTable;
					break;
				}else{
					$controllador = $this->_c;
				}
			}
		}
		if($id){			
			$res = $this->_m->eliminar($id, $controllador); //retorna 1
			//Verifico si existe algún archivo del registro eliminado 
			if ($res) {
				foreach ($this->_form as $campo) {
					if (!empty($campo['tipo']) && $campo['tipo'] === 'uploadfile') {
						$ruta = rtrim($campo['path'], '/')."/".$id;
						if (file_exists($ruta)) {
							$this->delete_folder($ruta);
						}
					}
				}
			}
		}else
			$mensaje_error = "No se encontró el id del registro";

		/*
		echo "--".$res."--";
		echo "<pre>";
		print_r($res); 
		echo "</pre>";
		*/
		if($mensaje_error)
		{
			$response["status"] = 0;
			$response["msg"] = $mensaje;
		}
		elseif($res or is_array($res))
		{
			$response["status"] = 1;
			$response["msg"] = "";
		}
		else
		{
			$response["status"] = 0;
			$response["msg"] = $res;
		}

		if($return)
			return $response;
		else
			echo json_encode($response);
	}

	/*public function busqueda($palabra="",$pagina=false)
	{
		//echo "-------------> $palabra";
		$palabraOriginal = str_replace("_", " ", $palabra);

		$palabra = strtoupper($palabra);
		$res = $this->_m->busqueda(strip_tags($palabra));

	//	print_r($res);

		$paginador = new Paginador();

		$this->_view->assign('palabra',$palabraOriginal);
		$this->_view->assign('idt',$this->_bd["idDeplegar"]);
		$this->_view->assign('info', $paginador->paginar($res, $pagina,10));
		$this->_view->assign('paginacion', $paginador->getView('prueba', $this->_c.'/busqueda'.'/'.$palabra));
		$this->_view->assign('nomsingular',$this->_nomSingular);
		$this->_view->assign('nomplural',$this->_nomPlural);
		$this->_view->assign('controlador',$this->_c);
		$this->_view->assign('total',count($res));

		$this->_view->renderizar('index',true);
	}*/




	public function op($table,$id,$campo)
	{
		$res = $this->_m->cargarOpciones($table,$id,$campo);
		$response["status"] = 1;
		$response["info"] = $res;
		echo json_encode($response);
	}
	private function verificaSQL(){
		$cont = 0;
		foreach ($this->_form as $sql) {

			if(isset($sql['sql'])){
				$this->_arraySQL[ $sql['campo'] ] = $sql['sql'];
			}

			$cont++;
		}
	}

		
	private function verificaSQLTablas(){

		foreach ($this->_form as $sql) {

			if(isset($sql['sql'])){
				$this->_arraySQL[ $sql['id'] ] = $sql['sql'];
			}

			$cont++;
		}
	}

	public function infosearch($campo,$numero="no",$id=0){
		//$this->_acl->acceso('see-'.$this->_c);

		if( ($numero=="si" and is_numeric($id) ) or $numero=="no"  ) { 

		//echo $numero." - ".$id;
		$this->verificaSQL();

		$res = $this->_m->getInfoSQL( $this->_arraySQL[$campo],$id);
		if(count($res)>0 and isset($res["DENOMINA"])){
			$response["info"] = $res["DENOMINA"];
		}else{
			$response["info"]="";
		}
		$response["status"] = 1;
		//print_r($this->_arraySQL);
		echo json_encode($response);
	  }else{
	  	$response["status"] = 0;
	  	echo json_encode($response);
	  }
	}

	public function gettable($tabla,$id){
			$this->verificaSQLTablas();
			$thearray[":id"] = $id;
			$res = $this->_m->execSQL( $this->_arraySQL[$tabla],$thearray);
			if(count($res)>0 ){ 
				$table = '<table class="table table-striped table-bordered"> <thead  class="thead-dark" ><tr>';
				foreach ($res[0] as $key => $fila) {
					$table = $table."<th>".$key."</th>";
				}

				$table = $table.'<tr></thead>';

				foreach ($res as $keyR => $filaR) {
					$table=$table."<tr>";
					foreach ($filaR as $keyC => $filaC) {
						$table=$table."<td>".$filaC."</td>";
					}
					$table=$table."</tr>";
				}
				$table = $table."</table>";
			}else{
				$table = "No hay resultados";
			}
			$response["msg"] = $table ;
			$response["status"] = 1;

			echo json_encode($response);
	}

	public function examinar($campo){

			//print_r($_POST);
			
			$palabra = $_POST["palabra"];
			//echo "Buésqueda: $palabra";

		$this->verificaSQL();
		$res = $this->_m->searchInfoSQL( $this->_arraySQL[$campo],$this->normaliza($palabra));
		if(isset($res) and is_array($res)){
			//echo "--->$campo";
		    echo"<table id=\"grid\" class=\"table table-bordered table-hover table-striped\">
                <thead style=\"background-color: #EEB;\">
                    <tr>
                        <th>ID</th>
                        <th>DENOMINA</th>

                        <th> </th>

                    </tr>
                </thead>
                <tbody>";
        foreach($res as $fila){           
        echo"
                 <tr>
                    <th>".$fila["ID"]."</th>
                    <td>".$fila["DENOMINA"]."</td>
                    <th><button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"sel_$campo('".$fila["ID"]."','".$fila["DENOMINA"]."') \">Seleccionar</button> </th>
                </tr>
            ";
        }
        echo"
        </tbody>
        </table>";

    	}else{
    		echo "Sin resultados";
    	}
	}

	public function get_lista_dependiente($idCampoHijo, $valorSelecCampoPadre = false, $value_selected = 0){		
		$this->verificaSQL();
		$cad="<option value=''>Seleccione...</option>";  

		if($valorSelecCampoPadre){
			//string que remplazo/ valor que asigno/ cadena donde esta el strng que voy a remplazar
			$consulta_sql = str_replace("[valor_padre]", $valorSelecCampoPadre, $this->_arraySQL[$idCampoHijo]); 
			$res = $this->_m->get_opciones_listas_dependientes($consulta_sql);

			    
	      
			if(is_array($res)){
				//Si solo es una opción, la envío sin el valor "seleccione..." para que automaticamente quede seleccionado
				if(count($res)==1) 
				  $cad="";
				foreach ($res as $key => $f) {
				    if($value_selected==$f["ID"]) $s = " selected "; else $s = "";
				    $cad.="<option $s value='".$f["ID"]."'>".$f["CAMPO"]." </option>";
				}
			}
		}
		

		echo $cad;
		//print_r($this->_arraySQL);
	}

	function normaliza ($cadena){
		$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
	ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
		$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
	bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
		$cadena = utf8_decode($cadena);
		$cadena = strtr($cadena, utf8_decode($originales), $modificadas);
		$cadena = strtolower($cadena);
		return utf8_encode($cadena);
	}

	public function get_registros($post, $filtro=""){
		

		$res = array(
			'draw' => $draw,
			'totalRecords' => $totalRecords,
			'totalRecordwithFilter' => $totalRecordwithFilter,
			'empRecords' => $empRecords
		);

		return $res;
	}

	//retorna la consulta para hacer la búsqueda de un valor en una columna de la tabla 
	public function get_searchQuery_byCol($columns){
		//print_r($columns);
		$comilla = $this->get_comilla();
		$searchQuery = "";
		## BUSCAR POR CAMPOS
		foreach ($columns as $key => $columna) {
			$valor = $columna['search']['value'];

			/*if($this->_db->manager=="oracle"){
				$valor = strtoupper($valor);
			}*/
		
			$col = $columna['name']; 
			if($col){
				if($valor != ''){
					$valor = $this->formatear_valor_busqueda($valor);
					if(DB['local']['MANAGER']=="oracle"){						
						$searchQuery .= " and REPLACE(upper($comilla".$col."$comilla), 'ÁÉÍÓÚÑ', 'AEIOUN') ".$valor;
					}else{ 
						$searchQuery .= " and $comilla".$col."$comilla ".$valor;
					}					
				}
			}			
		}
		return $searchQuery;
	}

	public function get_comilla(){
		if(DB['local']['MANAGER']=="oracle"){
			$comilla = '"';
		}
		else
		{
			$comilla = '`';
		}
		return $comilla;
	}

	public function buscar($filtro=""){
		// Limpia cualquier buffer de Smarty u otro
		/*while (ob_get_level()) { ob_end_clean(); }
		// Avisa que vas a devolver JSON
		header('Content-Type: application/json; charset=utf-8'); */


		// 1) Capturamos el parámetro que viene por POST
        $nameCrudTable = trim($_POST['name_crud_table'] ?? '');
        $this->_nameCrudTable = $nameCrudTable;
        // 2) Si es un sub-generator válido, recargamos BD/FORM/TABLAS
        if ($nameCrudTable !== "" && $this->isValidSubGenerator($nameCrudTable)) {
			// Recorro la configuración de formulario para encontrar el f que coincide
			foreach ($this->_form as $f) {
				if (isset($f['name_crud_table']) && $f['name_crud_table'] === $nameCrudTable ) {
					// Sobreescribo la configuración del controller
					$this->_bd     = $f['bd'];
					$this->_form   = $f['form'];
					$this->_tablas = $f['tablas'];

					// Restaurar el default de btnOpciones si no está
					if (!isset($this->_bd['btnOpciones'])) {
						$this->_bd['btnOpciones'] = true;
					}

					// — Sustituyo [IDPADRE] en sqlDeplegar por el filtro (ID del padre) —
					$this->_bd['sqlDeplegar'] = str_replace(
						'[IDPADRE]',
						intval($filtro),           // $filtro viene de la URL: /…/buscar/{filtro}
						$this->_bd['sqlDeplegar']
					);

					if (isset($f['template']) && is_array($f['template'])) {
						$this->_template = $f['template'];
					}

					// Se la mando al modelo
					$this->_m->setInfo   ($this->_bd);
					$this->_m->setForm   ($this->_form);
					$this->_m->setTablas ($this->_tablas);

					 // **¡Aquí** recalculas las columnas**!**
					$this->_columnas = $this->getColumnas();

					// Y si la vista los consume directamente:
					$this->_view->assign('columnas', $this->_columnas);
					break;
				}
			}
		}else{			
			$this->_columnas = $this->getColumnas();
		}
		
		$comilla = $this->get_comilla();
		
		//$datos = $this->_pruebas->get_conceptos_lista();
		
		## Read value
		//print_r($_POST);
		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = $comilla.$_POST['columns'][$columnIndex]['data'].$comilla; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		//$searchValue = mysqli_real_escape_string($con,$_POST['search']['value']); // Search value
		$searchValue = $_POST['search']['value']; // Search value
		$columns = $_POST['columns']; // columnas
		
		## BUSCAR POR CAMPOS
		##Retorna la consulta para hacer la búsqueda de un valor en una columna de la tabla 
		$searchQuery = $this->get_searchQuery_byCol($columns);
		
		## Número total de registros sin filtrar
		$totalRecords = $this->_m->get_total_sin_filtrar($filtro); 
		## Número total de registro con filtrado
		$totalRecordwithFilter = $this->_m->get_total_con_filtro($searchQuery,$searchValue);
		## Obtener registros
		$empRecords = $this->_m->get_datos($searchQuery, $columnName, $columnSortOrder, $row, $rowperpage,$searchValue,$filtro);
		
		
		$data = array();
		//$array_btns = $this->_bd["buttons"]; //array con todos los botones
		//$this->_columnas = $this->getColumnas();
		$columnas = $this->_columnas;	//array de las columnas			
		$idDeplegar = $this->_bd["idDeplegar"];	//nombre del id (debe ser ID)

		//Preparo los datos para ser enviados a la tabla de la vista (DataTable)
		if(is_array($empRecords)){ //Verifico si hay registros encontrados 
			foreach ($empRecords as $i => $row) { 
				$row = $this->data_untransform($row);
				$data[$i]["DT_RowId"] = "fila_id_".$row[$idDeplegar];
				foreach ($columnas as $columna) {
					$campo = $columna['campo']; 
					if(isset($row[$campo]) OR isset($this->_bd["checkbox_column"])){ //si el nombre de columna esta en la consulta sql 
						if($campo == 'checkbox_column'){
							$datos = $row['ID'];
						}else
							$datos = str_replace("[idDesplegar]",$row[$idDeplegar],$row[$campo]); //[idDesplegar] se usa para campos que tienen links "<a>"
						//Aplicamos el diseño “badge” de Bootstrap al texto si la propiedad 'status_style' existe en el array 'columnas'
						if(isset($columna['status_style'])){
							foreach ($columna['status_style'] as $key => $s) {
								if( $datos ==  $s['value']){  
									$text = isset($s['text']) ? $s['text'] : $datos;
 
									$datos = '<span class="badge badge-secondary" style="font-size: 13px; color: '.$s['text_color'].'; background-color: '.$s['background_color'].';">'.$text.'</span>';
								}
							}							
						}
					}else
						$datos = "";

					$data[$i][$campo] = $datos;
				}
				
				if($this->_bd["btnOpciones"])
					$data[$i]["OPCIONES"] = $this->generar_botones($row,$filtro);

			}
		}

		## Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords, //$totalRecords,   $totalRecordwithFilter //Total sin filtro
			"iTotalDisplayRecords" => $totalRecordwithFilter, //Total mostrado, con o sin filtro (contando los registros de las demas páginas)
			"aaData" => $data
		);

		echo json_encode($response);
	}

	//Botones de la lista desplegable de opciones
	public function generar_botones($row,$filtro=""){		
		$btns = '';
		$cadena = "";
		$btnOpciones = $this->_bd["btnOpciones"];
		$idDeplegar = $this->_bd["idDeplegar"];
		// preparamos el sufijo extra para sub-Generator
		$singular = addslashes($this->_nomSingular);
		$nameTableGen    = $this->_nameCrudTable ?? 'grid';

		//Verifico si el formulario será en pantalla completa o en ventana modal 				
		if(isset($this->_template['editForm'] ) AND $this->_template['editForm'] == 'modal'){
			
			//$subSegment = $nameTableGen ? "/{$nameTableGen}" : "";
			// URL path ya con filtro y nameTableGen en la ruta
			$editUrl    = BASE_URL . "{$this->_c}/editar_modal/" . $filtro;
			$modalId = $nameTableGen ? "modal_{$nameTableGen}" : "modal_formulario";
        	$formId = $nameTableGen ? "formp_{$nameTableGen}" : "formp_modal";
			
			$hrefEditar = sprintf(
				"javascript:open_modal_to_edit(%d, %d, %d, '%s', '%s', %d, '%s', '%s', '%s')",
				$row[$idDeplegar],   // idReg
				0,                   // idIdioma
				0,                   // duplicar
				$editUrl,            // editUrl
				$singular,           // singular
				$filtro,             // filtro
				$nameTableGen,             // name_crud_table
				$modalId,
				$formId
			);
			//$hrefEditar = 'javascript:open_modal_to_edit('.$row[$idDeplegar].')';
			$hrefDetalles = 'javascript:open_modal_detalles('.$row[$idDeplegar].')';
			$hrefDuplicar = 'javascript:open_modal_to_edit('.$row[$idDeplegar].',0,1)';
		}else{
			 $hrefEditar   = BASE_URL
                      . "{$this->_c}/editar/"
                      . $row[$idDeplegar]
                      . "/0/0/"
                      . $filtro ."/"
                      . $nameTableGen;					  
			$hrefDetalles = BASE_URL.''.$this->_c.'/detalles/'.$row[$idDeplegar].'/';
			$hrefDuplicar = BASE_URL.''.$this->_c.'/editar/'.$row[$idDeplegar].'/0/1/';
		}

		if($btnOpciones !== false){
			$defaultBtns = array(
				'editar' => array(
					'label'=>'<i class="fas fa-pencil-alt"></i> Editar',
					'class'=>"", 
					'href'=>$hrefEditar,
					'target'=>"_self",
				),			
				'detalles' => array(
					'label'=>'<i class="far fa-file-alt"></i> Detalles',
					'class'=>"", 
					'href'=>$hrefDetalles,
					'target'=>"",
				),
				'duplicar' => array(
					'label'=>'<i class="far fa-copy"></i> Duplicar',
					'class'=>"", 
					'href'=>$hrefDuplicar,
					'target'=>"_self"
				),				
				'eliminar' => array(
					'label'=>'<i class="far fa-trash-alt"></i> Eliminar',
					'class'=>"", 
					'href'=> sprintf(
						"javascript:eliminar_reg_generator('%s', %d, '%s', '%s')",
						BASE_URL . $this->_c,
						$row[$idDeplegar],
						addslashes($this->_nomSingular),
						$nameTableGen
					),
					'target'=>"",
				),
			);
			
			//Obtengo los índices de las opciones por defecto
			$keysDefaultBtns = array_keys($defaultBtns);
			//Verifico si existen el array de opciones en el generator  
			if(is_array($btnOpciones)){ 
				$keysBtnOpciones = array_keys($btnOpciones);
				//elimino los índices duplicados 
				$keysBtn = array_unique(array_merge($keysDefaultBtns, $keysBtnOpciones)); 
			}else
				$keysBtn = $keysDefaultBtns;

			foreach ($keysBtn as $key) {
				if(isset($btnOpciones[$key]))
					if($btnOpciones[$key] === false) //Si la opción está establecida como “false” en el generator, NO la muestro
						continue;

				if(isset($btnOpciones[$key]) AND is_array($btnOpciones[$key])){
					if(isset($defaultBtns[$key]))
						$btn = array_merge($defaultBtns[$key], $btnOpciones[$key]); //Uno los array de las sub-opciones
					else
						$btn = $btnOpciones[$key];
				}else
					$btn = $defaultBtns[$key];


				//Remplazo los nombres de las columnas entre corchetes con su valor (ejemplo [DENOMINACION] => IVAN)					
				$btn = $this->replace_column_with_value($row, $btn);				


				$label = $btn['label'] ? $btn['label'] : '';
				$class = $btn['class'] ? $btn['class'] : '';
				$href = $btn['href'] ? $btn['href'] : '';	
				$target = $btn['target'] ? $btn['target'] : '';				
				$option = '<a class="dropdown-item '.$class.'" href="'.$href.'" alt="" text="" target="'.$target.'">'.$label.'</a>';			

				//verifico si hay condición "mostrar_si" para mostrar la opción al usuario
				if(isset($btn['mostrar_si']) AND $btn['mostrar_si'] !== false){
					$condicion = $btn['mostrar_si'];
					try {						    
					    $condicion = eval("return ".$condicion.";");
					    if($condicion)
					    {
					         $btns .= $option;
					    }
					}catch(ParseError $p){
					    echo "Error en el atributo 'condicion' de la opcion $key del menú desplegable: ",  $p->getMessage(), "\n";
					}						
										    
				}else{ 
					$btns .= $option;
				}		
			}

			$cadena = '
			<div class="btn-group" role="group">				 
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-th-list"> </span> Ver <span class="caret"></span></a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
					'.$btns.'		
				</div>
			</div>';
		}		
		return $cadena;
	}

	function replace_column_with_value($row, $btnOpciones){	
		//print_r($btnOpciones);
		//$condicion = $btn['mostrar_si'];
		$res = array();
		if(is_array($btnOpciones)){
			foreach($btnOpciones as $nomOpcion => $valorOpcion) {				
				foreach($row as $colRow => $valueRow) {					
					//Remplazo los nombres de las columnas entre corchetes con su valor (ejemplo [DENOMINACION] => 'IVAN')
					$valorOpcion = str_replace("[".$colRow."]", $valueRow, $valorOpcion); 
				}
				$res[$nomOpcion] = $valorOpcion;
			}
		}
		return($res);
	}
	
	public function getColumnas(){
		$cols = array();
		$columnas = array();
		$cont = 0;

		

		//COLUMNAS DE LOS DATOS 
		//Obtiene las columnas del array “columnas”
		if(isset($this->_bd["columnas"])){ 
			//COLUMNA DE CHECKBOX 
			if(isset($this->_bd["checkbox_column"])){				
				$columnas[$cont]['campo'] = 'checkbox_column';
				$columnas[$cont]['titulo'] = '<input type="checkbox" name="select_all" value="1" id="grid-select-all">';
				$columnas[$cont]['tipo'] = 'checkbox_column';
				$cont ++;
			}

			foreach ($this->_bd["columnas"] as $columna) {
				$name = strtoupper($columna['campo']);
				$columnas[$cont] = [
					'campo'  => $name,
					'titulo' => $name,
					'tipo'   => 'data',
				];
				$cont++;
			}

			//COLUMNA DE OPCIONES 
			$cols = $columnas;
			if($this->_bd["btnOpciones"] != false ){ 
				$cols[count($columnas)]["campo"] = "OPCIONES";
				$cols[count($columnas)]['titulo'] = 'OPCIONES';
				$cols[count($columnas)]['tipo'] = 'opciones';
			}
		}else{ 		
			//Obtiene las columnas de la consulta sql 	
			$res_cols = $this->_m->getColums();

			
			if($res_cols == 1 OR empty($res_cols))
				$res_cols = array();
			else{
				//COLUMNA DE CHECKBOX 
				if(isset($this->_bd["checkbox_column"])){				
					$columnas[$cont]['campo'] = 'checkbox_column';
					$columnas[$cont]['titulo'] = '<input type="checkbox" name="select_all" value="1" id="grid-select-all">';
					$columnas[$cont]['tipo'] = 'checkbox_column';
					$cont ++;
				}
				foreach ($res_cols as $name_col) {
					$name = strtoupper($name_col);
					$columnas[$cont] = [
						'campo'  => $name,
						'titulo' => $name,
						'tipo'   => 'data',
					];
					$cont++;
				}
				//COLUMNA DE OPCIONES 
				$cols = $columnas;
				if($this->_bd["btnOpciones"] != false ){ 
					$cols[count($columnas)]["campo"] = "OPCIONES";
					$cols[count($columnas)]['titulo'] = 'OPCIONES';
					$cols[count($columnas)]['tipo'] = 'opciones';
				}				
			}			
		}	

			

							//	echo "---------------------------------------------------------------------- ii "; exit(); 

		#print_r($cols);
		#exit;
		return $cols;
		
	}

	//botones del menú principal 
	public function generar_boton($btn_array, $indice_btn, $id_reg=0, $nivel_btn = 1){
		
		$label = '';
		$icon = '';
		$class = '';
		$href = '#';		
		$target = '_self';
		$btn = '';
		$btnDesplegable = false;
		
		if(isset($btn_array[$indice_btn])){
			foreach ($btn_array[$indice_btn] as $indice => $valor) {
				if(is_array($valor)){ 
					if(!$btnDesplegable){
						$btnDesplegable = true;
						$btn .= '<button type="button" class="btn btn-secondary btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <div class="dropdown-menu">';						
					}
					$btn .= $this->generar_boton($btn_array[$indice_btn], $indice, $id_reg, $nivel_btn+1);				
				}else{
					if($valor)
						$$indice = $valor;
				}
				
			}
			if($btnDesplegable)
				$btn .= '</div>';

			//remplazo [idDeplegar] por el valor de ID
			$href = str_replace("[idDeplegar]", $id_reg, $href);
			$href = str_replace("[controlador]", $this->_c, $href);
				
			if($nivel_btn == 1 AND !$btnDesplegable){ //si es nivel 1 es un botón
				$btn .= '<a class="btn '.$class.'" href="'.$href.'" role="button" target="'.$target.'"><i class="fas '.$icon.'"></i> '.$label.'</a>';
			}elseif($nivel_btn == 2){ //si es nivel 2 es un botón desplegable
				$btn .= '<a class="dropdown-item" href="'.$href.'" role="button" target="'.$target.'"><i class="fas '.$icon.'"></i> '.$label.'</a>';
			}			
		}else{
			$btn = "";			
		}
		return $btn;
	}

	function formatear_valor_busqueda($valor){
		$valor = trim($valor); //Elimino espacios al inicio y final de la cadena
		$valor = $this->normaliza($valor); //elimino acentos
		$valor = strtoupper($valor); //Convierto a mayusculas

		$operadores = array("<>",">=","<=","=",">","<","|","IN(");
		
		//verifico si el valor tiene operadores relacionales 
		foreach ($operadores as $operador) {
			$posicion = strpos($valor, $operador); //Verifico si la cadena tiene un operador
			if ($posicion !== false){ //Existe operador en la cadena
				$num_caract = strlen($operador); //Obtiene la longitud del operador, puede ser 1 o 2
				

				if($operador=="|"){
					$porciones = explode("|", $valor );
					if(count($porciones)==2)
					{

						if($this->validar_fecha_espanol($porciones[0])){
							if(DB['local']['MANAGER']=="oracle")
								$porciones[0] = " TO_DATE( '".$porciones[0]."' , 'DD/MM/YYYY' ) ";
							else
								$porciones[0] = "'".$porciones[0]."'";
						}
						if($this->validar_fecha_espanol($porciones[1])){
							if(DB['local']['MANAGER']=="oracle")
								$porciones[1] = " TO_DATE( '".$porciones[1]."' , 'DD/MM/YYYY' ) ";
							else
								$porciones[1] = "'".$porciones[1]."'";
						}

						return ("BETWEEN ".$porciones[0]." AND ".$porciones[1]);
					}
					
				}else if($operador=="IN("){					
					return($valor);					
				}else{ 
					$valor = substr($valor, $num_caract);	//obtengo el valor, sin el operador
					if($this->validar_fecha_espanol($valor)){ //si el valor es una fecha, la formateo 
						if(DB['local']['MANAGER']=="oracle"){
							$valor = " TO_DATE( '".$valor."' , 'DD/MM/YYYY' ) "; 
						}else{
							$valor = "'".$valor."'"; //$valor = " STR_TO_DATE('".$valor."', '%d/%m/%Y')";
						}
						return $operador ." ".$valor." ";
					}
				}

				return $operador ." '".$valor."' ";	
				break;	
			}
		}

		//Verifico si el valor tiene el símbolo de ‘%’ al inicio o al final
		$primer_c = substr($valor, 0, 1); // Obtengo el primer caracter
		$ultimo_c = substr($valor, -1); // Obtengo el ultimo caracter
		if($primer_c == '%' OR $ultimo_c == '%')
			return " like '".$valor."' ";

		
		/*if($this->_db->manager=="oracle"){
		}*/
		
		$valor = " like '%".$valor."%' ";
		return $valor;
	}

	function validar_fecha_espanol($fecha){
		$valores = explode('/', $fecha);
		if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
			return true;
	    }
		return false;
	}

	public function get_datos_select_ajax($campo){

		ob_end_clean();


		//print_r($_POST);
		$palabra = $_POST["palabra"];
		$palabra = trim($palabra);
		if(!empty($palabra)){			
			//echo "Buésqueda: $palabra";

			$this->verificaSQL();
			$res = $this->_m->searchInfoSQLSelect2Ajax( $this->_arraySQL[$campo],$this->normaliza($palabra));

			if(isset($res) and is_array($res)){
				echo json_encode($res);
	    	}
		}else{
			echo '{}';
		}
	}

	public function infosearch_selectajax($campo,$id=false){

		ob_end_clean();

		//$this->_acl->acceso('see-'.$this->_c);		
		if($id ) { 

			//echo $numero." - ".$id;
			$this->verificaSQL();
			//echo "--".$id."--";
			$res = $this->_m->getInfoSQLSelect2Ajax( $this->_arraySQL[$campo],$id);
			if(count($res) > 0 and isset($res["text"])){
				$response["text"] = $res["text"];
				$response["id"] = $res["id"];
			}else{
				$response["text"]="";
				$response["id"]="";
			}
			$response["status"] = 1;
			//print_r($this->_arraySQL);
			echo json_encode($response);
		}else{
			$response["status"] = 0;
			echo json_encode($response);
		}
	}

	public function descargar_resultados(){

		$dt = json_decode($_GET['datos'], true);

		$comilla = $this->get_comilla();
		
		//$datos = $this->_pruebas->get_conceptos_lista();
		$filtro = $dt['filtro'];
		## Read value
		//print_r($_POST);
		$draw = $dt['draw'];
		$row = $dt['start'];
		$rowperpage = $dt['length']; // Rows display per page
		$columnIndex = $dt['order'][0]['column']; // Column index
		$columnName = $comilla.$dt['columns'][$columnIndex]['data'].$comilla; // Column name
		$columnSortOrder = $dt['order'][0]['dir']; // asc or desc
		//$searchValue = mysqli_real_escape_string($con,$dt['search']['value']); // Search value
		$searchValue = $dt['search']['value']; // Search value
		$columns = $dt['columns']; // columnas

		## BUSCAR POR CAMPOS
		##Retorna la consulta para hacer la búsqueda de un valor en una columna de la tabla 
		$searchQuery = $this->get_searchQuery_byCol($columns);
		
		$empRecords = $this->_m->get_datos($searchQuery, $columnName, $columnSortOrder, 0, 0,$searchValue,$filtro);

		$data = array();
		$this->_columnas = $this->getColumnas();
		$columnas = $this->_columnas;	//array de las columnas			
		$idDeplegar = $this->_bd["idDeplegar"];	//nombre del id (debe ser ID)

		//Preparo los datos para ser enviados a la tabla de la vista (DataTable)
		if(is_array($empRecords)){ //Verifico si hay registros encontrados 
			foreach ($empRecords as $i => $row) { 
				foreach ($columnas as $columna) {
					$campo = $columna['campo']; 

					if(isset($row[$campo])) //si el nombre de columna esta en la consulta sql
						$datos = str_replace("[idDesplegar]",$row[$idDeplegar],$row[$campo]);
					else{
						$datos = "";
					}/*else{
						$data[$i][$campo] = "";
					}*/
					$data[$i][$campo] = $datos;
				}

			}
		}


		//echo json_encode($data);
		//print_r($data);
    	$this->excell($data);
  	}
  	

  	public function descargar_resultados_csv(){

		$dt = json_decode($_GET['datos'], true);

		$comilla = $this->get_comilla();
		$filtro = $dt['filtro'];
		$columnIndex = $dt['order'][0]['column']; // Column index
		$columnName = $comilla.$dt['columns'][$columnIndex]['data'].$comilla; // Column name
		$columnSortOrder = $dt['order'][0]['dir']; // asc or desc
		//$searchValue = mysqli_real_escape_string($con,$dt['search']['value']); // Search value
		$searchValue = $dt['search']['value']; // Search value
		$columns = $dt['columns']; // columnas

		## BUSCAR POR CAMPOS
		##Retorna la consulta para hacer la búsqueda de un valor en una columna de la tabla 
		$searchQuery = $this->get_searchQuery_byCol($columns);
		

		$empRecords = $this->_m->get_datos($searchQuery, $columnName, $columnSortOrder, 0, 0,$searchValue,$filtro);

		$data = array();
		$this->_columnas = $this->getColumnas();
		$columnas = $this->_columnas;	//array de las columnas			
		$idDeplegar = $this->_bd["idDeplegar"];	//nombre del id (debe ser ID)
		$arrayCol = array();

		//Preparo los datos para ser enviados a la tabla de la vista (DataTable)
		if(is_array($empRecords)){ //Verifico si hay registros encontrados 
			foreach ($empRecords as $i => $row) { 
				foreach ($columnas as $columna) {
					$campo = $columna['campo']; 

					if(isset($row[$campo])) //si el nombre de columna esta en la consulta sql
						$datos = str_replace("[idDesplegar]",$row[$idDeplegar],$row[$campo]);
					else{
						$datos = "";
					}/*else{
						$data[$i][$campo] = "";
					}*/
					$data[$i][$campo] = $datos;
				}

			}
		}	


		foreach ($columnas as $columna) {
			$col = $columna['campo']; 
			$arrayCol[] = $col;
		}

		$this->csv($data, $arrayCol);
		
	}


  function ver_archivo($fcampo, $folder_name, $file_name){ 
		$ruta = "";

	    foreach ($this->_form as $key => $campo) {
	       if ($campo['campo'] == $fcampo) {
	           $ruta = $campo['path'] ."/". $folder_name ."/". $file_name;;
	           break;
	       }
		}

	    //$im = @imagecreatefromjpeg($path.$nombre);
	    //echo $ruta;
	    ob_end_clean();
	    ob_start();


	    $fp=fopen($ruta, "r");
	    fpassthru($fp);

	    $partes = explode(".", $file_name); //Se divide el nombre para extraer la extensión 
	    $ext = end($partes);


	    switch( $file_extension ) {
	    	case "pdf": $ctype="application/pdf"; break;
		    case "gif": $ctype="image/gif"; break;
		    case "png": $ctype="image/png"; break;
		    case "jpeg":
		    case "jpg": $ctype="image/jpeg"; break;
		    case "svg": $ctype="image/svg+xml"; break;
		    default:
		}

		header('Content-type: ' . $ctype);

	}

	function delete_file($fcampo, $folder_name, $file_name){ 

		foreach ($this->_form as $key => $campo) {
	       if ($campo['campo'] == $fcampo) {
	        	$ruta = $campo['path'] ."/". $folder_name ."/". $file_name;
	           	if(isset($campo['tabla']))
	           		$tabla = $campo['tabla'];
	          	else
	          		$tabla = 'p';

	           break;
	       }
		}


		if(unlink($ruta)){
			$response["message"] = "El archivo se elimino exitosamente";
			//Eliminar nombre del archivo en la tabla
			$res = $this->_m->eliminar_archivo_bd($folder_name, $fcampo, $tabla);

		}else
			echo "error al eliminar archivo";


		echo json_encode($response);
	}	

	function delete_folder($path){		
	    if (is_dir($path) === true)
	    {
	        $files = array_diff(scandir($path), array('.', '..'));

	        foreach ($files as $file)
	        {
	            $this->delete_folder(realpath($path) . '/' . $file);
	        }

	        return rmdir($path);
	    }
	    else if (is_file($path) === true)
	    {
	        return unlink($path);
	    }

	    return false;
	}

	public function importar()
	{
		//print_r($this->_columnas);
		$this->_view->assign('filtro'  ,  $filtro);
		$this->_columnas = $this->getColumnas();
		$this->_view->assign('columnas',  $this->_columnas);
		$this->_view->assign('reports'  , $this->_reports ); 

		$urlbarra        = (isset($this->_bd['urlbtnregresar']) ? $this->_bd['urlbtnregresar'] : ''); 

		$this->_view->assign('urlbarra',$urlbarra);

		$this->_view->assign('nomsingular',$this->_nomSingular);
		$this->_view->assign('nomplural'  ,$this->_nomPlural  );
		$this->_view->assign('controlador',$this->_c          );


		$this->_view->renderizar('importar',true);
	}

function infosort($filtro="")
	{
		
		$infoRows = $this->_m->get_datosFull($filtro); 

		/*
		echo "<pre>";
		print_r($infoRows[0]);
		echo "</pre>";
		*/


		$puntero =1;
		$b=false;
		$etiquetas = "";
		if(is_array( $infoRows) ) { 
		foreach($infoRows AS $datos){
			if (@$datos["profundidad"] <= $puntero and $b)
				$etiquetas .='</li>';

			//echo $datos["profundidad"].">".$puntero." / ";
			if (@$datos["profundidad"] > $puntero){
				$etiquetas .='<ol>';
				$puntero = $datos["profundidad"];
			}
			if (@$datos["profundidad"] < $puntero){
				$a=$puntero - @$datos["profundidad"];

				$i=1;
				while ($i <= $a){
					$i=$i + 1;
					$etiquetas .='</ol> </li>';
				}
				$puntero = $a;
			}
			$estadoItem ="";
			//$datos["profundidad"]  .'|'. $datos["idEtiqueta"]  .'|'.
			if($datos["activo"] == 1) $estadoItem = "checked";

			if(isset($datos[$this->_template['displayInfo']['color']])){

				$colorFondo="background-color:".$datos[$this->_template['displayInfo']['color']];
			}
			else{
				$colorFondo="";
			}

			if(isset($datos[$this->_template['displayInfo']['btn1']])){

				$btn1='<a type="button" class="btn btn-info" href="javascript:abrirURL(\''.$datos[$this->_template['displayInfo']['btn1']].'\')">Ver</a>';
			}
			else{
				$btn1="";
			}
// <a class = "btn btn-warning"  href="'.BASE_URL.$this->_c.'/editar/'.$datos[$this->_template['displayInfo']['id']].'">Editar</a> 

			$etiquetas .= '
			<li class="dd-item dd3-item" data-id="'.$datos[$this->_template['displayInfo']['id']].'" id="fila_'.$datos[$this->_template['displayInfo']['id']].'">
				<div class="dd-handle dd3-handle" style="padding-top:1.5rem; padding-bottom:1.5rem;"></div>
				<div class="dd3-content" style="'.$colorFondo.'" >
					<div id="cajon1" style="width:auto !important;">'.$datos[$this->_template['displayInfo']['tittle']].'</div>
					<div id="cajon2" style="text-align: right;">
						<input type="checkbox" name="switch" id="'.$datos[$this->_template['displayInfo']['id']].'" data-size="small" data-on-text="Activo" data-off-text="Inactivo" data-label-width="0" onChange="guardaStatus(this.checked, this.id)" '.$estadoItem .'>
						'.$btn1.'

						<a class = "btn btn-primary"  href="javascript:open_modal_to_edit('.$datos[$this->_template['displayInfo']['id']].',0,1)">Duplicar</a> 


						<a class = "btn btn-warning"  href="javascript:open_modal_to_edit('.$datos[$this->_template['displayInfo']['id']].')">Editar</a> 


						

						<a class = "btn btn-danger" href="javascript:eliminaregistro('.$datos[$this->_template['displayInfo']['id']].')">Eliminar</a>

					</div>
				</div>';

				$b=true;
			}
			if ($b)
				$etiquetas .= '</li>';

		}



		

		echo $etiquetas;

	}
	
	public function guardarOrdenEtiquetas()
		{

			$res = $this->_m->putOrdenEtiquetas($_POST);
			echo "";
			/*
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			*/
		}

	public function guardarStatus()
	{
		$res = $this->_m->putStatus($_POST);
		echo "";
	}

	public function eliminar_multiples_filas(){
		//$this->_acl->acceso('delete-'.$this->_c);
		foreach ($_POST['id'] as $key => $value) {
			$res = $this->eliminar($value, true);
			if($res["status"] == 0){
				$response["status"] = 0;
				$response["msg"] = $res;
				echo json_encode($response);
				break;
			}						
		}

		$response["status"] = 1;
		$response["msg"] = "";
		echo json_encode($response);		

	}

	public function cambiar_estatus_multiples_filas(){
		//$this->_acl->acceso('edit-'.$this->_c);

		$buttons = $this->_bd['checkbox_column']['buttons'];
		$array_ids = $_POST['id'];
		$idBtnClicked = $_POST['idbtn'];

		//Obtengo el nombre de la columna que será actualizada y el valor que obtendrá 
		foreach ($buttons as $key => $btn) {
			if($btn['id'] == $idBtnClicked){
				$colName = $btn['name_col'];
				$valor = $btn['valor'];
			}
		}
		
		$res = $this->_m->change_status($this->_c, $array_ids, $colName, $valor);

		if($res == 1)
		{
			$response["status"] = 1;
			$response["msg"] = "";
		}
		else
		{
			$response["status"] = 0;
			$response["msg"] = $res;
		}

		echo json_encode($response);		
	}

	public function grafica_modal()
	{
		//$this->_acl->acceso('see-'.$this->_c);

		$id_graf = $_POST['id_grafica'];
		$grafica = $this->_graficas[$id_graf];

		if(!empty($grafica))
		{	
			$labeles = [];
			$data = [];
			$datos = $this->_m->getDatosGraficas($grafica['consulta_sql']);

			foreach ($datos as $key => $d) {
				$labeles[] = '"'.$d['label'].'"';
				$data[] = $d['data'];
			}

			
			//$this->_view->assign('d',$datos); //valores en BD
			//$this->_view->assign('ventana_modal',true); //Para evitar que se carguen librerías que ya están en el index (ejem: app.js)

			$this->_view->assign('labeles',implode(",", $labeles));
			$this->_view->assign('data',implode(",", $data));
			$this->_view->assign('titulo',$grafica['titulo']);
			$this->_view->assign('etiqueta',$grafica['etiqueta']);
			$this->_view->assign('tipo_grafica',$grafica['tipo_grafica']);
			$this->_view->assign('descripcion',$grafica['descripcion']);
			//$this->_view->assign('controlador',$this->_c);

			//$this->_view->assign('BASE_URL',BASE_URL);
			$this->_view->assign('BASE_URL_VIEW',BASE_URL_VIEW);
			$this->_view->renderizar('graficas',true,true);
		}
	}

	public function data_transform($post)
	{
		//include_once("/opt/sitios/sau2/controllers/generator_functionsController.php");
		/*
		$gen_funct = new generator_functionsController();

		foreach ($this->_form as $key => $campo) {
			if(isset($campo['funcion_modifica']) AND $campo['funcion_modifica'] != ""){
				$function = $campo['funcion_modifica'];
				$valor = $post[$campo['campo']];
				
				//Verifico si la función existe en esta clase (en generatorController.php)
				if(method_exists($this, $function)){
					$post[$campo['campo']] = $this->$function($valor);
				}
				//Verifico si la función existe en la clase generator_functions (en generator_functionsController.php)
				else if(method_exists($gen_funct, $function))
					$post[$campo['campo']] = $gen_funct->$function($valor);				
				
			}
		}

		*/
		foreach ($this->_form as $field) {
			$name = $field['campo'];
			if (!empty($field['encrypt']) && isset($post[$name]) && $post[$name] !== '') {
				// ciframos sólo si viene valor
				$post[$name] = $this->encryptValue($post[$name]);
			}
		}
		return $post;
		
	}

	/** Método para Open IA, Por Sergio Solis  18/05/21025 */

	function ia(){

		$prompt = trim($_POST['prompt']);
		$text = trim($_POST['texto']);

		$api_key = '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';
		$url = 'https://api.openai.com/v1/chat/completions';

		$Precisiones = ". Precisiones:
		0. La finalidad es crear, corregir o modificar contenido del texto de un documento. 
		1. Conservar el formato HTML texto original.
		2. Corregir el HTML si es necesario y dar informe de los cambios.
		3. No cambiar el significado del texto.
		4. No agregar ni quitar etiquetas HTML si no es ncecesario.	
		5. El resultado debe ser un texto HTML.
		6. El contenido del texto final sugerido debe estar en una etiqueta <div id=\"response_ia\" style=\" border:solid 2px green; \">.
		7. Si el texto está vacio y el prompt tiene instrucciones para crear un nuevo documento desde cero, generarlo con un texto HTML.
		8. Si el texto está vacio y el prompt tiene instrucciones para corregir un texto, no generar nada, indicar el error.
		";
	
		try {
			if (!function_exists('curl_init') || !function_exists('curl_exec')) {
				throw new Exception("❌ Error: cURL no está habilitado en este servidor.");
			}
	
			$data = [
				"model" => "gpt-3.5-turbo",
				"messages" => [
					["role" => "system", "content" => "Eres un asistente útil."],
					["role" => "user", "content" => $prompt.". El texto es: ".$text. $Precisiones]
				]
			];
	
			$headers = [
				'Content-Type: application/json',
				'Authorization: Bearer ' . $api_key
			];
	
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			$response = curl_exec($ch);
	
			if ($response === false) { 
				throw new Exception("❌ Error en cURL: " . curl_error($ch));
			}
	
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
	
			$responseData = json_decode($response, true);
			if ($http_code !== 200) {
				$errorMsg = $responseData['error']['message'] ?? 'Error desconocido';
				throw new Exception("❌ Error HTTP $http_code: $errorMsg");
			}
	
			$responseText = $responseData['choices'][0]['message']['content'] ?? '(Respuesta vacía)';

			echo $responseText."<br>";
		} catch (Exception $e) {
			$errorText = $e->getMessage();
		}
	}



	protected function data_untransform(array $row): array
	{
		foreach ($this->_form as $field) {
			
			//desencriptar 
			if(isset($field['campo']) ){
				$name = $field['campo'];
				if (!empty($field['encrypt']) && !empty($row[$name])) {
					$row[$name] = $this->decryptValue($row[$name]);
				}
			}
		}
		return $row;
	}

	
	
	//// Funciones para cifrar y descifrar campos text/textarea
	/*
	protected function encryptValue(string $plaintext): string {
		$ivLen  = openssl_cipher_iv_length('AES-256-CBC');
		$iv     = openssl_random_pseudo_bytes($ivLen);
		$cipher = openssl_encrypt($plaintext, 'AES-256-CBC', GENERATOR_TEXT_ENCRYPTION_KEY, 0, $iv);
		return base64_encode($iv . '::' . $cipher);
	}
	protected function decryptValue(string $ciphertext): string {
		list($iv, $cipher) = explode('::', base64_decode($ciphertext), 2);
		return openssl_decrypt($cipher, 'AES-256-CBC', GENERATOR_TEXT_ENCRYPTION_KEY, 0, $iv);
	}
	*/
	public function generarClave()
    {
        // Genera 32 bytes aleatorios (256 bits)
        $bytes = random_bytes(32);
        // Codifícalos en Base64 y envíalos a la salida
        header('Content-Type: text/plain; charset=UTF-8');
        echo base64_encode($bytes);
        exit; // para no seguir con el flujo normal
    }


	//----------------------------------------------------

	// nueva funcion para encriptar y desencriptar

	
	protected function encryptValue(string $plaintext): string {
		$key = base64_decode(GENERATOR_TEXT_ENCRYPTION_KEY); // Igual que en PL/SQL
		$ivLen = openssl_cipher_iv_length('AES-256-CBC');
		$iv = openssl_random_pseudo_bytes($ivLen);

		$ciphertextRaw = openssl_encrypt($plaintext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

		// Combinar IV + separador seguro + texto cifrado
		$combined = $iv . '::' . $ciphertextRaw;

		return base64_encode($combined);
	}

	protected function decryptValue(string $ciphertext): string {
		$key = base64_decode(GENERATOR_TEXT_ENCRYPTION_KEY);

		$decoded = base64_decode($ciphertext, true);
		if ($decoded === false) {
			throw new \Exception('Formato Base64 inválido');
		}

		// Buscar separador '::' en los primeros bytes (posición 16 a 18)
		$sepPos = strpos($decoded, '::', 16); // Después del IV (16 bytes)
		if ($sepPos === false) {
			throw new \Exception('Formato de datos incorrecto: no se encontró el separador');
		}

		$iv = substr($decoded, 0, 16);
		$cipherRaw = substr($decoded, $sepPos + 2);

		$plaintext = openssl_decrypt($cipherRaw, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

		if ($plaintext === false) {
			throw new \Exception('Fallo en desencriptación');
		}

		return $plaintext;
	}
	//----------------------------------------------------

	 /**
     * Comprueba si $name corresponde a un sub-generator definido en el formulario padre.
     */
    private function isValidSubGenerator(string $name): bool
    {
        foreach ($this->_form as $el) {
            if (isset($el['name_crud_table']) && $el['name_crud_table'] === $name) {
                return true;
            }
        }
        return false;
    }



}

?>