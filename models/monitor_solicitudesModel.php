<?php
class monitor_solicitudesModel extends Model
{
        
    public function __construct() {
        parent::__construct();
    }

    public function getSolicitudes(){
        $sql = <<<SQL
        SELECT S.ID AS ID_SOL, S.NUMEMPL, S.UBICACION, S.EMPLEADO, S.DIVISION, ID_URE || ' ' || S.URE AS URE, S.ID_ASIG, S.ASIGNATURAS, S.HORASMATERIA AS HORAS, R.NUMEMPL AS NUMEMPL_SAE, R.ID_ASIG AS ID_ASIG_SAE, R.ASIGNATURA AS ASIGNATURA_SAE, R.HORAS AS HORAS_SAE
        FROM (
            SELECT
                ID, DIVISION,
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
                ID_ASIG,
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
                CLAVE AS "OFICIO SOLICITA",
                CLAVECANCEL AS "OFICIO CANCELA",
                DECODE(CLAVE, NULL, 'PENDIENTE', DECODE(CLAVECANCEL, NULL, 'ACTIVO' , 'CANCELADO' ) ) AS STATUS,
                PERIODO
            FROM (SELECT
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
                    CSA.ID_ASIG,
                    CSA.NOM_MATERIA AS ASIGNATURAS,
                    CSA.HRS_ASIG AS HORASMATERIA,
                    (SELECT COUNT(*) FROM CNT_SOLICITA_ASIG WHERE ID_SOL = SOL.SOL_ID ) AS "TOT GPOS",
                    SOL_HRS AS TOT_HRS,
                    ST_DENOMINA AS STATUS,
                    SOL_OFICIO AS IDOFICIO,
                    SOL_OFICIO_CANCELA AS IDOFICIOC,
                    SOL_FK_PERIODO AS PERIODO,
                    P.URES || ' ' || P.LURES AS DIVISION
                FROM (SELECT * FROM CNT_SOLICITA WHERE SOL_FK_PERIODO = (
                        SELECT PER_ID FROM ( SELECT * FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS = 1 ORDER BY PER_ID DESC ) WHERE ROWNUM = 1 ) ) SOL
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
                LEFT JOIN TURESP P ON P.URES = TUR.URESP
                ) SOL
                LEFT JOIN (SELECT OFI_CLAVE AS CLAVE, OFI_ID FROM CNT_SOLICITA_OFICIO) OFI 
                    ON OFI.OFI_ID = SOL.IDOFICIO
                LEFT JOIN ( SELECT OFI_CLAVE AS CLAVECANCEL, OFI_ID	FROM CNT_SOLICITA_OFICIO_CANCEL) OFIC 
                    ON OFIC.OFI_ID = SOL.IDOFICIOC                
                ORDER BY ID DESC
        ) S
        FULL OUTER JOIN
        (
            SELECT V.ID_DOCENTE AS NUMEMPL, V.ID_GRUPO AS ID_ASIG, S.NOM_MATERIA AS ASIGNATURA, S.HRS_ASIG AS HORAS
            FROM VGRUPOS V
            INNER JOIN VGRUPOSD S ON S.ID_GRUPO = V.ID_GRUPO AND S.ID_DOCENTE = V.ID_DOCENTE
            WHERE V.ID_PERIODO = 'S02' AND ID_ANIO = '2025'
        ) R ON R.NUMEMPL = S.NUMEMPL AND R.ID_ASIG = S.ID_ASIG
SQL;

        $res = $this->ssql($sql, null, 2);
        return $res;
        
    }

    
}



?>