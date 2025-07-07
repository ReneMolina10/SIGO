<?php



class renovarModel extends Model

{

    public function __construct() {

        parent::__construct();

    }


 public function getPlantillasAdmin(){
    $sql = "SELECT PLT_ID AS ID, PLT_DENOMINACION AS DENOMINA FROM CNT_PLANTILLAS WHERE PLT_STATUS = 1 AND PLT_FK_ID_CNT = 1";

    return $this->ssql($sql);

 }

 public function getPercepciones($mes,$anio)
  {
$sql= "
SELECT NOMI_NOMINA AS NOMINA, PAGO_EMPL AS NUMEMPL,PD.DPAG_CONP AS CONC, (DPAG_MONTO) AS MONTO,(DPAG_DIAS) AS DIAS  FROM PNOMINAS NOM

LEFT JOIN PPAGOS PG
ON PG.PAGO_NOMINA = NOM.NOMI_NOMINA 

LEFT JOIN PDPAGOS PD
ON PD.DPAG_PAGO = PG.PAGO_PAGO

WHERE  TO_CHAR(NOMI_FECHA,'MM/YYYY') = '$mes/$anio' 
AND PD.DPAG_PERDED = 'P'

ORDER BY PAGO_EMPL DESC,NOMI_NOMINA DESC,DPAG_CONP DESC

";

 
    return $this->ssql($sql);


}



 public function getFechaPeriodoAdmin()
  {
/*
$sql = "SELECT TO_CHAR(PER_FECHA_INI,'YYYY-MM-DD') AS PER_FECHA_INI, TO_CHAR(PER_FECHA_FIN,'YYYY-MM-DD') AS PER_FECHA_FIN
FROM CNT_PERIODOS_ADMIN
WHERE 
PER_ID =
(SELECT MIN(PER_ID)FROM CNT_PERIODOS_ADMIN  
WHERE PER_ANIO= (SELECT MAX(PER_ANIO) FROM CNT_PERIODOS_ADMIN))
AND
PER_ANIO= (SELECT MAX(PER_ANIO) FROM CNT_PERIODOS_ADMIN)";
*/
$sql = "
SELECT TO_CHAR(PER_FECHA_INI,'YYYY-MM-DD') AS PER_FECHA_INI, TO_CHAR(PER_FECHA_FIN,'YYYY-MM-DD') AS PER_FECHA_FIN
FROM CNT_PERIODOS_ADMIN
WHERE 
PER_ID =
(SELECT MAX(PER_ID)FROM CNT_PERIODOS_ADMIN  )
";

$datos = $this->_db->query($sql);
    return $datos->fetch();

}

function getURES()
{
    $sql = "SELECT URES, DECODE(FECHA_FIN,NULL,LURES,LURES||'(CERRADO)') LURES FROM TURESH";
    $datos = $this->_db->query($sql);
    return $datos->fetchAll();

} 

function getResultados($ua){
    
        /*
        $sql = "
				SELECT CNT_PK_UA AS UA, CNT_PK_ANIO AS ANIO , CNT_PK_CONTRATO AS CONT,
        CNT_FK_NOEMPL AS NO,EMPL.VEMP_NOMBRE||' '||EMPL.VEMP_APEPAT||' '||EMPL.VEMP_APEMAT AS NOMBRE,
				URE.LURES AS URE, CNT_MONTO_MENSUAL AS MNT_MENSUAL
				FROM CNT_CONTRATOS CONT
				LEFT JOIN PVEMPLDOS EMPL ON  CONT.CNT_FK_NOEMPL = EMPL.VEMP_EMPL
				LEFT JOIN SAIESH.TURES URE ON CONT.CNT_FK_URE = URE.URES
				WHERE CONT.CNT_FK_TIPO IN (1,6) AND CNT_FECHA_INICIO >= TO_DATE('2020/01/01', 'YYYY/MM/DD') and CNT_FECHA_INICIO <= TO_DATE('2020/06/30', 'YYYY/MM/DD')
        AND CNT_PK_UA = 1
				ORDER BY CONT.CNT_FK_URE "; */

        $sql = "

SELECT CNT_PK_UA AS UA, CNT_PK_ANIO AS ANIO , CNT_PK_CONTRATO AS CONT,
        CNT_FK_NOEMPL AS NO,EMPL.VEMP_NOMBRE||' '||EMPL.VEMP_APEPAT||' '||EMPL.VEMP_APEMAT AS NOMBRE,
        URE.URES AS IDURE, URE.LURES AS URE, CNT_MONTO_MENSUAL AS MNT_MENSUAL
        FROM CNT_CONTRATOS CONT
        LEFT JOIN PVEMPLDOS EMPL ON  CONT.CNT_FK_NOEMPL = EMPL.VEMP_EMPL
        LEFT JOIN TURESH URE ON CONT.CNT_FK_URE = URE.URES
        WHERE CONT.CNT_FK_TIPO IN (1,6) AND CNT_FECHA_INICIO >= 
                TO_DATE( ( SELECT TO_CHAR(PER_FECHA_INI,'DD-MM-YYYY') as f FROM CNT_PERIODOS_ADMIN WHERE PER_ID = (SELECT MAX(PER_ID) - 1  AS ID FROM CNT_PERIODOS_ADMIN ))
                , 'DD-MM-YYYY')
                and CNT_FECHA_INICIO <
                
                TO_DATE( ( SELECT TO_CHAR(PER_FECHA_INI,'DD-MM-YYYY') as f FROM CNT_PERIODOS_ADMIN WHERE PER_ID = (SELECT MAX(PER_ID)  AS ID FROM CNT_PERIODOS_ADMIN ))
                , 'DD-MM-YYYY')
                
                
        AND CNT_PK_UA = $ua
        ORDER BY CONT.CNT_FK_URE

        "; 

    	$datos = $this->_db->query($sql);
        return $datos->fetchall();

    } 

function getRenovar($ua, $anio, $cont){
	$sql="SELECT*FROM CNT_CONTRATOS 
	WHERE CNT_PK_UA = $ua AND CNT_PK_ANIO = $anio AND CNT_PK_CONTRATO=$cont ";
	 //echo $sql;
	$datos = $this->_db->query($sql);
    return $datos->fetch();
}      

function putContratos($datos){
        $anio = date("Y");
        $ua = $datos["CNT_PK_UA"];
        
        $sqlId  = "SELECT DECODE(MAX(CNT_PK_CONTRATO),NULL,0,MAX(CNT_PK_CONTRATO)) +1 AS ID FROM CNT_CONTRATOS 
                   WHERE CNT_PK_UA=:ua AND CNT_PK_ANIO=:anio";
        $infoId = array(':ua'  => $datos["CNT_PK_UA"],
                        ':anio'=> $anio);

        $resId = $this->_db->prepare($sqlId)->execute($infoId);

        $idC = $resId["ID"];



         $sql = "Insert into CNT_CONTRATOS (
            CNT_PK_UA,
            CNT_PK_ANIO,
            CNT_PK_CONTRATO,
            CNT_FK_NOEMPL,
            CNT_FK_TIPO,
            CNT_STATUS,
            CNT_FECHA_INICIO,
            CNT_FECHA_FIN,
            CNT_TEXTO,
            CNT_FK_CATEGORIA,
            CNT_FK_URE,
            CNT_FUNCIONES,
            CNT_NUM_QUINCENAS,
            CNT_NUM_SEMANAS,
            CNT_NUM_HORAS,
            CNT_MONTO_TOTAL,
            CNT_MONTO_QUINCENA,
            CNT_FK_NOEMPL_TESTIGO1,
            CNT_FK_NOEMPL_TESTIGO2,
            CNT_FECHA_FIRMA,
            CNT_FK_DEPTOSAE,
            CNT_MONTO_MENSUAL,
            CNT_NUM_HORAS_SEM,
            CNT_FK_PLANTILLA
        ) 
    values (
        :ua,
        :anio,
        :idc,
        :numempl,
        :tipoc,
        :status,
        TO_DATE(:fi,'YYYY-MM-DD'),
        TO_DATE(:ff,'YYYY-MM-DD'),
        :texto,
        :categoria,
        :ure,
        :funciones,
        :quincenas,
        :semanas,
        :horas,
        :monto,
        :monto_quincenal,
        :testigo1,
        :testigo2,
        TO_DATE(:fecha_firma,'YYYY-MM-DD'),
        :iddeptosae,
        :monto_mensual,
        :horas_semana,
        :plantilla

    ) 
    ";
         $info = array(':ua'               => $datos["CNT_PK_UA"],
                       ':anio'             => $anio,
                       ':idc'          	   => $idC,
                       ':numempl'          => $datos["CNT_FK_NOEMPL"],
                       ':status'           => 1,
                       ':fi'  	           => $datos["CNT_FECHA_INICIO"],
                       ':ff'  	  	       => $datos["CNT_FECHA_FIN"],
                       ':texto'            => $datos["CNT_TEXTO"],
                       ':tipoc' 	       => $datos["CNT_FK_TIPO"],
                       ':ure'              => $datos["CNT_FK_URE"],
                       ':categoria'        => $datos["CNT_FK_CATEGORIA"],
                       ':funciones'        => $datos["CNT_FUNCIONES"],
                       ':quincenas'        => $datos["CNT_NUM_QUINCENAS"],
                       ':semanas'          => $datos["CNT_NUM_SEMANAS"],
                       ':horas'            => $datos["CNT_NUM_HORAS"],
                       ':monto' 		   => $datos["CNT_MONTO_TOTAL"],
                       ':monto_quincenal'  => $datos["CNT_MONTO_QUINCENA"],
                       ':testigo1'         => $datos["CNT_FK_NOEMPL_TESTIGO1"],
                       ':testigo2'         => $datos["CNT_FK_NOEMPL_TESTIGO2"],
                       ':fecha_firma'      => $datos["CNT_FECHA_FIRMA"],
                       ':iddeptosae'       => $datos["CNT_FK_DEPTOSAE"],
                       ':monto_mensual'    => $datos["CNT_MONTO_MENSUAL"],
                       ':horas_semana'     => $datos["CNT_PERIODO_INFORMA"],
                       ':plantilla'     => $datos["CNT_FK_PLANTILLA"]                      
     );  
         /*
echo "hola 2";

    echo "<pre>";
    print_r($info);
    echo "</pre>";

*/


   $res = $this->_db->prepare($sql)->execute($info);

  // echo $res; 

   return($idC);
}
}



?>