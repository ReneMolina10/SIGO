<?php
class crearcontratosModel extends Model
{
        
    public function __construct() {
        parent::__construct();
    }
        
    /**
     * *En esta función se obtienen los departamentos de la URE
     * 
     * @return array
     * 
     */
    public function getDepartamentos(){
        $sql = "SELECT URES, LURES FROM TURESH WHERE DEPTO_ACAD=1 AND FECHA_FIN IS NULL OR URES IN ( 137100, 147610, 147710, 147810, 151400 )";
        $res = $this->ssql($sql, null, 2);
        return $res;
        
    }
        
        
    /**
     * *Esta función busca las solicitudes de contratos de un departamento
     * 
     * @param $ureDepartamento
     * @return array
     * 
     */
    public function getSolicitudesContratos($ureDepartamento){
        $sql = <<<SQL
        SELECT
            ID,
            GETIFNOMBRA(NUMEMPL, (SELECT PER_FECHA_INI FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS = 1)) AS NOMBRAMIENTO,
            SISRH.GETTIPOCONTRATO(NUMEMPL, (SELECT PER_FECHA_INI FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS = 1)) AS TIPOCONTRATO,
            GETGRADOESTUDIOS(NUMEMPL) AS NIVEL_ACA,
            NUMEMPL,
            EMPLEADO,
            RFC,
            CURP,
            FECHA_INGRESO,
            ID_URE,
            URE,
            UBICACION,
            ID_MATERIA,
            ASIGNATURAS,
            HORASMATERIA,
            "TOT GPOS",
            TOT_HRS,
            (
                SELECT
                    COUNT(*) AS CANTIDAD
                FROM
                    CNT_CONTRATOS
                WHERE
                    CNT_PK_ANIO = (
                    SELECT
                        PER_ANIO
                    FROM
                        CNT_PERIODOS_DOCEN
                    WHERE
                        PER_STATUS = 1)
                    AND CNT_PERIODO_SAE = (
                    SELECT
                        PER_PERIODO
                    FROM
                        CNT_PERIODOS_DOCEN
                    WHERE
                        PER_STATUS = 1)
                    AND SOL.NUMEMPL = CNT_FK_NOEMPL
                    AND SOL.ID_URE = CNT_FK_URE ) AS NUMC,
            OFI_SOL.OFI_CLAVE AS "OFICIO SOLICITA",
            OFI_CANC.OFI_CLAVE AS "OFICIO CANCELA",
            DECODE(OFI_SOL.OFI_CLAVE, NULL, 'PENDIENTE', DECODE(OFI_CANC.OFI_CLAVE, NULL, 'ACTIVO' , 'CANCELADO' ) ) AS STATUS,
            PERIODO
        FROM (
            SELECT
                SOL_ID AS ID,
                PER.PERS_PERSONA AS NUMEMPL,
                PER.PERS_NOMBRE || ' ' || PER.PERS_APEPAT || ' ' || PER.PERS_APEMAT AS EMPLEADO,
                PERS_RFC AS RFC,
                PERS_CURP AS CURP,
                PERS_FECHAING AS FECHA_INGRESO,
                TUR.URES AS ID_URE,
                TUR.LURES AS URE,
                U.UBI_DENOMINACION AS "UBICACION",
                CSA.ID_MATERIA,
                CSA.NOM_MATERIA AS ASIGNATURAS,
                CSA.HRS_ASIG AS HORASMATERIA,
                (SELECT COUNT(*) FROM CNT_SOLICITA_ASIG WHERE ID_SOL = SOL.SOL_ID ) AS "TOT GPOS",
                SOL_HRS AS TOT_HRS,
                SOL_FK_PERIODO AS PERIODO,
                SOL.SOL_OFICIO AS IDOFICIO_SOLICITUD, 
                CSA.SOL_OFICIO_CANCEL AS IDOFICIO_CANC_ASIG 
            FROM
                (SELECT * FROM CNT_SOLICITA WHERE SOL_FK_PERIODO = (
                    SELECT PER_ID FROM ( SELECT * FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS = 1 ORDER BY PER_ID DESC ) WHERE ROWNUM = 1 )
                ) SOL
            LEFT JOIN CNT_SOLICITA_ASIG CSA
                ON CSA.ID_SOL = SOL.SOL_ID
            INNER JOIN FINANZAS.FPERSONAS PER
                ON PER.PERS_PERSONA = SOL.SOL_NUMEMPL
            INNER JOIN TURESH TUR
                ON TUR.URES = SOL.SOL_FK_URE
            LEFT JOIN PLT_UBICACIONES U
                ON U.UBI_ID = SOL.SOL_LUGAR_ADSC
            LEFT JOIN CNT_SOLICITA_STATUS S 
                ON S.ST_ID = SOL.SOL_STATUS
        ) SOL
        LEFT JOIN CNT_SOLICITA_OFICIO OFI_SOL
            ON OFI_SOL.OFI_ID = SOL.IDOFICIO_SOLICITUD
        LEFT JOIN CNT_SOLICITA_OFICIO_CANCEL OFI_CANC
            ON OFI_CANC.OFI_ID = SOL.IDOFICIO_CANC_ASIG
                WHERE ID_URE = $ureDepartamento  
                ORDER BY ID DESC
SQL;
        
        $res = $this->ssql($sql, null, 2);
        return $res;
        
    }
        
    public function getTipoPlantillaConpensatorio(){
        
        $sql = "SELECT * FROM CNT_PLANTILLAS WHERE PLT_FK_ID_CNT IN (2,4) AND PLT_STATUS = 1 ORDER BY PLT_ID DESC";
        $res = $this->ssql($sql, null, 2);
        return $res;
    }
        
    public function getTipoPlantillaPrivada(){
        
        $sql = "SELECT * FROM CNT_PLANTILLAS WHERE PLT_FK_ID_CNT IN (3,5) AND PLT_STATUS = 1 ORDER BY PLT_ID DESC";
        $res = $this->ssql($sql, null, 2);
        return $res;
    }
        
    public function getFechasPeriodo($anioActual){
        $sql = "SELECT * FROM (SELECT
                    PER_QUINC,
                    PER_SEMAN,
                    TO_CHAR(PER_FECHA_INI, 'YYYY-MM-DD') AS FI,
                    TO_CHAR(PER_FECHA_FIN, 'YYYY-MM-DD') AS FF,
                    ROW_NUMBER() OVER (ORDER BY PER_ID DESC) AS RN
                FROM
                    CNT_PERIODOS_DOCEN
                WHERE
                    PER_ANIO = $anioActual) WHERE RN = 1";
        $res = $this->ssql($sql, null, 1);
        return $res;
    }

        
        
        
        
    public function getSolicitudById($idSolicitud) {
        //$sql = "SELECT * FROM CNT_SOLICITA WHERE SOL_ID = $idSolicitud";
        $sql = "SELECT 
                    s.*,
                    NVL(a.TOTALHORASSOLICITUD, 0) AS TOTALHORASSOLICITUD
                FROM CNT_SOLICITA s
                LEFT JOIN (
                    SELECT 
                        ID_SOL, 
                        SUM(HRS_ASIG) AS TOTALHORASSOLICITUD
                    FROM CNT_SOLICITA_ASIG
                    GROUP BY ID_SOL
                ) a 
                    ON a.ID_SOL = s.SOL_ID
                WHERE s.SOL_ID =  $idSolicitud";
        $stmt = $this->_db->query($sql);
        //$stmt->execute([':idSolicitud' => $idSolicitud]);
        return($stmt->fetch());
    }

    public function getAsignaturasByIdSol($idSolicitud) {
        //$sql = "SELECT * FROM CNT_SOLICITA WHERE SOL_ID = $idSolicitud";
        $sql = "SELECT 
                    id_materia || ' ' || nom_materia AS materia
                FROM cnt_solicita_asig
                WHERE id_sol = $idSolicitud
                ORDER BY id_materia ";
        $res = $this->ssql($sql, null, 2);
        return $res;
    }
        
    public function crearContratoMasivo($datosContrato) {
        // Si algún campo no está definido en $datosContrato, se le asigna una cadena vacía
        // (o un valor por defecto) para evitar errores en la consulta.
        $campos = [
            "ua", "numempl", "inicio", "fin", "fecha_firma", "plantilla", "tipoc", 
            "categoria", "ure", "funciones", "quincenas", "semanas", "horas", "monto_total", 
            "monto_quincenal", "deptosae", "monto_mensual", "horas_semana", "per", "da", 
            "monto_hora", "uf", "monto_final", "fderoga", "clavenum", "anio", "numc", "contenido"
        ];
        
        foreach ($campos as $campo) {
            if (!isset($datosContrato[$campo])) {
                $datosContrato[$campo] = "";
            }
        }
        
        // Llama a la función putContratos que se encarga de insertar o actualizar el contrato
        $resultado = $this->putContratos($datosContrato);
        
        return $resultado;
    }
        
    public function putContratos($post) {
        
        // 1. Obtener la clave textual de la UA (si se proporciona "ua")
        $claveTexto = "";
        if (!empty($post["ua"])) {
            $sqlClave = "SELECT UA_CLAVE FROM CNT_UACADEMICAS WHERE UA_ID = :ua";
            $paramsClave = array(':ua' => $post["ua"]);
            $resClave = $this->ssql($sqlClave, $paramsClave);
            if (isset($resClave[0]['UA_CLAVE'])) {
                $claveTexto = $resClave[0]['UA_CLAVE'];
            }
        }
        
        // 2. Convertir montos a número, eliminando comas
        $post["monto_quincenal"] = isset($post["monto_quincenal"])       ? (double) trim(str_replace(',', '', $post["monto_quincenal"]))  : 0;
        $post["monto_mensual"]   = isset($post["monto_mensual"])         ? (double) trim(str_replace(',', '', $post["monto_mensual"]))    : 0;
        $post["monto_total"]     = isset($post["monto_total"])           ? (double) trim(str_replace(',', '', $post["monto_total"]))      : 0;
     
        // 3. Definir año y UA
        $anio = date("Y");
        $ua   = isset($post["ua"]) ? $post["ua"] : "";
        
        // 4. Determinar el nuevo número de contrato para la UA y año dado
        $sqlId = "SELECT DECODE(MAX(CNT_PK_CONTRATO),NULL,0,MAX(CNT_PK_CONTRATO)) + 1 AS ID 
                  FROM CNT_CONTRATOS 
                  WHERE CNT_PK_UA = :ua AND CNT_PK_ANIO = :anio";
        $infoId = array(':ua' => $ua, ':anio' => $anio);
        $resId = $this->ssql($sqlId, $infoId);
        $idC = isset($resId[0]['ID']) ? $resId[0]['ID'] : 0;
        
        
        // 5. Preparar la consulta de INSERT para CNT_CONTRATOS
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
                    CNT_MONTO_FINAL,
                    CNT_FECHA_DERROGA
                ) VALUES (
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
                    :monto_total,
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
                    :monto_final,
                    TO_DATE(:fderoga, 'YYYY-MM-DD')
                )";
        
        $params = array(
            ':ua' => $ua,
            ':anio' => $anio,
            ':numempl' => isset($post["numempl"]) ? $post["numempl"] : "",
            ':plantilla' => isset($post["plantilla"]) ? $post["plantilla"] : "",
            ':tipoc' => isset($post["tipoc"]) ? $post["tipoc"] : "",
            ':idc' => $idC,
            ':fi' => isset($post["inicio"]) ? $post["inicio"] : "",
            ':ff' => isset($post["fin"]) ? $post["fin"] : "",
            ':categoria' => isset($post["categoria"]) ? $post["categoria"] : "",
            ':ure' => isset($post["ure"]) ? $post["ure"] : "",
            ':funciones' => isset($post["funciones"]) ? $post["funciones"] : "",
            ':quincenas' => isset($post["quincenas"]) ? $post["quincenas"] : "",
            ':semanas' => isset($post["semanas"]) ? $post["semanas"] : "",
            ':horas' => isset($post["horas"]) ? $post["horas"] : "",
            ':monto_total' => $post["monto_total"],
            ':monto_quincenal' => $post["monto_quincenal"],
            ':testigo1' => 0,
            ':testigo2' => 0,
            ':fecha_firma' => isset($post["fecha_firma"]) ? $post["fecha_firma"] : "",
            ':iddeptosae' => isset($post["deptosae"]) ? $post["deptosae"] : "",
            ':monto_mensual' => $post["monto_mensual"],
            ':horas_semana' => isset($post["horas_semana"]) ? $post["horas_semana"] : "",
            ':periodo_sae' => isset($post["per"]) ? $post["per"] : "",
            ':da' => isset($post["da"]) ? $post["da"] : "",
            ':monto_hora' => isset($post["monto_hora"]) ? $post["monto_hora"] : "",
            ':ubicafisica' => isset($post["uf"]) ? $post["uf"] : "",
            ':monto_final' => isset($post["monto_final"]) ? $post["monto_final"] : "",
            ':fderoga' => isset($post["fderoga"]) ? $post["fderoga"] : ""
        );
        
        // Ejecutar el INSERT usando ssql()
        $this->ssql($sql, $params);
        
        // Armar la respuesta para construir la clave final del contrato
        $mensaje = array();
        $mensaje["id"]   = $idC;
        $mensaje["anio"] = $anio;
        $mensaje["ua"]   = $ua;
        $mensaje["uat"]  = $claveTexto;
        
        return $mensaje;
    }
    
        
    /**
     * Obtiene la clave del período (PER_PERIODO) a partir del ID del período.
     */
    public function getClavePeriodo($periodoId) {
        $sql = "SELECT PER_PERIODO FROM CNT_PERIODOS_DOCEN WHERE PER_ID = :periodoId";
        $params = array(':periodoId' => $periodoId);
        $result = $this->ssql($sql, $params);
        return (isset($result[0]['PER_PERIODO'])) ? $result[0]['PER_PERIODO'] : "";
    }
        
    /**
     * Obtiene la División Académica (DIVISION_ACADEMICA) a partir del URE hijo.
     * Se une TURESH con TURESP usando la columna URESP de TURESH que representa el URE padre.
     */
    public function getDivisionAcademica($ureChild) {
        $sql = "SELECT t2.DIV AS DIVISION_ACADEMICA
                FROM TURESH t1
                INNER JOIN TURESP t2 ON t1.URESP = t2.URES
                WHERE t1.URES = :ureChild";
        $params = array(':ureChild' => $ureChild);
        $result = $this->ssql($sql, $params);
        return (isset($result[0]['DIVISION_ACADEMICA'])) ? $result[0]['DIVISION_ACADEMICA'] : "";
    }
        
    public function getPlantillaTexto($id){
        $sql = "
            SELECT  PLT_TEXTO AS TEXTO
            FROM CNT_PLANTILLAS
            WHERE PLT_STATUS=1 AND PLT_ID = '$id'
            ";
        $res = $this->ssql($sql, null, 1);
        return $res;
    }
    
    public function getInfoContrato( $clavenum, $anio, $numc, $info ){
        $informacionContrato = "SELECT * FROM CNT_CONTRATOS WHERE CNT_PK_ANIO = $anio AND CNT_PK_CONTRATO = $numc AND CNT_PK_UA = $clavenum";
        
        $informacionContrato = $this->ssql($informacionContrato, null, 1);
        //$informacionContrato = $this->_db->query( $informacionContrato ); 
        //$informacionContrato = $informacionContrato->fetch();
        
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
            $SQL = "SELECT ' ' AS INFO FROM dual";
        //    $SQL = "SELECT TES_PREFIJO AS INFO  FROM CNT_CONTRATOS C LEFT JOIN CNT_TESTIGOS T ON C.CNT_FK_NOEMPL_TESTIGO1 = T.TES_ID  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
        if($info=="testigo1nombre") {
            $SQL = "SELECT CASE 
                        WHEN T.SUPLENTE_NOMBRE IS NOT NULL AND TRIM(T.SUPLENTE_NOMBRE) <> '' 
                        THEN T.SUPLENTE_NOMBRE 
                        ELSE T.TITULAR_NOMBRE 
                    END AS INFO 
                    FROM CNT_CONTRATOS C 
                    LEFT JOIN TURESH T ON T.URES = C.CNT_FK_URE  
                    WHERE C.CNT_PK_ANIO = $anio 
                      AND C.CNT_PK_CONTRATO = $numc 
                      AND C.CNT_PK_UA = $clavenum";
        }
        if($info=="testigo1cargo") {
            $SQL = "SELECT CASE 
                        WHEN T.SUPLENTE_CARGO IS NOT NULL AND TRIM(T.SUPLENTE_CARGO) <> '' 
                        THEN T.SUPLENTE_CARGO 
                        ELSE T.TITULAR_CARGO 
                    END AS INFO 
                    FROM CNT_CONTRATOS C 
                    LEFT JOIN TURESH T ON T.URES = C.CNT_FK_URE  
                    WHERE C.CNT_PK_ANIO = $anio 
                      AND C.CNT_PK_CONTRATO = $numc 
                      AND C.CNT_PK_UA = $clavenum";
        }
        
        
        if($info=="testigo2_prefijo") 
            $SQL = "SELECT ' ' AS INFO FROM dual";
        //    $SQL = "SELECT TES_PREFIJO AS INFO  FROM CNT_CONTRATOS C LEFT JOIN CNT_TESTIGOS T ON C.CNT_FK_NOEMPL_TESTIGO2 = T.TES_ID  WHERE  CNT_PK_ANIO=$anio AND CNT_PK_CONTRATO=$numc AND CNT_PK_UA =$clavenum";
        if($info=="testigo2_nombre")         
            $SQL = "SELECT CASE 
                        WHEN P.SUPLENTE_NOMBRE IS NOT NULL AND TRIM(P.SUPLENTE_NOMBRE) <> '' 
                        THEN P.SUPLENTE_NOMBRE 
                        ELSE P.TITULAR_NOMBRE 
                    END AS INFO 
                    FROM CNT_CONTRATOS C 
                    LEFT JOIN TURESH T ON T.URES = C.CNT_FK_URE
                    LEFT JOIN TURESP P ON P.URES = T.URESP
                    WHERE C.CNT_PK_ANIO = $anio 
                      AND C.CNT_PK_CONTRATO = $numc 
                      AND C.CNT_PK_UA = $clavenum";
        if($info=="testigo2_cargo")
            $SQL = "SELECT CASE 
                        WHEN P.SUPLENTE_CARGO IS NOT NULL AND TRIM(P.SUPLENTE_CARGO) <> '' 
                        THEN P.SUPLENTE_CARGO 
                        ELSE P.TITULAR_CARGO 
                    END AS INFO 
                    FROM CNT_CONTRATOS C 
                    LEFT JOIN TURESH T ON T.URES = C.CNT_FK_URE
                    LEFT JOIN TURESP P ON P.URES = T.URESP
                    WHERE C.CNT_PK_ANIO = $anio 
                    AND C.CNT_PK_CONTRATO = $numc 
                    AND C.CNT_PK_UA = $clavenum";
    
    
    
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
        $row = $this->ssql($SQL, null, 1);
        //$post = $this->_db->query($SQL); 
        //$row  = $post->fetch();
        
       // $row["INFO"] = $SQL;
        return($row["INFO"]);
    
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
        $row  = $post->fetch(PDO::FETCH_ASSOC);

        return isset($row['INFO']) ? $row['INFO'] : '';

    }
    

    public function putTextoContratos($texto, $clavenum, $anio, $numc) {
        $sql = "UPDATE CNT_CONTRATOS 
                SET CNT_TEXTO = :contenido 
                WHERE CNT_PK_UA = :clavenum 
                AND CNT_PK_ANIO = :anio 
                AND CNT_PK_CONTRATO = :num";
        
        $array = [
            ':contenido' => $texto,
            ':clavenum' => $clavenum,
            ':anio' => $anio,
            ':num' => $numc
        ];
        
        return $this->ssql($sql, $array);
    }

    public function getURE($idusr) {
        $sql = "SELECT UA_ID AS IDURE, UA_DENOMINACION AS UA, UA_CLAVE AS CLAVE 
                FROM CNT_UACADEMICAS 
                WHERE UA_ID = :idusr";
        
        $array = [':idusr' => $idusr];
        
        return $this->ssql($sql, $array, 1);
    }

    public function getContratoTexto($clave, $anio, $numero) {
        $sql = "SELECT C.CNT_TEXTO AS TEXTO, TCNT_CLAVE AS CLAVE, PLT_MARGENES AS MARGENES, PLT_CLAVE
                FROM CNT_CONTRATOS C
                LEFT JOIN CNT_UACADEMICAS U ON U.UA_ID = C.CNT_PK_UA
                LEFT JOIN CNT_TIPOCONT T ON C.CNT_FK_TIPO = T.TCNT_ID
                LEFT JOIN CNT_PLANTILLAS P ON P.PLT_ID = C.CNT_FK_PLANTILLA
                WHERE C.CNT_STATUS = 1 AND C.CNT_PK_ANIO = :anio AND C.CNT_PK_CONTRATO = :numero AND U.UA_CLAVE = :clave";
        
        $params = [':anio' => $anio, ':numero' => $numero, ':clave' => $clave];
        /*print_r("SELECT C.CNT_TEXTO AS TEXTO, TCNT_CLAVE AS CLAVE, PLT_MARGENES AS MARGENES, PLT_CLAVE
                FROM CNT_CONTRATOS C
                LEFT JOIN CNT_UACADEMICAS U ON U.UA_ID = C.CNT_PK_UA
                LEFT JOIN CNT_TIPOCONT T ON C.CNT_FK_TIPO = T.TCNT_ID
                LEFT JOIN CNT_PLANTILLAS P ON P.PLT_ID = C.CNT_FK_PLANTILLA
                WHERE C.CNT_STATUS = 1 AND C.CNT_PK_ANIO = $anio AND C.CNT_PK_CONTRATO = $numero AND U.UA_CLAVE = $clave");
        exit;
        */
        //print_r($this->ssql($sql, $params));
        return $this->ssql($sql, $params,1);

        /*$result = $this->ssql($sql, $params,1);
         // Convertir el campo TEXTO si es un objeto OCI-Lob
        if (is_array($result)) {
            // Si se espera una sola fila
            if (isset($result['TEXTO'])) {
                if (is_object($result['TEXTO']) && method_exists($result['TEXTO'], 'load')) {
                    $result['TEXTO'] = $result['TEXTO']->load();
                }
            } else {
                // Si se devuelve un arreglo de filas
                foreach ($result as $key => $row) {
                    if (isset($row['TEXTO']) && is_object($row['TEXTO']) && method_exists($row['TEXTO'], 'load')) {
                        $result[$key]['TEXTO'] = $row['TEXTO']->load();
                    }
                }
            }
        }

        return $result;*/
    }

    public function getInfoRector($info) {
        $sql = "";
        
        switch ($info) {
            case "nombrecompleto":
                $sql = "SELECT VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '|| VEMP_APEMAT AS INFO 
                        FROM PVEMPLDOS 
                        WHERE VEMP_EMPL = (SELECT TITULAR FROM TURESH WHERE URES = 114000 AND ROWNUM = 1)";
                break;
            
            case "prefijo":
                $sql = "SELECT DECODE(VEMP_SEXO,'M',TGA_PREFIJO_MAS,'F',TGA_PREFIJO_FEM) AS INFO 
                        FROM (
                            SELECT T.*, E.VEMP_SEXO FROM PEGRADOACAD P
                            LEFT JOIN PVEMPLDOS E ON E.VEMP_EMPL = P.EGRA_PERSONA
                            LEFT JOIN PENIVELACAD A ON P.EGRA_GRADO = A.ENIV_GRADO
                            LEFT JOIN CNT_TERM_GRADACAD T ON P.EGRA_GRADO = T.TGA_ID
                            WHERE EGRA_PERSONA = (SELECT TITULAR FROM TURESH WHERE URES = 114000 AND ROWNUM = 1)
                            ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC
                        ) T WHERE ROWNUM = 1";
                break;
            
            case "cargo":
                $sql = "SELECT DECODE((SELECT VEMP_SEXO FROM PVEMPLDOS 
                        WHERE VEMP_EMPL = (SELECT TITULAR FROM TURESH WHERE URES = 114000 AND ROWNUM = 1)),
                        'M', TPT_DENOMINA_MAS, 'F', TPT_DENOMINA_FEM) AS INFO 
                        FROM CNT_TERM_PUESTOS WHERE TPT_ID = 'rector'";
                break;
            
            case "lael":
                $sql = "SELECT DECODE((SELECT VEMP_SEXO FROM PVEMPLDOS 
                        WHERE VEMP_EMPL = (SELECT TITULAR FROM TURESH WHERE URES = 114000 AND ROWNUM = 1)),
                        'M', 'EL', 'F', 'LA') AS INFO FROM DUAL";
                break;
            
            default:
                return null;
        }
        
        $params = [];
        return $this->ssql($sql, $params, 1);
    }

    public function getInfoAdministrador($info) {
        $sql = "";
        
        switch ($info) {
            case "prefijo":
                $sql = "SELECT TES_PREFIJO AS INFO FROM CNT_TESTIGOS WHERE TES_URE = '142000'";
                break;
            case "nombrecompleto":
                $sql = "SELECT TES_NOMBRE AS INFO FROM CNT_TESTIGOS WHERE TES_URE = '142000'";
                break;
            case "cargo":
                $sql = "SELECT TES_CARGO AS INFO FROM CNT_TESTIGOS WHERE TES_URE = '142000'";
                break;
            default:
                return null;
        }
        
        $params = [];
        return $this->ssql($sql, $params, 1);
    }

    public function getInfoDirector($info, $idURE) {
        $miArray = [
            146801, 146811, 146813, 146812,
            146911, 146913, 146912, 146915, 146914,
            147611, 147612, 147613,
            147711, 147712, 147713,
            147811, 147812, 147813, 147814
        ];
    
        if ($idURE == 146420) {
            $idURE = 146900;
        }
    
        if (in_array($idURE, $miArray)) {
            $idURE = substr($idURE, 0, 4) . "01";
        } elseif (substr($idURE, 0, 3) == "146" || substr($idURE, 0, 3) == "147") {
            $idURE = substr($idURE, 0, 4) . "00";
        } else {
            $idUREresp = $idURE;
            $idURE = substr($idURE, 0, 3) . "000";
    
            if (substr($idURE, 0, 3) == "142") {
                $idURE = $idUREresp;
            }
        }
    
        $sql = "";
        switch ($info) {
            case "prefijo":
                $sql = "SELECT TES_PREFIJO AS INFO FROM CNT_TESTIGOS WHERE TES_URE = :idURE AND TES_STATUS = 1";
                break;
            case "lael":
                $sql = "SELECT TES_LAEL AS INFO FROM CNT_TESTIGOS WHERE TES_URE = :idURE AND TES_STATUS = 1";
                break;
            case "nombrecompleto":
                $sql = "SELECT TES_NOMBRE AS INFO FROM CNT_TESTIGOS WHERE TES_URE = :idURE AND TES_STATUS = 1";
                break;
            case "cargo":
                $sql = "SELECT TES_CARGO AS INFO FROM CNT_TESTIGOS WHERE TES_URE = :idURE AND TES_STATUS = 1";
                break;
            default:
                return null;
        }
        
        $params = [':idURE' => $idURE];
        return $this->ssql($sql, $params, 1);
    }
    
    public function getInfoJefeDepto($info, $idURE) {
        $campoFiltro = (substr($idURE, -3) == "000") ? "TES_URE_ADJUNTO" : "TES_URE";
        $sql = "";
        
        switch ($info) {
            case "prefijo":
                $sql = "SELECT TES_PREFIJO AS INFO FROM CNT_TESTIGOS WHERE $campoFiltro = :idURE";
                break;
            case "nombrecompleto":
                $sql = "SELECT TES_NOMBRE AS INFO FROM CNT_TESTIGOS WHERE $campoFiltro = :idURE";
                break;
            case "cargo":
                $sql = "SELECT TES_CARGO AS INFO FROM CNT_TESTIGOS WHERE $campoFiltro = :idURE";
                break;
            default:
                return null;
        }
        
        $params = [':idURE' => $idURE];
        return $this->ssql($sql, $params, 1);
    }
    
    public function getInfoAdmin($info) {
        $sql = "";
        
        switch ($info) {
            case "nombrecompleto":
                $sql = "SELECT VEMP_NOMBRE ||' '|| VEMP_APEPAT ||' '|| VEMP_APEMAT AS INFO 
                         FROM PVEMPLDOS 
                         WHERE VEMP_EMPL = (SELECT TITULAR FROM TURESH WHERE URES = 123000 AND ROWNUM = 1)";
                break;
            
            case "prefijo":
                $sql = "SELECT DECODE(VEMP_SEXO,'M',TGA_PREFIJO_MAS,'F',TGA_PREFIJO_FEM) AS INFO 
                         FROM (
                             SELECT T.*, E.VEMP_SEXO FROM PEGRADOACAD P
                             LEFT JOIN PVEMPLDOS E ON E.VEMP_EMPL = P.EGRA_PERSONA
                             LEFT JOIN PENIVELACAD A ON P.EGRA_GRADO = A.ENIV_GRADO
                             LEFT JOIN CNT_TERM_GRADACAD T ON P.EGRA_GRADO = T.TGA_ID
                             WHERE EGRA_PERSONA = (SELECT TITULAR FROM TURESH WHERE URES = 123000 AND ROWNUM = 1)
                             ORDER BY A.ENIV_NIVEL DESC, P.EGRA_FEC DESC
                         ) T WHERE ROWNUM = 1";
                break;
            
            case "cargo":
                $sql = "SELECT DECODE((SELECT VEMP_SEXO FROM PVEMPLDOS 
                         WHERE VEMP_EMPL = (SELECT TITULAR FROM TURESH WHERE URES = 123000 AND ROWNUM = 1)),
                         'M', TPT_DENOMINA_MAS, 'F', TPT_DENOMINA_FEM) AS INFO 
                         FROM CNT_TERM_PUESTOS WHERE TPT_ID = 'admin'";
                break;
            
            default:
                return null;
        }
        
        $params = [];
        return $this->ssql($sql, $params,1);
    }
    
    public function getInfoPlantilla($info, $numEmpl) {
        $sql = "";
        
        switch ($info) {
            case "categoria":
                $sql = "SELECT CATEGORIA AS INFO FROM VPLANTILLA WHERE NUM_EMPL = :numEmpl";
                break;
            case "ure":
            case "ures_del_dela":
                $sql = "SELECT URE AS INFO FROM VPLANTILLA WHERE NUM_EMPL = :numEmpl";
                break;
            default:
                return null;
        }
        
        $params = [':numEmpl' => $numEmpl];
        $row = $this->ssql($sql, $params,1);
        return($row["INFO"]);
    }



    
}



?>