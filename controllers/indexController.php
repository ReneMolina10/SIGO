<?php
/*
class indexController extends Controller
{
  private $_index;

  public function __construct()
  {
    parent::__construct();
    $this->forzarLogin();
    $this->_index = $this->loadModel('index');
  }

  public function session()
  {

    $_SESSION["_FederatedPrincipal_"]="";

    echo "<pre>";
    print_r( $_SESSION);
    echo "</pre>";

  }

  public function refresh_session()
  {

    session_start();

  }

  

  
  public function index()
  {



       $this->_view->renderizar('index', true);

  }

  
}

*/
?>


<?php
class indexController extends Controller
{
	private $_pdf;
	public function __construct() {
		parent::__construct();
		$this->forzarLogin();
		$this->_contratos = $this->loadModel('contratos');
		$this->_empleado = $this->loadModel('empleado');
        $this->_renovar = $this->loadModel('renovar');
    $this->_numPaginador = 10;
		 //$this->_edicion = $this->loadModel('proyectos');
		 //$paginador = new Paginador();
	}
public function sessions(){ 
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
}
public function copiarScaneados(){
    $pathDestino = "/opt/tmp/contratos2019";
    echo "Copiando en: ". $pathDestino;
    $res = $this->_contratos->getContratosCopiar(); 
    echo "<table border='1'>";
    foreach ($res as $k => $f) {
        //  $pathDestino = "/opt/sitios/sarh/contratos/archivos_temporales/auditoria/2020_4CARPETAS/".$f[TIPO]."/";
      if($f[CNT_PK_UA]==1)
        $dir="che";
      elseif($f[CNT_PK_UA]==2)
        $dir="coz";
      elseif($f[CNT_PK_UA]==3)
        $dir="pc";
      elseif($f[CNT_PK_UA]==4)
        $dir="c";
        elseif($f[CNT_PK_UA]==5)
        $dir="cs";
      else
        $dir="x";
      $nombreArchivoE = "CPPS".strtoupper($dir).'-'.$f[CNT_PK_CONTRATO].'-'.$f[CNT_PK_ANIO];

      $nombreArchivo = "CPS".strtoupper($dir).'-'.$f[CNT_PK_CONTRATO].'-'.$f[CNT_PK_ANIO].'.pdf';
      $nombreArchivoD = "CPPS".strtoupper($dir).'-'.$f[CNT_PK_CONTRATO].'-'.$f[CNT_PK_ANIO].'_'.$f[CNT_FK_NOEMPL].'_'.$f[NOMBRE].'.pdf';
      $nombreArchivo2 = strtoupper($dir).'-'.$f[CNT_PK_ANIO].'-'.$f[CNT_PK_CONTRATO];
      $archivoS = "/contratos/".$nombreArchivo;
      $archivo = "/opt/contratos_scan/".$dir."/".$f[CNT_PK_ANIO]."/".$nombreArchivo;
      $archivoD = $pathDestino."/". utf8_decode($nombreArchivoD);
//echo $archivoD." <br/>";
      if(!file_exists(str_replace("//","/",$archivo) )){
          echo " $archivo<br/>"; 
      } 
      if(file_exists(str_replace("//","/",$archivo) )){

        echo "<tr>";
          echo "<td>";
            echo $nombreArchivo;
          echo "</td>";
          echo "<td>";
            //echo '<a href="\contratos\\'.$nombreArchivo.'">'.$nombreArchivo2.'</a>';
            echo 'contratos\\'.$nombreArchivoD;
          echo "</td>";
          echo "<td>";
            echo 'OK';
          echo "</td>";
        echo "</tr>";

      }
      else
      {

        echo "<tr>";
          echo "<td>";
            echo $nombreArchivoE;
          echo "</td>";
          echo "<td>";
            echo '-</a>';
          echo "</td>";
          echo "<td>";
          echo 'NO';
        echo "</td>";

        echo "</tr>";

      }


     
   
        if(file_exists(str_replace("//","/",$archivo) )){
       echo "EXISTE $archivo<br/>"; 
          if (!copy($archivo, $archivoD)) {
      echo "<pre>";
        
               echo $archivo." A  ".$archivoD."\n";
            }else{
              echo "$c : $archivo copiado...\n";
            }
         echo "</pre>";
 
        }else{
          echo "<p style='color:red'>NO E $archivo<p/>";
        }
        
       
        

    }
    echo "</table>";
    
    //echo "TOTAL: $c ";
    /*
header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=excelenphp.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    */
}
public function imprimemasivoadendum(){
      $res = $this->_contratos->getAdendums();
     
       $this->_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      foreach ($res as $key => $fila) {
         $this->imprimeadendum($fila["ADE_FK_UA"]."-".$fila["ADE_ANIO"]."-".$fila["ADE_FK_NUMCONTRATO"], $fila["ADE_CLAVE"]);
      }
      $this->_pdf->Output('adendums.pdf', 'I');
  }
 
public function imprimeadendum($id,$claveA){
		
		if($id!=""){ 
			$partes = explode("-",$id);
			
			$clave  = $partes[0];
			$anio   = $partes[1];
			$numC   = $partes[2];
      			$idImprime = $clave."-".$numC."-".$anio;
			if( !is_numeric($anio) or !is_numeric($numC) ) exit();
			$infoC  = $this->_contratos->getAdendumTexto($clave,$anio,$numC);
		//	print_r($infoC); exit();
 
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
if ($clave==1) $clave = "CHE";
if ($clave==2) $clave = "COZ";
if ($clave==3) $clave = "PC";
if ($clave==4) $clave = "C";
  
$subtituloDoc = "CM".$clave."-".$claveA."-".$anio;  
$this->_pdf->SetHeaderData($logo, $sizeLogo, $tituloDoc, $subtituloDoc);
// set header and footer fonts
$this->_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, 'B', PDF_FONT_SIZE_MAIN));
$this->_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$this->_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$margenes = explode(",", "13,10,10,10,05,10"); 
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
$this->_pdf->startPageGroup();
$this->_pdf->AddPage('P','Letter');
$html = $texto;
$this->_pdf->SetFont('helvetica', '', 9.5);
$this->_pdf->writeHTML($html, true, 0, true, true);
$this->_pdf->resetHeaderTemplate();
}
  public function diastrabajador($anio){
   
    $resE = $this->_empleado->getTrabajadoresAnio($anio);
    
     /*
    echo "<pre>";
    print_r($res);
    echo "</pre>";
    */
$conEmpl = 0;
$diasTrab = array();
foreach ($resE as $keye => $fe) {
      $res = $this->_empleado->getFechasTrabajadoresAnio($anio,$fe["CNT_FK_NOEMPL"]);
      empty($diasTrab);
      $diasTrab = array();
      $c = 0; 
      foreach ($res as $key => $fila) {
            
            $fechaInicio=strtotime($fila["CNT_FECHA_INICIO"]);
            $fechaFin=strtotime($fila["CNT_FECHA_FIN"]);
            
            for($i=$fechaInicio; $i<=$fechaFin + 86400; $i+=86400){
                //echo $c." - ".date("d-m-Y", $i)."- $i -<br>";
                $diasTrab[$c] = date("d-m-Y", $i);
                $c++;
            }
      }
      /*
          echo "<pre>";
    print_r(array_unique($diasTrab));
    echo "</pre>";
*/
      $resE[$conEmpl]["DIAS_TOTALES"] = count($diasTrab);
      $resE[$conEmpl]["DIAS_UNICOS"] = count(array_unique($diasTrab));
      $conEmpl++;
  }
  /*
    echo "<pre>";
    print_r($diasTrab);
    echo "</pre>";
echo "-----------------";
    echo "<pre>";
    print_r(array_unique($diasTrab));
    echo "</pre>";
echo "--->".count(array_unique($diasTrab) ) ;
       
    echo "<pre>";
    print_r($resE);
    echo "</pre>";
   */
    $diasUnicos = array_unique($diasTrab);
    /*
   echo "<pre>";
    print_r($diasUnicos);
    echo "</pre>";
    */
    /*
      $contF = 1;
    foreach ($diasUnicos as $key3 => $f3) {
      echo $contF." - ".$f3."\n ";
      $contF++;
    }
    */
    $this->_view->assign('info', $resE);
    $this->_view->renderizar('list_trabajadores_dias_anio','inicio'); 
  }
  
  public function renovar($ua=1)
  {
    $contratos = $this->_renovar->getResultados($ua);
    $plantillas = $this->_renovar->getPlantillasAdmin();
    
      $u = $this->_renovar->getURES(); 
     // print_r($u);
    $plts =  $this->convierteOption( $plantillas ,"ID","DENOMINA");
    $this->_view->assign('plts', $plts);
    $this->_view->assign('u', $u);
    $this->_view->assign('contratos', $contratos);
    $this->_view->renderizar('listrenovar','inicio'); 
  
  }
  public function renovarduplicar($cont,$monto="",$ure,$plt)
  {
    $var = explode('-', $cont);
    $ua    = $var[0];
    $anio  =$var[1];  
    $contr =$var[2]; 
    
    $contratos = $this->_renovar->getRenovar($ua, $anio, $contr);
    $infoFecha = $this->_renovar->getFechaPeriodoAdmin();
    $contratos["CNT_FECHA_FIRMA"]= $infoFecha["PER_FECHA_INI"];
    $contratos["CNT_FECHA_INICIO"]= $infoFecha["PER_FECHA_INI"];
    $contratos["CNT_FECHA_FIN"]= $infoFecha["PER_FECHA_FIN"];
    if($monto!=""){ 
       $contratos["CNT_MONTO_MENSUAL"] = $monto;
       $contratos["CNT_MONTO_QUINCENA"] = $monto / 2;
       $contratos["CNT_MONTO_TOTAL"] = ""; 
       
     }
    $contratos["CNT_TEXTO"]="***";
    $contratos["CNT_FK_PLANTILLA"]=$plt;
    $contratos["CNT_PK_ANIO"]=date("Y"); 
    $contratos["CNT_FK_URE"]= $ure; 
/*
echo "<pre>";
print_r($contratos);
echo "</pre>";
*/
    $idC = $this->_renovar->putContratos($contratos);
//echo "---->".$idC;
    if( is_numeric($idC) ){ 
//echo "--> f , $ua,".$contratos["CNT_PK_ANIO"].",$idC,2 ";
//--> f , 1,2020,626,2 {"id":"626"}
//echo "----------------->".$ua."_".$contratos["CNT_PK_ANIO"]."_".$idC."_".$plt;
        $res2 =  $this->crear(false,$ua,$contratos["CNT_PK_ANIO"],$idC,$plt);
        //crear($sae=false,$clavenum="",$anio="",$numc="",$plantilla="")
        $ar["id"] = $idC;
    }else{
        $ar["id"] = 0;
    }
    echo json_encode($ar);
  }

  /*
public function excell(){
    $spreadsheet = (new exell() )->getInstancia();
   // $worksheet = $spreadsheet->getActiveSheet();
}
*/
public function e(){
  $data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$data->read('fichero.xls');
//Establecemos las cabeceras para un archivo xls
/*header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=excelenphp.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
*/    
//Y mostramos los datos en forma de tabla
echo("<table>");
for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
  echo("<tr>");
  for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
    echo("<td>".$data->sheets[0]['cells'][$i][$j] ."</td>");
  }
  echo("</tr>");
  
}
echo("</table>");
}
public function carrerasempl(){
  //$res = $this->_contratos->getTrabajadoresTMP();
$fila = array();
$res[0]["EMPL"]='1';
echo '
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
</head>
<body>
';
$cadena = "<table border='1'>";
$cont=0;
  foreach ($res as $key => $fila) {
    $grado="";
        //$grado = $this->_contratos->getEmpleadoGradoAcademico($fila["NOMBRE"]);
        $nombre = $this->_contratos->getInfoTrabajador($fila["EMPL"],"nombrecompleto2");
        $grado = $this->_contratos->getInfoTrabajador($fila["EMPL"],"gradoacademico");
        $grado2 = $this->_contratos->getInfoTrabajador($fila["EMPL"],"gradoacademico2");
        $carrera = $this->_contratos->getInfoTrabajador($fila["EMPL"],"carrera");
        $carrera2= $this->_contratos->getInfoTrabajador($fila["EMPL"],"carrera2");
         $cedula= $this->_contratos->getInfoTrabajador($fila["EMPL"],"numerocedula");
if ($carrera==$carrera2) { $carrera2 = ""; $cont++;}
if ($grado==$grado2) $grado2 = "";
        $cadena .= "<tr>
<td>".$fila["EMPL"]."</td>
<td>".($nombre)."</td>
        <td>".($grado)."</td>
        <td>".($carrera)."</td>
        <td>".($grado2)."</td>
        <td>".($cedula)."</td>
        <td>".($carrera2)."</td>
        </tr>";
  }
$cadena .= "</table>";
echo "Diferentes $cont";
echo $cadena;
echo '</body>
</html>';
}
public function getPlantillas($id=0){
    $info = $this->_contratos->getPlantillasByTipo($id);
    echo $this->convierteOption($info,"PLT_ID","PLT_DENOMINACION");
}
  public function procesar($empl = "", $numhoras = 0)
  {
      if ($empl != "") {
          $da = $_POST["da"];
          $per = $_POST["per"];
          $a = $_POST["a"];
          $depto = $_POST["depto"];
          $idsMaterias = "";
          $cont = 0;
          foreach ($_POST['materia_' . $empl] as $key => $fil) {
              $cont++;
              if ($cont == 1)
                  $coma = "";
              else
                  $coma = ",";
              $idsMaterias .= $coma . "'" . $fil . "'";
          }
          $infoSAE = $this->_contratos->getInfoSAEbyIdEmpleadoG($da, $per, $a, $empl, $idsMaterias);
          $plantilla = 0;
          $horas = 0;
          $materias = "";
          $contMaterias = 0;
          foreach ($infoSAE as $key => $fila) {
              $idDeptoSAE = $fila["ID_DEPARTAMENTO"];
              $horas += $fila["HRS_ASIG"];
              $materias .= '"' . $fila["ID_MATERIA"] . "-" . $this->art(ucwords(mb_strtolower($fila["NOM_MATERIA"]))) . '"';
              
              if (count($infoSAE) >= 2 && $contMaterias == (count($infoSAE) - 2)) {
                  $primeraLetra = substr(mb_strtoupper($infoSAE[count($infoSAE) - 1]["NOM_MATERIA"]), 0, 1);
                  $segundaLentra = substr(mb_strtoupper($infoSAE[count($infoSAE) - 1]["NOM_MATERIA"]), 1, 1);
                  if ($primeraLetra == "I" || $primeraLetra == "Í" || ($primeraLetra == "H" && ($segundaLentra == "I" || $segundaLentra == "Í")))
                      $materias .= " e ";
                  else
                      $materias .= " y ";
              } elseif ($contMaterias != (count($infoSAE) - 1))
                  $materias .= ", ";
              $contMaterias++;
          }
          
          if ($numhoras != 0)
              $horas = $numhoras;
          
          if (strpos(strtoupper($da), "BE_") !== false) {
            
              if ($fila["ID_CATE"] != NULL || $fila["ID_CATE"] != "") {
                  $plantilla = $_POST["pcompensa"];
                  $tipoC = 4;
              } else {
                  $plantilla = $_POST["pprivada"];
                  $tipoC = 5;
              }
              $montoTotal = $_POST["culde"] * $horas * $_POST["semanas"];
              $montoQuincena = $montoTotal / $_POST["quincenas"];
              $montoMensual = $montoQuincena * 2;
              $totalHoras = $horas * $_POST["semanas"];
              $categoria = 40;
              $totalHorasSemana = $horas;
              $montoporhora = $_POST["culde"];
          } else {
              if ($fila["ID_CATE"] != "") {
                  $plantilla = $_POST["pcompensa"];
                  $tipoC = 2;
                  if ($horas > 8)
                      $horas = 8;
              } else {
                  $plantilla = $_POST["pprivada"];
                  $tipoC = 3;
                  if ($horas > 18)
                      $horas = 18;
              }
              $grado = $this->_contratos->getEmpleadoGradoAcademico($empl);
              
              if ($grado == "DOCTORADO") {
                  $montoTotal = $_POST["dr"] * $horas * $_POST["semanas"];
                  $categoria = 41;
                  $montoporhora = $_POST["dr"];
              } else if ($grado == "MAESTRÍA") {
                  $montoTotal = $_POST["mtro"] * $horas * $_POST["semanas"];
                  $categoria = 42;
                  $montoporhora = $_POST["mtro"];
              } else if ($grado == "ESPECIALIDAD MÉDICA (CIFRHS)" || $grado == "ESPECIALIDAD") {
                  $montoTotal = $_POST["mtro"] * $horas * $_POST["semanas"];
                  $categoria = 42;
                  $montoporhora = $_POST["mtro"];
              } else if ($grado == "LICENCIATURA") {
                  $montoTotal = $_POST["lic"] * $horas * $_POST["semanas"];
                  $categoria = 43;
                  $montoporhora = $_POST["lic"];
              } else {
                  $montoTotal = $_POST["culde"] * $horas * $_POST["semanas"];
                  $categoria = 40;
                  $montoporhora = $_POST["culde"];
              }
              $montoQuincena = $montoTotal / $_POST["quincenas"];
              $montoMensual = $montoQuincena * 2;
              $totalHoras = $horas * $_POST["semanas"];
              $totalHorasSemana = $horas;
          }
          if ($fila["ID_DIVISION"] == "BE_CHT")
              $daDetalle["DA_FK_ID_UA"] = 1;
          else
              $daDetalle = $this->_contratos->getDABySiglas($_POST["da"]);
          $daDetalle["DA_FK_ID_UA"] = $_SESSION['ua'];
          $_POST["contenido"] = "";
          $_POST["numempl"] = $empl;
          $_POST["anio"] = date("Y");
          $_POST["inicio"] = $_POST["finicio"];
          $_POST["fin"] = $_POST["ffin"];
          $_POST["tipoc"] = $tipoC;
          $_POST["plantilla"] = $plantilla;
          $_POST["monto"] = $montoTotal;
          $_POST["ua"] = $daDetalle["DA_FK_ID_UA"];
          $_POST["funciones"] = $materias;
          $_POST["categoria"] = $categoria;
          $_POST["horas"] = $totalHoras;
          $_POST["monto_quincenal"] = $montoQuincena;
          $_POST["fecha_firma"] = $_POST["ffirma"];
          $_POST["deptosae"] = $idDeptoSAE;
          $_POST["horas_semana"] = $totalHorasSemana;
          $_POST["monto_mensual"] = $montoMensual;
          $_POST["ure"] = $depto;
          $post["monto_hora"] = $montoporhora;
          $link = $this->crear(true);
          $mensaje["m"] = "Ok";
          $mensaje["link"] = $link;
      } else {
          $mensaje["m"] = "Error: " . $empl;
          $mensaje["link"] = "x";
      }
      echo json_encode($mensaje);
  }
	public function importar($da="",$per="",$a="")
	{
    if( strpos( strtoupper($da), "BE_") !== false ) $tipo = 2; else $tipo = 1;
    if($da!="" and $per!="" and $a!=""){
        $infoSAE                = $this->_contratos->getInfoSAE($da,$per,$a); 
        
        if ($tipo == 1){ 
            $plantillascompensa = $this->_contratos->getPlantillasByIdTipo(2);
            $plantillasprivado  = $this->_contratos->getPlantillasByIdTipo(3);
        }else{
            $plantillascompensa = $this->_contratos->getPlantillasByIdTipo(4);
            $plantillasprivado  = $this->_contratos->getPlantillasByIdTipo(5);          
        }
        $testigos               = $this->_contratos->getTestigos(); 
        $deptos                 = $this->_contratos->getDeptos(  strtoupper($da) );
        $infoFechas             = $this->_contratos->getInfoFechas($per,$a,$tipo);  
        $c=0;
        $emplAct = 0;
        $grado="";
        $sumaHoras = 0;
        $sumaHorasC = 0;
        $arrayTotalHrs = array();
        //print_r($infoSAE);
        foreach ($infoSAE as $key => $fila) {
            if($emplAct!=$fila["VEMP_EMPL"]){
               $grado = $this->_contratos->getEmpleadoGradoAcademico($fila["VEMP_EMPL"]);
               
               
               if($c!=0){
                    //$infoSAE[$c]["TOTAL"]
                    $arrayTotalHrs[$numempl] = $sumaHoras;
                    $arrayTotalHrsC[$numempl] = $sumaHorasC;
               }
               $sumaHoras = 0;
               $sumaHorasC = 0;
               $emplAct = $fila["VEMP_EMPL"];
                    //echo "-----------------------> Ok";
             }
             $sumaHoras += $fila["HRS_ASIG"];
             $sumaHorasC += $fila["HORAS"];
             $infoSAE[$c]["GRADO"] = $grado;
             $numempl = $fila["VEMP_EMPL"];
          
          if($c==count($infoSAE)) $arrayTotalHrs[$numempl] = $sumaHoras;
          if ($fila["CONTRATO"]!="") 
          {
          	$link = "";
          	$partes1 = explode("|", $fila["CONTRATO"]);
          	foreach ($partes1 as $k1 => $f1) {
          		
          	
          		$partes = explode("_", $f1);
          		//print_r($partes);
          		if($partes[1]==1)
          			$link = $link .'
          					<div>'.$partes[0].'</div>
          					<a href="'.BASE_URL.'/index/editar/'.$partes[0].'/" target="_blank">[Editar]</a>
          					<a href="'.BASE_URL.'/index/pdf/'.$partes[0].'/" target="_blank">[Imprimir]</a> <br/>
          					';
          		else if($partes[1]==2)
          			$link = $link .'<div>'.$partes[0].'</div>
          		                    <a href="'.BASE_URL.'/index/descargapdf/'.$partes[0].'/" target="_blank">[Descargar]</a>
          					 ';
          		else
          			$link = $link ."";
          	}
          	$infoSAE[$c]["CONTRATO"] = $link;
          }
      		$c++;
        }
        $this->_view->assign('compensa', $this->convierteOption($plantillascompensa,"PLT_ID","PLT_DENOMINACION") );
        $this->_view->assign('privado',  $this->convierteOption($plantillasprivado,"PLT_ID","PLT_DENOMINACION") );
        $this->_view->assign('deptos',   $this->convierteOption($deptos,"URES","LURES") );
        $this->_view->assign('infofechas', $infoFechas);
        $this->_view->assign('athoras', $arrayTotalHrs);
        $this->_view->assign('athorasc', $arrayTotalHrsC);
        $this->_view->assign('da', $da);
        $this->_view->assign('per', $per);
        $this->_view->assign('a', $a);
        $this->_view->assign('info', $infoSAE);
        $this->_view->assign('testigos', $this->convierteOption($testigos,"TES_ID","TES_NOMBRE",1));
        $this->_view->renderizar('importlist','inicio');
    }else{
        $this->_view->assign('lista_divisiones', $this->getListaDivisiones('2022'));
        $this->_view->assign('a', date("Y"));
        $this->_view->renderizar('importform','inicio');
    }
    
   // $this->_view->renderizar('');
	}
	private function elementos($texto){
   
    return array_filter(explode(PHP_EOL,htmlspecialchars($texto)),function($k) { return trim($k) != '';});
    
	}
  public function crearmasivo(){
 
      $res = $this->_contratos->getContratosParaProcesar();  
      foreach ($res as $key => $fila) {
         $res2 =  $this->crear(false,$fila["UA"],$fila["ANIO"],$fila["NUMC"],49);
         // print_r($fila);
         echo $fila["UA"]." - ".$fila["ANIO"]." - ".$fila["NUMC"]."<br/>";
      }
  }
/*
public function crearmasivo(){ 
    //$res = $this->_contratos->   (); 798 - 1150
      for ($cont =728 ; $cont <=1193 ;$cont++) {
         $res2 =  $this->crear(false,1,2019,$cont,'');
         // print_r($fila);
         echo "1 - 2019 - ".$cont."<br/>";
      }
  }
*/
  public function creardcs(){
      $res = $this->_contratos->getDCSTMP();
      foreach ($res as $key => $fila) {
        
         if( $this->_contratos->ifAdministrativo($fila["CNT_FK_NOEMPL"]) ){
              $plantilla = 9;
              $this->_contratos->setTipo($fila["CNT_PK_CONTRATO"],2);
         }
         else{
            $plantilla = 7;
            $this->_contratos->setTipo($fila["CNT_PK_CONTRATO"],3);
         }
          $res2 =  $this->crear(false,1,2018,$fila["CNT_PK_CONTRATO"],$plantilla);
         
         // print_r($fila);
         echo $fila["UA"]." - ".$fila["ANIO"]." - ".$fila["NUMC"]."<br/>";
      }
  }
  public function crearadendum()
  {
exit();
      $res = $this->_contratos->getContratosAdendum();
//echo "----";
     // print_r($res);  exit();
      foreach ($res  as $k => $f) {
          
         // echo "-->".$f["CNT_PK_CONTRATO"]."<br/>";
    if($clavenum=="" and $anio=="" and $numc=="" and $plantilla==""){
        $array = $this->_contratos->putContratos($_POST);
        $_POST["clavenum"] = $array["ua"];
        $_POST["anio"] = $array["anio"];
        $_POST["numc"] = $array["id"];
        //echo json_encode($res);
    }else{
        $_POST["plantilla"] = $this->_contratos->getInfoContrato($clavenum,$anio,$numc,"plantilla");
        $_POST["numempl"]   = $this->_contratos->getInfoContrato($clavenum,$anio,$numc,"numempleado");
        $_POST["clavenum"]  = $clavenum;
        $_POST["anio"]      = $anio;
        $_POST["numc"]      = $numc;
    }
 $row = $this->_contratos->getPlantillaTexto(23);
//print_r($row);
  $re1='(\\{)'; # Any Single Character 1
  $re2='((?:[a-z][a-z0-9_]*))'; # Variable Name 1
  $re3='(\\.)'; # Any Single Character 2
  $re4='((?:[a-z][a-z0-9_]*))'; # Variable Name 2
  $re5='(\\.)'; # Any Single Character 3
  $re6='((?:[a-z][a-z0-9_]*))'; # Variable Name 3
  $re7='(\\})'; # Any Single Character 4
$_POST["clavenum"]= $f["CNT_PK_UA"];
$_POST["anio"] = $f["CNT_PK_ANIO"];
$_POST["numc"] = $f["CNT_PK_CONTRATO"];
$_POST["numempl"] = $f["CNT_FK_NOEMPL"];
  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7."/is", $row["TEXTO"], $coincidencias))
  {
      $c=0;
       foreach ($coincidencias[0] as $fila) {
        if($coincidencias[4][$c]=="trab"){
          if($coincidencias[6][$c]=="funciones"){ 
            //$info = $this->_contratos->getInfoAdmin($coincidencias[6][$c]);
            $infoA = $this->_contratos->getInfoContrato($f["CNT_PK_UA"],$f["CNT_PK_ANIO"],$f["CNT_PK_CONTRATO"],$coincidencias[6][$c]);
           // echo $infoA;
            $infoA = $this->elementos($infoA);
            $info ="<ul>";
            foreach ($infoA as $filaF ) {
              $info .= "<li>".$filaF."</li>";
            }
            $info .="</ul>";
          }elseif($coincidencias[6][$c]=="escuela"){ 
            //  $info =  number_format($_POST["monto"], 2, '.', ',') ;
            $info = $this->_contratos->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
            if (strpos($info,"UNIVERSIDAD")!==false or strpos($info,"ESCUELA")!==false ) {
              $info  = "la ".$info;
            }else if(strpos($info,"ESCUELA")!==false or strpos($info,"INSTITUTO")!==false  ) {
                 $info  = "el ".$info;
            }else{
              $info  = "el/la ".$info;
            }
        }elseif($coincidencias[6][$c]=="estudiostextocompleto"){ 
            $info ="";
          //    $info =  $this->num2letras(number_format($_POST["monto"],2,'.','')) ;
              $numCedula = $this->_contratos->getInfoTrabajador($_POST["numempl"],"numerocedula");
              $gradoAcademico = $this->_contratos->getInfoTrabajador($_POST["numempl"],"gradoacademico");
              $escuela = $this->_contratos->getInfoTrabajador($_POST["numempl"],"escuela");
            if (strpos($escuela,"UNIVERSIDAD")!==false or strpos($escuela,"ESCUELA")!==false or strpos($escuela,"DIRECCIÓN")!==false or strpos($escuela,"ACADEMIA")!==false) { 
              $escuela  = "la ".$escuela;
            }else if(strpos($escuela,"COLEGIO")!==false or strpos($escuela,"INSTITUTO")!==false or strpos($escuela,"CENTRO")!==false ) {
                 $escuela  = "el ".$escuela;
            }else{
              $escuela  = " la escuela  ".$escuela." "; 
            }
              $carrera = $this->_contratos->getInfoTrabajador($_POST["numempl"],"carrera");
              $fechatitulo = $this->_contratos->getInfoTrabajador($_POST["numempl"],"fechatitulo");
            if(strpos($carrera,"QUÍMICO")!==false or strpos($carrera,"MÉDICO")!==false or strpos($carrera,"TRABAJADOR")!==false or strpos($carrera,"INGENIERO")!==false  ) {
                  $carrera = "como $carrera";
              }else{
                  $carrera = "en $carrera";
              }
            $info = " título de $gradoAcademico $carrera expedido por $escuela el día $fechatitulo";
            if($numCedula!=""){
                $fechaCedula = $this->_contratos->getInfoTrabajador($_POST["numempl"],"fechacedula");
              $info = $info." y cédula profesional $numCedula, de fecha $fechaCedula";
            }else{
                if($carrera=="SECUNDARIA"  or $carrera=="EDUCACIÓN SECUNDARIA" or $carrera=="BACHILLER") 
                    $carrera = "";
                if($carrera!="") $carrera = " ( ".$carrera." ) ";
                if($escuela!="") $escuela = "expedido por ".$escuela." ";
                if($fechatitulo!="") $fechatitulo = " el día  ".$fechatitulo." ";
                $info = " estudios de $gradoAcademico $carrera $escuela $fechatitulo";
                //$info = "OKOKOKOK";
            }
            $infoAptitudes = $this->_contratos->getInfoTrabajador($_POST["numempl"],"aptitudes");
            if($infoAptitudes!="" and $info!="") 
                $info = $info. ". Tiene ".$infoAptitudes;
            else if($infoAptitudes!="" and $info=="")
                $info = $info. " ".$infoAptitudes;
          //título de {tt.trab.gradoacademico} en {tt.trab.carrera} expedido por {tt.trab.escuela} el día {mn.trab.fechatitulo} y cédula profesional {mn.trab.numerocedula}, de fecha {mn.trab.fechacedula}
          }elseif($coincidencias[6][$c]=="estudios"){ 
            $info = $this->_contratos->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
            if($info=="") $info = "C.";
          }elseif($coincidencias[6][$c]=="prefijo"){ 
            $info = $this->_contratos->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
            if($info=="") $info = "C.";
          }else{
            $info = $this->_contratos->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
          }
          
        }
        if($coincidencias[4][$c]=="contrato"){
          //echo $_POST["clavenum"]." - ".$coincidencias[6][$c];
         // echo " [".$_POST["clavenum"]."- ".$_POST["anio"]."- ".$_POST["numc"]."- ".$coincidencias[6][$c]."] <br/>";
          $info = $this->_contratos->getInfoContrato($_POST["clavenum"],$_POST["anio"],$_POST["numc"],$coincidencias[6][$c]);
        //  echo "[ $info ] <br/>";
          if($coincidencias[6][$c]=="sueldoquincenatexto" or $coincidencias[6][$c]=="sueldototaltexto" or $coincidencias[6][$c]=="sueldomensualtexto")
            $info = $this->num2letras(number_format($info,2,'.','')) ;
          if($coincidencias[6][$c]=="sueldoquincenanum" or $coincidencias[6][$c]=="sueldototalnum" or $coincidencias[6][$c]=="sueldomensual")
            $info = number_format($info,2,'.',',') ;
          if($coincidencias[6][$c]=="fechainicio" or $coincidencias[6][$c]=="fechafin"  or $coincidencias[6][$c]=="fechafirmatexto")
            $info = $this->getFechaTexto($info);
            if($coincidencias[6][$c]=="ures"){ 
              //  $info = $this->_contratos->getInfoContrato($_POST["numempl"],$coincidencias[6][$c]);
               if (strpos($info,"DIRECCI")!==false or strpos($info,"DIVISI")!==false or strpos($info,"RECTOR")!==false or strpos($info,"COORDINACI")!==false  or strpos($info,"AUDITORÍA")!==false) {
                  $info  = "a la ".$info;
                }else if(strpos($info,"DEPARTAMENTO")!==false or strpos($info,"ÁREA")!==false or strpos($info,"CENTRO")!==false ) {
                     $info  = "al ".$info; 
                }else{
                  $info  = "a ".$info;
                }
            }
            if($coincidencias[6][$c]=="ures_del_dela"){ 
              //  $info = $this->_contratos->getInfoContrato($_POST["numempl"],$coincidencias[6][$c]);
               if (strpos($info,"DIRECCI")!==false or strpos($info,"DIVISI")!==false or strpos($info,"RECTOR")!==false or strpos($info,"COORDINACI")!==false  or strpos($info,"AUDITORÍA")!==false) {
                  $info  = "de la ".$info;
                }else if(strpos($info,"DEPARTAMENTO")!==false or strpos($info,"ÁREA")!==false or strpos($info,"CENTRO")!==false ) {
                     $info  = "del ".$info; 
                }else{
                  $info  = "del ".$info;
                }
            }
             
          
    
        }
        $idURE   = $this->_contratos->getInfoContrato($_POST["clavenum"],$_POST["anio"],$_POST["numc"],"idure");
        if($coincidencias[4][$c]=="plantilla"){ 
          $info = $this->_contratos->getInfoPlantilla($coincidencias[6][$c],$_POST["numempl"]);
//echo "[".$coincidencias[6][$c].", ".$_POST["numempl"].", $info ] ";
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
          //  echo "<--DELA  ";
              //  $info = $this->_contratos->getInfoContrato($_POST["numempl"],$coincidencias[6][$c]);
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
          $info = $this->_contratos->getInfoJefeDepto($coincidencias[6][$c],$idURE);
        }
        if($coincidencias[4][$c]=="director"){ 
          $info = $this->_contratos->getInfoDirector($coincidencias[6][$c],$idURE);
        }
        if($coincidencias[4][$c]=="administrador"){ 
          $info = $this->_contratos->getInfoAdministrador($coincidencias[6][$c]);
        }        
        if($coincidencias[4][$c]=="rector"){ 
          $info = $this->_contratos->getInfoRector($coincidencias[6][$c]);
        }
        if($coincidencias[4][$c]=="admin"){ 
          $info = $this->_contratos->getInfoAdmin($coincidencias[6][$c]);
        }
        
          if($info!=""){ 
            if($coincidencias[2][$c]=="my") $info = mb_strtoupper($info);
            if($coincidencias[2][$c]=="mn") $info = mb_strtolower($info);
            if($coincidencias[2][$c]=="tt") $info = $this->art(ucwords(mb_strtolower($info)));
            if($coincidencias[2][$c]=="or") $info = ucfirst($info);
            //df = Default
                $row["TEXTO"] = str_replace($fila,$info,$row["TEXTO"]);
          }
        
          $c++;
       }
      
  }
   // echo "------->".$row["TEXTO"];
      //$_POST["contenido"] = $row["TEXTO"];
      //$res = $this->_contratos->putTextoContratos($row["TEXTO"],$_POST["clavenum"],$_POST["anio"],$_POST["numc"]);
$this->_contratos->putAdendum($_POST["numc"],$_POST["clavenum"],$_POST["anio"],$row["TEXTO"]);
echo $_POST["numc"]."-".$_POST["clavenum"]."-".$_POST["anio"]."<br/>";
/*
    if(!$sae and $clavenum=="" and $anio=="" and $numc=="" and $plantilla==""){ 
      $array["texto"] = $row["TEXTO"];
      echo json_encode($array);
    }else{
      return(true);
    }
    
*/
      }
  }
//--> f , 1,2020,626,2 {"id":"626"}
	public function crear($sae=false,$clavenum="",$anio="",$numc="",$plantilla="")
	{
    if ($clavenum == "" && $anio == "" && $numc == "" && $plantilla == "") {
        $array = $this->_contratos->putContratos($_POST);
        $_POST["clavenum"] = $array["ua"];
        $_POST["anio"] = $array["anio"];
        $_POST["numc"] = $array["id"];
    } else {
       $_POST["plantilla"] = $this->_contratos->getInfoContrato($clavenum, $anio, $numc, "plantilla");
     // $_POST["plantilla"] = $plantilla;
        $_POST["numempl"] = $this->_contratos->getInfoContrato($clavenum, $anio, $numc, "numempleado");
        $_POST["clavenum"] = $clavenum;
        $_POST["anio"] = $anio;
        $_POST["numc"] = $numc;
    }
    $row = $this->_contratos->getPlantillaTexto($_POST["plantilla"]);
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
            $infoA = $this->_contratos->getInfoContrato($_POST["clavenum"],$_POST["anio"],$_POST["numc"],$coincidencias[6][$c]);
	       		$infoA = $this->elementos($infoA);
	       		$info ="<ul>";
	       		foreach ($infoA as $filaF ) {
	       			$info .= "<li>".$filaF."</li>";
	       		}
	       		$info .="</ul>";
	       	}elseif($coincidencias[6][$c]=="escuela"){ 
              $info = $this->_contratos->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
              if (strpos($info,"UNIVERSIDAD")!==false or strpos($info,"ESCUELA")!==false ) {
                $info  = "la ".$info;
              }else if(strpos($info,"ESCUELA")!==false or strpos($info,"INSTITUTO")!==false  ) {
                $info  = "el ".$info;
              }else{
                $info  = "el/la ".$info;
              }
              
          }elseif($coincidencias[6][$c]=="estudiostextocompleto"){
            
            $numCedula = $this->_contratos->getInfoTrabajador($_POST["numempl"],"numerocedula");
            $gradoAcademico = $this->_contratos->getInfoTrabajador($_POST["numempl"],"gradoacademico");
            $escuela = $this->_contratos->getInfoTrabajador($_POST["numempl"],"escuela");
            // dd( $numCedula, $gradoAcademico, $escuela );
            if (strpos($escuela,"UNIVERSIDAD")!==false or strpos($escuela,"ESCUELA")!==false or strpos($escuela,"DIRECCIÓN")!==false or strpos($escuela,"ACADEMIA")!==false) { 
              $escuela  = "la ".$escuela;
            }else if(strpos($escuela,"COLEGIO")!==false or strpos($escuela,"INSTITUTO")!==false or strpos($escuela,"CENTRO")!==false ) {
              $escuela  = "el ".$escuela;
            }else{
              $escuela  = " la escuela  ".$escuela." "; 
            }
            $carrera = $this->_contratos->getInfoTrabajador($_POST["numempl"],"carrera");
            $fechatitulo = $this->_contratos->getInfoTrabajador($_POST["numempl"],"fechatitulo");
            if($numCedula!=""){
                $fechaCedula = $this->_contratos->getInfoTrabajador($_POST["numempl"],"fechacedula");
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
            $infoAptitudes = $this->_contratos->getInfoTrabajador($_POST["numempl"],"aptitudes");
            if($infoAptitudes!="" and $info!="") 
                $info = $info. ". Tiene ".$infoAptitudes;
            else if($infoAptitudes!="" and $info=="")
                $info = $info. " ".$infoAptitudes;
          }elseif($coincidencias[6][$c]=="estudios"){
            $info = $this->_contratos->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
            if($info=="") $info = "C.";
          }elseif($coincidencias[6][$c]=="prefijo"){ 
            $info = $this->_contratos->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
            if($info=="") $info = "C.";
       		}else{
       			$info = $this->_contratos->getInfoTrabajador($_POST["numempl"],$coincidencias[6][$c]);
       		}
       	}
       	if($coincidencias[4][$c]=="contrato"){
       		  $info = $this->_contratos->getInfoContrato($_POST["clavenum"],$_POST["anio"],$_POST["numc"],$coincidencias[6][$c]);
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
        $idURE   = $this->_contratos->getInfoContrato($_POST["clavenum"],$_POST["anio"],$_POST["numc"],"idure");
        if($coincidencias[4][$c]=="plantilla"){
          $info = $this->_contratos->getInfoPlantilla($coincidencias[6][$c],$_POST["numempl"]);
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
          $info = $this->_contratos->getInfoJefeDepto($coincidencias[6][$c],$idURE);
        }
        if($coincidencias[4][$c]=="director"){ 
          $info = $this->_contratos->getInfoDirector($coincidencias[6][$c],$idURE);
        }
        if($coincidencias[4][$c]=="administrador"){ 
          $info = $this->_contratos->getInfoAdministrador($coincidencias[6][$c]);
        }        
       	if($coincidencias[4][$c]=="rector"){ 
       		$info = $this->_contratos->getInfoRector($coincidencias[6][$c]);
       	}
       	if($coincidencias[4][$c]=="admin"){ 
       		$info = $this->_contratos->getInfoAdmin($coincidencias[6][$c]);
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
    $res = $this->_contratos->putTextoContratos($row["TEXTO"],$_POST["clavenum"],$_POST["anio"],$_POST["numc"]);
    if(!$sae and $clavenum=="" and $anio=="" and $numc=="" and $plantilla==""){ 
		  $array["texto"] = $row["TEXTO"];
		  echo json_encode($array);
    }else{
    	$claveUA = $this->_contratos->getURE($_POST["clavenum"]);
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
 public function tmp(){
 		$res = $this->_contratos->tmp();
 		print_r($res);
 }
  public function index($pagina=false)
  { 
    $res = $this->_contratos->getURE($_SESSION["ua"]);
    $this->_view->assign('info',$res);
    $this->_view->assign('anio',date("Y")); 
    $this->_view->renderizar('index','inicio');
    
  }
  /**
   * Vuelve a generar los contratos de asignatura de 2023
   * con plantillas incorrectas
   * 
   * @return 
   */
  public function recreaContratosAsignatura2023(){
    $sql = " SELECT UA_CLAVE AS UA_CHAR,C.CNT_PK_UA AS UA, C.CNT_PK_ANIO AS ANIO, CNT_PK_CONTRATO AS NUMC  FROM cnt_contratos C
 LEFT JOIN CNT_UACADEMICAS U
 ON U.UA_ID = C.CNT_PK_UA
 WHERE CNT_PK_CONTRATO IN (
  87,
  88,
  89,
  90,
  91,
  92,
  93,
  94,
  95,
  97,
  98,
  99,
  100,
  102,
  103,
  104,
  105,
  106,
  107,
  108,
  109,
  110,
  111,
  112,
  113,
  114,
  115,
  116,
  117,
  118,
  119,
  120,
  121,
  122,
  123,
  124,
  125,
  126,
  127,
  128,
  129,
  130,
  131,
  133,
  134,
  135,
  136,
  137,
  139,
  140,
  141,
  143,
  144,
  145,
  146,
  147,
  149,
  150,
  151,
  152,
  153,
  154,
  155,
  156,
  157,
  158,
  159,
  160,
  161
 )
 AND CNT_PK_ANIO = 2023
 AND CNT_PK_UA = 1";
    $data = $this->_contratos->executeQuery( $sql );
      foreach ($data as $key => $fila) {
         $res2 =  $this->crear(false,$fila["UA"],$fila["ANIO"],$fila["NUMC"],2);
         // print_r($fila);
         echo $fila["UA"]." - ".$fila["ANIO"]." - ".$fila["NUMC"]."<br/>";
      }
  }
  public function listar2($anio="",$ua=1,$pagina=false) 
  {
        if($anio == "") 
            $anio = date("YYYY");
        $paginador = new Paginador();
        $this->_view->assign('contratos', $paginador->paginar($this->_contratos->getAllContratos($anio,$ua), $pagina,10));
        $listaContratos = $this->convierteOption( $this->_contratos->getListContratos(1,$anio),"ID","NOMBRE");
        
        $this->_view->assign('paginacion', $paginador->getView('prueba', 'index/listar/'. $anio.'/'.$ua));
        $this->_view->assign('listacontratos',$listaContratos);
        $this->_view->assign('totalpaginas',$total_paginas);
        $this->_view->assign('prev',$prev);
        $this->_view->assign('fin',$ult);
        $this->_view->assign('ini', $pagina);
        $this->_view->assign('anio', $anio);
        
        $this->_view->assign('filtro', 1);
       $this->_view->renderizar('listar','inicio');
  }
  public function contratos($anio, $ua){
   // $contratos = $this->_contratos->getAllContratos2($anio,$ua,$_POST["start"],$_POST["length"]);
    //$total  = $this->_contratos->getNumContratos($anio, $ua);
   $contratos =  $this->_contratos->getAllContratos3($anio, $ua);
    echo json_encode($contratos);
  }
  public function subirContrato($idContrato){
    $idContrato = trim($idContrato);
    $contrato = explode('-',trim($idContrato));
    $unidadContL = strtolower($contrato[0]);
    $unidadCont = $contrato[0];
    $numCont = $contrato[1];
    $anioCont = $contrato[2];
    $dirContrato = "/opt/contratos_scan/".$unidadContL."/".$anioCont."/CPS".$idContrato.".pdf";
    $target_file = basename($_FILES["contrato"]["name"]);
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk=1;
    if($unidadContL = 'che'){
      $numUnidad = 1;
    }
    $contrato = [
      'unidad' => $numUnidad,
      'anio' => $anioCont,
      'numero' => $numCont,
      'status' => 2,
    ];
    if($fileType == "pdf") {
      if (file_exists($dirContrato)) {
        echo "Contrato ya existe";
        echo "</br>";
        $uploadOk = 0;
      }else {
        $uploadOk = 1;
      }      
    } else{
      echo "El contrato debe de ser un archivo PDF.";
      echo "</br>";
        $uploadOk = 0;
    }   
    
  // if everything is ok, try to upload file
    if ($uploadOk == 0) {
        echo "El contrato no se subió.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["contrato"]["tmp_name"], $dirContrato)) {
            $this->_contratos->actualizaStatus($contrato);
            echo "Se subió el Contrato CSP".$idContrato. ".";
        } else {
            echo "Hubo un error al cargar el archivo.";
        }
    }
}
  public function listar($anio="",$ua=1) 
  {
    if($anio == "") 
        $anio = date("YYYY");
        $this->_view->assign('totalpaginas',$total_paginas);
        $this->_view->assign('prev',$prev);
        $this->_view->assign('fin',$ult);
        $this->_view->assign('ini', $pagina);
        $this->_view->assign('anio', $anio);
        
        $this->_view->assign('filtro', 1);
        $this->_view->assign('ua', $ua);
       $this->_view->renderizar('listar2','inicio');
  }
	
		public function vigentes($pagina=false) 
	{
        $paginador = new Paginador();
        $this->_view->assign('contratos', $paginador->paginar($this->_contratos->getAllvigenetes(), $pagina,10));
        $listaContratos = $this->convierteOption( $this->_contratos->getListContratos(2),"ID","NOMBRE");
$this->_view->assign('paginacion', $paginador->getView('prueba', 'index/index/'));
        $this->_view->assign('listacontratos',$listaContratos);
        $this->_view->assign('totalpaginas',$total_paginas);
        $this->_view->assign('prev',$prev);
        $this->_view->assign('fin',$ult);
        $this->_view->assign('ini', $pagina);
        $this->_view->assign('filtro', 2);
		$this->_view->renderizar('index','inicio');
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
	public function guardar(){
			//$_POST["contenido"] = "---";
			//print_r($_POST);
			$res = $this->_contratos->putContratos($_POST);
			echo json_encode($res);
	}
public function eliminar($id){
  $partes = explode("-",$id);
      
      $clave  = $partes[0];
      $anio   = $partes[1];
      $numC   = $partes[2];
      if( !is_numeric($anio) or !is_numeric($numC) ) exit();
      $claveNum  = $this->_contratos->getIdUAByClave($clave);
      $res  = $this->_contratos->delContrato($claveNum,$anio,$numC);
      echo json_encode($res);
}
	public function editar($id="")
	{
		    //$rowWEmpleados    = $this->_empleado-> getEmpleados();
        $rowTipoContratos = $this->_contratos->getTiposContratos();
        $rowUA            = $this->_contratos->getUA();
        $rowDA            = $this->_contratos->getDA();
        $testigos         = $this->_contratos->getTestigos();
 
        $ubicaciones      = $this->_contratos->getUbicaciones(); 
        $infoFechas       = $this->_contratos->getInfoFechasActual();  
        //$deptosae         = $this->_contratos->getDeptosSAE(); 
        
//echo "--------------------->".$listURES;
        
		if($id!=""){ 
			$partes = explode("-",$id);
			
			$clave  = $partes[0];
			$anio   = $partes[1];
			$numC   = $partes[2];
			if( !is_numeric($anio) or !is_numeric($numC) ) exit();
			$infoC  = $this->_contratos->getContratoDetalle($clave,$anio,$numC);
            if(method_exists ($infoC['TEXTO'],'load' ) )
                $infoC["TEXTO"] = $infoC['TEXTO']->load();
            else
                $infoC["TEXTO"] = $infoC['TEXTO'];
			
			$claveNum = $infoC["UA_ID"];
      
	 	}else{
          $infoC["CNT_FK_NOEMPL_TESTIGO1"]=1;
        }
    $listURES = $this->_contratos->getListURES( $infoC["ID_URE"] );
		//$rowPLT   = $this->_contratos->getPlantillas();
		$rowCC    = $this->_contratos->getCategoriasContrato();
		//$PLT      = $this->convierteOption($rowPLT,"PLT_ID","PLT_DENOMINACION");
		$CC       = $this->convierteOption($rowCC,"ID_CATEGORIA","CATEGORIA",$infoC["CNT_FK_CATEGORIA"]);
	//	$personas      = $this->convierteOption($rowWEmpleados,"NOEMPL","NOMBRE",$infoC["CNT_FK_NOEMPL"]);
		$tipoContratos = $this->convierteOption($rowTipoContratos,"TCNT_ID","TCNT_DENOMINACION",$infoC["CNT_FK_TIPO"]);
		$UA            = $this->convierteOption($rowUA,"UA_ID","UA_DENOMINACION",$infoC["UA_ID"]);
		$DA            = $this->convierteOption($rowDA,"DA_ID","DA_DENOMINACION",$infoC["UA_ID"]);
    
    $this->_view->assign('testigos1', $this->convierteOption($testigos,"TES_ID","TES_NOMBRE",$infoC["CNT_FK_NOEMPL_TESTIGO1"]));
    $this->_view->assign('testigos2', $this->convierteOption($testigos,"TES_ID","TES_NOMBRE",$infoC["CNT_FK_NOEMPL_TESTIGO2"]));
    $this->_view->assign('uf', $this->convierteOption($ubicaciones,"UBI_ID","UBI_DENOMINACION",$infoC["CNT_UBICAFISICA"])); 
        
   // $this->_view->assign('deptosae', $this->convierteOption($deptosae,"CLAVE","DENOMINA",$infoC["CNT_FK_DEPTOSAE"]));
 
		if($id!=0 and is_numeric($id)){
		//	$proyecto = $this->_proyecto->getProyectoById($id);
		//	$this->_view->assign('datos', $proyecto);
		}
    $this->_view->assign('numempl', $infoC["CNT_FK_NOEMPL"]);
		$this->_view->assign('clave',   $clave);
		$this->_view->assign('clavenum',$claveNum);
		$this->_view->assign('anio',    $anio);
		$this->_view->assign('numc',    $numC);
		$this->_view->assign('id',      $id);
		$this->_view->assign('dc',      $infoC);
		$this->_view->assign('tc',      $tipoContratos); 
		$this->_view->assign('ua',      $UA);
		$this->_view->assign('da',      $DA);
	//	$this->_view->assign('plt',     $PLT);
		$this->_view->assign('cc',      $CC); 
    $this->_view->assign('ures',    $listURES); 
     $this->_view->assign('infofechas',    $infoFechas); 
		$this->_view->renderizar('editar','inicio');
	}
public function pdf2(){
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 023');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 023', PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set font
$pdf->SetFont('times', 'BI', 14);
// Start First Page Group
$pdf->startPageGroup();
// add a page
$pdf->AddPage();
// set some text to print
$txt = <<<EOD
Example of page groups.
Check the page numbers on the page footer.
This is the first page of group 1.
EOD;
// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
// add second page
$pdf->AddPage();
$pdf->Cell(0, 10, 'This is the second page of group 1', 0, 1, 'L');
// Start Second Page Group
$pdf->startPageGroup();
// add some pages
$pdf->AddPage();
$pdf->Cell(0, 10, 'This is the first page of group 2', 0, 1, 'L');
$pdf->AddPage();
$pdf->Cell(0, 10, 'This is the second page of group 2', 0, 1, 'L');
$pdf->AddPage();
$pdf->Cell(0, 10, 'This is the third page of group 2', 0, 1, 'L');
$pdf->AddPage();
$pdf->Cell(0, 10, 'This is the fourth page of group 2', 0, 1, 'L');
// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('example_023.pdf', 'I');
}
  public function pdfmasivo(){
      $res = $this->_contratos->getContratosEnRevision($_POST);
       $this->_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      foreach ($res as $key => $fila) {
         //$res2 =  $this->crear(false,$fila["UA"],$fila["ANIO"],$fila["NUMC"],2);
         // print_r($fila);
         //echo $fila["UA_CHAR"]." - ".$fila["ANIO"]." - ".$fila["NUMC"]."<br/>";
         $this->creapdf($fila["UA_CHAR"]."-".$fila["ANIO"]."-".$fila["NUMC"]);
      }
      $this->_pdf->Output('contratos.pdf', 'I');
  }
public function pdf($id="")
  {
      $this->_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $this->creapdf($id);
      //Close and output PDF document
    $this->_pdf->Output($id.'_contrato.pdf', 'I');
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
			$infoC  = $this->_contratos->getContratoTexto($clave,$anio,$numC);
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
   if ($num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while ($num[0] == '0') $num = substr($num, 1); 
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
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
public function getFechaTexto($fecha){
        $partes = explode("-", $fecha);
        $dia = "";
        switch ($partes[0]) {
            case 1:
                $dia = "primero";
                break;
            case 2:
                $dia = "dos";
                break;
            case 3:
                $dia = "tres";
                break;
            case 4:
                $dia = "cuatro";
                break;
            case 5:
                $dia = "cinco";
                break;
            case 6:
                $dia = "seis";
                break;
            case 7:
                $dia = "siete";
                break;
            case 8:
                $dia = "ocho";
                break;
            case 9:
                $dia = "nueve";
                break;
            case 10:
                $dia = "diez";
                break;
            case 11:
                $dia = "once";
                break;
            case 12:
                $dia = "doce";
                break;
            case 13:
                $dia = "trece";
                break;
            case 14:
                $dia = "catorce";
                break;
            case 15:
                $dia = "quince";
                break;
            case 16:
                $dia = "dieciséis";
                break;
            case 17:
                $dia = "diecisiete";
                break;
            case 18:
                $dia = "dieciocho";
                break;
            case 19:
                $dia = "diecinueve";
                break;
            case 20:
                $dia = "veinte";
                break;
            case 21:
                $dia = "veintiuno";
                break;
            case 22:
                $dia = "veintidos";
                break;
            case 23:
                $dia = "veintitres";
                break;
            case 24:
                $dia = "veinticuatro";
                break;
            case 25:
                $dia = "veinticinco";
                break;
            case 26:
                $dia = "veintiseis";
                break;
            case 27:
                $dia = "veintisiete";
                break;
            case 28:
                $dia = "veintiocho";
                break;
            case 29:
                $dia = "veintinueve";
                break;
            case 30:
                $dia = "treinta";
                break;
            case 31:
                $dia = "treinta y uno";
                break;
            default:
                 $dia = "--";
                break;
        }
        $mes = "";
        switch ($partes[1]) {
            case '1':
                $mes = "enero";
                break;
            case '2':
                $mes = "febrero";
                break;
            case '3':
                $mes = "marzo";
                break;
            case '4':
                $mes = "abril";
                break;
            case '5':
                $mes = "mayo";
                break;
            case '6':
                $mes = "junio";
                break;
            case '7':
                $mes = "julio";
                break;
            case '8':
                $mes = "agosto";
                break;
            case '9':
                $mes = "septiembre";
                break;
            case '10':
                $mes = "octubre";
                break;
            case '11':
                $mes = "noviembre";
                break;
            case '12':
                $mes = "diciembre";
                break;
            default:
                 $mes = "--";
                break;
            
           
        }
         $anio = $this->num2letras($partes[2],false,false,false);
        return($dia.' de '.$mes.' de '.$anio);
    }
public function buscar(){
    //echo 'Busqueda exitosa';
    $busqueda = $this->_contratos->buscar($_POST);
    
    //print_r($_POST);
    
    
    echo"<table id=\"contratos\" class=\"table table-bordered table-hover table-striped\">
                <thead style=\"background-color: #EEB;\">
                    <tr>
                        <th>NUM. EMPLEADO</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO PATERNO</th>
                        <th>APELLIDO MATERNO</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>";
        foreach($busqueda as $fila){           
        echo"
                 <tr>
                    <th>".$fila["VEMP_EMPL"]."</th>
                    <td>".$fila["VEMP_NOMBRE"]."</td>
                    <td>".$fila["VEMP_APEPAT"]."</td>
                    <td>".$fila["VEMP_APEMAT"]."</td>
                    <th><button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"selempl('".$fila["VEMP_EMPL"]."') \">Seleccionar</button> </th>
                </tr>
            ";
        }
        echo"
        </tbody>
        </table>";
    
}
public function infoempl($numempl = ""){
   //echo $numempl;
  $numempl = trim($numempl);
   
   if($numempl !=""){
   $info=$this->_contratos->infoempl($numempl);
   $estu=$this->_contratos->getestudios($numempl);
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
    
    foreach ($estu as $valor){
        echo "<label>".$valor["GRADO"]." EN ".$valor["CARRERA"]."</label>";
        echo"<p id=\"instituto\">".$valor["INSTITUTO"]."-".$valor["TÍTULO"]."</p>";
        echo"<p id=\"cedula\">".$valor["CÉDULA"]."</p>";
    }
    
}
       
   } 
   
   
  public function descargapdf($id){
      
      
      $parte= explode('-',$id);   
      $nombre="CPS".$parte[0]."-".$parte[2]."-".$parte[1].".pdf";
      $path = "/opt/contratos_scan/".strtolower($parte[0])."/".$parte[1]."/";
      
      // echo  $path;
      
      //header("Content-type: application/octet-stream");
	  //header("Content-Disposition: attachment; filename=\"$nombre\"\n");
    header('Content-type: application/pdf');
					$fp=fopen($path.$nombre, "r");
					fpassthru($fp);
      
      
  }
  public function contratosMari(){
    $contratos = $this->_contratos->getContratosMari();
    foreach ($contratos as $contrato) {
      $id     = $contrato['CLAVE'];
      $parte  = explode('-',$id);   
      $nombre = "CPS".$parte[0]."-".$parte[2]."-".$parte[1].".pdf";
      $path   = "/opt/contratos_scan/".strtolower($parte[0])."/".$parte[1]."/";
      echo $id;
      echo "</pr>";
      copy( $path.$nombre, "/opt/contratos_scan/mari/".$id.".pdf");
    }
  }
    public function descargasideol($id){
   $res = $this->_contratos->getContratosSideol($id);
print_r($res);
  
  /*    
      $parte= explode('-',$id);   
      $nombre="CPS".$parte[0]."-".$parte[2]."-".$parte[1].".pdf";
      $path = "/opt/contratos_scan/".strtolower($parte[0])."/".$parte[1]."/";
    header('Content-type: application/pdf');
          $fp=fopen($path.$nombre, "r");
          fpassthru($fp);
*/      
      
  }
  
  
    public function descargapdfs(){
        
        
        $pdf = (new fpdi())->getInstancia();
        
        $directorio = '/opt/contratos_scan2/';
        $archivos  = scandir($directorio);
        
      
        //$files = array(1 => 'CPSC-107-2018.pdf', 2 => 'ejemplo.pdf' );
        
        foreach ($archivos as $var) {
           // echo($var);
            if ($var != "."and $var != ".."){
        	$pagecount = $pdf->setSourceFile($directorio.$var); 
        
        	$cont=0;
        
        	for ($cont = 1; $cont <= $pagecount; $cont++) 
        	{
        		$tplidx = $pdf->importPage($cont, '/MediaBox'); 
        		$pdf->addPage(); 
        		$pdf->useTemplate($tplidx); 
        
        		}
            }
        }
        
        $pdf->Output('Vigentes.pdf','d');
          
         
          }
          function reporteh(){
$trabadores = array();
$url = "http://search.sep.gob.mx/solr/cedulasCore/select?fl=%2A%2Cscore&q=israel+cruz+rodriguez&start=0&rows=10&facet=false&indent=on&wt=json";
$obj = json_decode(file_get_contents($url), true);
echo json_encode($obj); 
//echo $obj['access_token'];
       /*   
echo "<table border='1'>";
foreach ($trabadores as $key => $fila) {
  echo "<tr>";
    echo "<td>". $fila."</td>";
    echo "<td>". $this->_contratos->getInfoTrabajador($fila,"numerocedula")."</td>";
    echo "<td>". $this->_contratos->getInfoTrabajador($fila,"fechacedula")."</td>";
    echo "<td>". $this->_contratos->getInfoTrabajador($fila,"escuela")."</td>";
    echo "<td>". $this->_contratos->getInfoTrabajador($fila,"gradoacademico")."</td>";
    echo "<td>". $this->_contratos->getInfoTrabajador($fila,"carrera")."</td>";
  echo "</tr>";
}
echo "</table>";
*/
}
function curp($curp){
  //$curp = $_GET["c"];
  $peticion = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:ValidateMexico">
     <soapenv:Header/>
     <soapenv:Body>
        <urn:Curp soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
     <return xsi:type="urn:CurpReq">
        <user xsi:type="xsd:string">prueba</user>
        <password xsi:type="xsd:string">sC}9pW1Q]c</password>
        <Curp xsi:type="xsd:string">'.$curp.'</Curp>
     </return>
        </urn:Curp>
     </soapenv:Body>
  </soapenv:Envelope>';
        $header = array(
            'Content-type: text/xml;charset="utf-8"',
            'Accept-Encoding: gzip, deflate',
            'SOAPAction: "urn:ValidateMexico#Curp"',
            'Connection: Keep-Alive',
            'Content-length: '.strlen($peticion),
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://187.160.251.219/ws/index.php');
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($curl, CURLOPT_PORT, 80);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $peticion);
        curl_setopt($curl, CURLOPT_ENCODING, $peticion);
        $re = curl_exec($curl);
// echo "$re";
  curl_close($curl);
  $doom = new \DOMDocument();
  $doom->loadXML($re);
  $estatus = $doom->getElementsByTagName('Response')->item(0)->nodeValue;
  if ($estatus=='correct') {
    echo 'Sexo: '.  $doom->getElementsByTagName('Sexo')->item(0)->nodeValue ."<br/>";
    echo 'Fecha Nac: '.  $doom->getElementsByTagName('FechaNacimiento')->item(0)->nodeValue ."<br/>";
    echo 'Foja: '.  $doom->getElementsByTagName('Foja')->item(0)->nodeValue ."<br/>";
    echo 'Tomo: '.  $doom->getElementsByTagName('Tomo')->item(0)->nodeValue ."<br/>";
    echo 'Libro: '.  $doom->getElementsByTagName('Libro')->item(0)->nodeValue ."<br/>";
    echo 'NumActa: '.  $doom->getElementsByTagName('NumActa')->item(0)->nodeValue ."<br/>";
    echo 'NumEntidadReg: '.  $doom->getElementsByTagName('NumEntidadReg')->item(0)->nodeValue ."<br/>";
    echo 'CveMunicipioReg: '.  $doom->getElementsByTagName('CveMunicipioReg')->item(0)->nodeValue ."<br/>";
    echo 'NumRegExtranjeros: '.  $doom->getElementsByTagName('NumRegExtranjeros')->item(0)->nodeValue ."<br/>";
    echo 'FolioCarta: '.  $doom->getElementsByTagName('FolioCarta')->item(0)->nodeValue ."<br/>";
    echo 'CveEntidadEmisora: '.  $doom->getElementsByTagName('CveEntidadEmisora')->item(0)->nodeValue ."<br/>";
    echo 'Curp: '.  $doom->getElementsByTagName('Curp')->item(0)->nodeValue ."<br/>";
    echo 'Paterno: '.$doom->getElementsByTagName('Paterno')->item(0)->nodeValue."<br/>";
    echo 'Materno: '.$doom->getElementsByTagName('Materno')->item(0)->nodeValue."<br/>";
    echo 'Nombre: '.$doom->getElementsByTagName('Nombre')->item(0)->nodeValue."<br/>";
  }else{
    echo "Error";
  }
}
function cedula($n,$ap,$am){
header('Content-Type: text/html; charset=UTF-8');
/*
$n=$_GET["n"];
$ap=$_GET["ap"];
$am=$_GET["am"];
*/
http://localhost/x/index.php?n=ISRAEL&ap=CRUZ&am=RODRIGUEZ
$url = "http://search.sep.gob.mx/solr/cedulasCore/select?fl=%2A%2Cscore&q=".$n."-".$ap."-".$am."&start=0&rows=20&facet=true&indent=on&wt=json";
$obj = json_decode(file_get_contents($url), true);
$x = json_decode(json_encode($obj),true);
/*
echo "<pre>";
 print_r (($x) );
echo "</pre>";
/*
echo "<pre>";
 print_r (prettyPrint($x) );
echo "</pre>";
*/
$n= str_replace("-", " ", $_GET["n"]) ;
$ap=str_replace("-", " ", $_GET["ap"]) ; 
$am=str_replace("-", " ", $_GET["am"]) ; 
echo ' 
<!DOCTYPE html>
<html>
<head>
    <title>CEDULAS UQROO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <table class="table table-bordered table-doted">
        
    ';
echo "<h2> Nombre: ".$n." </br> Apellido Paterno: ".$ap." </br> Apellido Materno: ".$am."</h2>";
foreach ($x["response"]["docs"] as $key => $fila) {
    //print_r($fila);
    if($n==normaliza($fila["nombre"]) and $ap==normaliza($fila["paterno"]) and $am == normaliza($fila["materno"]) ){ 
    echo "<tr>";
        echo "<td>".$fila["nombre"]."</td>";
        echo "<td>".$fila["paterno"]."</td>";
        echo "<td>".$fila["materno"]."</td>";
        echo "<td>".$fila["titulo"]."</td>";
        echo "<td>".$fila["institucion"]."</td>";
        echo "<td>".$fila["numCedula"]."</td>";
        echo "<td>".$fila["anioRegistro"]."</td>";
        echo "<td>".$fila["tipo"]."</td>";
   // [id] => 6866721|C1
   // [score] => 3.8977294
    echo "<tr>";
    }
}
echo ' 
</table>
</body>
</html>
';
}
public function getListaDivisiones($anio){
    $divisiones = $this->_contratos->getDivisiones($anio);    
    //$cadena="<option value='0'>Seleccione...</option>";
    $cadena="";
    foreach ($divisiones as $division) {
        //if($division['ID_DIVISION']) $s = " selected "; else $s = "";
            $cadena.="<option value='".$division['ID_DIVISION']."'>".$division['ID_DIVISION']."</option>";
    } 
    return $cadena;
    
}

public function session()
  {

    $_SESSION["_FederatedPrincipal_"]="";

    echo "<pre>";
    print_r( $_SESSION);
    echo "</pre>";

  }

  
}
?>