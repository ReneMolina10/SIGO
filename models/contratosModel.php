<?php
class contratosModel extends Model{
    public function __construct() {
        parent::__construct();
    }
    public function tmp(){
        $sql = "SELECT * FROM CNT_USR";
        $res = $this->ssql($sql);
        return $res;
    }
    /**
     * contratos para cencusrar de mari
     * 
     * @author Yair Beltran Matos
     * 
     */
    public function getContratosMari(){
        $sql = "SELECT  
        --COUNT(*)
            U.UA_CLAVE||'-'||CNT_PK_ANIO||'-'||CNT_PK_CONTRATO AS CLAVE, 
            CNT_STATUS AS STATUS
            FROM (
            SELECT*FROM 
            (
            SELECT D.*, rownum r 
            FROM 
            (
            SELECT
            *
            FROM CNT_CONTRATOS 
            WHERE CNT_PK_ANIO = 2023
            ) D
            )    
            )C
            LEFT JOIN PVEMPLDOS P
            ON P.VEMP_EMPL=C.CNT_FK_NOEMPL
            LEFT JOIN CNT_UACADEMICAS U
            ON U.UA_ID = C.CNT_PK_UA
            LEFT JOIN CNT_TIPOCONT TC
            ON TC.TCNT_ID = C.CNT_FK_TIPO
            LEFT JOIN CNT_CATEGORIAS CC
            ON CC.CAT_ID_CAT = C.CNT_FK_CATEGORIA
            LEFT JOIN TURESH UR
            ON UR.URES = C.CNT_FK_URE
            WHERE  CNT_STATUS = 2 AND CNT_FK_NOEMPL IN (
            '564',
        '92139',
        '648',
        '91175',
        '90307',
        '92285',
        '91267',
        '92985',
        '92561',
        '92285',
        '93207',
        '90230',
        '92985',
        '92866',
        '92945',
        '92938',
        '93252',
        '568',
        '622',
        '92073',
        '92592',
        '92179',
        '91298',
        '91616',
        '91037',
        '91617',
        '91135',
        '93260',
        '91931',
        '91258',
        '92946',
        '93209',
        '93127',
        '93015',
        '93108',
        '93130',
        '93217',
        '93026',
        '93120',
        '91525',
        '102227',
        '92765',
        '93205',
        '93220',
        '93227',
        '93186',
        '91733',
        '92040',
        '90643',
        '155',
        '92866',
        '01-04024',
        '90699',
        '90226',
        '90732',
        '667',
        '92561',
        '92825',
        '91556',
        '91493',
        '831',
        '92139',
        '93166',
        '92855',
        '93082',
        '838',
        '831',
        '90347',
        '90850',
        '92490',
        '596',
        '93055',
        '91507',
        '91479',
        '621',
        '93231',
        '90788',
        '92614',
        '92908',
        '91128',
        '1155',
        '618',
        '93058',
        '92336',
        '93150',
        '9601402',
        '824',
        '622',
        '717',
        '92064',
        '92627',
        '101288',
        '92333',
        '92623',
        '91037',
        '92427',
        '91178',
        '90432',
        '91818',
        '92194',
        '90492',
        '90647',
        '92892',
        '91464',
        '91131',
        '91041',
        '92893',
        '831',
        '92373',
        '92739',
        '642',
        '93114',
        '93223',
        '91954',
        '93012',
        '91619',
        '91035',
        '90792',
        '92892',
        '93279',
        '91137',
        '93226',
        '93240',
        '93212',
        '91818',
        '92603',
        '92250',
        '91970',
        '93200',
        '92075',
        '92615',
        '92732',
        '93239',
        '92183',
        '92999',
        '572',
        '93241',
        '91055',
        '92944',
        '93119',
        '93190',
        '92942',
        '93238',
        '91940',
        '93072',
        '92766',
        '90628',
        '93124',
        '93071',
        '638',
        '91629',
        '92674',
        '91640',
        '92043',
        '92024',
        '91758',
        '91189',
        '91763',
        '91238',
        '91944',
        '91043',
        '91942',
        '92498',
        '91197',
        '91512',
        '91784',
        '91362',
        '92592',
        '91763',
        '92661',
        '93125',
        '92578',
        '92910',
        '92497',
        '93151',
        '92577',
        '92631',
        '93162',
        '92692',
        '92634',
        '92788',
        '93092',
        '92133',
        '93151',
        '93093',
        '93152',
        '92995',
        '92931',
        '93147',
        '93173',
        '92635',
        '93122',
        '92753',
        '92756',
        '93174',
        '92263',
        '92695',
        '93080',
        '92824',
        '92346',
        '92901',
        '92545',
        '93183',
        '93195',
        '92871',
        '92320',
        '92518',
        '93083',
        '92339',
        '92188',
        '93182',
        '93187',
        '9200350',
        '92455',
        '92437',
        '93124',
        '728',
        '92666',
        '91924',
        '92435',
        '92380',
        '93086',
        '92164',
        '93181',
        '92590',
        '92185',
        '93169',
        '92371',
        '92696',
        '93073',
        '91969',
        '92302',
        '92671',
        '92385',
        '92379',
        '92196',
        '93066',
        '92310',
        '93167',
        '93192',
        '93250',
        '92908',
        '91137',
        '93282',
        '91455',
        '91530',
        '93026',
        '92340',
        '91544',
        '91274',
        '92941',
        '838',
        '91287',
        '93116',
        '92271',
        '92651',
        '93035',
        '93246',
        '92141',
        '91590',
        '91281',
        '91797',
        '92834',
        '91276',
        '92434',
        '91695',
        '92620',
        '92609',
        '92987',
        '92283',
        '93215',
        '91119',
        '92002',
        '93180',
        '92465',
        '92835',
        '92137',
        '91835',
        '93219',
        '92837',
        '93202',
        '92503',
        '91543',
        '92741',
        '91832',
        '92245',
        '92246',
        '93194',
        '93177',
        '92257',
        '93244',
        '93178',
        '92392',
        '92685',
        '93115'
        )
        -- AND ROWNUM = 1
            ORDER BY UA_CLAVE DESC,CNT_PK_ANIO DESC,C.CNT_PK_CONTRATO DESC
        ";
        return $this->ssql( $sql );
    }
    public function getContratosCopiar(){
    $sql = "SELECT * FROM (
                SELECT C.*, CNT_PK_UA||'-'||CNT_PK_ANIO||'-'||CNT_PK_CONTRATO AS CLAVE FROM CNT_CONTRATOS C 
                    WHERE CNT_PK_ANIO = 2019 
                ) R 
            LEFT JOIN (SELECT PERS_PERSONA, REPLACE(PERS_NOMBRE||' '||PERS_APEPAT ||' '||PERS_APEPAT,' ','_') AS NOMBRE   FROM FINANZAS.FPERSONAS ) P
            ON R.CNT_FK_NOEMPL = P.PERS_PERSONA
    ";
        $res = $this->ssql($sql);
        return $res; 
    }
    public function gerContratosCopiarxAnt(){
        $sql = " 
        SELECT * FROM CNT_CONTRATOS WHERE CNT_PK_ANIO = 2020 AND CNT_FK_TIPO = 1
        AND CNT_FK_NOEMPL IN 
        (
        SELECT PERS_PERSONA FROM FINANZAS.FPERSONAS WHERE PERS_RFC IN (
        'BOMM431030EH4',
        'BOPV711021A73',
        'GATC800710HI6',
        'MELA851101BY6',
        'PESV841018T29',
        'MOGI890818TS1',
        'CAMD750504GY9',
        'GOCK910203CG2',
        'BARH810825DY4',
        'OISF670825982',
        'ROCA850528KA6',
        'SAOA870928QI8',
        'VAHL760509T93',
        'CECK890808BZ5',
        'ROAF810723CQ8',
        'BOLG760718KD1',
        'MOAA5605176A0',
        'YAOB850902H89',
        'CARJ741102DUA',
        'ROHL720611DS5',
        'PUAA781021LZ7',
        'CACN8209289V0',
        'LOLN761005AVA',
        'PAVH911016AX7',
        'PESL890511J1A',
        'ROFJ820419MN3',
        'SAGA710305JY3',
        'EISJ620817MJ4',
        'PEXG9103232D9',
        'CALA910228882',
        'JILD700419FP7',
        'LOMG801003MW1',
        'CAGG7906023L5',
        'SAIM8205309DA',
        'AOCR901220JX1',
        'AUVA820129SN5',
        'CEMM8609138L2',
        'GARA820621MT1',
        'MOCM850610971',
        'MORM880725QEA',
        'SEBL810408639',
        'COCA8307268S4',
        'VASR8505112E0',
        'CANJ860409Q26',
        'PAWA890406N22',
        'HEMR560129M35',
        'HEAL710808SL1',
        'CIPR620202JV6',
        'COMR601002PB8',
        'PACJ931007JQ3',
        'CAMD880622FQ9',
        'AOAJ861212B5A',
        'CEAN930623RJ8',
        'CAGG771103JU5',
        'RIMJ871120SY0',
        'AUMI820401CG3',
        'DUAA950411RR0',
        'GOHL8912193G5',
        'GUSG941118115',
        'OIMB8503116A8',
        'ROPA820511BJ6',
        'TOME921125DX1',
        'UILA880820T76',
        'VACL8112191C0',
        'CADA930507SXA',
        'TISA900813D35',
        'GAGJ730122BX7',
        'MALW720415L40',
        'PUOL6106134M9',
        'AARJ8606257IA',
        'IEKI750623D85',
        'CAAJ960322465',
        'CAAR540126G64',
        'CAVG7007115M7',
        'GOVN750219DG3',
        'TECO8101257D8',
        'VASB910812TEA',
        'BOCL770904PU8',
        'CAGB830127GD5',
        'PENA870607390',
        'CATV9205156S1',
        'MASY8110197W8',
        'SOGJ8001054X0',
        'MAMI881103US4',
        'GOCS570503LN6',
        'VIJI690426HD5',
        'COQA921215392',
        'DIRS860924U94',
        'GALP711219U61',
        'GAPC741219ME7',
        'HEAJ931020E99',
        'HECF7502189J3',
        'MOLP900210MY9',
        'VIMD850828Q35',
        'KUCR820829NX1',
        'GULM801116DV6',
        'ROVI790731P47',
        'AASP7808121R2',
        'VAES8709175Y7',
        'GARD6809034M6',
        'FESJ980217BI2',
        'EIJR830903B90',
        'IACM7707051NA',
        'MOAM861026672',
        'ROBJ870219BD6',
        'TERS780313AEA',
        'TONA731128CW0',
        'CEOL8308079K8',
        'CAAS781009M87',
        'ROAR701030GG2',
        'SALA8202058C5',
        'GAYV661205SJA',
        'NONJ8811156GA',
        'CAHM7611119M4',
        'MECG790130N40',
        'VACR730806BTA',
        'PECM810818KT1',
        'VEAR860531699',
        'AULJ831014CS3',
        'CAMM8612088F5',
        'CUOC820925PD0',
        'FUBM860203AB7',
        'HEAD861127DM8',
        'MARM840313CF5',
        'MOVN920807672',
        'ROPM860202UG6',
        'UAEA890915BH0',
        'ZAAB9211147U1',
        'BEYH861120JQ2',
        'UACR850315SG1',
        'CICL791103GT8',
        'MALM870221QG9',
        'CAQM921103D38',
        'ROSH880626GQ2',
        'ZURC7712197B6',
        'BADF791114DF9',
        'HECE800522CE2',
        'MABI691221TH0',
        'AAFF6812142D4',
        'MUQN810427TSA',
        'PARN620910UW3',
        'MOCA781014871',
        'SIPE6809072E1',
        'MAPP641220779',
        'GONC651018KL1',
        'IEPK871105BQ8',
        'NAPJ9006229E4',
        'MEGR880312EP6',
        'MAGL780422PZ0',
        'DITS710130FT8',
        'MAGS760821LW3',
        'VASC820827G88',
        'IACJ890527T95',
        'MIPM631020DK6',
        'CAGS7103105V9',
        'EIPL840603638',
        'MABL801010U77',
        'MARD750724TA8',
        'QUPN5606131T4',
        'BEBD921214ALA'
        )
        )
        ";
        $res = $this->ssql($sql);
        return $res; 
    }
public function getAdendums(){
    $sql = "SELECT * FROM CNT_ADENDUM where ADE_CLAVE IN (558,531) OR ADE_CLAVE >=628 "; 
    // echo "-- $sql --";
    $res = $this->_db->query($sql); 
    $row = $res->fetchall();
    return($row);
}
function getAdendumTexto($clave,$anio,$numC){
    $sql = "SELECT ADE_TEXTO AS TEXTO FROM CNT_ADENDUM WHERE ADE_FK_UA = $clave and ADE_FK_NUMCONTRATO = $numC and ADE_ANIO = $anio ";
    $res = $this->_db->query($sql); 
    $row = $res->fetch();
    return($row);
}
public function putAdendum($numContrato,$ua,$anio,$texto){
    $sqlLlave = "SELECT DECODE(MAX(ADE_CLAVE),NULL,0,MAX(ADE_CLAVE)) +1 AS LLAVE FROM CNT_ADENDUM";
    $resLlave = $this->_db->query($sqlLlave);
    $rowLlave = $resLlave->fetch();
/*
    echo "<pre>";
    print_r($rowLlave);
    echo "</pre>";
    */
//$texto = "x";
    $sql = "INSERT INTO CNT_ADENDUM (ADE_CLAVE, ADE_FK_NUMCONTRATO, ADE_FK_UA, ADE_ANIO, ADE_TEXTO) 
    VALUES ('".$rowLlave["LLAVE"]."', '$numContrato', '$ua', '$anio', :texto)
    ";
  //  echo "$sql <br/>";
    //$res = $this->ssquery($sql);
    $res = $this->_db->prepare($sql)->execute( array(':texto'=>$texto ) );
   //  print_r($res);
}
public function getContratosAdendum(){
        $sql = "
SELECT * FROM CNT_CONTRATOS 
WHERE 
CNT_FK_CATEGORIA NOT IN (40,41,42,43,44) 
AND CNT_FECHA_INICIO >= TO_DATE('01/08/2019','DD/MM/YYYY') AND CNT_FECHA_INICIO <= TO_DATE('31/12/2019','DD/MM/YYYY')
        /*
SELECT * FROM CNT_CONTRATOS 
WHERE 
CNT_FK_CATEGORIA IN (40,41,42,43) 
AND CNT_FECHA_INICIO >= TO_DATE('15/08/2019','DD/MM/YYYY') AND CNT_FECHA_INICIO <= TO_DATE('31/12/2019','DD/MM/YYYY')
ORDER BY CNT_PK_UA
*/
        ";
 $res = $this->_db->query($sql); 
    $row = $res->fetchall();
return ($row );
}
public function getURE($idusr)
{
    $sql = "
SELECT UA_ID AS IDURE, UA_DENOMINACION AS UA, UA_CLAVE AS CLAVE FROM CNT_UACADEMICAS U
WHERE UA_ID = '$idusr'";
    $res = $this->_db->query($sql,null,1); 
    $row = $res->fetch();
    return($row);
}
public function getDeptos($da){ 
    // $sql = "SELECT URES,LURES FROM TURESH WHERE URESP = (
    //             SELECT DA_URI FROM CNT_DA WHERE DA_SIGLA = '$da'
    //         )";
        $sql = "SELECT URES,LURES FROM TURESH WHERE DEPTO_ACAD=1 AND FECHA_FIN IS NULL OR URES IN ( 137100, 147610, 147710, 147810, 151400 )";
          //  echo $sql;
    $res = $this->_db->query($sql); 
    $row = $res->fetchall();
    return($row);
}
public function getInfoFechas($per,$a,$tipo){
    $sql = "SELECT PER_QUINC,PER_SEMAN, 
                   TO_CHAR(PER_FECHA_INI,'YYYY-MM-DD') AS FI,
                   TO_CHAR(PER_FECHA_FIN,'YYYY-MM-DD') AS FF
            FROM CNT_PERIODOS_DOCEN 
            WHERE PER_ANIO = $a AND PER_PERIODO = '$per' -- AND PER_TIPO = $tipo
            ";
    $res = $this->_db->query($sql); 
   // echo "--- $sql ---";
    $row = $res->fetch();
    return($row);
}
public function getInfoFechasActual(){
    $sql = "SELECT PER_QUINC,PER_SEMAN, 
                   TO_CHAR(PER_FECHA_INI,'YYYY-MM-DD') AS FI,
                   TO_CHAR(PER_FECHA_FIN,'YYYY-MM-DD') AS FF
            FROM CNT_PERIODOS_DOCEN 
            WHERE PER_STATUS = 1 AND PER_TIPO = 1";
    $res = $this->_db->query($sql); 
   // echo "--- $sql ---";
    $row = $res->fetch();
    return($row);
}
public function getPlantillasByTipo($id){
        $sql = "SELECT * FROM CNT_PLANTILLAS WHERE PLT_STATUS=1 AND PLT_FK_ID_CNT =$id";
        $res = $this->_db->query($sql); 
        $row = $res->fetchall();
    return($row);
}
public function getPlantillasByIdTipo($id){
    $sql = "SELECT * FROM CNT_PLANTILLAS WHERE PLT_FK_ID_CNT = $id AND PLT_STATUS=1 ORDER BY PLT_ID DESC";
    $res = $this->_db->query($sql); 
    $row = $res->fetchall();
    return($row);
}
public function getEmpleadoTipo($idEmpl){
    $sql = "SELECT EMPL,ID_CATE FROM SAIESH.PLANTILLA_2018_9 WHERE EMPL = '$idEmpl' LIMIT 1";
    $res = $this->_db->query($sql); 
    $row = $res->fetch();
    return($row);
}
public function getEmpleadoGradoAcademico($idEmpl){
    $sql = "SELECT GETGRADOESTUDIOS('$idEmpl') AS TIPO FROM DUAL";
    $res = $this->_db->query($sql); 
    $row = $res->fetch();
    return $row["TIPO"];
}
public function getDABySiglas($da){
    $da = strtoupper($da);
        $sql = "SELECT * FROM  CNT_DA WHERE DA_SIGLA='$da' and ROWNUM=1
        ";
    $res = $this->_db->query($sql); 
    $row = $res->fetch();
    return($row);
}
public function setTipo($contrato, $id){
    $sql= "UPDATE CNT_CONTRATOS SET CNT_FK_TIPO = '$id', CNT_NUM_QUINCENAS=8 WHERE CNT_PK_CONTRATO=$contrato AND   ROWNUM = 1 ";
    $res = $this->_db->prepare($sql)->execute( array() ); 
}
public function getDCSTMP(){
    $sql = "SELECT * FROM CNT_CONTRATOS WHERE CNT_PK_CONTRATO>=1180 AND CNT_PK_CONTRATO<= 1205      ";
    $res = $this->_db->query($sql); 
    $row = $res->fetchall();
    return($row);
}
public function getContratosSideol($numEmpleado){
    $sql = "
    SELECT CNT_PK_CONTRATO,CNT_PK_ANIO,CNT_PK_UA, TO_CHAR(CNT_FECHA_INICIO,'DD/MM/YYYY') AS CNT_FECHA_INICIO,
     TO_CHAR(CNT_FECHA_FIN,'DD/MM/YYYY') AS CNT_FECHA_FIN, CNT_STATUS AS STATUS
    FROM CNT_CONTRATOS 
    WHERE CNT_PK_ANIO=2019 AND CNT_FK_NOEMPL= '$numEmpleado' AND (CNT_STATUS=2 or CNT_STATUS=1)
    AND CNT_FECHA_INICIO <= SYSDATE AND CNT_FECHA_FIN >= SYSDATE
     " ;
    $res = $this->_db->query($sql); 
    $row = $res->fetchall();
    return($row);
}
public function ifAdministrativo($id){
        $sql = "
    SELECT * FROM (SELECT EMPL,ID_CATE FROM SAIESH.PLANTILLA_2018_9) P
    LEFT JOIN (SELECT ID_CATEGORIA,GENERICO,NIVEL FROM SAIESH.TTABULADOR) T
    ON P.ID_CATE=T.ID_CATEGORIA
    WHERE P.EMPL = '$id'
";
   $res = $this->_db->query($sql); 
$row = $res->fetch();
 if ($row["GENERICO"]==1 and $row["NIVEL"]!=""){
        return(true);
    }else{
        return(false);
    }
}
public function getInfoSAEbyIdEmpleadoG($da, $per, $a, $idEmpl, $idsMaterias)
{
    $da = strtoupper($da);
    $per = strtoupper($per);
    $sql = "
    SELECT 
        ID_MATERIA,
        SUM(HORAS) AS HORAS,
        SUM(HRS_ASIG) AS HRS_ASIG,
        ID_DIVISION,
        ID_CATE,
        ID_MATERIA,
        NOM_MATERIA,
        ID_DEPARTAMENTO
    FROM 
    ( 
        SELECT 
            HORAS,
            HRS_ASIG,
            ID_DIVISION,
            ID_MATERIA,
            DECODE(ID_DISCIPLINA, 0, NOM_MATERIA, NOM_MATERIA ||' ('||NOM_DISCIPLINA||')') AS NOM_MATERIA,
            ID_DEPARTAMENTO,
            ID_CATE
        FROM 
        (
            SELECT 
                NOM_DEPARTAMENTO,
                ID_DOCENTE,
                ID_GRUPO,
                ID_DEPARTAMENTO,
                ID_MATERIA,
                HORAS,
                ID_PERIODO,
                ANIO,
                NOM_MATERIA,
                ID_DIVISION,
                PERIODO,
                HRS_ASIG,
                ID_DISCIPLINA,
                NOM_DISCIPLINA,
                TIPOA
            FROM SISRH.VGRUPOSD
            GROUP BY 
                ID_DOCENTE,
                NOM_DEPARTAMENTO,
                ID_GRUPO,
                ID_DEPARTAMENTO,
                ID_MATERIA,
                HORAS,
                ID_PERIODO,
                ANIO,
                NOM_MATERIA,
                ID_DIVISION,
                PERIODO,
                HRS_ASIG,
                ID_DISCIPLINA,
                NOM_DISCIPLINA,
                TIPOA
        ) G 
        LEFT JOIN 
        (
            SELECT NUM_EMPL AS EMPL, ID_CAT AS ID_CATE FROM VPLANTILLA_NOMBRA
        ) P ON P.EMPL = G.ID_DOCENTE 
        WHERE G.ID_PERIODO = '$per' 
        AND G.ANIO = $a 
        AND G.ID_DIVISION = '$da' 
        AND G.ID_DOCENTE = '$idEmpl'
        AND g.ID_MATERIA IN ($idsMaterias)
    )
    GROUP BY 
        ID_MATERIA,
        ID_DIVISION,
        ID_CATE,
        NOM_MATERIA,
        ID_DEPARTAMENTO";
    $res = $this->_db->query($sql); 
    $row = $res->fetchall();
    return $row;
}
public function getInfoSAEbyIdEmpleado($da,$per,$a,$idEmpl){
    $da = strtoupper($da);
    $per = strtoupper($per);
        $sql = "
SELECT * FROM (
SELECT ID_DOCENTE,NOM_DEPARTAMENTO,
ID_GRUPO, ID_DEPARTAMENTO,ID_MATERIA,HORAS,ID_PERIODO,ANIO,NOM_MATERIA,ID_DIVISION,PERIODO,HRS_ASIG,ID_DISCIPLINA,NOM_DISCIPLINA, TIPOA 
FROM SISRH.VGRUPOSD  --WHERE ID_DOCENTE = '90855' AND ID_PERIODO = 'S01' AND ANIO = 2021
GROUP BY 
ID_DOCENTE,NOM_DEPARTAMENTO,ID_GRUPO, ID_DEPARTAMENTO,ID_MATERIA,HORAS,ID_PERIODO,ANIO,NOM_MATERIA,ID_DIVISION,PERIODO,HRS_ASIG,ID_DISCIPLINA,NOM_DISCIPLINA, TIPOA 
) G
/*
LEFT JOIN (SELECT EMPL,ID_CATE FROM SAIESH.PLANTILLA_2018_9) P
ON P.EMPL  = G.ID_DOCENTE
*/
LEFT JOIN (SELECT NUM_EMPL AS NO_EMPL, ID_CAT AS ID_CATE, '' AS ID_CATEH,GENERICO,'' AS NIVEL  FROM VPLANTILLA WHERE NUM_EMPL = '$idEmpl') T
-- LEFT JOIN (SELECT ID_CATEGORIA,GENERICO,NIVEL FROM SAIESH.TTABULADOR) T
ON P.ID_CATE=T.ID_CATEGORIA
-- LEFT JOIN (SELECT VEMP_EMPL,VEMP_NOMBRE||' '||VEMP_APEPAT||' '||VEMP_APEMAT AS NOMDOCENTE FROM PERSONAL.PVEMPLDOS) E
-- ON E.VEMP_EMPL = G.ID_DOCENTE
WHERE ID_PERIODO='$per' AND ANIO = $a AND ID_DIVISION='$da' AND G.ID_DOCENTE= '$idEmpl' ORDER BY NOMDOCENTE
        ";
       // echo $sql; 
    $res = $this->_db->query($sql); 
    $row = $res->fetchall();
    return($row);
}
public function getTestigos(){
    $sql = "SELECT TES_ID,TES_NOMBRE || ' - ' || TES_CARGO AS TES_NOMBRE FROM CNT_TESTIGOS WHERE TES_STATUS=1";
    $res = $this->_db->query($sql); 
    $row = $res->fetchall();
    return($row);
    }
public function getInfoSAE($da,$per,$a){
    $da = strtoupper($da);
    $per = strtoupper($per);
        $sql = "
SELECT 
ID_GRUPO,
ID_DEPARTAMENTO,
ID_MATERIA,
HORAS,
HRS_ASIG,
ID_PERIODO,
ANIO,
ID_DOCENTE,
DECODE(ID_DISCIPLINA,0,NOM_MATERIA,NOM_MATERIA ||' ('||NOM_DISCIPLINA||')' ) AS NOM_MATERIA
,
ID_DIVISION,
NOM_DEPARTAMENTO,
PERIODO,
-- TO_CHAR( FECHA_INICIO , 'YYYY-MM-DD' ) AS FECHA_INICIO,
-- TO_CHAR( FECHA_FIN , 'YYYY-MM-DD' ) AS FECHA_FIN,
EMPL,
ID_CATE,
ID_CATEH,
ID_CATEGORIA,
GENERICO,
NIVEL,
E.VEMP_EMPL AS VEMP_EMPL,
NOMDOCENTE,
TIPOA,
GETCONTRATOS1($a,'$per','$da',E.VEMP_EMPL) AS CONTRATO
FROM (
SELECT ID_DOCENTE,NOM_DEPARTAMENTO,
ID_GRUPO, ID_DEPARTAMENTO,ID_MATERIA,HORAS,ID_PERIODO,ANIO,NOM_MATERIA,ID_DIVISION,PERIODO,HRS_ASIG,ID_DISCIPLINA,NOM_DISCIPLINA, TIPOA 
FROM SISRH.VGRUPOSD  --WHERE ID_DOCENTE = '90855' AND ID_PERIODO = 'S01' AND ANIO = 2021
GROUP BY 
ID_DOCENTE,NOM_DEPARTAMENTO,ID_GRUPO, ID_DEPARTAMENTO,ID_MATERIA,HORAS,ID_PERIODO,ANIO,NOM_MATERIA,ID_DIVISION,PERIODO,HRS_ASIG,ID_DISCIPLINA,NOM_DISCIPLINA, TIPOA 
) G
LEFT JOIN (SELECT NUM_EMPL AS EMPL,ID_CAT AS ID_CATE,NULL AS ID_CATEH  FROM VPLANTILLA_NOMBRA) P
ON P.EMPL  = G.ID_DOCENTE
LEFT JOIN (SELECT ID_CATEGORIA,GENERICO,NIVEL FROM SAIESH.TTABULADOR) T
ON P.ID_CATE=T.ID_CATEGORIA
LEFT JOIN (SELECT VEMP_EMPL,VEMP_NOMBRE||' '||VEMP_APEPAT||' '||VEMP_APEMAT AS NOMDOCENTE FROM PERSONAL.PVEMPLDOS) E
ON E.VEMP_EMPL = G.ID_DOCENTE
WHERE ID_PERIODO='$per' AND ANIO = $a AND ID_DIVISION='$da' 
AND (  (GENERICO!=2  or (GENERICO IS NULL AND E.VEMP_EMPL IS NOT NULL)  )  OR (ID_DIVISION IN ('BE_CHT','BE_PDC') )  )
ORDER BY NOMDOCENTE
        ";
    $res = $this->_db->query($sql); 
    $row = $res->fetchall();
    return($row);
}
public function getListURES($idSel=""){
    $sql = "SELECT URES AS ID, DECODE(FECHA_FIN,NULL, ( URES || ' - ' || LURES), ( URES || ' - ' || LURES||'(CERRADO)') )  AS DENOMINA, URESP AS IDP FROM TURESH where fecha_fin is null ORDER BY URES ASC";
    $res = $this->_db->query($sql); 
    $row = $res->fetchall();
    $option = "";
    foreach ($row as  $fila) {
        if($idSel==$fila["ID"])
            $sel = " selected ";
        else
            $sel ="";
        if( ($fila["IDP"]=="114000" and strpos($fila["DENOMINA"], "DEPARTAMENTO")===false 
             and strpos($fila["DENOMINA"], "TRANSPARENCIA")===false) or $fila["ID"]=="114000"  ){
            //$style=' style="background-color:#CCC;" ';
            $c="»";
        }else{
            //$style="";
            $c="&nbsp;&nbsp;";
        }
        $option.='<option value="'.$fila["ID"].'" '.$sel.'>'.$c.' '.$fila["DENOMINA"].'</option>';
    }
    return($option);
}
public function getContratosParaProcesar(){
    /*
    $sql = "SELECT * FROM CNT_CONTRATOS WHERE CNT_PK_CONTRATO>1179 AND CNt_PK_UA = 1";
     $sql = "SELECT UA_CLAVE AS UA_CHAR,CNT_PK_UA AS UA, CNT_PK_ANIO AS ANIO, C.CNT_PK_CONTRATO AS NUMC FROM CNT_CONTRATOS C
            LEFT JOIN (SELECT VEMP_EMPL FROM PVEMPLDOS) E
            ON C.CNT_FK_NOEMPL = E.VEMP_EMPL
            LEFT JOIN CNT_UACADEMICAS U
            ON U.UA_ID = C.CNT_PK_UA
            WHERE CNT_STATUS = 1 AND E.VEMP_EMPL IS NOT NULL 
            AND CNT_PK_ANIO=2018 and 
             CNT_PK_CONTRATO>1179 AND CNt_PK_UA = 1
            ORDER BY UA_CLAVE DESC, CNT_PK_CONTRATO ASC
            ";
*/
            /*
$sql =  "
SELECT 
UA_CLAVE AS UA_CHAR,CNT_PK_UA AS UA, CNT_PK_ANIO AS ANIO, C.CNT_PK_CONTRATO AS NUMC
FROM CNT_CONTRATOS C
LEFT JOIN CNT_UACADEMICAS U
ON U.UA_ID = C.CNT_PK_UA
WHERE CNT_FK_TIPO IN (2,3) AND
CNT_PK_UA = 3 AND CNT_PK_ANIO = 2020 AND CNT_PK_CONTRATO > 104  --CNT_FK_URE LIKE '128___' 
AND CNT_FK_CATEGORIA IN (43,42,41)
ORDER BY UA_CLAVE DESC, CNT_PK_CONTRATO ASC
"; 
*/
/*
$sql = "
SELECT UA_CLAVE AS UA_CHAR,C.CNT_PK_UA AS UA, C.CNT_PK_ANIO AS ANIO, CNT_PK_CONTRATO AS NUMC
 FROM CNT_CONTRATOS C
LEFT JOIN CNT_UACADEMICAS U
ON U.UA_ID = C.CNT_PK_UA
 WHERE CNT_PK_CONTRATO >= 385 AND CNT_PK_ANIO = 2021 AND CNT_PK_UA = 1
";
*/
/*
$sql = "
SELECT UA_CLAVE AS UA_CHAR,C.CNT_PK_UA AS UA, C.CNT_PK_ANIO AS ANIO, CNT_PK_CONTRATO AS NUMC FROM CNT_CONTRATOS c
LEFT JOIN CNT_UACADEMICAS U
ON U.UA_ID = C.CNT_PK_UA
WHERE CNT_PK_UA = 1 AND -- CNT_PERIODO_SAE = 'S02' AND 
CNT_PK_ANIO = 2021 AND CNT_FECHA_INICIO >= TO_DATE('2021-05-31','YYYY-MM-DD') AND CNT_FK_CATEGORIA IN (40,43,42,41)
";
$sql = "
SELECT UA_CLAVE AS UA_CHAR,C.CNT_PK_UA AS UA, C.CNT_PK_ANIO AS ANIO, CNT_PK_CONTRATO AS NUMC FROM CNT_CONTRATOS c
LEFT JOIN CNT_UACADEMICAS U
ON U.UA_ID = C.CNT_PK_UA
WHERE CNT_PK_UA = 1 AND -- CNT_PERIODO_SAE = 'S02' AND 
CNT_PK_ANIO = 2025 
AND
CNT_FECHA_INICIO >= TO_DATE('2025-01-01','YYYY-MM-DD') 
AND
CNT_FK_CATEGORIA IN (40,43,42,41,46,47)
AND
CNT_PK_CONTRATO IN (301,302,303)
";
*/
$sql = "
SELECT UA_CLAVE AS UA_CHAR,C.CNT_PK_UA AS UA, C.CNT_PK_ANIO AS ANIO, CNT_PK_CONTRATO AS NUMC FROM CNT_CONTRATOS c
LEFT JOIN CNT_UACADEMICAS U
ON U.UA_ID = C.CNT_PK_UA
WHERE 
CNT_PK_ANIO = 2025
AND
 CNT_FK_TIPO in (4,5)
AND
CNT_FK_CATEGORIA IN (40,46)
AND CNT_PK_UA = 1
";
    $res = $this->_db->query($sql); 
    $rows = $res->fetchall();
    return($rows);
}
public function getContratosEnRevision( $post=array() ){
    if($post["contratos"]!=""){ 
            $inter=explode(",",$post["contratos"]);
            $cadena="";
            $cont=0;
            if(count($inter)>0 ) { 
                $cadena="AND (";
                foreach ($inter as $valor) {
                    $rango=explode("-",$valor);
                    if(count($rango)==1){
                        if($cont==0){
                             $cadena .= "  C.CNT_PK_CONTRATO = $valor ";
                        }
                        else{
                             $cadena .= " or C.CNT_PK_CONTRATO = $valor ";
                        }
                    }else{
                        $val1=$rango[0];
                        $val2=$rango[1];
                        if($cont==0){
                             $cadena .= " ( C.CNT_PK_CONTRATO >= $val1 AND C.CNT_PK_CONTRATO <= $val2) ";
                        }
                        else{
                              $cadena .= " OR ( C.CNT_PK_CONTRATO >= $val1 AND C.CNT_PK_CONTRATO <= $val2) ";
                        }            
                    }
                    $cont++;
                }
                $cadena.=")";
            }
    }
    if($post["tipo"]=="") $post["tipo"]=1;
    if($post["campus"]=="") $post["campus"]=1;
    if($post["fecha"]=="") $post["fecha"] = 2018;
    if ($post["tipo"]!=0) $cadenatipo = "AND CNT_FK_TIPO=".$post["tipo"]; else $cadenatipo="";
    $SQL = "SELECT UA_CLAVE AS UA_CHAR,CNT_PK_UA AS UA, CNT_PK_ANIO AS ANIO, C.CNT_PK_CONTRATO AS NUMC FROM CNT_CONTRATOS C
            LEFT JOIN (SELECT VEMP_EMPL FROM PVEMPLDOS) E
            ON C.CNT_FK_NOEMPL = E.VEMP_EMPL
            LEFT JOIN CNT_UACADEMICAS U
            ON U.UA_ID = C.CNT_PK_UA
            WHERE CNT_STATUS = 1 AND E.VEMP_EMPL IS NOT NULL $cadenatipo AND CNT_PK_UA=".$post["campus"]."
            AND CNT_PK_ANIO=".$post["fecha"]." $cadena
            ORDER BY UA_CLAVE DESC, CNT_PK_CONTRATO ASC
            ";
    //print_r ($inter) 
   // AND  C.CNT_PK_CONTRATO >= ".$post["inicio"]." AND C.CNT_PK_CONTRATO <=".$post["fin"]." 
   // echo "$SQL";
    $post = $this->_db->query($SQL); 
    $row  = $post->fetchall();
    return($row);
}
public function getListContratos($status,$anio){
    $sql = "SELECT UA.UA_CLAVE || '-' || CNT_PK_ANIO || '-' ||CNT_PK_CONTRATO AS ID, UA.UA_CLAVE || '-' || CNT_PK_ANIO || '-' ||CNT_PK_CONTRATO || ': '||E.VEMP_EMPL ||' - '|| DECODE (E.NOMBRE,NULL,'(Vacio)',E.NOMBRE) AS NOMBRE FROM CNT_CONTRATOS C
        LEFT JOIN CNT_UACADEMICAS UA
        ON UA.UA_ID = C.CNT_PK_UA
        LEFT JOIN (SELECT VEMP_EMPL,VEMP_NOMBRE||' '|| VEMP_APEPAT||' '||VEMP_APEMAT AS NOMBRE FROM PVEMPLDOS  ) E
        ON E.VEMP_EMPL = C.CNT_FK_NOEMPL
        WHERE CNT_STATUS = $status AND CNT_PK_ANIO=$anio
        ";
    $post = $this->_db->query($sql); 
    $row  = $post->fetchall();
    return($row);
}
public function getListvigentes($status=1){
    $sql = "SELECT UA.UA_CLAVE || '-' || CNT_PK_ANIO || '-' ||CNT_PK_CONTRATO AS ID, UA.UA_CLAVE || '-' || CNT_PK_ANIO || '-' ||CNT_PK_CONTRATO || ': '||E.VEMP_EMPL ||' - '|| DECODE (E.NOMBRE,NULL,'(Vacio)',E.NOMBRE) AS NOMBRE FROM CNT_CONTRATOS C
        LEFT JOIN CNT_UACADEMICAS UA
        ON UA.UA_ID = C.CNT_PK_UA
        LEFT JOIN (SELECT VEMP_EMPL,VEMP_NOMBRE||' '|| VEMP_APEPAT||' '||VEMP_APEMAT AS NOMBRE FROM PVEMPLDOS  ) E
        ON E.VEMP_EMPL = C.CNT_FK_NOEMPL
        WHERE CNT_STATUS = $status
        ";
    $post = $this->_db->query($sql); 
    $row  = $post->fetchall();
    return($row);
}
public function getInfoJefeDepto($info, $idURE){
	if (substr($idURE, -3) == "000") $cadena = "TES_URE_ADJUNTO = '$idURE'"; else $cadena = "TES_URE = '$idURE'";
    if($info=="prefijo")
        $SQL = "SELECT TES_PREFIJO AS INFO FROM CNT_TESTIGOS WHERE $cadena ";
    if($info=="nombrecompleto")
        $SQL = "SELECT TES_NOMBRE AS INFO FROM CNT_TESTIGOS WHERE $cadena ";
    if($info=="cargo")
        $SQL = "SELECT TES_CARGO AS INFO FROM CNT_TESTIGOS WHERE $cadena ";
//echo "-- $SQL  --";
     $post = $this->_db->query($SQL); 
    $row  = $post->fetch();
   // $row["INFO"] = $SQL;
    return($row["INFO"]);
}
public function getInfoPlantilla($info, $numEmpl){
    if($info=="categoria")
        $SQL = "SELECT CATEGORIA AS INFO FROM VPLANTILLA WHERE NUM_EMPL = '$numEmpl'";
    if($info=="ure" or $info=="ures_del_dela")
        $SQL = "SELECT URE AS INFO FROM VPLANTILLA WHERE NUM_EMPL = '$numEmpl'"; 
    $post = $this->_db->query($SQL); 
    $row  = $post->fetch();
   // $row["INFO"] = $SQL;
    return($row["INFO"]);
}
public function getInfoDirector($info, $idURE){
$miArray = array( 
    146801,
    146811,
    146813,
    146812,
    146911,
    146913,
    146912,
    146915,
    146914,
    147611,
147612,
147613,
147711,
147712,
147713,
147811,
147812,
147813,
147814
);
    if($idURE==146420)  $idURE = 146900; 
if (in_array(  $idURE, $miArray)){ 
        $idURE = substr($idURE,0,4)."01";
}else if (substr($idURE, 0,3) == "146" or substr($idURE, 0,3) == "147") {
        $idURE = substr($idURE,0,4)."00";
    }else{
        $idUREresp = $idURE;
        $idURE = substr($idURE,0,3)."000";
        if (substr($idURE, 0,3) == "142")  $idURE = $idUREresp;
    }
    if($info=="prefijo")
        $SQL = "SELECT TES_PREFIJO AS INFO FROM CNT_TESTIGOS WHERE TES_URE = '$idURE' AND TES_STATUS = 1";
    if($info=="lael")
        $SQL = "SELECT TES_LAEL AS INFO FROM CNT_TESTIGOS WHERE TES_URE = '$idURE' AND TES_STATUS = 1";
    if($info=="nombrecompleto")
        $SQL = "SELECT TES_NOMBRE AS INFO FROM CNT_TESTIGOS WHERE TES_URE = '$idURE' AND TES_STATUS = 1";
    if($info=="cargo")
        $SQL = "SELECT TES_CARGO AS INFO FROM CNT_TESTIGOS WHERE TES_URE = '$idURE' AND TES_STATUS = 1";
    $post = $this->_db->query($SQL);
    $row  = $post->fetch();
   //$row["INFO"] = $SQL;
    return($row["INFO"]);
}
public function getInfoAdministrador($info){
    if($info=="prefijo")
        $SQL = "SELECT TES_PREFIJO AS INFO FROM CNT_TESTIGOS WHERE TES_URE = '142000'";
    if($info=="nombrecompleto")
        $SQL = "SELECT TES_NOMBRE AS INFO FROM CNT_TESTIGOS WHERE TES_URE = '142000'";
    if($info=="cargo")
        $SQL = "SELECT TES_CARGO AS INFO FROM CNT_TESTIGOS WHERE TES_URE = '142000'";
     $post = $this->_db->query($SQL); 
    $row  = $post->fetch();
   // $row["INFO"] = $SQL;
    return($row["INFO"]);
}
/**
 * Retorna informacion especifica del contrato
 * 
 * @param mixed $clavenum
 * @param mixed $anio
 * @param mixed $numc
 * @param mixed $info selecciona la informacion requerida
 * 
 * @return string
 */
public function getInfoContrato( $clavenum, $anio, $numc, $info ){
    $informacionContrato = "SELECT * FROM CNT_CONTRATOS WHERE CNT_PK_ANIO = $anio AND CNT_PK_CONTRATO = $numc AND CNT_PK_UA = $clavenum";
    $informacionContrato = $this->_db->query( $informacionContrato ); 
    $informacionContrato = $informacionContrato->fetch();
    //Parche que se necesito para solventar la solicitud de que 
    //los contratos de idiomas salgan bajo una direccion que no existe
    if( 
        in_array( $informacionContrato['CNT_FK_URE'], [ 146420, 147520] ) &&
        $info == "direccion"
    ){
        return "Centro de Enseñanza de Idiomas";
    }
    if($info=="plantilla")
        $SQL = "SELECT CNT_FK_PLANTILLA AS INFO FROM CNT_CONTRATOS WHERE CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="direccion")
        $SQL = "SELECT U2.LURES AS INFO FROM CNT_CONTRATOS C
                LEFT JOIN TURESH U ON U.URES = C.CNT_FK_URE
                LEFT JOIN TURESP U2 ON U2.URES = U.URESP 
                WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="fechainicio")
        $SQL = "SELECT TO_CHAR(CNT_FECHA_INICIO, 'DD-MM-YYYY')AS INFO FROM CNT_CONTRATOS WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="idure")
        $SQL = "SELECT CNT_FK_URE AS INFO FROM CNT_CONTRATOS WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="ures" || $info=="uressimple" ||  $info=="ures_del_dela")
        $SQL = "
    SELECT LURES AS INFO FROM CNT_CONTRATOS C
LEFT JOIN TURESH U 
ON U.URES = C.CNT_FK_URE
    WHERE C.CNT_STATUS=1 AND C.CNT_PK_ANIO=$anio AND C.CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
        /*
        $SQL = "SELECT TO_CHAR(CNT_FECHA_INICIO, 'DD') ||' DE ' ||DECODE(TO_CHAR(CNT_FECHA_INICIO, 'MM'),'01','ENERO','02','FEBRERO','03','MARZO','04','ABRIL','05','MAYO','06','JUNIO','07','AGOSTO','09','SEPTIEMBRE','10','NOVIEMBRE','11','NOVIEMBRE','12','DICIEMBRE')||' DE '||TO_CHAR(CNT_FECHA_INICIO, 'YYYY')AS INFO FROM CNT_CONTRATOS WHERE CNT_STATUS=1 AND CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
        */
    if($info=="fechafin")
        $SQL = "SELECT TO_CHAR(CNT_FECHA_FIN, 'DD-MM-YYYY') AS INFO FROM CNT_CONTRATOS WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="fechafirmatexto")
        $SQL = "SELECT TO_CHAR(CNT_FECHA_FIRMA, 'DD-MM-YYYY') AS INFO FROM CNT_CONTRATOS WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="lugar")
        $SQL = "SELECT UA_LUGAR AS INFO FROM 
                CNT_CONTRATOS C
                LEFT JOIN CNT_UACADEMICAS A
                ON C.CNT_PK_UA = A.UA_ID
                 WHERE CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="funciones") 
        $SQL = "SELECT CNT_FUNCIONES AS INFO FROM CNT_CONTRATOS  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
    if($info=="materias") 
        $SQL = "SELECT CNT_FUNCIONES AS INFO FROM CNT_CONTRATOS  WHERE CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
     if($info=="horastotales") 
        $SQL = "SELECT CNT_NUM_HORAS AS INFO FROM CNT_CONTRATOS  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
    if($info=="sueldomensual") 
        $SQL = "SELECT CNT_MONTO_MENSUAL AS INFO FROM CNT_CONTRATOS  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
    if($info=="sueldomensualtexto") 
        $SQL = "SELECT CNT_MONTO_MENSUAL AS INFO FROM CNT_CONTRATOS  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
    if($info=="sueldototalnum") 
        $SQL = "SELECT CNT_MONTO_TOTAL AS INFO FROM CNT_CONTRATOS  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
    if($info=="sueldototaltexto") 
        $SQL = "SELECT CNT_MONTO_TOTAL AS INFO FROM CNT_CONTRATOS  WHERE CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
    if($info=="numquincenas") 
        $SQL = "SELECT CNT_NUM_QUINCENAS AS INFO FROM CNT_CONTRATOS  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
    if($info=="sueldoquincenanum") 
        $SQL = "SELECT CNT_MONTO_QUINCENA AS INFO FROM CNT_CONTRATOS  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
    if($info=="sueldoquincenatexto") 
        $SQL = "SELECT CNT_MONTO_QUINCENA AS INFO FROM CNT_CONTRATOS  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
    if($info=="testigo1prefijo") 
        $SQL = "SELECT TES_PREFIJO AS INFO  FROM CNT_CONTRATOS C LEFT JOIN CNT_TESTIGOS T ON C.CNT_FK_NOEMPL_TESTIGO1 = T.TES_ID  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="testigo1nombre") 
        $SQL = "SELECT TES_NOMBRE AS INFO  FROM CNT_CONTRATOS C LEFT JOIN CNT_TESTIGOS T ON C.CNT_FK_NOEMPL_TESTIGO1 = T.TES_ID  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="testigo1cargo") 
        $SQL = "SELECT TES_CARGO AS INFO  FROM CNT_CONTRATOS C LEFT JOIN CNT_TESTIGOS T ON C.CNT_FK_NOEMPL_TESTIGO1 = T.TES_ID  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum"; 
     if($info=="testigo2_prefijo") 
        $SQL = "SELECT TES_PREFIJO AS INFO  FROM CNT_CONTRATOS C LEFT JOIN CNT_TESTIGOS T ON C.CNT_FK_NOEMPL_TESTIGO2 = T.TES_ID  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="testigo2_nombre") 
        $SQL = "SELECT TES_NOMBRE AS INFO  FROM CNT_CONTRATOS C LEFT JOIN CNT_TESTIGOS T ON C.CNT_FK_NOEMPL_TESTIGO2 = T.TES_ID  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="testigo2_cargo")
        $SQL = "SELECT TES_CARGO AS INFO  FROM CNT_CONTRATOS C LEFT JOIN CNT_TESTIGOS T ON C.CNT_FK_NOEMPL_TESTIGO2 = T.TES_ID  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";   
    if($info=="deptosae")
        $SQL = "SELECT DEP_DENOMINA AS INFO  FROM CNT_CONTRATOS C LEFT JOIN CNT_DEPARTAMENTOS_SAE D ON C.CNT_FK_DEPTOSAE = D.DEP_ID WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="numempleado")
        $SQL = "SELECT CNT_FK_NOEMPL AS INFO  FROM CNT_CONTRATOS C 
                WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
   if($info=="horassemana")
        $SQL = "SELECT CNT_NUM_HORAS_SEM AS INFO  FROM CNT_CONTRATOS C 
                WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
    if($info=="claveinterna")
        $SQL = " 
        SELECT PLT_CLAVE||UA_CLAVE||'-'||CNT_PK_CONTRATO||'-'||CNT_PK_ANIO   AS INFO 
        FROM (SELECT * FROM CNT_CONTRATOS WHERE CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum ) C
        LEFT JOIN CNT_UACADEMICAS U
        ON U.UA_ID = C.CNT_PK_UA
        LEFT JOIN (SELECT PLT_ID,PLT_CLAVE FROM CNT_PLANTILLAS) P
        ON P.PLT_ID = C.CNT_FK_PLANTILLA
        ";
    if($info=="montofinal")
        $SQL = " 
        SELECT CNT_MONTO_FINAL AS INFO 
        FROM (SELECT * FROM CNT_CONTRATOS WHERE CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum ) C
        ";
    //echo "[ $SQL ] <br/>";
    $post = $this->_db->query($SQL); 
    $row  = $post->fetch();
   // $row["INFO"] = $SQL;
    return($row["INFO"]);
}   
public function getInfoAdmin($info)
{
    if($info=="nombrecompleto") 
        $SQL = "SELECT VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '||VEMP_APEMAT AS INFO FROM PVEMPLDOS WHERE VEMP_EMPL=(SELECT TITULAR FROM TURESH WHERE URES = 123000 AND ROWNUM=1)";
    if($info=="prefijo") 
        $SQL = "SELECT DECODE(VEMP_SEXO,'M',TGA_PREFIJO_MAS,'F',TGA_PREFIJO_FEM) AS INFO FROM (
                SELECT T.*,E.VEMP_SEXO FROM PEGRADOACAD P
                LEFT JOIN PVEMPLDOS E
                ON E.VEMP_EMPL = P.EGRA_PERSONA
                LEFT JOIN PENIVELACAD A
                ON P.EGRA_GRADO = A.ENIV_GRADO
                LEFT JOIN CNT_TERM_GRADACAD T
                ON P.EGRA_GRADO = T.TGA_ID
                WHERE EGRA_PERSONA=(SELECT TITULAR FROM TURESH WHERE URES = 123000 AND ROWNUM=1) ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC) T WHERE  ROWNUM=1
                ";
    if($info=="cargo") 
        $SQL = "SELECT DECODE((SELECT VEMP_SEXO FROM PVEMPLDOS WHERE VEMP_EMPL = (SELECT TITULAR FROM TURESH WHERE URES = 123000 AND ROWNUM=1)),'M',TPT_DENOMINA_MAS,'F',TPT_DENOMINA_FEM) AS INFO FROM CNT_TERM_PUESTOS WHERE TPT_ID='admin'
                "; 
    $post = $this->_db->query($SQL);
    $row  = $post->fetch();
    return($row["INFO"]);
} 
public function getInfoRector($info)
{
    if($info=="nombrecompleto") 
        $SQL = "SELECT VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '||VEMP_APEMAT AS INFO FROM PVEMPLDOS WHERE VEMP_EMPL=(SELECT TITULAR FROM TURESH WHERE URES = 114000 AND ROWNUM=1)";
    if($info=="prefijo") 
        $SQL = "SELECT DECODE(VEMP_SEXO,'M',TGA_PREFIJO_MAS,'F',TGA_PREFIJO_FEM) AS INFO FROM (
                SELECT T.*,E.VEMP_SEXO FROM PEGRADOACAD P
                LEFT JOIN PVEMPLDOS E
                ON E.VEMP_EMPL = P.EGRA_PERSONA
                LEFT JOIN PENIVELACAD A
                ON P.EGRA_GRADO = A.ENIV_GRADO
                LEFT JOIN CNT_TERM_GRADACAD T
                ON P.EGRA_GRADO = T.TGA_ID
                WHERE EGRA_PERSONA=(SELECT TITULAR FROM TURESH WHERE URES = 114000 AND ROWNUM=1) ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC) T WHERE  ROWNUM=1
                ";
    if($info=="cargo") 
        $SQL = "SELECT DECODE((SELECT VEMP_SEXO FROM PVEMPLDOS WHERE VEMP_EMPL = (SELECT TITULAR FROM TURESH WHERE URES = 114000 AND ROWNUM=1)),'M',TPT_DENOMINA_MAS,'F',TPT_DENOMINA_FEM) AS INFO FROM CNT_TERM_PUESTOS WHERE TPT_ID='rector'
                "; 
    if($info=="lael") 
        $SQL = "SELECT DECODE((SELECT VEMP_SEXO FROM PVEMPLDOS WHERE VEMP_EMPL = (SELECT TITULAR FROM TURESH WHERE URES = 114000 AND ROWNUM=1)),'M','EL','F','LA') AS INFO FROM DUAL 
                "; 
    $post = $this->_db->query($SQL);
    $row  = $post->fetch();
    return($row["INFO"]);
} 
public function getTrabajadoresTMP(){
    $SQL = "SELECT * FROM SAIESH.PLANTILLA_2019_1";
    $post = $this->_db->query($SQL);
    $res  = $post->fetchAll();
    return($res);
}
public function getTrabajadores (){
    $SQL = "
SELECT * FROM SAIESH.PLANTILLA_2018_18_911 P
-- LEFT JOIN SAIESH.TTABULADOR  T
-- ON P.ID_CATE = T.ID_CATEGORIA OR P.ID_CATEH = T.ID_CATEGORIA
-- WHERE T.NIVEL = 6 OR ID_CATEGORIA IN (41,42,43)
    ";
    $post = $this->_db->query($SQL);
    $res  = $post->fetchAll();
    return($res);
}
public function updateCate($nume,$g1,$g2){
 $this->_db->prepare("
        UPDATE SAIESH.PLANTILLA_2018_18_911 SET ID_GRADO = TO_NUMBER(:g1), ID_GRADO2 = TO_NUMBER(:g2) WHERE EMPL=:num"
        )
                ->execute(
                        array(
                           ':g1' => $g1,
                           ':g2' => $g2,
                           ':num' => $nume
                        ));
  // $res = $this->_db->prepare($sql)->execute($info);         // <----------------- VERIFICAR ESTO!!!!!
}
public function getInfoTrabajador($numEmpleado,$info)
{
    if($info=="nombrecompleto") 
        $SQL = "SELECT VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '||VEMP_APEMAT AS INFO FROM PVEMPLDOS WHERE VEMP_EMPL='$numEmpleado'";
    if($info=="nombrecompleto2") 
        $SQL = "SELECT   VEMP_APEPAT ||' '||VEMP_APEMAT||', '|| VEMP_NOMBRE AS INFO FROM PVEMPLDOS WHERE VEMP_EMPL='$numEmpleado'";
    if($info=="nombres") 
        $SQL = "SELECT VEMP_NOMBRE AS INFO FROM PVEMPLDOS WHERE VEMP_EMPL='$numEmpleado'";
    if($info=="apellidos")
        $SQL = "SELECT VEMP_APEPAT ||' '||VEMP_APEMAT AS INFO FROM PVEMPLDOS WHERE VEMP_EMPL='$numEmpleado'";
    if($info=="lael")
        $SQL = "SELECT DECODE(VEMP_SEXO,'F','LA','M','EL') AS INFO FROM PVEMPLDOS WHERE VEMP_EMPL='$numEmpleado'";
    if($info=="prefijo"){
        $SQL = "SELECT DECODE(VEMP_SEXO,'M',TGA_PREFIJO_MAS,'F',TGA_PREFIJO_FEM) AS INFO FROM (
                SELECT T.*,E.VEMP_SEXO FROM PEGRADOACAD P
                LEFT JOIN PVEMPLDOS E
                ON E.VEMP_EMPL = P.EGRA_PERSONA
                LEFT JOIN PENIVELACAD A
                ON P.EGRA_GRADO = A.ENIV_GRADO
                LEFT JOIN CNT_TERM_GRADACAD T
                ON P.EGRA_GRADO = T.TGA_ID
                WHERE EGRA_PERSONA='$numEmpleado' AND ( A.ENIV_NIVEL<=4  OR (A.ENIV_NIVEL>4 AND ( P.EGRA_CEDULA IS NOT NULL OR P.EGRA_TITULO = 3 ) ) )  ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC) T WHERE  ROWNUM=1
                ";
    }
    if($info=="estudios")
        $SQL = "SELECT DECODE(VEMP_SEXO,'M',TGA_DENOMINA_MAS,'F',TGA_DENOMINA_FEM) AS INFO FROM (
                SELECT T.*,E.VEMP_SEXO FROM PEGRADOACAD P
                LEFT JOIN PVEMPLDOS E
                ON E.VEMP_EMPL = P.EGRA_PERSONA
                LEFT JOIN PENIVELACAD A
                ON P.EGRA_GRADO = A.ENIV_GRADO
                LEFT JOIN CNT_TERM_GRADACAD T
                ON P.EGRA_GRADO = T.TGA_ID
                WHERE EGRA_PERSONA='$numEmpleado' AND ( A.ENIV_NIVEL<=4  OR (A.ENIV_NIVEL>4 AND P.EGRA_CEDULA IS NOT NULL ) ) ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC) T WHERE  ROWNUM=1
                ";
       if($info=="aptitudes")
        $SQL = "SELECT APT_CERTIFICADOS AS INFO FROM CNT_APTITUDES WHERE APT_NUMEMPL = '$numEmpleado'  "; 
    if($info=="gradoacademico")
        $SQL = "SELECT GETGRADOESTUDIOS('$numEmpleado') AS INFO from dual"; 
    if($info=="maximonivelconcedula")
        $SQL = "
                    SELECT ENIV_DESCRIP INTO Grado 
                    FROM (
                SELECT * FROM PEGRADOACAD P
                LEFT JOIN PERSONAL.PENIVELACAD A
                ON P.EGRA_GRADO = A.ENIV_GRADO
                LEFT JOIN PECARRERAS CA ON CA.ECAR_CARRERA = P.EGRA_CARRERA
                    LEFT JOIN PEAREACAD AR ON CA.ECAR_AREA = AR.EARE_AREA
                    LEFT JOIN PERSONAL.PEDESCU R ON P.EGRA_ESCU = R.EDES_ID
                    LEFT JOIN PESCUELAS E ON E.ESCU_ESCU = R.EDES_ESCU
                    LEFT JOIN PECIUDAD C ON C.ECIU_CIUDAD = R.EDES_CIUDAD
                    LEFT JOIN PEESTADO E ON C.ECIU_ESTADO = E.EEST_ESTADO
                    LEFT JOIN PEPAIS P ON E.EEST_PAIS = P.EPAI_PAIS
                WHERE EGRA_PERSONA=NUMEMPL 
                AND 
                ( 
                A.ENIV_NIVEL<=4  OR (A.ENIV_NIVEL>4 AND P.EGRA_CEDULA IS NOT NULL)
                OR EPAI_PAIS != 'MX'
                )
                ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC
        ) T WHERE  ROWNUM=1
    ";
        if($info=="gradoacademico2")
        $SQL = "
            SELECT ENIV_DESCRIP AS INFO  FROM (
                SELECT A.ENIV_DESCRIP FROM PEGRADOACAD P
                LEFT JOIN PENIVELACAD A
                ON P.EGRA_GRADO = A.ENIV_GRADO
                WHERE P.EGRA_PERSONA='$numEmpleado' ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC) T WHERE  ROWNUM=1";
        if($info=="maximonivelsincedula")
        $SQL = "
            SELECT ID_NIVEL AS INFO  FROM (
                SELECT N.ID_NIVEL FROM PEGRADOACAD P
                LEFT JOIN PENIVELACAD A
                ON P.EGRA_GRADO = A.ENIV_GRADO
                 LEFT JOIN SAIESH.TNIVELES_ACADEMICOS N
                ON A.ENIV_GRADO = N.ID_SAIIES
                WHERE P.EGRA_PERSONA='$numEmpleado' ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC) T WHERE  ROWNUM=1";
    if($info=="carrera")
        $SQL = "SELECT GETESPECIALIDAD('$numEmpleado') AS INFO FROM DUAL";
    if($info=="carrera2")
        $SQL =  "
                SELECT ECAR_NOMBRE||ESPECIALIDAD AS INFO  FROM (
                SELECT ECAR_NOMBRE,DECODE(C.ECAR_ESPECIALIDAD,NULL,'',' CON ESPECIALIDAD EN '||C.ECAR_ESPECIALIDAD) AS ESPECIALIDAD FROM PEGRADOACAD P
                LEFT JOIN PENIVELACAD A
                ON P.EGRA_GRADO = A.ENIV_GRADO
                LEFT JOIN PECARRERAS C
                ON C.ECAR_CARRERA = P.EGRA_CARRERA
                WHERE P.EGRA_PERSONA='$numEmpleado'  ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC) T WHERE  ROWNUM=1
                ";
    if($info=="numerocedula")
        $SQL =  "
                SELECT DECODE( EGRA_TITULO, 3, 'E', EGRA_CEDULA) AS INFO FROM (
                SELECT P.EGRA_CEDULA, P.EGRA_TITULO FROM PEGRADOACAD P
                LEFT JOIN PENIVELACAD A
                ON P.EGRA_GRADO = A.ENIV_GRADO
                WHERE P.EGRA_PERSONA='$numEmpleado' AND ( A.ENIV_NIVEL<=4  OR (A.ENIV_NIVEL>4 AND ( P.EGRA_CEDULA IS NOT NULL OR P.EGRA_TITULO = 3 ) ) ) ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC) T WHERE  ROWNUM=1
                ";
    if($info=="fechatitulo")
        $SQL = "SELECT GETFECHATITULO('$numEmpleado') AS INFO FROM DUAL";
    if($info=="fechacedula")
        $SQL =  "
                SELECT TO_CHAR(EGRA_FEXPCDLA, 'DD') ||' de ' ||DECODE(TO_CHAR(EGRA_FEXPCDLA, 'MM'),'01','Enero','02','Febrero','03','Marzo','04','ABRIL','05','Mayo','06','Junio','07','Julio','08','Agosto','09','Septiembre','10','Octubre','11','Noviembre','12','Diciembre')||' de '||TO_CHAR(EGRA_FEXPCDLA, 'YYYY')AS INFO   FROM (
                SELECT P.EGRA_FEXPCDLA FROM PEGRADOACAD P
                LEFT JOIN PENIVELACAD A
                ON P.EGRA_GRADO = A.ENIV_GRADO
                WHERE P.EGRA_PERSONA='$numEmpleado' AND ( A.ENIV_NIVEL<=4  OR (A.ENIV_NIVEL>4 AND P.EGRA_CEDULA IS NOT NULL ) ) ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC) T WHERE  ROWNUM=1
                ";
    if($info=="escuela")
        $SQL = "SELECT GETESCUELA('$numEmpleado') AS INFO FROM DUAL";
    if($info=="rfc")
          $SQL = "
                SELECT VEMP_RFC AS INFO FROM PVEMPLDOS WHERE VEMP_EMPL='$numEmpleado'
                ";
    if($info=="domicilio")
        $SQL = "
                SELECT 
                TRIM(
                DECODE (E.VIALIDAD, NULL, CASE WHEN VEMP_CALLE NOT LIKE 'CALLE%' AND VEMP_CALLE NOT LIKE 'AV%' AND VEMP_CALLE  IS NOT NULL  THEN 'CALLE '||TRIM(VEMP_CALLE)||', ' ELSE  TRIM(VEMP_CALLE) END, 
                GET_TIPOVIALIDAD(VEMP_TVALIDADP) || ' ' || TRIM(E.VIALIDAD)||', ')                
                ||
                CASE WHEN VEMP_NUME IS NOT NULL THEN 'NÚMERO EXTERIOR '|| TRIM(VEMP_NUME)||', '  END 
                ||
                CASE WHEN VEMP_NUMI IS NOT NULL THEN 'NÚMERO INTERIOR '|| TRIM(VEMP_NUMI)||', '  END 
                ||
                CASE WHEN VEMP_CRUZA1 IS NOT NULL THEN 'CRUZAMIENTO 1: '|| GET_TIPOVIALIDAD(VEMP_TVALIDADC1) || ' ' ||  TRIM(VEMP_CRUZA1)||', '  END 
                ||
                CASE WHEN VEMP_CRUZA2 IS NOT NULL THEN 'CRUZAMIENTO 2: '|| GET_TIPOVIALIDAD(VEMP_TVALIDADC2) || ' ' ||  TRIM(VEMP_CRUZA2)||', '  END 
                ||
                 DECODE (C.D_ASENTA, NULL, CASE WHEN VEMP_COLONIA IS NOT NULL THEN 'COLONIA '|| TRIM(VEMP_COLONIA)||', '  END, 
                CASE WHEN C.D_ASENTA IS NOT NULL THEN 'COLONIA '|| TRIM(C.D_ASENTA)||', '  END ) 
                ||
                CASE WHEN VEMP_CP IS NOT NULL THEN 'CÓDIGO POSTAL '|| TRIM(VEMP_CP)||', '  END 
                || 
                CASE WHEN ECIU_NOMBRE IS NOT NULL THEN 'DE LA CIUDAD DE '|| TRIM(ECIU_NOMBRE)||', '  END 
                ||
                CASE WHEN EEST_NOMBRE IS NOT NULL THEN 'DEL ESTADO DE '|| TRIM(EEST_NOMBRE)  END
                 ||
                CASE WHEN EPAI_NOMBRE IS NOT NULL THEN ', '|| TRIM(EPAI_NOMBRE)||', '  END
                 )
                AS INFO
                FROM PVEMPLDOS E
                LEFT JOIN PECIUDAD C
                ON E.VEMP_DOMICIUDAD = C.ECIU_CIUDAD
                LEFT JOIN PEESTADO ES
                ON ES.EEST_ESTADO = C.ECIU_ESTADO
                LEFT JOIN PEPAIS P
                ON P.EPAI_PAIS = ES.EEST_PAIS
                LEFT JOIN PLT_COLONIAS C 
                ON C.ID_COLONIA = E.ID_COLONIA
                WHERE VEMP_EMPL = '$numEmpleado'
    ";
        if($info=="nombramiento") 
                $SQL = "SELECT CATEGORIA AS INFO FROM  SAIESH.PLANTILLA_2018_9 P
        LEFT JOIN SAIESH.TTABULADOR T
        ON P.ID_CATE=T.ID_CATEGORIA
        WHERE P.EMPL='$numEmpleado'";
        if($info=="categoria") 
                $SQL = "SELECT CATEGORIA AS INFO FROM  SAIESH.PLANTILLA_2018_9 P
        LEFT JOIN SAIESH.TTABULADOR T
        ON P.ID_CATE=T.ID_CATEGORIA
        WHERE P.EMPL='$numEmpleado'";
        if($info=="nombramiento") 
                $SQL = "SELECT CATEGORIA AS INFO FROM  SAIESH.PLANTILLA_2018_9 P
        LEFT JOIN SAIESH.TTABULADOR T
        ON P.ID_CATE=T.ID_CATEGORIA
        WHERE P.EMPL='$numEmpleado'";
        if($info=="area") 
                $SQL = "SELECT LURES AS INFO FROM  SAIESH.PLANTILLA_2018_9 P
                LEFT JOIN TURESH U
                ON P.ID_URES=U.URES
                WHERE P.EMPL='$numEmpleado'";
    $post = $this->_db->query($SQL);
    $row  = $post->fetch();
    return($row["INFO"]);
}
public function delContrato($claveNum,$anio,$numC){
    $sql = "DELETE FROM CNT_CONTRATOS 
    WHERE CNT_PK_ANIO=$anio and CNT_PK_CONTRATO=$numC and CNT_PK_UA='$claveNum'  AND  ROWNUM=1
    ";
//echo "$sql";
    $res = $this->_db->prepare($sql)->execute( array() );
    if ($res) {
        $array["code"] = 1;
        $array["msg"] = "Eliminado";
        return $array;
    }else{
        $array["code"] = 0;
        $array["msg"] = "Error al eliminar: ".$res;
        return $array;
    }
}
public function putTextoContratos($texto,$clavenum,$anio,$numc){
 $this->_db->prepare("
        UPDATE CNT_CONTRATOS 
        SET CNT_TEXTO = :contenido 
        WHERE CNT_PK_UA=:clavenum AND CNT_PK_ANIO=:anio AND CNT_PK_CONTRATO = :num")
                ->execute(
                        array(
                           ':contenido' => $texto,
                           ':clavenum' => $clavenum,
                           ':anio'  => $anio,
                           ':num'  => $numc
                        ));
  // $res = $this->_db->prepare($sql)->execute($info);         // <----------------- VERIFICAR ESTO!!!!!
}
public function getIdUreByDeptoSAE($iddeptosae){
    $res = $this->_db->query("SELECT IDURE FROM CNT_DEPARTAMENTOS_SAE WHERE DEP_ID = '$iddeptosae'");
    $row = $res->fetch();
    return ($row["IDURE"]);
}
public function getUbicaciones(){
    $res = $this->_db->query("SELECT UBI_ID,UBI_DENOMINACION FROM PLT_UBICACIONES");
    $row = $res->fetchall();
    return ($row);
}
    /**
     * Ejecuta una sql dada
     * 
     * @param string $sql
     *  
     * @return array
     */
    public function executeQuery( $sql ){
        $query = $this->_db->query( $sql );
        return $query->fetchall();
    }
    public function putContratos($post){
        $resClaveTexto = $this->_db->query("SELECT UA_CLAVE FROM CNT_UACADEMICAS WHERE UA_ID= '".$post["ua"]."'");
        $claveTexto = $resClaveTexto->fetch();
        $post["monto_quincenal"] = (double) trim(str_replace(',', '', $post["monto_quincenal"]));
        $post["monto_mensual"] = (double) trim(str_replace(',', '', $post["monto_mensual"]));
        $post["monto"] = (double) trim(str_replace(',', '', $post["monto"]));
        if ($post["anio"] != "" && $post["numc"] != "" && $post["clavenum"] != "") {
            $sql = "UPDATE CNT_CONTRATOS 
                    SET CNT_TEXTO = :contenido, 
                        CNT_FK_NOEMPL = :numempl,
                        CNT_FK_PLANTILLA = :plantilla,
                        CNT_FK_TIPO = :tipoc,
                        CNT_FECHA_INICIO = TO_DATE(:fi, 'YYYY-MM-DD'),
                        CNT_FECHA_FIN = TO_DATE(:fF, 'YYYY-MM-DD'),
                        CNT_FK_CATEGORIA = :categoria,  
                        CNT_FK_URE = :ure,
                        CNT_FUNCIONES = :funciones,
                        CNT_NUM_QUINCENAS = :quincenas,
                        CNT_NUM_SEMANAS = :semanas,
                        CNT_NUM_HORAS = :horas,
                        CNT_MONTO_TOTAL = :monto,
                        CNT_MONTO_QUINCENA = :monto_quincenal,
                        CNT_FK_NOEMPL_TESTIGO1 = :testigo1,
                        CNT_FK_NOEMPL_TESTIGO2 = :testigo2,
                        CNT_FECHA_FIRMA = TO_DATE(:fecha_firma, 'YYYY-MM-DD'),
                        CNT_FK_DEPTOSAE = :iddeptosae,
                        CNT_MONTO_MENSUAL = :monto_mensual,
                        CNT_NUM_HORAS_SEM = :horas_semana,
                        CNT_PERIODO_SAE = :periodo_sae,
                        CNT_FK_DIVSAE = :da,
                        CNT_MONTO_HORA = :monto_hora,
                        CNT_UBICAFISICA = :ubicafisica,
                        CNT_MONTO_FINAL = :monto_final,
                        CNT_FECHA_DERROGA = TO_DATE(:fderoga, 'YYYY-MM-DD')
                    WHERE CNT_PK_UA = :clavenum AND CNT_PK_ANIO = :anio AND CNT_PK_CONTRATO = :num";
            $a = array(
                ':contenido' => $post["contenido"],
                ':numempl' => $post["numempl"],
                ':plantilla' => $post["plantilla"],
                ':clavenum' => $post["clavenum"],
                ':tipoc' => $post["tipoc"],
                ':anio' => $post["anio"],
                ':num' => $post["numc"],
                ':fi' => $post["inicio"],
                ':ff' => $post["fin"],
                ':categoria' => $post["categoria"],
                ':ure' => $post["ure"],
                ':funciones' => $post["funciones"],
                ':quincenas' => $post["quincenas"],
                ':semanas' => $post["semanas"],
                ':horas' => $post["horas"],
                ':monto' => $post["monto"],
                ':monto_quincenal' => $post["monto_quincenal"],
                ':testigo1' => 0,
                ':testigo2' => 0,
                ':fecha_firma' => $post["fecha_firma"],
                ':iddeptosae' => $post["deptosae"],
                ':monto_mensual' => $post["monto_mensual"],
                ':horas_semana' => $post["horas_semana"],
                ':periodo_sae' => $post["per"],
                ':da' => $post["da"],
                ':monto_hora' => $post["monto_hora"],
                ':ubicafisica' => $post["uf"],
                ':monto_final' => $post["monto_final"],
                ':fderoga' => $post["fderoga"]
            );
            $res = $this->ssql($sql, $a);
            $idC = $post["numc"];
            $anio = $post["anio"];
            $ua = $post["clavenum"];
        } else {
            $anio = date("Y");
            $ua = $post["ua"];
            $sqlId = "SELECT DECODE(MAX(CNT_PK_CONTRATO),NULL,0,MAX(CNT_PK_CONTRATO)) + 1 AS ID FROM CNT_CONTRATOS 
                    WHERE CNT_PK_UA = :ua AND CNT_PK_ANIO = :anio";
            $infoId = array(':ua' => $post["ua"], ':anio' => $anio);
            $resId = $this->_db->prepare($sqlId)->execute($infoId);
            $idC = $resId["ID"];
            $sql = "INSERT INTO CNT_CONTRATOS (
                        CNT_PK_UA,
                        CNT_PK_ANIO,
                        CNT_PK_CONTRATO,
                        CNT_FK_NOEMPL,
                        CNT_FK_PLANTILLA,
                        CNT_FK_TIPO,
                        CNT_STATUS,
                        CNT_FECHA_INICIO,
                        CNT_FECHA_FIN,
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
                        CNT_PERIODO_SAE,
                        CNT_FK_DIVSAE,
                        CNT_MONTO_HORA,
                        CNT_UBICAFISICA,
                        CNT_NOMBRAMIENTO,
                        CNT_MONTO_FINAL
                    ) 
                    VALUES (
                        :ua,
                        :anio,
                        :idc,
                        :numempl,
                        :plantilla,
                        :tipoc,
                        1,
                        TO_DATE(:fi, 'YYYY-MM-DD'),
                        TO_DATE(:ff, 'YYYY-MM-DD'),
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
                        TO_DATE(:fecha_firma, 'YYYY-MM-DD'),
                        :iddeptosae,
                        :monto_mensual,
                        :horas_semana,
                        :periodo_sae,
                        :da,
                        :monto_hora,
                        :ubicafisica,
                        (SEC_NOMBRAMIENTOS.nextval),
                        :monto_final
                    )";
            $info = array(
                ':ua' => $post["ua"],
                ':anio' => $anio,
                ':numempl' => $post["numempl"],
                ':plantilla' => $post["plantilla"],
                ':tipoc' => $post["tipoc"],
                ':idc' => $idC,
                ':fi' => $post["inicio"],
                ':ff' => $post["fin"],
                ':categoria' => $post["categoria"],
                ':ure' => $post["ure"],
                ':funciones' => $post["funciones"],
                ':quincenas' => $post["quincenas"],
                ':semanas' => $post["semanas"],
                ':horas' => $post["horas"],
                ':monto' => $post["monto"],
                ':monto_quincenal' => $post["monto_quincenal"],
                ':testigo1' => 0,
                ':testigo2' => 0,
                ':fecha_firma' => $post["fecha_firma"],
                ':iddeptosae' => $post["deptosae"],
                ':monto_mensual' => $post["monto_mensual"],
                ':horas_semana' => $post["horas_semana"],
                ':periodo_sae' => $post["per"],
                ':da' => $post["da"],
                'monto_hora' => $post["monto_hora"],
                ':ubicafisica' => $post["uf"],
                ':monto_final' => $post["monto_final"]
            );
            $res = $this->ssql($sql, $info);
        }
        if ($post["tipoc"] == 1) {
            $rowExiteAdmin['NUM'] = 1;
        }
        $mensaje["id"] = $idC;
        $mensaje["anio"] = $anio;
        $mensaje["ua"] = $ua;
        $mensaje["uat"] = $claveTexto["UA_CLAVE"];
        return ($mensaje);
    }
public function getPlantillaTexto($id){
    $sql = "
        SELECT  PLT_TEXTO AS TEXTO
        FROM CNT_PLANTILLAS
        WHERE PLT_STATUS=1 AND PLT_ID='$id'
        ";
       // echo "$sql ";
        $post = $this->_db->query($sql);
        return $post->fetch(); 
}
public function getContratoTexto($clave,$anio,$numero){
    $query = "SELECT C.CNT_TEXTO AS TEXTO, TCNT_CLAVE AS CLAVE, PLT_MARGENES AS MARGENES, PLT_CLAVE
              FROM CNT_CONTRATOS C
              LEFT JOIN CNT_UACADEMICAS U
                ON U.UA_ID = C.CNT_PK_UA
              LEFT JOIN (SELECT TCNT_ID, TCNT_CLAVE FROM CNT_TIPOCONT) T
                ON C.CNT_FK_TIPO = T.TCNT_ID
              LEFT JOIN (SELECT PLT_ID, PLT_MARGENES, PLT_CLAVE FROM CNT_PLANTILLAS) P
                ON P.PLT_ID = C.CNT_FK_PLANTILLA
              WHERE C.CNT_STATUS = 1 AND C.CNT_PK_ANIO = $anio and C.CNT_PK_CONTRATO = $numero and U.UA_CLAVE = '$clave'
    ";
    $post = $this->_db->query( $query );
    return $post->fetch(); 
}
public function getContratoDetalle($clave,$anio,$numero){
    $sql = "
        SELECT CNT_FK_TIPO,U.UA_ID AS UA_ID,U.UA_CLAVE AS UA_CLAVE,CNT_PK_ANIO AS ANIO,CNT_PK_CONTRATO AS NOCONTRATO,
        PL.PLT_ID AS PLT_ID,
        TC.TCNT_ID AS ID_CONTRATO,
        TCNT_DENOMINACION AS TIPO_CONTRATO,
        CNT_FK_NOEMPL,
        TO_CHAR( CNT_FECHA_INICIO , 'YYYY-MM-DD' ) AS CNT_FECHA_INICIO,
        TO_CHAR( CNT_FECHA_FIN , 'YYYY-MM-DD' ) AS CNT_FECHA_FIN,
        TO_CHAR( CNT_FECHA_FIRMA , 'YYYY-MM-DD' ) AS CNT_FECHA_FIRMA,
        VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '|| VEMP_APEMAT AS NOMBRE,
        C.CNT_TEXTO AS TEXTO,
        C.CNT_FK_URE AS ID_URE,
        CNT_FK_NOEMPL_TESTIGO1,
        CNT_FK_NOEMPL_TESTIGO2,
        CNT_MONTO_QUINCENA,
        CNT_NUM_QUINCENAS,
        CNT_NUM_SEMANAS,
        CNT_FUNCIONES,
        CNT_NUM_HORAS,
        CNT_MONTO_TOTAL,
        CNT_MONTO_QUINCENA,
        CNT_MONTO_MENSUAL,
        CNT_FK_DEPTOSAE, 
        CNT_FK_CATEGORIA,
        CNT_NUM_HORAS_SEM,
        CNT_MONTO_HORA,
        CNT_UBICAFISICA,
        CNT_MONTO_FINAL,
        TO_CHAR( CNT_FECHA_DERROGA , 'YYYY-MM-DD' ) AS CNT_FECHA_DERROGA
        FROM CNT_CONTRATOS C
        LEFT JOIN PVEMPLDOS P
        ON P.VEMP_EMPL=C.CNT_FK_NOEMPL
        LEFT JOIN CNT_UACADEMICAS U
        ON U.UA_ID = C.CNT_PK_UA
        LEFT JOIN CNT_PLANTILLAS PL
        ON C.CNT_FK_PLANTILLA = PL.PLT_ID
        LEFT JOIN CNT_TIPOCONT TC
        ON TC.TCNT_ID = C.CNT_FK_TIPO
        WHERE C.CNT_STATUS=1 AND C.CNT_PK_ANIO=$anio and C.CNT_PK_CONTRATO=$numero and U.UA_CLAVE='$clave'
            ";
        $post = $this->_db->query($sql);
//echo $sql;
        return $post->fetch();
}
/*
public function getContratoDetalleAdmin($clave,$anio,$claveNum){
        $res = $this->_db->query("
        SELECT * FROM CNT_CONT_ADMIN WHERE  ADM_PK_UA=".$claveNum." and ADM_PK_ANIO=".$anio." and  ADM_PK_CONTRATO=".$clave );
        return $res->fetch();
}
*/
public function getCategoriasContrato($id=2)
    { 
        $post = $this->_db->query("SELECT CAT_ID AS ID_CATEGORIA,CAT_DENOMINA_MAS AS CATEGORIA FROM CNT_CATEGORIAS --WHERE CAT_CLASIFICA = $id");
        return $post->fetchall();
    }
public function getIdUAByClave($clave)
    { 
        $sql = "SELECT UA_ID FROM CNT_UACADEMICAS WHERE UA_CLAVE = '$clave'";
        $res = $this->_db->query($sql);
        $row = $res->fetch();
        return ($row["UA_ID"]);
    }
public function getUA()
    { 
        $post = $this->_db->query("SELECT * FROM CNT_UACADEMICAS WHERE UA_STATUS=1");
        return $post->fetchall();
    }
public function getDA()
    { 
        $post = $this->_db->query("SELECT * FROM CNT_DA WHERE DA_STATUS=1");
        return $post->fetchall();
    }
public function getDeptosSAE()
    { 
        $post = $this->_db->query("SELECT DEP_ID AS CLAVE, DEP_ID || ' - '||DEP_DENOMINA AS DENOMINA FROM CNT_DEPARTAMENTOS_SAE");
        return $post->fetchall();
    }
public function getPlantillasByIdContrato($id)
    { 
        $post = $this->_db->query("SELECT * FROM CNT_PLANTILLAS WHERE PLT_FK_ID_CNT = $id and PLT_STATUS=1");
        return $post->fetchall();
    }
public function getPlantillas()
    { 
        $post = $this->_db->query("SELECT * FROM CNT_PLANTILLAS WHERE PLT_STATUS=1");
        return $post->fetchall();
    }
public function getTotalContratos()
    { 
        $post = $this->_db->query("SELECT COUNT(*) AS TOTAL FROM CNT_CONTRATOS WHERE CNT_STATUS=1");
        $row =  $post->fetch();
        return $row["TOTAL"];
    }
public function getAllContratos($anio,$ua=1)
    { 
        $post = $this->_db->query("
SELECT  U.UA_ID AS UA_ID,U.UA_CLAVE AS UA_CLAVE,CNT_PK_ANIO AS ANIO,CNT_PK_CONTRATO AS NOCONTRATO,
TC.TCNT_ID AS ID_CONTRATO,
TCNT_DENOMINACION AS TIPO_CONTRATO,
CNT_FK_NOEMPL,
CNT_FECHA_INICIO,CNT_FECHA_FIN,VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '|| VEMP_APEMAT AS NOMBRE 
FROM CNT_CONTRATOS C
LEFT JOIN PVEMPLDOS P
ON P.VEMP_EMPL=C.CNT_FK_NOEMPL
LEFT JOIN CNT_UACADEMICAS U
ON U.UA_ID = C.CNT_PK_UA
LEFT JOIN CNT_TIPOCONT TC
ON TC.TCNT_ID = C.CNT_FK_TIPO
WHERE C.CNT_STATUS=1  AND CNT_PK_ANIO = $anio AND CNT_PK_UA = $ua
ORDER BY UA_CLAVE DESC,CNT_PK_ANIO DESC,C.CNT_PK_CONTRATO DESC
            ");
        return $post->fetchall();
    }
public function getAllContratos2($anio,$ua=1, $inicio, $fin){
    $post = $this->_db->query("SELECT  U.UA_ID AS UA_ID,
    U.UA_CLAVE AS UA_CLAVE,
    CNT_STATUS AS STATUS,
    CNT_FK_URE AS URES,
    CNT_PK_ANIO AS ANIO,
    CNT_PK_CONTRATO AS NOCONTRATO,
    TC.TCNT_ID AS ID_CONTRATO,
    TC.TCNT_ABREVIA AS TCNT_ABREVIA,
    TC.TCNT_DENOMINACION AS TIPO_CONTRATO,
    CC.CAT_ABREVIA AS CAT_ABREVIA,
    CC.CAT_DENOMINA_MAS AS CATEGORIA_CONTRATO,
    CNT_FK_NOEMPL,
    DECODE(CNT_MONTO_MENSUAL, 0, CNT_MONTO_QUINCENA*2, NULL, CNT_MONTO_QUINCENA*2, CNT_MONTO_MENSUAL) AS MONTO_MENSUAL,
    CNT_FECHA_INICIO,
    CNT_FECHA_FIN,
    VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '|| VEMP_APEMAT AS NOMBRE 
    FROM (
    SELECT*FROM 
    (
    SELECT D.*, rownum r 
    FROM 
    (
    SELECT
    *
    FROM CNT_CONTRATOS 
    WHERE CNT_PK_ANIO = $anio AND CNT_PK_UA = $ua
    ) D
    )
    WHERE   r BETWEEN $inicio AND ($inicio + $fin)
    )C
    LEFT JOIN PVEMPLDOS P
    ON P.VEMP_EMPL=C.CNT_FK_NOEMPL
    LEFT JOIN CNT_UACADEMICAS U
    ON U.UA_ID = C.CNT_PK_UA
    LEFT JOIN CNT_TIPOCONT TC
    ON TC.TCNT_ID = C.CNT_FK_TIPO
    LEFT JOIN CNT_CATEGORIAS CC
    ON CC.CAT_ID_CAT = C.CNT_FK_CATEGORIA
    ORDER BY UA_CLAVE DESC,CNT_PK_ANIO DESC,C.CNT_PK_CONTRATO DESC
    ");
    return $post->fetchall();
}
public function getAllContratos3($anio,$ua=1){
    $post = $this->_db->query("SELECT  U.UA_ID AS UA_ID,
    U.UA_CLAVE AS UA_CLAVE,
    DECODE(CNT_STATUS,1,'Abierto',2,'Cerrado',3,'CANCELADO') AS NSTATUS,
    CNT_STATUS AS STATUS,
    CNT_FK_URE AS URES,
    LURES AS NOMB_URES,
    CNT_PK_ANIO AS ANIO,
    CNT_PK_CONTRATO AS NOCONTRATO,
    TC.TCNT_ID AS ID_CONTRATO,
    TC.TCNT_ABREVIA AS TCNT_ABREVIA,
    TC.TCNT_DENOMINACION AS TIPO_CONTRATO,
    CC.CAT_ABREVIA AS CAT_ABREVIA,
    CC.CAT_DENOMINA_MAS AS CATEGORIA_CONTRATO,
    DECODE (CNT_FK_NOEMPL,NULL,'VACIO',CNT_FK_NOEMPL) AS CNT_FK_NOEMPL,
    to_char(DECODE(CNT_MONTO_MENSUAL, 0, CNT_MONTO_QUINCENA*2, NULL, CNT_MONTO_QUINCENA*2, CNT_MONTO_MENSUAL), '$999,999.99') AS MONTO_MENSUAL,
    CNT_FECHA_INICIO,
    CNT_FECHA_FIN,
    DECODE (CNT_NUM_HORAS_SEM, NULL,'-', CNT_NUM_HORAS_SEM)AS HORAS_SEMANA,
    DECODE(CNT_NUM_HORAS, NULL, '-',CNT_NUM_HORAS) AS HORAS_TOTALES,
    DECODE (CNT_FK_NOEMPL,NULL,'CANCELADO',VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '|| VEMP_APEMAT) AS NOMBRE
    FROM (
    SELECT*FROM 
    (
    SELECT D.*, rownum r 
    FROM 
    (
    SELECT
    *
    FROM CNT_CONTRATOS 
    WHERE CNT_PK_ANIO = $anio AND CNT_PK_UA = $ua
    ) D
    )    
    )C
    LEFT JOIN PVEMPLDOS P
    ON P.VEMP_EMPL=C.CNT_FK_NOEMPL
    LEFT JOIN CNT_UACADEMICAS U
    ON U.UA_ID = C.CNT_PK_UA
    LEFT JOIN CNT_TIPOCONT TC
    ON TC.TCNT_ID = C.CNT_FK_TIPO
    LEFT JOIN CNT_CATEGORIAS CC
    ON CC.CAT_ID_CAT = C.CNT_FK_CATEGORIA
    LEFT JOIN TURESH UR
    ON UR.URES = C.CNT_FK_URE
    ORDER BY UA_CLAVE DESC,CNT_PK_ANIO DESC,C.CNT_PK_CONTRATO DESC
    ");
    return $post->fetchall();
}
public function getAllvigenetes()
    { 
        $post = $this->_db->query("
SELECT  U.UA_ID AS UA_ID,U.UA_CLAVE AS UA_CLAVE,CNT_PK_ANIO AS ANIO,CNT_PK_CONTRATO AS NOCONTRATO,
TC.TCNT_ID AS ID_CONTRATO,
TCNT_DENOMINACION AS TIPO_CONTRATO,
CNT_FK_NOEMPL,
CNT_FECHA_INICIO,CNT_FECHA_FIN,VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '|| VEMP_APEMAT AS NOMBRE 
FROM CNT_CONTRATOS C
LEFT JOIN PVEMPLDOS P
ON P.VEMP_EMPL=C.CNT_FK_NOEMPL
LEFT JOIN CNT_UACADEMICAS U
ON U.UA_ID = C.CNT_PK_UA
LEFT JOIN CNT_TIPOCONT TC
ON TC.TCNT_ID = C.CNT_FK_TIPO
WHERE C.CNT_STATUS= 2 
ORDER BY UA_CLAVE DESC,CNT_PK_ANIO DESC,C.CNT_PK_CONTRATO DESC
            ");
        return $post->fetchall();
    }
public function getContratos($ini=0,$fin=0)
    { 
        $post = $this->_db->query("
SELECT * FROM (
SELECT ROWNUM AS NUM,t.* FROM 
( 
SELECT  U.UA_ID AS UA_ID,U.UA_CLAVE AS UA_CLAVE,CNT_PK_ANIO AS ANIO,CNT_PK_CONTRATO AS NOCONTRATO,
TC.TCNT_ID AS ID_CONTRATO,
TCNT_DENOMINACION AS TIPO_CONTRATO,
CNT_FK_NOEMPL,
CNT_FECHA_INICIO,CNT_FECHA_FIN,VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '|| VEMP_APEMAT AS NOMBRE 
FROM CNT_CONTRATOS C
LEFT JOIN PVEMPLDOS P
ON P.VEMP_EMPL=C.CNT_FK_NOEMPL
LEFT JOIN CNT_UACADEMICAS U
ON U.UA_ID = C.CNT_PK_UA
LEFT JOIN CNT_PLANTILLAS PL
ON C.CNT_FK_PLANTILLA = PL.PLT_ID
LEFT JOIN CNT_TIPOCONT TC
ON TC.TCNT_ID = C.CNT_FK_TIPO
WHERE C.CNT_STATUS=1  
ORDER BY UA_CLAVE DESC,CNT_PK_ANIO DESC,C.CNT_PK_CONTRATO DESC
) t
) t
WHERE NUM BETWEEN  $ini AND $fin 
            ");
        return $post->fetchall();
    }
    public function getTiposContratos()
    { 
        $post = $this->_db->query("SELECT * FROM CNT_TIPOCONT WHERE TCNT_STATUS=1");
        return $post->fetchall();
    }
    public function getPosts()
    {
        $post = $this->_db->query("select * from posts");
        return $post->fetchall();
    }
    public function getPost($id)
    {
        $id = (int) $id;
        $post = $this->_db->query("select * from posts where id = $id");
        return $post->fetch();
    }
    public function insertarPost($titulo, $cuerpo, $imagen)
    {
        $this->_db->prepare("INSERT INTO posts VALUES (null, :titulo, :cuerpo, :imagen)")
                ->execute(
                        array(
                           ':titulo' => $titulo,
                           ':cuerpo' => $cuerpo,
                           ':imagen' => $imagen
                        ));
    }
    public function editarPost($id, $titulo, $cuerpo)
    {
        $id = (int) $id;
        $this->_db->prepare("UPDATE posts SET titulo = :titulo, cuerpo = :cuerpo WHERE id = :id")
                ->execute(
                        array(
                           ':id' => $id,
                           ':titulo' => $titulo,
                           ':cuerpo' => $cuerpo
                        ));
    }
    public function eliminarPost($id)
    {
        $id = (int) $id;
        $this->_db->query("DELETE FROM posts WHERE id = $id");
    }
    public function insertarPrueba($nombre)
    {
        $this->_db->prepare("INSERT INTO prueba VALUES (null, :nombre)")
                ->execute(
                        array(
                           ':nombre' => $nombre
                        ));
    }
    public function getPrueba($condicion = "")
    {
        $post = $this->_db->query(
                "select `r`.*, `p`.`pais`, `c`.`ciudad` from `prueba` `r`, `paises` `p`, `ciudades` `c`" .
                "where `r`.`id_pais` = `p`.`id` and `r`.`id_ciudad` = `c`.`id` $condicion order by id asc");
        return $post->fetchAll();
    }
public function buscar($post){
    $nombre = mb_strtoupper(trim($post["nombre"]));
    $apepat = mb_strtoupper(trim($post["appaterno"]));
    $apemat = mb_strtoupper(trim($post["apmaterno"]));
    $post = $this->_db->query(
        "SELECT VEMP_EMPL, VEMP_NOMBRE, VEMP_APEPAT, VEMP_APEMAT FROM PVEMPLDOS WHERE VEMP_NOMBRE LIKE '%$nombre%' 
            AND VEMP_APEPAT LIKE '%$apepat%' AND VEMP_APEMAT LIKE '%$apetmat%' AND VEMP_ACTIVO='S' " 
        );
    return $post -> fetchall();
}
public function infoempl($numempl){
    $post = $this->_db->query("
            SELECT VEMP_NOMBRE, VEMP_APEPAT, VEMP_APEMAT FROM PVEMPLDOS WHERE VEMP_EMPL = '$numempl'" 
            );
    return $post -> fetch();    
}
public function getestudios($numempl){
    $post = $this->_db->query("
            SELECT 
				                ENIV_DESCRIP AS GRADO,
				                ESCU_NOMBRE AS INSTITUTO,
				                TO_CHAR(EGRA_FOBGRADO,'DD/MM/YYYY' ) AS TÍTULO,
				                ECAR_NOMBRE || DECODE(ECAR_ESPECIALIDAD,NULL,'','-') || ECAR_ESPECIALIDAD  AS CARRERA,
				                EGRA_CEDULA ||' - '|| TO_CHAR(EGRA_FEXPCDLA,'DD/MM/YYYY' ) AS CÉDULA 
				                FROM PEGRADOACAD P
				                LEFT JOIN PENIVELACAD A
				                ON P.EGRA_GRADO = A.ENIV_GRADO
				                 LEFT JOIN PECARRERAS C
				                ON C.ECAR_CARRERA = P.EGRA_CARRERA
				                LEFT JOIN PEDESCU PE
                				ON PE.EDES_ID = P.EGRA_ESCU
				               LEFT JOIN PESCUELAS E
                				ON E.ESCU_ESCU = PE.EDES_ESCU
				                WHERE EGRA_PERSONA='$numempl'" 
            );
    return $post -> fetchall();    
}
public function actualizaStatus($contrato){
   // $this_db->prepare("UPDATE posts SET titulo = :titulo, cuerpo = :cuerpo WHERE id = :id")
   $status = $contrato[status];
   $sql = "UPDATE CNT_CONTRATOS SET
   CNT_STATUS = $status
   WHERE  CNT_PK_UA = :unidad
   AND CNT_PK_ANIO =  :anio
   AND CNT_PK_CONTRATO = :numero";
   $this->_db->prepare($sql)
            ->execute(
                    array(
                       ':unidad' => $contrato[unidad],
                       ':numero' => $contrato[numero],
                       ':anio' => $contrato[anio]
                    ));
}
public function getDivisiones($anio){
    $sql = "SELECT ID_DIVISION FROM VGRUPOSDX
            WHERE ANIO = $anio
            GROUP BY ID_DIVISION";
    $res = $this->ssql($sql);
    return $res; ;    
}
}
?>