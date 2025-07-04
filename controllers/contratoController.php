<?php

class contratoController extends Controller
{
  private $_cont;

  public function __construct()
  {
    parent::__construct();
    $this->forzarLogin();
    $this->_cont = $this->loadModel('contrato');
  }

  /*public function session()
  {


    $_SESSION["_FederatedPrincipal_"]="";

    echo "<pre>";
    print_r( $_SESSION);
    echo "</pre>";

  }*/
  
  public function index()
  {
       //$this->_view->renderizar('index', true);
  }

  public function editar($id="")
  {
    
      // Inicializaciones por defecto
      $clave    = "";
      $anio     = "";
      $numC     = "";
      $claveNum = "";
      $infoC    = [];            // Para evitar undefined index al asignar
      
      $rowTipoContratos = $this->_cont->getTiposContratos();
      $rowCC            = $this->_cont->getCategoriasContrato();
      $rowUA            = $this->_cont->getUA();
      $ubicaciones      = $this->_cont->getUbicaciones(); 
      $rowDA            = $this->_cont->getDA();
      $testigos         = $this->_cont->getTestigos();
      $infoFechas       = $this->_cont->getInfoFechasActual();
      

      if($id!=""){ 
        $partes = explode("-",$id);
        
        $clave  = $partes[0];
        $anio   = $partes[1];
        $numC   = $partes[2];
        if( !is_numeric($anio) or !is_numeric($numC) ) exit();
        $infoC  = $this->_cont->getContratoDetalle($clave,$anio,$numC);
          if(method_exists ($infoC['TEXTO'],'load' ) )
              $infoC["TEXTO"] = $infoC['TEXTO']->load();
          else
              $infoC["TEXTO"] = $infoC['TEXTO'];

        $claveNum = $infoC["UA_ID"] ?? "";
        
      }else{
        $infoC["CNT_FK_NOEMPL_TESTIGO1"]=1;
      }
      

      $idTipoContrato = $infoC["CNT_FK_TIPO"] ?? false;
      $idCategoria = $infoC["CNT_FK_CATEGORIA"] ?? false;
      $idUA = $infoC["UA_ID"] ?? false;
      $idUF = $infoC["CNT_UBICAFISICA"] ?? false;
      $idURE = $infoC["ID_URE"] ?? false;
      $numEmp = $infoC['CNT_FK_NOEMPL']     ?? "";

      
      

      
      $tipoContratos = $this->convierteOption($rowTipoContratos,"TCNT_ID","TCNT_DENOMINACION",$idTipoContrato);
      $CC            = $this->convierteOption($rowCC,"ID_CATEGORIA","CATEGORIA",$idCategoria);
      $UA            = $this->convierteOption($rowUA,"UA_ID","UA_DENOMINACION",$idUA);
      $UF            = $this->convierteOption($ubicaciones,"UBI_ID","UBI_DENOMINACION",$idUF); 
      $listURES      = $this->_cont->getListURES( $idURE );
      $DA            = $this->convierteOption($rowDA,"DA_ID","DA_DENOMINACION",$idUA);
      
      
      $this->_view->assign('tc',      $tipoContratos); 
      $this->_view->assign('cc',      $CC); 
      $this->_view->assign('ua',      $UA);
      $this->_view->assign('uf',      $UF);
      $this->_view->assign('ures',    $listURES); 
      $this->_view->assign('da',      $DA);
      $this->_view->assign('infofechas',    $infoFechas);
      $this->_view->assign('dc',      $infoC);
      $this->_view->assign('numempl', $numEmp);
      $this->_view->assign('id',      $id);
      $this->_view->assign('numc',    $numC);
      $this->_view->assign('clave',   $clave);
		  $this->_view->assign('clavenum',$claveNum);
		  $this->_view->assign('anio',    $anio);


      $this->_view->renderizar('editar', true);
  }

  function listarArchivos() {
    $directorio = 'https://'.$_SERVER['SERVER_NAME'].'/contratos2/views/layout/lte2/';
    echo $directorio;
    if (!is_dir($directorio)) {
        echo "El directorio no existe.";
        return;
    }
    
    $archivos = scandir($directorio);
    
    foreach ($archivos as $archivo) {
        if ($archivo !== '.' && $archivo !== '..') {
            echo $archivo . "\n";
        }
    }
  }

  public function convierteOption($array,$id,$campo,$sel="")
	{
			$cadena = "";
			$selecionado = "";
			foreach ($array as $key => $fila) {
				if($sel==$fila[$id])$selecionado='selected="selected"'; else $selecionado='';
				$cadena .= '<option value="'.$fila[$id].'" '.$selecionado.'>'. $fila[$campo]."</option>";
			}
			return($cadena);
	}


  public function get_empleados(){
    ob_end_clean();

    $palabra = $_POST["palabra"];
    $palabra = trim($palabra);        

    if(!empty($palabra)){

        $res = $this->_cont->getpersonas($this->normaliza($palabra));
        if(isset($res) and is_array($res)){
            echo json_encode($res);
        }
    }else{
        echo '{}';
    }
  }

  function normaliza ($cadena){
      $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
      $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
      $cadena = utf8_decode($cadena);
      $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
      $cadena = strtolower($cadena);

      return utf8_encode($cadena);
  }

  public function infoempl(){
    //echo $numempl;
    $numempl = trim($_POST['numempl'] ?? '');
    
    if($numempl !=""){
      $info=$this->_cont->getInfoempl($numempl);
      $estu=$this->_cont->getestudios($numempl);
      //print_r($estu);
          /*echo"<table id=\"contratos\" class=\"table table-bordered table-hover table-striped\">
                  <thead >
                      <tr>
                          <th>NOMBRE</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>".$info["VEMP_NOMBRE"]." ".$info["VEMP_APEPAT"]." ".$info["VEMP_APEMAT"]."</td>
                  </tr>
              
          </tbody>
          </table>";
      */
      echo "<label for=\"nomempl\">NOMBRE DE EMPLEADO</label>";
      echo"<p id=\"nomempl\">".$info["VEMP_NOMBRE"]." ".$info["VEMP_APEPAT"]." ".$info["VEMP_APEMAT"]."</p>";
      foreach ($estu as $valor) {
        // Datos básicos con mensaje por defecto
        $grado        = $valor['GRADO']       ?? 'sin grado';
        $carrera      = $valor['CARRERA']     ?? 'sin carrera';
        $instituto    = $valor['INSTITUTO']   ?? 'sin instituto';
        $fechaTitulo  = $valor['TÍTULO']      ?? 'sin fecha';
    
        // Componentes de cédula en bruto
        $numCedula    = $valor['NUM_CEDULA']   ?? '';
        $fechaCedula  = $valor['FECHA_CEDULA'] ?? '';
    
        // Armar la cadena “CÉDULA” solo si ambos existen
        if ($numCedula !== '' && $fechaCedula !== '') {
            $cedula = "{$numCedula} - {$fechaCedula}";
        } else {
            $cedula = '<span style="background-color: #eded58;">sin cédula</span>';
        }
    
        // Salida HTML
        echo "<label>{$grado} EN {$carrera}</label>";
        echo "<p id=\"instituto\">{$instituto} - {$fechaTitulo}</p>";
        echo "<p id=\"cedula\">{$cedula}</p>";
      }     
    }        
  } 

  public function getPlantillas($id=0){
    $info = $this->_cont->getPlantillasByTipo($id);
    echo $this->convierteOption($info,"PLT_ID","PLT_DENOMINACION");
  }

  public function crear($sae=false,$clavenum="",$anio="",$numc="",$plantilla="")
	{
    $_POST['numempl'] = trim($_POST['numempl'] ?? '');
    if ($clavenum == "" && $anio == "" && $numc == "" && $plantilla == "") {
        $array = $this->_cont->putContratos($_POST);
        $_POST["clavenum"] = $array["ua"];
        $_POST["anio"] = $array["anio"];
        $_POST["numc"] = $array["id"];
    } else {
       $_POST["plantilla"] = $this->_cont->getInfoContrato($clavenum, $anio, $numc, "plantilla");
     // $_POST["plantilla"] = $plantilla;
        $_POST["numempl"] = $this->_cont->getInfoContrato($clavenum, $anio, $numc, "numempleado");
        $_POST["clavenum"] = $clavenum;
        $_POST["anio"] = $anio;
        $_POST["numc"] = $numc;
    }
    $row = $this->_cont->getPlantillaTexto($_POST["plantilla"]);
   // echo $row["TEXTO"];
    $re1 = '(\\{)';    // Any Single Character 1
    $re2 = '((?:[a-z][a-z0-9_]*))';    // Variable Name 1
    $re3 = '(\\.)';    // Any Single Character 2
    $re4 = '((?:[a-z][a-z0-9_]*))';    // Variable Name 2
    $re5 = '(\\.)';    // Any Single Character 3
    $re6 = '((?:[a-z][a-z0-9_]*))';    // Variable Name 3
    $re7 = '(\\})';    // Any Single Character 4
    if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7."/is", $row["TEXTO"], $coincidencias)){
      $c=0;
       foreach ($coincidencias[0] as $fila) {
       	if($coincidencias[4][$c]=="trab"){
       		if($coincidencias[6][$c]=="funciones"){ 
            $infoA = $this->_cont->getInfoContrato($_POST["clavenum"],$_POST["anio"],$_POST["numc"],$coincidencias[6][$c]);
	       		$infoA = $this->elementos($infoA);
	       		$info ="<ul>";
	       		foreach ($infoA as $filaF ) {
	       			$info .= "<li>".$filaF."</li>";
	       		}
	       		$info .="</ul>";
	       	}elseif($coincidencias[6][$c]=="escuela"){ 
              $info = $this->_cont->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
              if (strpos($info,"UNIVERSIDAD")!==false or strpos($info,"ESCUELA")!==false ) {
                $info  = "la ".$info;
              }else if(strpos($info,"ESCUELA")!==false or strpos($info,"INSTITUTO")!==false  ) {
                $info  = "el ".$info;
              }else{
                $info  = "el/la ".$info;
              }
              
          }elseif($coincidencias[6][$c]=="estudiostextocompleto"){
            
            $numCedula = $this->_cont->getInfoTrabajador($_POST["numempl"],"numerocedula");
            $gradoAcademico = $this->_cont->getInfoTrabajador($_POST["numempl"],"gradoacademico");
            $escuela = $this->_cont->getInfoTrabajador($_POST["numempl"],"escuela");
            // dd( $numCedula, $gradoAcademico, $escuela );
            if (strpos($escuela,"UNIVERSIDAD")!==false or strpos($escuela,"ESCUELA")!==false or strpos($escuela,"DIRECCIÓN")!==false or strpos($escuela,"ACADEMIA")!==false) { 
              $escuela  = "la ".$escuela;
            }else if(strpos($escuela,"COLEGIO")!==false or strpos($escuela,"INSTITUTO")!==false or strpos($escuela,"CENTRO")!==false ) {
              $escuela  = "el ".$escuela;
            }else{
              $escuela  = " la escuela  ".$escuela." "; 
            }
            $carrera = $this->_cont->getInfoTrabajador($_POST["numempl"],"carrera");
            $fechatitulo = $this->_cont->getInfoTrabajador($_POST["numempl"],"fechatitulo");
            if($numCedula!=""){
                $fechaCedula = $this->_cont->getInfoTrabajador($_POST["numempl"],"fechacedula");
              if(strpos($carrera,"QUÍMICO")!==false or strpos($carrera,"MÉDICO")!==false or strpos($carrera,"TRABAJADOR")!==false or strpos($carrera,"INGENIERO")!==false  ) {
                  $carrera = "como $carrera";
              }else{
                  $carrera = "en $carrera";
              }
              if ( $numCedula !== 'E') {
                $info = " título de $gradoAcademico $carrera expedido por $escuela el día $fechatitulo y cédula profesional $numCedula, de fecha $fechaCedula";
              }else{
                $info = " título de $gradoAcademico $carrera expedido por $escuela ( EXTRANJERO )";
              }
            }else{
                if($carrera=="SECUNDARIA"  or $carrera=="EDUCACIÓN SECUNDARIA" or $carrera=="BACHILLER") 
                    $carrera = "";
                if($carrera!="") $carrera = " ( ".$carrera." ) ";
                if($escuela!="") $escuela = "expedido por ".$escuela." ";
                if($fechatitulo!="") $fechatitulo = " el día  ".$fechatitulo." ";
                $info = " estudios de $gradoAcademico $carrera $escuela $fechatitulo";
            }
            $infoAptitudes = $this->_cont->getInfoTrabajador($_POST["numempl"],"aptitudes");
            if($infoAptitudes!="" and $info!="") 
                $info = $info. ". Tiene ".$infoAptitudes;
            else if($infoAptitudes!="" and $info=="")
                $info = $info. " ".$infoAptitudes;
          }elseif($coincidencias[6][$c]=="estudios"){
            $info = $this->_cont->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
            if($info=="") $info = "C.";
          }elseif($coincidencias[6][$c]=="prefijo"){ 
            $info = $this->_cont->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
            if($info=="") $info = "C.";
       		}else{
       			$info = $this->_cont->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
       		}
       	}
       	if($coincidencias[4][$c]=="contrato"){
       		  $info = $this->_cont->getInfoContrato($_POST["clavenum"],$_POST["anio"],$_POST["numc"],$coincidencias[6][$c]);
            if($coincidencias[6][$c]=="sueldoquincenatexto" or $coincidencias[6][$c]=="sueldototaltexto" or $coincidencias[6][$c]=="sueldomensualtexto")
              $info = $this->num2letras(number_format($info,2,'.','')) ;
            if($coincidencias[6][$c]=="sueldoquincenanum" or $coincidencias[6][$c]=="sueldototalnum" or $coincidencias[6][$c]=="sueldomensual")
              $info = number_format($info,2,'.',',') ;
            if($coincidencias[6][$c]=="fechainicio" or $coincidencias[6][$c]=="fechafin"  or $coincidencias[6][$c]=="fechafirmatexto")
              $info = $this->getFechaTexto($info);
            if($coincidencias[6][$c]=="ures"){
               if (strpos($info,"DIRECCI")!==false or strpos($info,"DIVISI")!==false or strpos($info,"RECTOR")!==false or strpos($info,"COORDINACI")!==false  or strpos($info,"AUDITORÍA")!==false) {
                  $info  = "a la ".$info;
                }else if(strpos($info,"DEPARTAMENTO")!==false or strpos($info,"ÁREA")!==false or strpos($info,"CENTRO")!==false ) {
                  $info  = "al ".$info; 
                }else{
                  $info  = "al ".$info;
                }
            }
            if($coincidencias[6][$c]=="ures_del_dela"){ 
               if (strpos($info,"DIRECCI")!==false or strpos($info,"DIVISI")!==false or strpos($info,"RECTOR")!==false or strpos($info,"COORDINACI")!==false  or strpos($info,"AUDITORÍA")!==false) {
                  $info  = "de la ".$info;
                }else if(strpos($info,"DEPARTAMENTO")!==false or strpos($info,"ÁREA")!==false or strpos($info,"CENTRO")!==false ) {
                  $info  = "del ".$info; 
                }else{
                  $info  = "del ".$info;
                }
            }
            if($coincidencias[6][$c]=="montofinal") {
                if( !($info=='0' or $info==0 or $info=="") )
                  $info  = ' y un último pago por la cantidad de $'.number_format($info,2,'.',',').' ('.$this->num2letras(number_format($info,2,'.','')).')';
                else
                  $info = "x";
            }
       	}
        $idURE   = $this->_cont->getInfoContrato($_POST["clavenum"],$_POST["anio"],$_POST["numc"],"idure");
        if($coincidencias[4][$c]=="plantilla"){
          $info = $this->_cont->getInfoPlantilla($coincidencias[6][$c],$_POST["numempl"]);
          if($coincidencias[6][$c]=="ure"){
            if (strpos($info,"DIRECCI")!==false or strpos($info,"DIVISI")!==false or strpos($info,"RECTOR")!==false or strpos($info,"COORDINACI")!==false  or strpos($info,"AUDITORÍA")!==false) {
              $info  = " la ".$info;
            }else if(strpos($info,"DEPARTAMENTO")!==false or strpos($info,"ÁREA")!==false or strpos($info,"CENTRO")!==false ) {
              $info  = "el ".$info; 
            }else{
              $info  = "el ".$info;
            }
          }
          if($coincidencias[6][$c]=="ures_del_dela"){  
            if (strpos($info,"DIRECCI")!==false or strpos($info,"DIVISI")!==false or strpos($info,"RECTOR")!==false or strpos($info,"COORDINACI")!==false  or strpos($info,"AUDITORÍA")!==false) {
              $info  = "de la ".$info;
            }else if(strpos($info,"DEPARTAMENTO")!==false or strpos($info,"ÁREA")!==false or strpos($info,"CENTRO")!==false ) {
              $info  = "del ".$info; 
            }else{
              $info  = "del ".$info;
            }
          }
        }
        if($coincidencias[4][$c]=="jefdepto"){ 
          $info = $this->_cont->getInfoJefeDepto($coincidencias[6][$c],$idURE);
        }
        if($coincidencias[4][$c]=="director"){ 
          $info = $this->_cont->getInfoDirector($coincidencias[6][$c],$idURE);
        }
        if($coincidencias[4][$c]=="administrador"){ 
          $info = $this->_cont->getInfoAdministrador($coincidencias[6][$c]);
        }        
       	if($coincidencias[4][$c]=="rector"){ 
       		$info = $this->_cont->getInfoRector($coincidencias[6][$c]);
       	}
       	if($coincidencias[4][$c]=="admin"){ 
       		$info = $this->_cont->getInfoAdmin($coincidencias[6][$c]);
       	}
       		if($info!=""){ 
            if($info=="x") $info="";
       			if($coincidencias[2][$c]=="my") $info = mb_strtoupper($info);
            if($coincidencias[2][$c]=="mn") $info = mb_strtolower($info);
            if($coincidencias[2][$c]=="tt") $info = $this->art(ucwords(mb_strtolower($info)));
            if($coincidencias[2][$c]=="or") $info = ucfirst($info);
            $row["TEXTO"] = str_replace($fila,$info,$row["TEXTO"]);
       		}
      		$c++;
       }
    }
    $res = $this->_cont->putTextoContratos($row["TEXTO"],$_POST["clavenum"],$_POST["anio"],$_POST["numc"]);
    if(!$sae and $clavenum=="" and $anio=="" and $numc=="" and $plantilla==""){ 
		  $array["texto"] = $row["TEXTO"];
		  echo json_encode($array);
    }else{
    	$claveUA = $this->_cont->getURE($_POST["clavenum"]);
    	$clave = $claveUA["CLAVE"]."-".$_POST["anio"]."-".$_POST["numc"];
		  $link = '<div>'.$clave.'</div>
		 	<a href="'.BASE_URL.'/index/editar/'.$clave.'/" target="_blank">[Editar]</a>
          					<a href="'.BASE_URL.'/index/pdf/'.$clave.'/" target="_blank">[Imprimir]</a> <br/> ';
      return($link);
    }
	}

  public function art($cadena="") {
    $cadena = str_replace(" Para ", " para ", $cadena);
    $cadena = str_replace(" Con ", " con ", $cadena);
    $cadena = str_replace("Expedido", "expedido", $cadena);
    $cadena = str_replace("Metódos ", "Métodos ", $cadena);
    $cadena = str_replace("Día", "día", $cadena);
    $cadena = str_replace(". tiene ", ". Tiene ", $cadena);
     
    $cadena = str_replace(" De ", " de ", $cadena);
        $cadena = str_replace(" con ", " con ", $cadena);
    $cadena = str_replace("A La ", "a la ", $cadena);
    $cadena = str_replace(" Del ", " del ", $cadena);
    $cadena = str_replace("Del ", "del ", $cadena);
    $cadena = str_replace(" La ", " la ", $cadena);
        $cadena = str_replace(" Como ", " como ", $cadena);
    $cadena = str_replace(" Y ", " y ", $cadena);
    $cadena = str_replace(" E ", " e ", $cadena);
    $cadena = str_replace(" Ii", " II", $cadena);
    $cadena = str_replace(" Iii", " III", $cadena);
    $cadena = str_replace(" IIi", " III", $cadena);
    $cadena = str_replace(" Vi", " VI", $cadena);
    $cadena = str_replace("La ", "la ", $cadena);
    $cadena = str_replace("Al ", "al ", $cadena);
    $cadena = str_replace("A ", "a ", $cadena);
        $cadena = str_replace(" Las ", " las ", $cadena);
                $cadena = str_replace(" Los ", " los ", $cadena);
    $cadena = str_replace("El ", "el ", $cadena);
    $cadena = str_replace(" En ", " en ", $cadena);
    $cadena = str_replace(" Por ", " por ", $cadena);
    $cadena = str_replace(" Fecha ", " fecha ", $cadena);
    $cadena = str_replace("( ", "(", $cadena);
    $cadena = str_replace(" )", ")", $cadena);
    $cadena = str_replace('" ', '"', $cadena);
    $cadena = str_replace(' "', '"', $cadena);
    $cadena = str_replace('  ', ' ', $cadena);
    //if(strpos($cadena, '"')==0 ) 
    return $cadena;
  }

  public function num2letras($num, $fem = false, $dec = true,$moneda=true) { 
    $matuni[2]  = "dos"; 
    $matuni[3]  = "tres"; 
    $matuni[4]  = "cuatro"; 
    $matuni[5]  = "cinco"; 
    $matuni[6]  = "seis"; 
    $matuni[7]  = "siete"; 
    $matuni[8]  = "ocho"; 
    $matuni[9]  = "nueve"; 
    $matuni[10] = "diez"; 
    $matuni[11] = "once"; 
    $matuni[12] = "doce"; 
    $matuni[13] = "trece"; 
    $matuni[14] = "catorce"; 
    $matuni[15] = "quince"; 
    $matuni[16] = "dieciseis"; 
    $matuni[17] = "diecisiete"; 
    $matuni[18] = "dieciocho"; 
    $matuni[19] = "diecinueve"; 
    $matuni[20] = "veinte"; 
    $matunisub[2] = "dos"; 
    $matunisub[3] = "tres"; 
    $matunisub[4] = "cuatro"; 
    $matunisub[5] = "quin"; 
    $matunisub[6] = "seis"; 
    $matunisub[7] = "sete"; 
    $matunisub[8] = "ocho"; 
    $matunisub[9] = "nove"; 
    $matdec[2] = "veint"; 
    $matdec[3] = "treinta"; 
    $matdec[4] = "cuarenta"; 
    $matdec[5] = "cincuenta"; 
    $matdec[6] = "sesenta"; 
    $matdec[7] = "setenta"; 
    $matdec[8] = "ochenta"; 
    $matdec[9] = "noventa"; 
    $matsub[3]  = 'mill'; 
    $matsub[5]  = 'bill'; 
    $matsub[7]  = 'mill'; 
    $matsub[9]  = 'trill'; 
    $matsub[11] = 'mill'; 
    $matsub[13] = 'bill'; 
    $matsub[15] = 'mill'; 
    $matmil[4]  = 'millones'; 
    $matmil[6]  = 'billones'; 
    $matmil[7]  = 'de billones'; 
    $matmil[8]  = 'millones de billones'; 
    $matmil[10] = 'trillones'; 
    $matmil[11] = 'de trillones'; 
    $matmil[12] = 'millones de trillones'; 
    $matmil[13] = 'de trillones'; 
    $matmil[14] = 'billones de trillones'; 
    $matmil[15] = 'de billones de trillones'; 
    $matmil[16] = 'millones de billones de trillones'; 
    
    //Zi hack
    $float=explode('.',$num);
    $num=$float[0];
    $num = trim((string)@$num); 
    // Inicializar si está vacío
    if ($num === '') {
      $num = '0';
    }
    // Detectar signo
    if ($num[0] == '-') { 
       $neg = 'menos '; 
       $num = substr($num, 1); 
    }else 
       $neg = ''; 
    //while ($num[0] == '0') $num = substr($num, 1); 
    // Eliminar ceros a la izquierda, dejando al menos uno
    while (strlen($num) > 1 && $num[0] === '0') {
      $num = substr($num, 1);
    }
    //if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
    // Asegurar primer carácter válido
    if (!isset($num[0]) || $num[0] < '1' || $num[0] > '9') {
      $num = '0' . $num;
    }
    $zeros = true; 
    $punt = false; 
    $ent = ''; 
    $fra = ''; 
    for ($c = 0; $c < strlen($num); $c++) { 
       $n = $num[$c]; 
       if (! (strpos(".,'''", $n) === false)) { 
          if ($punt) break; 
          else{ 
             $punt = true; 
             continue; 
          } 
       }elseif (! (strpos('0123456789', $n) === false)) { 
          if ($punt) { 
             if ($n != '0') $zeros = false; 
             $fra .= $n; 
          }else 
             $ent .= $n; 
       }else 
          break; 
    } 
    $ent = '     ' . $ent; 
    if ($dec and $fra and ! $zeros) { 
       $fin = ' coma'; 
       for ($n = 0; $n < strlen($fra); $n++) { 
          if (($s = $fra[$n]) == '0') 
             $fin .= ' cero'; 
          elseif ($s == '1') 
             $fin .= $fem ? ' una' : ' un'; 
          else 
             $fin .= ' ' . $matuni[$s]; 
       } 
    }else 
       $fin = ''; 
    if ((int)$ent === 0) return 'Cero ' . $fin; 
    $tex = ''; 
    $sub = 0; 
    $mils = 0; 
    $neutro = false; 
    while ( ($num = substr($ent, -3)) != '   ') { 
       $ent = substr($ent, 0, -3); 
       if (++$sub < 3 and $fem) { 
          $matuni[1] = 'una'; 
          $subcent = 'as'; 
       }else{ 
          $matuni[1] = $neutro ? 'un' : 'uno'; 
          $subcent = 'os'; 
       } 
       $t = ''; 
       $n2 = substr($num, 1); 
       if ($n2 == '00') { 
       }elseif ($n2 < 21) 
          $t = ' ' . $matuni[(int)$n2]; 
       elseif ($n2 < 30) { 
          $n3 = $num[2]; 
          if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
          $n2 = $num[1]; 
          $t = ' ' . $matdec[$n2] . $t; 
       }else{ 
          $n3 = $num[2]; 
          if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
          $n2 = $num[1]; 
          $t = ' ' . $matdec[$n2] . $t; 
       } 
       $n = $num[0]; 
       if ($n == 1) { 
          $t = ' ciento' . $t; 
       }elseif ($n == 5){ 
          $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
       }elseif ($n != 0){ 
          $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
       } 
       if ($sub == 1) { 
       }elseif (! isset($matsub[$sub])) { 
          if ($num == 1) { 
             $t = ' mil'; 
          }elseif ($num > 1){ 
             $t .= ' mil'; 
          } 
       }elseif ($num == 1) { 
          $t .= ' ' . $matsub[$sub] . '?n'; 
       }elseif ($num > 1){ 
          $t .= ' ' . $matsub[$sub] . 'ones'; 
       }   
       if ($num == '000') $mils ++; 
       elseif ($mils != 0) { 
          if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
          $mils = 0; 
       } 
       $neutro = true; 
       $tex = $t . $tex; 
    } 
    $tex = $neg . substr($tex, 1) . $fin; 
    //Zi hack --> return ucfirst($tex);
    if($moneda)
       $end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
     else
       $end_num=ucfirst($tex);
    return $end_num; 
  } 

  public function getFechaTexto($fecha)
  {
      // Validar formato y existencia
      if (empty($fecha) || strpos($fecha, '-') === false) {
          return '';
      }

      $partes = explode('-', $fecha);
      $diaNum = isset($partes[0]) ? (int)$partes[0] : 0;
      $mesNum = isset($partes[1]) ? (int)$partes[1] : 0;
      $anioStr = isset($partes[2]) ? $partes[2] : '';

      // Mapeo de día
      switch ($diaNum) {
          case 1:  $dia = 'primero';       break;
          case 2:  $dia = 'dos';           break;
          case 3:  $dia = 'tres';          break;
          case 4:  $dia = 'cuatro';        break;
          case 5:  $dia = 'cinco';         break;
          case 6:  $dia = 'seis';          break;
          case 7:  $dia = 'siete';         break;
          case 8:  $dia = 'ocho';          break;
          case 9:  $dia = 'nueve';         break;
          case 10: $dia = 'diez';          break;
          case 11: $dia = 'once';          break;
          case 12: $dia = 'doce';          break;
          case 13: $dia = 'trece';         break;
          case 14: $dia = 'catorce';       break;
          case 15: $dia = 'quince';        break;
          case 16: $dia = 'dieciséis';      break;
          case 17: $dia = 'diecisiete';    break;
          case 18: $dia = 'dieciocho';     break;
          case 19: $dia = 'diecinueve';    break;
          case 20: $dia = 'veinte';        break;
          case 21: $dia = 'veintiuno';     break;
          case 22: $dia = 'veintidós';     break;
          case 23: $dia = 'veintitrés';    break;
          case 24: $dia = 'veinticuatro';  break;
          case 25: $dia = 'veinticinco';   break;
          case 26: $dia = 'veintiséis';    break;
          case 27: $dia = 'veintisiete';   break;
          case 28: $dia = 'veintiocho';    break;
          case 29: $dia = 'veintinueve';   break;
          case 30: $dia = 'treinta';       break;
          case 31: $dia = 'treinta y uno'; break;
          default: $dia = '--';            break;
      }

      // Mapeo de mes
      switch ($mesNum) {
          case 1:  $mes = 'enero';      break;
          case 2:  $mes = 'febrero';    break;
          case 3:  $mes = 'marzo';      break;
          case 4:  $mes = 'abril';      break;
          case 5:  $mes = 'mayo';       break;
          case 6:  $mes = 'junio';      break;
          case 7:  $mes = 'julio';      break;
          case 8:  $mes = 'agosto';     break;
          case 9:  $mes = 'septiembre'; break;
          case 10: $mes = 'octubre';    break;
          case 11: $mes = 'noviembre';  break;
          case 12: $mes = 'diciembre';  break;
          default: $mes = '--';         break;
      }

      // Convertir año a texto (sin decimales ni moneda)
      $anio = $this->num2letras($anioStr, false, false, false);

      return "{$dia} de {$mes} de {$anio}";
  }

  public function guardar(){
    //$_POST["contenido"] = "---";
    //print_r($_POST);
    $res = $this->_cont->putContratos($_POST);
    echo json_encode($res);
  }

  public function pdf($id="")
  {
    //ob_start();
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    if (ob_get_length()) {
        ob_clean();      // limpia cualquier salida previa
    }
    $this->_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $this->creapdf($id);
    //Close and output PDF document
    $this->_pdf->Output($id.'_contrato.pdf', 'I');
    //ob_end_flush();
  }

  private function creapdf($id="")
	{    
		if($id!=""){ 
			$partes = explode("-",$id);
			
			$clave  = $partes[0];
			$anio   = $partes[1];
			$numC   = $partes[2];
      $idImprime = $clave."-".$numC."-".$anio;
			if( !is_numeric($anio) or !is_numeric($numC) ) exit();
			$infoC  = $this->_cont->getContratoTexto($clave,$anio,$numC);
        // LLAMAR METODO QUE TRAE LA CLAVE
      if(method_exists($infoC['TEXTO'],'load'))
          $infoC["TEXTO"] = $infoC['TEXTO']->load();
	 	}else{ exit(); }
  
		//$texto= $infoC["TEXTO"];
		$texto=  html_entity_decode($infoC["TEXTO"]);
    //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $this->_pdf->SetCreator(PDF_CREATOR);
    $this->_pdf->SetAuthor('Departamento de Recursos Humanos');
    $this->_pdf->SetTitle('UNIVERSIDAD AUTÓNOMA DEL ESTADO DE QUINTANA ROO'); 
    $this->_pdf->SetSubject('Contrato');
    $this->_pdf->SetKeywords('contrato');
    // set default header data
    $tituloDoc = ""; //"UNIVERSIDAD DE QUINTANA ROO";
    $logo = ""; //"logo_uqroo.jpg";
    $sizeLogo = "10";
    $subtituloDoc = "CONTRATO NÚMERO: ".$infoC["CLAVE"].$idImprime;
    $this->_pdf->SetHeaderData($logo, $sizeLogo, $tituloDoc, $subtituloDoc);
    // set header and footer fonts
    $this->_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, 'B', PDF_FONT_SIZE_MAIN));
    $this->_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $this->_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $margenes = explode(",", $infoC["MARGENES"]);
    // set margins
    $margenTop = $margenes[0];
    $margenDer = $margenes[1];
    $margenBoottom = $margenes[2];
    $margenIzq = $margenes[3];
    $margenEncabezado = $margenes[4];
    $margenFooter = $margenes[5];
    $this->_pdf->SetMargins($margenIzq, $margenTop, $margenDer);
    $this->_pdf->SetHeaderMargin($margenEncabezado);
    $this->_pdf->SetFooterMargin($margenFooter);
    $this->_pdf->SetAutoPageBreak(TRUE, $margenBoottom);
    // set auto page breaks
    ;
    // set image scale factor
    $this->_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      require_once(dirname(__FILE__).'/lang/eng.php');
      $this->_pdf->setLanguageArray($l);
    }
    // ---------------------------------------------------------
    // add a page
    $this->_pdf->startPageGroup();
    $this->_pdf->AddPage('P','LEGAL');
    /*
    // set font
    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->Write(0, 'Example of HTML Justification', '', 0, 'L', true, 0, false, false, 0);
    */
    // create some HTML content
    $html = $texto;
    // set core font
    $this->_pdf->SetFont('helvetica', '', 9.5);
    //$pdf->Ln();
    $this->_pdf->writeHTML($html, true, 0, true, true);
    $this->_pdf->resetHeaderTemplate();

    /*
    $this->_pdf->startPageGroup();
    $this->_pdf->AddPage('P','LEGAL');
    $this->_subtituloDoc = "XXX: CONTRATO NÚMERO: CPS".$idImprime;
    $this->_pdf->SetHeaderData($logo, $sizeLogo, $tituloDoc, $subtituloDoc);
    $this->_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    // output the HTML content
    $this->_pdf->writeHTML($html, true, 0, true, true);
    */
    /*
    // set UTF-8 Unicode font
    $pdf->SetFont('dejavusans', '', 10);
    // output the HTML content
    $pdf->writeHTML($html, true, 0, true, true);
    // reset pointer to the last page
    $pdf->lastPage();
    */
    //AddPage
    // ---------------------------------------------------------
	}

  public function eliminar($id){
    $partes = explode("-",$id);
        
    $clave  = $partes[0];
    $anio   = $partes[1];
    $numC   = $partes[2];
    if( !is_numeric($anio) or !is_numeric($numC) ) exit();
    $claveNum  = $this->_cont->getIdUAByClave($clave);
    $res  = $this->_cont->delContrato($claveNum,$anio,$numC);
    echo json_encode($res);
  }

  public function get_empleado(){
		ob_end_clean();
    $numempl=$_POST['numempl'];
		//$this->_acl->acceso('see-'.$this->_c);		
		if($numempl) { 
			//echo $numero." - ".$id;
			$res = $this->_cont->get_empleado($numempl);
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


}


?>