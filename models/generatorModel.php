<?php

class generatorModel extends Model
{
    private $info    =array();
    private $form    =array();
    private $tablas  =array();
    private $template=array();

    public function __construct() {
        if(isset($this->info["conexion"]) )
            parent::__construct($this->info["conexion"]);
        else
          parent::__construct();

        $this->_registry = Registry::getInstancia(); // <--- MULTI_BD
        /*
        if(isset($this->info["conexion"]) )
          $this->_db = $this->_registry->_db[ $this->info["conexion"] ]; // <--- MULTI_BD
        else
          $this->_db = $this->_registry->_db['local']; // <--- MULTI_BD
        */
    }

    public function setInfo($array)
    {
        $this->info = $array;

        if(isset($this->info["conexion"]) ){ 
            parent::setOrigen($this->info["conexion"]);
            $this->_db = $this->_registry->_db[ $this->info["conexion"] ]; // <--- MULTI_BD
        }else{
             $this->_db = $this->_registry->_db['local']; // <--- MULTI_BD
        }

    }
    public function setForm($array)
    {
        $this->form = $array;
    }
    public function setTablas($array)
    {
        $this->tablas = $array;
    }
    public function setTemplate($array)
    {
        $this->template = $array;
    }
    public function getInfo()
    {

      /*
      if (trim($this->info['where'])!="") $this->info['where']= " WHERE " . $this->info['where'];

      $sql = "SELECT ".$this->info['colT'].",".$this->info['idT']." AS IDDFILA 
              FROM ".$this->info['tabla']." 
              ".$this->info['where']."
              ORDER BY ".$this->info['orderBy']." ".$this->info['orderP'];

      */        
      $sql = $this->info['sqlDeplegar'];
      //echo "-----> $sql";
      $res = $this->ssql($sql);
    //  print_r($res);
    }

    public function getInfoInput($sql)
    {
        $sql = $sql;
        $res = $this->ssql($sql);
        return($res);
    }

    public function eliminar($id, $controlador)
    {
      if(DB['local']['MANAGER']=="oracle"){ $cadLimite = "AND ROWNUM = 1"; } else { $cadLimite = " LIMIT  1";}
        $sql = "DELETE FROM ".$this->tablas['p']['nom']." WHERE ".$this->tablas['p']['id']."=:id $cadLimite "; //LIMIT 1
      
        $array = array(':id' =>trim($id));

 
        $res = $this->ssql($sql,$array);
       //$this->putLog($controlador, 3, $id);

        return($res);
    }

    public function getIdiomas()
    {

        $sql = "SELECT * FROM idiomas";


        $res = $this->ssql($sql,null,2);
        return($res);
    }

    /*
    DESACTIVADO 18/11/2020
    public function busqueda($palabra)
    {
        $filtro = $this->filtroBusqueda($this->info['busqLike'],$this->info['busqIgual'],$palabra);
        
      //  $sql = "SELECT ".$this->info['colT'].",".$this->info['idT']." AS IDDFILA FROM ".$this->info['tabla']." WHERE $filtro ORDER BY ".$this->info['orderBy']." ".$this->info['orderP'];
        
        $sql = "SELECT * FROM (".$this->info['sqlDeplegar'].") WHERE ". $filtro;

        echo "-------------------> $sql";

        $res = $this->ssql($sql,null,2);
        return($res);
    }
    */
    public function eliminar_acentos($cadena=""){
    $cadena = mb_strtoupper($cadena);
    $cadena = str_replace(
      array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'),
      array('A', 'E', 'I', 'O', 'U', 'N'),
      $cadena
      );
      return $cadena;
    }

    public function filtroBusqueda($blike, $bigual,$palabra){
      $aLike    = explode(",",trim($blike));
      $aIgual   = explode(",",trim($bigual));
      // $palabra = str_replace("-"," ",trim($palabra));
      $palabra = $this->eliminar_acentos(mb_strtoupper($palabra));
      $palabras = explode(" ",trim($palabra));


      $cadena = "";


      if(DB['local']['MANAGER']=="oracle"){

          foreach ($palabras as $key => $pal) {
              if(trim($pal)!=""){
                $cadena.="(";
                foreach ($aLike as $key => $valor) {
                  $cadena.= "(translate(upper($valor), 'ÁÉÍÓÚÑ', 'AEIOUN'))" ." LIKE '%".$pal."%' or ";
                }
             
             
                foreach ($aIgual as $key => $valor) {
                  $cadena.= "(translate(upper($valor), 'ÁÉÍÓÚÑ', 'AEIOUN'))"." = '".$pal."' or ";
                }

                  $cadena.=" 1=2 ) and ";
              }
          }
      

      }else{

              foreach ($palabras as $key => $pal) {
              if(trim($pal)!=""){
                $cadena.="(";
                foreach ($aLike as $key => $valor) {
                  $valor = $this->eliminar_acentos($valor);
                  $cadena.= "$valor" ." LIKE '%".$pal."%' or ";
                }
             
             
                foreach ($aIgual as $key => $valor) {
                  $valor = $this->eliminar_acentos($valor);
                  $cadena.= "$valor"." = '".$pal."' or ";
                }

                  $cadena.=" 1=2 ) and ";
              }
          }

      }






      $cadena.= "1=1";

      return($cadena);

    }


/*

    public function insertPost($post,$tabla)
    {
      $campos = "";
      $valores = "";
      $cant = count($post);
      $cont=0;
      $array = array();


      if(trim($this->info['getIdForInsert'])!=""){
          $res = $this->ssql($this->info['getIdForInsert'],array(),1);
          
          $post[$this->info['idT']]=$res["ID"];
          array_push($this->form, array('campo' =>$this->info['idT']) );
      }


      $campos      = "";
      $referencias = ""; 
      $valArray    = array();
      foreach ($this->form as $key => $fila) {
        if(isset($fila["campo"])){
          $campos = $campos.", ".$fila["campo"];
          
          if($fila["tipo"]=='date'){ 
              if(DB['local']['MANAGER']=="oracle")
              $referencias = $referencias.", TO_DATE(:".$fila["campo"].",'YYYY-MM-DD')";
              else
              $referencias = $referencias.", DATE_FORMAT(:".$fila["campo"].",'%Y-%m-%d')";
            }else if($fila["tipo"]=='datetime-local'){ 
              if(DB['local']['MANAGER']=="oracle"){ 
               // echo "HORA: ".$fila["campo"]; 
                $fila["campo"] = str_replace("T", " ", $fila["campo"]);
              $referencias = $referencias.", TO_DATE(:".$fila["campo"].",'YYYY-MM-DD HH:MI')";
            }
              else
              $referencias = $referencias.", DATE_FORMAT(:".$fila["campo"].",'%Y-%m-%d')";

          }else
              $referencias = $referencias.", :".$fila["campo"];

          $valArray[$fila["campo"]] = $post[$fila["campo"]];
        }
      }

        $miSQL = "INSERT INTO ".$this->info['tabla']." (".$campos.") VALUES (".$referencias.")";

        $miSQL = str_replace("(,","(",$miSQL);
       


      $res = $this->ssql($miSQL,$valArray);

      return($post[$this->info['idT']]);
      
    }
*/

/*
    public function updatePost($post,$tabla,$nomId)
    {
      $valores = "";
      $cant = count($post);
      $cont=0;
      $array = array();
echo "<pre>";
echo "****";
   echo "</pre>";   

      foreach ($post as $key => $value) {
        
        if($cont<$cant-2) $coma = ","; else $coma="";
        if($key != "id_tabla"){ 

         $fecha = false;
         if (!(strpos($key, "tipodate_") === false)) { $key = str_replace("tipodate_", "", $key); $fecha = true; }
         echo "--->".$key."$value <br/>";
          if ((strpos($key, "palabra_") === false))  { 
              if($fecha){ 
                  if(DB['local']['MANAGER']=="oracle")
                      $valores .= "$key = TO_DATE(:".$key.",'YYYY-MM-DD')$coma";
                  else
                      $valores .= "$key = DATE_FORMAT(:".$key.",'%Y-%m-%d')$coma";

              }else
                  $valores .= "$key = :".$key."$coma";
          

          
          $array[":".$key]= $this->val($value);
          }
        }
        $cont++;
      } 

      $array[":idt"] = $post["id_tabla"];

      if(DB['local']['MANAGER']=="oracle"){ $cadLimite = "AND ROWNUM = 1"; } else { $cadLimite = " LIMIT  1";}


      $sql = "UPDATE $tabla  SET $valores  WHERE $nomId=:idt $cadLimite";

      

      $res = $this->ssql($sql,$array);
      
      if($res===true)
      {
        return($post["id_tabla"]);
      }
      else
      {
        return($res);
      }
      
    }
*/
    public function putInfo($post, $controlador)
    {
     // echo "*****";
      $cont=0;
      foreach ($this->tablas as $key => $fila) {

        $res[ $fila['id'] ] = $this->putPost($cont,$post,$this->form,$key,$fila, $controlador);

        $post[$fila['id']] = $res[ $fila['id'] ];
       // if(isset($post["id_tabla"]))$post["id_tabla"]=0;
        /*
        if($post["id_tabla"]==0)
          $res = $this->insertPost($post,$this->info['tabla']);
        else
          $res = $this->updatePost($post,$this->info['tabla'],$this->info['idT']);
        */
        $cont++; 
      }

       if(@$this->info["idIdioma"]!="" and @$this->info["idIdGrupoIdioma"]!="" and ( $post["id_grupo_idioma"]==0 or $post["id_grupo_idioma"]=="")  ){
          $res["id_grupo_idioma"] = $res["id"];
       }
     // print_r($res);
        return($res); 
    }

    public function putPost($num,$datos,$form,$keyt,$infoTabla, $controlador){ //$cont,$post,$this->form,$key,$fila
     
      $nomt = $infoTabla["nom"];
      $idt  = $infoTabla["id"];
      $camposInsert1 = "";
      $camposInsert2 = "";
      $camposCheckInsert1 = "";
      $camposCheckInsert2 = "";
      $arrayValores  =  array();
      $cadLimite = "";
      $cadenaUpd     = "";
      $idUpd         = "";
      $insertar      = false;

      //if($num==0) { 
        /*
        $idC = $datos["id_tabla"]; 
        $datos[$idt] = $datos["id_tabla"]; 
        $form[] = array("campo" => $idt); 
        */
      //} 

      $idC = $datos[$idt];
      $sqlConsulta = "SELECT COUNT(*) AS T FROM $nomt WHERE $idt=:id"; //si existe
      $res = $this->ssql($sqlConsulta,array(":id"=>$idC),1);

      if($res["T"]==0){
        $insertar=true;
        if(trim($infoTabla["getId"]!="") ){
          $resId = $this->ssql($infoTabla["getId"],array(),1); //obtengo el nuevo id
          if(empty($resId["ID"]))
            $datos[$idt] = 1;
          else
            $datos[$idt] = $resId["ID"];
          //echo $resId["ID"]."-----";
        }
        if(@$this->info["idIdioma"]!="" and @$this->info["idIdGrupoIdioma"]!="" ){

          if($datos["id_grupo_idioma"]=="" or $datos["id_grupo_idioma"]==0)
            $datos["id_grupo_idioma"] = $resId["ID"];

        }
        if(trim($infoTabla["getId"])=="" and $num!=0){
          //Toma el ID calculado de la tabla con la que etá relacionada.
          $datos[$idt] = $datos[ $this->tablas[ $infoTabla["tRel"] ]["id"] ] ; 
        }
      }
      //print_r($res);

      foreach ($form as $key => $fila) {
        if (!isset($fila["tabla"]) and $num==0) 
          $fila["tabla"] = $keyt;

          if($fila["tabla"]==$keyt){
                if(isset($fila["campo"])) {

                  if(@$fila["disabled"] == 'true') //si el campo tiene la propiedad 'disabled' igual a 'true' no lo buscamos en base de datos  
                    continue;

                  if($fila["tipo"]=="checkbox" OR $fila["tipo"]=="select_multiple" OR $fila["tipo"]=="dual_listbox"  ){
                    if(isset($datos[$fila["campo"]]))
                      $valores = $datos[$fila["campo"]];
                    else
                      $valores = 0;
                   //$idTabla = ;
                    //echo $fila["tabla"]."<br/>";
                    //echo $keyt."<br/>";
                   // print_r($infoTabla);

                   // $this->insertMultiple($fila, $valores, $datos["id"], $insertar); //array de los datos del Check, valores del check, id registro
                     //$this->insertMultiple($fila, $valores, $datos[$infoTabla["id"] ], $insertar); //array de los datos del Check, valores del check, id registro
                  }else{
                    if($fila["tipo"]=="date"  ){ 
                      if(DB['local']['MANAGER']=="oracle")
                      $campo = "TO_DATE( :".$fila["campo"]." , 'YYYY-MM-DD' )";
                      else
                      $campo = "DATE_FORMAT( :".$fila["campo"]." , '%Y-%m-%d' )";
                    }else if($fila["tipo"]=='datetime-local'){ 
                          if(DB['local']['MANAGER']=="oracle"){ 
                              $campo = "TO_DATE( :".$fila["campo"]." , 'YYYY-MM-DD HH24:MI')";

                          }
                            //FALTA AGREGAR PARA MYSQL                   
                    }elseif($fila["tipo"]=="uploadfile"){
                      if(isset($datos[$fila["campo"]])){                        
                        if($datos[$fila["campo"]]['name']!=''){ //Verifico si fue seleccionado el archivo por el usuario
                          $res_ruta_file = $this->subir_archivo($fila, $datos[$fila["campo"]],$datos[$idt]);
                          if($res_ruta_file){
                            $campo = ":".$fila["campo"];  //Campo
                            $ruta_file = $res_ruta_file; //Valor
                          }                      
                        }else{
                          //Si no se selecciono ningún archivo nos saltamos la asignación de este campo en la consulta sql
                          continue;
                        }
                      }
                    }else
                      $campo = ":".$fila["campo"];

                        //===Campos
                        if($insertar){ //para insertar
                          $camposInsert1  = $fila["campo"].", ".$camposInsert1;
                          $camposInsert2  = $campo.", ".$camposInsert2;                         
                        }else{ //para actualizar
                         // echo $fila["campo"]." - ".$infoTabla["id"]." <br/>";
                          if( trim($fila["campo"]) != trim($infoTabla["id"]) ){
                            $cadenaUpd =  $fila["campo"]."=".$campo.", ".$cadenaUpd;
                          }
                        }

                    
                    //===valores
                    if($fila["tipo"]=='datetime-local')
                      $valor = str_replace("T", " ", $datos[$fila["campo"]]); 
                    elseif($fila["tipo"]=='password' and strlen($datos[$fila["campo"]])<20){
                      $valor = Hash::getHash('sha1', $datos[$fila["campo"]], HASH_KEY);
                    }elseif($fila["tipo"]=="uploadfile"){
                      if(isset($ruta_file))
                        $valor = $ruta_file;
                    }elseif($fila["tipo"]=="select" and $datos[$fila["campo"]]==""){
                      
                         $valor=0;

                         

                    }elseif($fila["tipo"]=="date" and $datos[$fila["campo"]]==""){
                      
                         $valor='0001-01-01';
                         
                         
                    
                         
                    }else 
                      $valor = $datos[$fila["campo"]];
                    
                    $arrayValores[":".$fila["campo"]] = trim($valor);
                  }
                }
          }

      }
      //echo "--"; print_r($camposInsert2); echo "--";exit;
    
      if($insertar){
        $sql = "INSERT INTO $nomt ($camposInsert1) VALUES ($camposInsert2)";
        $sql = str_replace(", )",")",$sql);
        $accion_log = 1; //insertar
      }else{
        $sql = "UPDATE $nomt SET $cadenaUpd WHERE $idt = :$idt $cadLimite ";
        $sql = str_replace(",  WHERE"," WHERE",$sql);
        $accion_log = 2; //actualizar
      }


      /*
      echo " $sql <br/>valores:<br/>"; 
      echo "<pre>";
      print_r($arrayValores);
      echo "</pre>";
      */
      //echo $sql;
      $res = $this->ssql($sql,$arrayValores);

      //Insertar campo de opciones múltiples
      foreach ($form as $key => $fila) {
        if (!isset($fila["tabla"]) and $num==0) 
          $fila["tabla"] = $keyt;
        if($fila["tabla"]==$keyt){
          if(isset($fila["campo"])) {

            if($fila["tipo"]=="checkbox" OR $fila["tipo"]=="select_multiple" OR $fila["tipo"]=="dual_listbox"  ){
              if(isset($datos[$fila["campo"]]))
                $valores = $datos[$fila["campo"]];
              else
                $valores = 0;

             //$idTabla = ;
              //echo $fila["tabla"]."<br/>";
              //echo $keyt."<br/>";
             // print_r($infoTabla);

             // $this->insertMultiple($fila, $valores, $datos["id"], $insertar); //array de los datos del Check, valores del check, id registro
               $this->insertMultiple($fila, $valores, $datos[$infoTabla["id"] ], $insertar); //array de los datos del Check, valores del check, id registro
            }
          }
        }
      }
      
      $this->putLog($controlador, $accion_log, $datos[$idt]);
      


      /*
      $sql2 = "UPDATE CNT_USUARIOS SET USUA_ID_ROLE=1, USUA_ACTIVO= 1, USUA_NOMBRE= :USUA_NOMBRE, USUA_ID_USUARIO='xqwe'  
      WHERE USUA_ID_USUARIO = 'xqwe' and ROWNUM=1";
      $res = $this->ssql($sql2,array(':USUA_NOMBRE'=>'iiii'));
      */
      //print_r(array(':USUA_NOMBRE'=>'iiii'));
      //echo "------------>".$res;
      return($datos[$idt]);
      

    }
    public function insertMultiple($fila, $datos, $id_reg, $insertar = 0) 
    {
      $tabla_g = $fila["tabla_g"];
      $id_tabla_g = $fila["id_tabla_g"];
      #$campo_tabla_g = $fila["campo_tabla_g"];
      $valor_tabla_g = $fila["valor_tabla_g"];
      $campo = $fila['campo'];
      
      if(isset($fila["campo_tabla_g"])){
            $campo_tabla_g = $fila["campo_tabla_g"];

            //verifico si hay registros y si sí hay los elimino
            if(!$insertar){ 
              if(DB['local']['MANAGER']=="oracle"){ $cadLimite = "AND ROWNUM = 1"; } else { $cadLimite = " LIMIT  1";}

              $sql = "SELECT $id_tabla_g, $campo_tabla_g FROM $tabla_g WHERE $id_tabla_g = :id AND $campo_tabla_g = :campo $cadLimite";

              $array2 = array(":id"=>$id_reg, ":campo"=>$campo);
              $res = $this->ssql($sql,$array2);
              if(is_array($res)){
                $sql = "DELETE FROM $tabla_g WHERE $id_tabla_g = :id AND $campo_tabla_g = :campo"; //LIMIT 1          
                $this->ssql($sql,$array2);
              }        
            }

            //si hay valores en form los inserto en la tabla
            $array[":".$id_tabla_g] = $id_reg;
            $array[":".$campo_tabla_g] = $campo;
            if(is_array($datos)){ //$datos[$fila["campo"]] = array con los valores del check
              foreach ($datos as  $valor) {
                $array[":".$valor_tabla_g] = $valor;
                $sql = "INSERT INTO $tabla_g ($id_tabla_g, $campo_tabla_g, $valor_tabla_g) VALUES (:$id_tabla_g, :$campo_tabla_g, :$valor_tabla_g)";
                $this->ssql($sql,$array);
              }
            }
      }else{
            //verifico si hay registros y si sí hay los elimino
            if(!$insertar){
            if(DB['local']['MANAGER']=="oracle"){ $cadLimite = "AND ROWNUM = 1"; } else { $cadLimite = " LIMIT  1";}

              $sql = "SELECT $id_tabla_g FROM $tabla_g WHERE $id_tabla_g = :id $cadLimite";
              $array2 = array(":id"=>$id_reg);
              $res = $this->ssql($sql,$array2);
              if(is_array($res)){
                $sql = "DELETE FROM $tabla_g WHERE $id_tabla_g = :id"; //LIMIT 1          
                $this->ssql($sql,$array2);
              }        
            }

            //si hay valores en form los inserto en la tabla
            $array[":".$id_tabla_g] = $id_reg;
            if(is_array($datos)){ //$datos[$fila["campo"]] = array con los valores del check
              foreach ($datos as  $valor) {
                $array[":".$valor_tabla_g] = $valor;
                $sql = "INSERT INTO $tabla_g ($id_tabla_g, $valor_tabla_g) VALUES (:$id_tabla_g, :$valor_tabla_g)";
                $this->ssql($sql,$array);
              }
            }
      }

      
    }
//////////////////////////////////////////////////////////////////////////////////////////////////



    public function getInfoById($id,$idIdioma=0,$generator="", $duplicar = 0) //For Editar
    {
      $campos = "";
      $res = array();
      $res_multiple = array();
      $res_archivos = array();

      foreach ($this->form as $key => $fila) {
            if(isset($fila["campo"])){

                  if(@$fila["disabled"] == 'true') //si el campo tiene la propiedad 'disabled' igual a 'true' no lo buscamos en base de datos  
                    continue;
              
                  if($fila["tipo"] == "checkbox" OR $fila["tipo"] == "select_multiple" OR $fila["tipo"] == "dual_listbox"){
                    $valores = $this->getValoresMultiples($id, $fila);
                    $res_multiple = array_merge($res_multiple, $valores);
                  }else if($fila["tipo"]=="date"){
                      if(DB['local']['MANAGER']=="oracle")
                        $campos = "TO_CHAR( ".$fila["campo"]." , 'YYYY-MM-DD' ) AS ".$fila["campo"].", ".$campos;
                      else
                        $campos = "DATE_FORMAT( ".$fila["campo"]." , '%Y-%m-%d' ) AS ".$fila["campo"].", ".$campos;
                  }elseif($fila["tipo"]=="uploadfile"){
                    $res_archivo = $this->get_files($generator, $fila, $id);                   
                    $res_archivos[$fila["campo"]] = $res_archivo;                                    
                  }else
                      $campos = $fila["campo"].", ".$campos;
            }

      }
        $tablas = "";        
        $contTablas = 0;

               // print_r($this->tablas);

        foreach ($this->tablas as $key => $fila) {
          if($contTablas==0) 
          {
            $tablas = $fila["nom"];
            if($idIdioma==0)
                $campoConsulta = $fila["nom"].".".$fila["id"];
            else
                $campoConsulta = " id_idioma = $idIdioma AND id_grupo_idioma ";
          }else{
            $tablas .= " LEFT JOIN ".$fila["nom"]." 
            ON ".$fila["nom"].".".$fila["id"]."=".
                $this->tablas[$fila["tRel"]]["nom"].".".$fila["cRel"];
          }
          $contTablas++;
        }
        

        //Verifico si hay alguna condición para colocársela a la consulta SQL
        $validaEdicion = "";
        if(isset($this->info['validaEdicion']) AND $this->info['validaEdicion'] != ""){
          $validaEdicion = "AND ".$this->info['validaEdicion'];
        }
        

        $sql   = "SELECT $campos FROM $tablas WHERE $campoConsulta =:id $validaEdicion"; //LIMIT 1
        $sql = str_replace(",  FROM"," FROM",$sql);

        $array = array(":id"=>$id);
        $res = $this->ssql($sql,$array,1);

        if(!is_array($res))  $res = array();
        
        $resultado = array_merge($res, $res_multiple, $res_archivos);
        /*echo "<pre>";
         print_r($resultado);
        echo "</pre>";*/
        if($duplicar){
          $nombre_id = $this->tablas['p']['id'];
          $resultado[$nombre_id] = '';
        }

        return($resultado);
    }

    public function getValoresMultiples($id, $fila){
      $res_multiple = array();
      $tabla = $fila["tabla_g"];
      $id_tabla = $fila["id_tabla_g"];
      $col_valor = $fila["valor_tabla_g"];
      
      if(isset($fila["campo_tabla_g"])){
        $campo = $fila["campo_tabla_g"];
        $sql_checkbox = "SELECT $col_valor FROM $tabla WHERE $id_tabla = :id AND $campo = :campo";        
        $array = array(":id"=>$id, ":campo"=>$fila["campo"]);
      }else{        
        $sql_checkbox = "SELECT $col_valor FROM $tabla WHERE $id_tabla = :id ";         
        $array = array(":id"=>$id);        
      }
      
      $sql_checkbox = str_replace(",  FROM"," FROM",$sql_checkbox);

     // echo "[$sql_checkbox]\n";
      
      $res_check = $this->ssql($sql_checkbox,$array,2);
      if(is_array($res_check)){
        foreach ($res_check as $c) {
          foreach ($c as  $c2) {
            $res_multiple[$fila["campo"]][$c2] = 1 ;                         
          }                      
        } 
      }
      return $res_multiple;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    public function cargarOpciones($table,$id,$campo,$idSel=0)
    {   
        $sql   = "SELECT ".$this->delEsp($id)." AS idt, ".$this->delEsp($campo)." AS campo FROM ".$this->delEsp($table)."";
        $array = array();
        $res   = $this->ssql($sql,$array);
        $resop = $this->conformaOption($res);
        return($resop);
    }
    private function conformaOption($info)
    {
        $cad="";
        foreach ($info as $key => $f) {
            $cad.='<option id="'.$f["idt"].'">'.$f["campo"].' </option>';
        }
        return($cad);
    }
    private function delEsp($cad)
    {
        $cad = str_replace(" ","",$cad);
        return($cad);
    }

    public function getInfoSQL($sql,$id)
    {
        if(DB['local']['MANAGER']=="oracle")
          $this->ssql("alter SESSION set NLS_DATE_FORMAT = 'DD/MM/YYYY'");

        $res  = $this->ssql("SELECT ID,DENOMINA FROM ( ".$sql.") T WHERE ID = :id",array(":id"=>$id),1);
        return($res);
    }
    public function execSQL($sql,$thearray)
    {
      if(DB['local']['MANAGER']=="oracle")
        $this->ssql("alter SESSION set NLS_DATE_FORMAT = 'DD/MM/YYYY'");
      $res  = $this->ssql($sql,$thearray);
      return($res);
    }

    public function searchInfoSQL($sql,$palabra)
    {
      if(DB['local']['MANAGER']=="oracle")
        $this->ssql("alter SESSION set NLS_DATE_FORMAT = 'DD/MM/YYYY'");

      $palabra= strtoupper($palabra);
      if(DB['local']['MANAGER']=="oracle")
        $sql = "SELECT ID,DENOMINA FROM ( $sql) T WHERE (translate(upper(DENOMINA), 'ÁÉÍÓÚ', 'AEIOU')) LIKE '%$palabra%'";
      else
        $sql = "SELECT ID,DENOMINA FROM ( $sql) T WHERE UPPER(DENOMINA) LIKE '%$palabra%' ";
      

       


      // echo $sql; 
      $res  = $this->ssql($sql,array());
      return($res);
    }

    //Esta función es usada por el componente Select2 que usa el método AJAX
    public function searchInfoSQLSelect2Ajax($sql,$palabra)
    {
        $palabra= strtoupper($palabra);
        $partes = explode(" ", $palabra);
        $condicion = "";
        foreach ($partes as $key => $parte) {
          if($key > 0)
            $condicion .= "AND ";
          if(DB['local']['MANAGER']=="oracle")
            $condicion .= "(translate(upper(\"text\"), 'ÁÉÍÓÚÑ', 'AEIOUN')) LIKE '%$parte%' ";
          else
           $condicion .= "UPPER(text) LIKE '%$parte%'  "; 

        }
        if(DB['local']['MANAGER']=="oracle")
          $sql = "SELECT \"id\",\"text\" FROM ( $sql) T WHERE $condicion";
        else
          $sql = "SELECT id,text FROM ( $sql) T WHERE $condicion";
        $res  = $this->ssql($sql,array());
        //$res = array_change_key_case($res, CASE_LOWER ); //convierte a minusculas 
        return($res);
    }
    public function getInfoSQLSelect2Ajax($sql,$id)
    {
      //echo "SELECT \"id\",\"text\" FROM ( ".$sql.") T WHERE \"id\" = '$id'";
      $limit = $this->getLimitSQL();
     // $res  = $this->ssql("SELECT id,text FROM ( ".$sql.") T WHERE id = :id " . $limit ,array(":id"=>$id),1);
      $res  = $this->ssql("SELECT \"id\",\"text\" FROM ( ".$sql.") T WHERE \"id\" = :id " . $limit ,array(":id"=>$id),1);

      return($res);
    }


    /*
    DESACTIVADO 18/11/2020
    public function busqueda2($palabra)
    {
        $filtro = $this->filtroBusqueda($this->info['busqLike'],$this->info['busqIgual'],$palabra);
        
       // $sql = "SELECT ".$this->info['colT'].",".$this->info['idT']." AS IDDFILA FROM ".$this->info['tabla']." WHERE $filtro ORDER BY ".$this->info['orderBy']." ".$this->info['orderP'];
        
        $sql = "SELECT * FROM (".$this->info['sqlDeplegar'].") WHERE ". $filtro;

        //echo "-------------------> $sql";

        $res = $this->ssql($sql,null,2);
        return($res);
    }
    */

    public function get_total_sin_filtrar($filtro="")
    {       
      //$tabla = $this->tablas['p']['nom'];

      if($filtro!="" and isset($this->info['idFiltro']) )
      {

          if(!isset($this->info['sqlContar']) ){ //===> ¡Averigua si tiene caso dejar 'sqlContar' o en que casos vale la pena usarlo!
            $sql = "SELECT count(*) as TOTAL FROM (" . $this->info['sqlDeplegar'] . ") t";
          }else{
            $sql = $this->info['sqlContar'];
          }
      }else{
          if(!isset($this->info['sqlContar']) ){
            $sql = "SELECT count(*) as TOTAL FROM (" . $this->info['sqlDeplegar'] . ") t"; //" WHERE ".$this->info['idFiltro']." = '".$filtro."'";
          }else{
            $sql = $this->info['sqlContar']; // ." WHERE ".$this->info['idFiltro']." = '".$filtro."'"; 
          }
      }

     // echo " - $sql - ";
      $records = $this->ssql($sql,null,1);
      return $records['TOTAL'];
    }

    public function get_total_con_filtro($searchQuery="",$searchValue="")
    {     
      $cadenaBusqueda = $this->filtroBusqueda($this->info['busqLike'],$this->info['busqIgual'],$searchValue);
      
      $sql = "SELECT count(*) as ALLCOUNT FROM (" . $this->info['sqlDeplegar'] . ") t WHERE  1=1 AND ".$cadenaBusqueda."
      AND  1=1  ".$searchQuery;
      $records = $this->ssql($sql,null,1);
      return $records['ALLCOUNT'];
    }

    public function get_datos($searchQuery="", $columnName="", $columnSortOrder="", $row=0, $rowperpage=0,$searchValue="",$filtro="")
    { 
      if(DB['local']['MANAGER']=="oracle")
        $this->ssql("alter SESSION set NLS_DATE_FORMAT = 'DD/MM/YYYY'");

      if($rowperpage>0)
        $cadenaBloque = " WHERE NUM BETWEEN ".($row+1)." AND ".($row+$rowperpage);
      else
        $cadenaBloque = "";

      if($filtro!="" and isset($this->info['idFiltro']) )
      {
         $SqlGlobal = "SELECT * FROM (".$this->info['sqlDeplegar'].") WHERE ".$this->info['idFiltro']." = '".$filtro."'";
      }else{
         $SqlGlobal = $this->info['sqlDeplegar'];
      }

      $cadenaBusqueda = $this->filtroBusqueda($this->info['busqLike'],$this->info['busqIgual'],$searchValue);      


          
      if(DB['local']['MANAGER']=="oracle"){
          $sql = "
          SELECT * FROM (
            SELECT * FROM ( 
              SELECT ROWNUM AS NUM,R.*  FROM ( 
                SELECT * FROM ( " . $SqlGlobal . ") t WHERE  1=1 AND ".$cadenaBusqueda." 
              ) R WHERE  1=1  ".$searchQuery." order by ".$columnName." ".$columnSortOrder."
            ) R
          )R $cadenaBloque ";

      }else{
          $sql = "
          SELECT * FROM (
            SELECT * FROM ( 
              SELECT @rownum:=@rownum+1 AS NUM,R.*  FROM ( 
                SELECT * FROM ( " . $SqlGlobal . ") t WHERE  1=1 AND ".$cadenaBusqueda." 
              ) R, (SELECT @rownum:=0) N WHERE  1=1  ".$searchQuery." order by ".$columnName." ".$columnSortOrder."
            ) R
          )R $cadenaBloque ";

        /*$sql = "
        SELECT * FROM (" . $SqlGlobal . ") t WHERE  1=1 AND ".$cadenaBusqueda." AND  1=1  ".$searchQuery." order by ".$columnName." ".$columnSortOrder."
        LIMIT ".$row.",".$rowperpage;*/
        #$sql = "SELECT * FROM (" . $this->info['sqlDeplegar'] . ") t WHERE 1=1 ".$searchQuery." order by ".$columnName.
        #" ".$columnSortOrder." limit ".$row.",".$rowperpage;
      }
      /*
      echo "<pre>";
      print_r($sql);
      echo "</pre>";
      */    
      $res = $this->ssql($sql,null,2);
      return $res;
    }

    /*public function getColums()
    {     
      if(DB['local']['MANAGER']=="oracle"){
        // Nombre de la tabla principal (en mayúsculas)
        $table = strtoupper($this->tablas['p']['nom'] ?? '');
        if (!$table) {
            return [];
        }

        // Consulta al diccionario de Oracle para obtener las columnas
        $sql = "
          SELECT column_name
          FROM user_tab_columns
          WHERE table_name = '{$table}'
        ";
        $rows = $this->ssql($sql, null, 2);
        //print_r($rows);
        if (!is_array($rows)) {
            return [];
        }

        // Extraigo solo el campo COLUMN_NAME
        return array_map(function($r){
            return $r['COLUMN_NAME'];
        }, $rows);
      }else{
        // Para MySQL

      }

    }*/

    public function getColums()
    {
        // 1) ¿Tenemos un sqlDeplegar definido?
        $sql = $this->info['sqlDeplegar'] ?? '';        
        if (preg_match('/^\s*SELECT\s+(.*?)\s+FROM\s+/is', $sql, $m)) {
            $colsList = trim($m[1]);
            // 1.a) Si es sólo un "*", vuelvo al metadata
            if ($colsList === '*' || preg_match('/^\*\s*(,\s*\*)*$/', $colsList)) {
                return $this->getColumnsFromMetadata();
            }
            // 1.b) Desgloso la lista separada por comas
            $pieces = explode(',', $colsList);
            $result = [];
            foreach ($pieces as $col) {
                $col = trim($col);
                // alias con " AS "
                if (preg_match('/\s+AS\s+(.+)$/i', $col, $am)) {
                    $name = trim($am[1], '"` ');
                }
                // alias sin AS: "expr alias"
                elseif (preg_match('/\s+([A-Za-z0-9_"]+)$/', $col, $am2)) {
                    $name = trim($am2[1], '"` ');
                }
                else {
                    // quito calificador de tabla: "tabla.col"
                    $parts = explode('.', $col);
                    $name  = trim(end($parts), '"` ');
                }
                $result[] = $name;
            }
            return $result;
        }

        // 2) Si no pude extraer columnas explícitas, voy al metadata
        return $this->getColumnsFromMetadata();
    }

  /**
   * Consulta al diccionario de Oracle o MySQL para sacar
   * los nombres de campo sin traer filas.
   */
  private function getColumnsFromMetadata(): array
  {
      // detecto manager
      if (DB['local']['MANAGER'] === "oracle") {
          $table = strtoupper($this->tablas['p']['nom'] ?? '');
          if (!$table) return [];
          $sql = "SELECT column_name FROM user_tab_columns WHERE table_name = '{$table}'";
          $rows = $this->ssql($sql, null, 2);
          return is_array($rows)
              ? array_map(function($r) { return $r['COLUMN_NAME']; }, $rows)
              : [];
      } else {
          // MySQL
          $table = $this->tablas['p']['nom'] ?? '';
          if (!$table) return [];
          $rows = $this->ssql("SHOW COLUMNS FROM {$table}", null, 1);
          return is_array($rows)
              ? array_map(function($r) { return $r['Field']; }, $rows)
              : [];
      }
  }

    
       
    public function putLog($generator, $id_accion, $id_reg)
    {     
      $id_usuario = $_SESSION['id_usuario'.BASE_SESION];
      $ip = $_SERVER["REMOTE_ADDR"];
      $id = $this->nexIdLog();
      if(DB['local']['MANAGER']=="oracle"){
        $fecha = "TO_DATE(:fecha, 'YYYY-MM-DD HH24:MI')";
      }else{
        $fecha = "DATE_FORMAT( :fecha , '%Y-%m-%d' )"; //no terminado
      }

      //date_default_timezone_set('america/Cancun');
      $sql = "INSERT INTO log_generator (id, generator, id_accion, id_registro, id_usuario, fecha, ip ) VALUES (:id, :generator, :id_accion, :id_registro, :id_usuario, $fecha, :ip)";

      #$sql = "INSERT INTO log_generator (id, generator, id_accion, id_registro, id_usuario, fecha, ip) VALUES ($id, '$generator', $id_accion, $id_reg, $id_usuario, TO_DATE('$fecha', 'YYYY-MM-DD HH24:MI'), '$ip')";
 
      $arrayValores = array(
        ':id' => $id, 
        ':generator' => $generator, 
        ':id_accion' => $id_accion,
        ':id_registro' => $id_reg,
        ':id_usuario' => $id_usuario,
        ':fecha' => date("Y-m-d H:i"),
        //':hora' => date("H:i:s"),
        ':ip' => $ip,
        //':nickname' => $_SESSION['usuario'.BASE_SESION],
      );

      

      $this->ssql($sql,$arrayValores);
      
    }


    public function nexIdLog(){
    
    $etiquetas = $this->_db->query("SELECT MAX(id) AS \"id\" FROM log_generator");
    $row = $etiquetas->fetch();
    $id = $row["id"] + 1;
    return $id;
    
  }

  public function eliminar_archivo_bd($id, $nom_col_file, $idtabla)
  {
    if(DB['local']['MANAGER']=="oracle"){ $cadLimite = "AND ROWNUM = 1"; } else { $cadLimite = " LIMIT  1";}

      //$sql = "DELETE FROM ".$this->tablas['p']['nom']." WHERE ".$this->tablas['p']['id']."=:id $cadLimite "; //LIMIT 1
      $tabla = $this->tablas[$idtabla]['nom'];
      $idBD = $this->tablas[$idtabla]['id'];
      $sql = "UPDATE ".$tabla." SET $nom_col_file = '' WHERE ".$idBD."=:id $cadLimite";

      $array = array(':id' =>trim($id));
      //echo $sql;

      $res = $this->ssql($sql,$array, null);    
      return($res);
  }

  public function subir_archivo($fila, $datos, $id_reg)
  {

    //obtengo el id del registro, para crear la carpeta contenedora de los archivos
    $folder_name = $id_reg; 
    $file_name = $datos['name'];
    $partes = explode(".", $file_name); //Se divide el nombre para extraer la extensión 
    $ext = strtolower(end($partes));

    //genero nombre para guardar        
    $nombre_archivo_post = $fila["file_name"] . "." . $ext; //Nombre del archivo que se va a guardar 
    $ruta = $fila["path"] . "/" . $folder_name; //Ruta de la carpeta en donde se va a guardar el archivo
    $destino = $ruta . "/" . $nombre_archivo_post; //Ruta y nombre del archivo
    
    //creo la carpeta si no existe 
    if (!file_exists($ruta)) { 
        mkdir($ruta, 0777, true);
    }
    
    //Verifico si ya existe el archivo, si existe lo elimino, (aunque tenga otra extención se va a eliminar)
    $archivos_encontrados  = scandir($ruta);                        
    foreach ($archivos_encontrados as $file_name_full) {
      list($file_name2, $ext2) = explode(".", $file_name_full);
      $ext2 = strtolower($ext2);
      if($file_name2 == $fila["file_name"]){
        if($ext2 != $ext){
          unlink($ruta."/".$file_name_full);
        }
      }
    }

    //subo el archivo
    if (move_uploaded_file($datos['tmp_name'], $destino)) {
        //$guardado = 1;
        //$campo = ":".$fila["campo"];  //Campo
        return $ruta_file = $folder_name ."/". $nombre_archivo_post; //Valor
    } else {
        echo "Hubo un error al subir el archivo ";
    }
    
  }

  public function get_files($generator, $fila, $id_reg)
  {
    //obtengo el id del registro, que es la carpeta contenedora de los archivos
    $folder_name = $id_reg;
    $file_name = $fila["campo"];
    
    //Ruta de la carpeta en donde se esta guardando el archivo
    $ruta = $fila["path"] . "/" . $folder_name; 

    //creo la carpeta si no existe 
    if (file_exists($ruta)) { 
      //mkdir($ruta, 0777, true);
      $archivos_encontrados  = scandir($ruta);
      foreach ($archivos_encontrados as $file_name_full) {
        list($file_name, $ext) = explode(".", $file_name_full);
        if($file_name == $fila["file_name"]){
          //$res_archivos[$fila["campo"]] = $file_name;
          $res_archivos["ext"] = $ext;
          $res_archivos["file_name_full"] = $file_name_full;
          $res_archivos["ruta_archivo"] = $destino = BASE_URL.$generator."/ver_archivo/".$fila["campo"]."/". $folder_name ."/". $file_name_full;
          $res_archivos["ruta_func_delete_file"] = $destino = BASE_URL.$generator."/delete_file/".$fila["campo"]."/". $folder_name ."/". $file_name_full;
          //$ruta . "/" . $file_name_full; //Ruta y nombre del archivo
          return $res_archivos;
          break;
        }//else
          //$file_name = ""; 
      }
    }
    return "";
  }

  public function get_opciones_listas_dependientes($sql)
  {   
      $array = array();
      $res   = $this->ssql($sql,$array);
      return($res);
      
      

      
  }
    
// WHERE ROWNUM BETWEEN ".$row." AND ".$rowperpage."


  public function get_datosFull($filtro)
    { 



          if(isset($this->info['idFiltro']) )
          {

                $sql = "SELECT * FROM (" . $this->info['sqlDeplegar'] . ") t WHERE ".$this->info['idFiltro']." = '".$filtro."'";
              
          }else{
                $sql = "SELECT * FROM (" . $this->info['sqlDeplegar'] . ") t ";
              
          }

         // echo " - $sql - ";
          $records = $this->ssql($sql);
          return $records;


    }

      public function putOrdenEtiquetas($post) {
 

    if(isset($_POST["nestable-output"]) and $_POST["nestable-output"]){

      $aItems = json_decode($_POST["nestable-output"],true);
      /*
      echo "<pre>";
          print_r($aItems);
          echo "</pre>";*/


          $cont=1;
          foreach($aItems as $i){


            $idItem = $i["id"];
        //echo "(".$idItem.":1)";
            $this->ssql("UPDATE ".$this->tablas['p']['nom']." SET ".$this->template['displayInfo']['realOrden']." = '$cont', ".$this->template['displayInfo']['realProfundidad']." = 1 WHERE ".$this->template['displayInfo']['realId']." = $idItem LIMIT 1");
            $cont++;


        //if(isset($i["children"])){
            if(array_key_exists('children',$i)){
              $hijos = $i["children"];
          /* echo "<pre>";
          print_r($i);
          echo "</pre>";
          */
          foreach($hijos as $si){
            $idSItem = $si["id"];
            //echo "(".$idSItem.":2)";
            $this->ssql("UPDATE ".$this->tablas['p']['nom']." SET ".$this->template['displayInfo']['realOrden']." = '$cont', ".$this->template['displayInfo']['realProfundidad']." = 2 WHERE ".$this->template['displayInfo']['realId']." = $idItem LIMIT 1");
            $cont++;
          }

        }

      }

    }else{
      echo "Es necesario crear items";
    }
    
  }

  public function putStatus($post) {
    if ($_POST['status']=='true')
      $status = 1;
    else
      $status = 0;
    //print_r($post);
    try { 
      $conf = $this->ssql("UPDATE ".$this->tablas['p']['nom']." SET ".$this->template['displayInfo']['realStatus']."=".$status." WHERE ".$this->template['displayInfo']['realId']." = ".$post["id"]." LIMIT 1");
      
    }catch( PDOException $Exception ) {
      echo $Exception->getMessage( );
      throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
    }     
  }

  public function change_status($controlador, $array_ids, $colName, $valor)
  {
      $cadena_ids = implode(",", $array_ids);

      $sql = "UPDATE ".$this->tablas['p']['nom']." SET $colName = $valor WHERE ".$this->tablas['p']['id']." IN ($cadena_ids)";
      $res = $this->ssql($sql);

      foreach ($array_ids as $key => $id) {
        $this->putLog($controlador, 2, $id);
      }
      
      return($res);
  }

  public function getDatosGraficas($sql)
  {
      $sql = $sql;
      $res = $this->ssql($sql);
      return($res);
  }

}

?>