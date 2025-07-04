<?php
class nombramientoModel extends Model {
    public function __construct(){
        parent :: __construct();
    }



    public function duplicarMPlaza($info,$ure)
    {
        /*
        
        $sql = "INSERT INTO PLT_MPLAZAS (MPLZ_PLAZA,MPLZ_FK_IDPLAZA,MPLZ_OBSERVA,MPLZ_INICIO,MPLZ_FK_URES)

        VALUES( (SELECT (MAX(MPLZ_PLAZA) + 1) AS T FROM PLT_MPLAZAS) ,".$info["MPLZ_FK_IDPLAZA"].",'MOVIMIENTO AUTOMATICO POR CAMBIO DE URES 2021',TO_DATE('01/01/2021','DD/MM/YYYY'),
        '".$ure."' 

        )

         ";
        
       $res = $this->ssql($sql);
        return($res);
        */

    }

        public function getMPlaza($id)
    {
        $sql = "

SELECT * FROM PLT_MPLAZAS where MPLZ_PLAZA = $id



        ";
        $post = $this->_db->query($sql);
        return $post->fetch();

    }



    public function getPlazasDuplicar()
    {
        $sql = "

SELECT IDMOV,URE FROM TMP_MOV_URES_PLAZAS_IDM



        ";
        $post = $this->_db->query($sql);
        return $post->fetchall();

    }


    public function getPlazasPorActualizar()
    {
        $sql = "

SELECT * FROM PLT_MPLAZAS  P

LEFT JOIN TMP_MOV_URES_PLAZAS L
ON P.MPLZ_FK_IDPLAZA = PLAZA

WHERE 
(-- MPLZ_FIN IS NULL OR MPLZ_FIN > TO_DATE('07/01/2021','DD/MM/YYYY') 
EXTRACT(YEAR FROM MPLZ_INICIO) = 2021
)
AND PLAZA IS NOT NULL


        ";
        $post = $this->_db->query($sql);
        return $post->fetchall();

    }


    public function updateMPlaza($idmov,$ure)
    {
        $sql = "UPDATE PLT_MPLAZAS SET MPLZ_FK_URES = $ure  WHERE MPLZ_PLAZA = $idmov AND ROWNUM = 1";
        
       $res = $this->ssql($sql);
        return($res);
        //echo "$sql <br/>";
      //$post = $this->_db->query($sql);
      //return $post->fetchall();

    }




    public function getPlazasPorCerrar($ure)
    {
        $sql = "SELECT * FROM PLT_MPLAZAS WHERE MPLZ_FK_URES = $ure AND MPLZ_FIN IS NULL";
        $post = $this->_db->query($sql);
        return $post->fetchall();

    }

    public function cierraPlaza($id,$fecha)
    {
        $sql = "UPDATE PLT_MPLAZAS SET MPLZ_FIN = TO_DATE('$fecha','YYYY-MM-DD')  WHERE MPLZ_PLAZA = $id AND ROWNUM = 1";
        
        $res = $this->ssql($sql);
        return($res);
      //  echo "$sql <br/>";
      //$post = $this->_db->query($sql);
      //return $post->fetchall();

    }


    public function creaPlaza($f,$uresd,$fecha)
    {
        $sql = "
INSERT INTO PLT_MPLAZAS (MPLZ_PLAZA,MPLZ_DENOMINACION,MPLZ_FK_URES,MPLZ_OBSERVA,MPLZ_INICIO,MPLZ_FK_IDPLAZA)
VALUES ((SELECT MAX(MPLZ_PLAZA) + 1 AS LLAVE  FROM PLT_MPLAZAS),'".$f["MPLZ_DENOMINACION"]."','".$uresd."','Creado automáticamente con el módulo de movimiento masivo de plazas',TO_DATE('$fecha','YYYY-MM-DD'),".$f["MPLZ_FK_IDPLAZA"].")
        ";

        $res = $this->ssql($sql);
        return($res);
        
      //echo "$sql <br/>";
      //$post = $this->_db->query($sql);
      //return $post->fetchall();

    }
    



    public function getUresCerrados()
    {
        $sql = "
            SELECT URES,URES||' - '||LURES||'(CERRADO:'||TO_CHAR(FECHA_FIN,'DD/MM/YYYY')||')' AS CAMPO  FROM TURESH H
            WHERE FECHA_FIN IS NOT NULL
            ORDER BY URES
            ";  

        $post = $this->_db->query($sql);
        return $post->fetchall();

    }

    public function getUresAbiertos()
    {
        $sql = "
            SELECT URES,URES||' - '||LURES||'(ABIERTO:'||TO_CHAR(FECHA_INICIO,'DD/MM/YYYY')||')' AS CAMPO  FROM TURESH H
            WHERE FECHA_FIN IS  NULL
            ORDER BY URES
            ";  

        $post = $this->_db->query($sql);
        return $post->fetchall();
        
    }

    public function getNombramientos($anio){
        $sql = "SELECT 
        MOV_ID,
        MOV_TIPO, 
        MOV_FK_NUMPLAZA, 
        MOV_FK_NUMEMPL, 
        MOV_INICIO, 
        DECODE(MOV_FIN, NULL, '--') AS MOV_FIN, 
        PLZ_DENOMINACION

        FROM PLT_MOVIMIENTOS_2 M
        
        LEFT JOIN PLT_PLAZAS P
        ON P.PLZ_PLAZA = M.MOV_FK_NUMPLAZA 
        
        --LEFT JOIN PLT_PUESTOS PTO
        --ON PTO.PTO_ID = M.MOV_FK_NUMPLAZA
        
        WHERE to_char(M.MOV_INICIO,'YYYY') = $anio
        ";

        $post = $this->_db->query($sql);
        return $post->fetchall();
    }

    public function getNombramiento($idNombramiento){
        $sql = "SELECT CIU.*,NOTAS.*,M.*, P.*,C.*,MT.*,PZ.*,U.*,AN.*,NOR.*,AC.*,CL.* , GETDOMICILIO(NUM_EMPL) AS DOMI, GETPREFIJOESTUDIOS(NUM_EMPL) AS PREFIJO, UB.UBI_ABREVIA FROM ( 

                SELECT MOV_ID AS MOV_ID, MOV_FK_NUMEMPL AS NUM_EMPL, MOV_INICIO, TO_CHAR(MOV_INICIO,'YYYY-MM-DD') AS INICIO, TO_CHAR(MOV_FIN,'YYYY-MM-DD') AS FIN, 
                MOV_FK_CATEGORIA AS ID_CATEGORIA, MOV_TIPO AS TIPO,  MOV_OBSERVA AS OBSERVACIONES,
                MOV_FK_NUMPLAZA AS NUMPLAZA, MOV_TEXT AS TEXT, GETPREFIJOESTUDIOS(MOV_FK_NUMEMPL) AS PREFIJO, MOV_DEFINITIVIDAD AS DEFINITIVIDAD
                FROM PLT_MOVIMIENTOS 
                WHERE MOV_ID = $idNombramiento
                ) M
                LEFT JOIN 
                (

                    SELECT 
                    PERS_PERSONA AS VEMP_EMPL,
                    TO_CHAR(PERS_FECHAING,'DD/MM/YYYY') AS FECHAI,
                    PERS_NOMBRE||' '||PERS_APEPAT||' '||PERS_APEMAT AS NOMBREC,
                    TO_CHAR(PERS_FECHANAC,'DD/MM/YYYY') AS FECHANAC,
                    PERS_LUGARNAC as LUGARNAC,
                    N.C_PAIS||DECODE(EM.C_NOMBRE_MIGRATORIO, NULL,'','/'||EM.C_NOMBRE_MIGRATORIO) AS NACION, 
                    DECODE(PERS_SEXO,'M','MASCULINO','F','FEMENINO','-' ) AS SEXO, 
                    PERS_CURP AS CURP,
                    PERS_RFC AS RFC, 
                    ATRE_LUGNAC AS LUGNAC
                FROM FINANZAS.FPERSONAS P

                LEFT JOIN PATREMPL D
                    ON P.PERS_PERSONA = D.ATRE_EMPL
                LEFT JOIN CAT_NACIONALIDADES N 
                    ON N.C_ID_PAIS = P.PERS_NACIONALIDAD
                LEFT JOIN CAT_ESTATUS_MIGRATORIO EM
                    ON EM.C_ID_MIGRATORIO = P.PERS_ESTATUS_MIGRATORIO

                ) P
                ON P.VEMP_EMPL = M.NUM_EMPL

                LEFT JOIN 
                (SELECT ID_CATEGORIA, CATEGORIA FROM NOM_CATEGORIAS) C
                ON C.ID_CATEGORIA = M.ID_CATEGORIA

                LEFT JOIN ( SELECT CMTO_IDCATEGORIA,CMTO_FECHA_INICIO,CMTO_FECHA_FIN,TO_CHAR(MONTO_MENSUAL,'$99,999.00')  AS MONTO_MENSUAL FROM NOM_CATEGORIA_MONTOS WHERE CMTO_IDCONCEPTO=1) MT
                ON MT.CMTO_IDCATEGORIA = M.ID_CATEGORIA AND 
                ( MOV_INICIO>=CMTO_FECHA_INICIO AND MOV_INICIO <= CMTO_FECHA_FIN or  MOV_INICIO>=CMTO_FECHA_INICIO AND CMTO_FECHA_FIN IS NULL )

                LEFT JOIN ( SELECT MPLZ_FK_IDPLAZA AS IDPLAZA, MPLZ_FK_URES AS IDURE,MPLZ_INICIO,MPLZ_FIN,MPLZ_FK_IDUBICA FROM PLT_MPLAZAS ) PZ
                ON 
                IDPLAZA=NUMPLAZA AND 
                ( (M.MOV_INICIO >=PZ.MPLZ_INICIO AND M.MOV_INICIO<= PZ.MPLZ_FIN) 
                OR  (M.MOV_INICIO>=PZ.MPLZ_INICIO AND PZ.MPLZ_FIN IS NULL ) )



                LEFT JOIN 
                ( 
                SELECT H.URES AS IDURE, H.LURES AS URE, P.LURES AS DIRECCION FROM TURESH H
                LEFT JOIN  (SELECT URES, LURES FROM TURESP ) P
                ON H.URESP = P.URES

                ) U
                ON
                U.IDURE = PZ.IDURE


                LEFT JOIN PLT_NOMART_ASIG AN
                ON AN.ASIA_IDCAT = M.ID_CATEGORIA


                LEFT JOIN PLT_NOMART NOR
                ON NOR.NAR_ID = AN.ASIA_IDFUN


                LEFT JOIN (SELECT * FROM PLT_NOMCLAU_ASIG) AC
                ON AC.CLAA_FK_CAT = M.ID_CATEGORIA

                LEFT JOIN (SELECT * FROM PLT_NOMCLAU ) CL
                ON CL.CLAU_ID = AC.CLAA_FK_CLAU


                LEFT JOIN (SELECT NNOTA_FKIDCAT,NNOTA_FKIDNOTA FROM PLT_NOMNOTAS_ASIG) ANOT
                ON ANOT.NNOTA_FKIDCAT = M.ID_CATEGORIA

                LEFT JOIN (SELECT NNOT_ID,NNOT_TEXTO FROM PLT_NOMNOTAS ) NOTAS 
                ON NOTAS.NNOT_ID = ANOT.NNOTA_FKIDNOTA

                LEFT JOIN  (SELECT C.ECIU_CIUDAD  AS IDCNAC, C.ECIU_NOMBRE || ', ' || E.EEST_NOMBRE || ', ' ||P.EPAI_NOMBRE AS CIUDADNAC FROM PECIUDAD C LEFT JOIN PEESTADO E ON C.ECIU_ESTADO = E.EEST_ESTADO LEFT JOIN PEPAIS P ON P.EPAI_PAIS = E.EEST_PAIS) CIU
                ON P.LUGNAC = CIU.IDCNAC

                LEFT JOIN PLT_UBICACIONES UB ON UB.UBI_ID = PZ.MPLZ_FK_IDUBICA

        ";

        // dd( $sql  );
        $post = $this->_db->query($sql);
        return $post->fetch();
    }

    public function getTipoNombramientos(){
        $sql="SELECT TNOM_ID AS ID, TNOM_DENOMINACION AS DENOMINACION FROM PLT_TIPO_NOMBRAMIENTO";
        $post = $this->_db->query($sql);
        return $post->fetchall();
    }

    public function getCategorias(){

        $sql = "SELECT ID_CATEGORIA AS ID, ID_CATEGORIA||'-'||CATEGORIA AS DENOMINACION  FROM NOM_CATEGORIAS";
        $post = $this->_db->query($sql);
        return $post->fetchall();
        
    }

    public function getUres(){
        $sql="SELECT URES, URES||'-'||LURES AS  LURES FROM TURES
                ORDER BY URES ASC";

        $post = $this->_db->query($sql);
        return $post->fetchall();

    }
    
    public function getPlazas(){
        $sql="SELECT PLZ_PLAZA AS PLAZA, PLZ_PLAZA||'-'||PLZ_DENOMINACION AS DENOMINACION 
        FROM PLT_PLAZAS 
        ORDER BY PLZ_PLAZA ASC";

        $post = $this->_db->query($sql);
        return $post->fetchall();

    }    

    public function infoempl($numEmpl){
        $post = $this->_db->query("
                SELECT VEMP_EMPL AS ID,VEMP_NOMBRE, VEMP_APEPAT, VEMP_APEMAT FROM PVEMPLDOS WHERE VEMP_EMPL = '$numEmpl'" 
                );
        return $post -> fetch();    
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
    public function getIdNom(){
        $sql="SELECT DECODE(MAX(MOV_ID),NULL,0,MAX(MOV_ID)) +1 AS ID FROM PLT_MOVIMIENTOS_2";
        $post = $this->_db->query($sql);

        return $post->fetch();
    
    }

    public function putNombramiento($post){
       //print_r($nombramiento);
        try{
        if($post['id'] != ''){
            $idNomb = $post['id'];

            $nombramiento = array(
                ':id' => $post['id'],
                ':numEmpl' => $post['numempl'],
                ':tipo' => $post['tipoNombramiento'],
                ':inicio' => $post['inicio'],
                ':fin' => $post['fin'],
                ':categoria' => $post['categorias'],
                ':ure' => $post['ure'],
                ':sustituye' => $post['sustituye'],
                ':observaciones' => $post['observaicones'],
                ':text' => $post['contenido'],
                ':plaza' => $post['plaza']
            );

            $sql="UPDATE PLT_MOVIMIENTOS_2
            SET MOV_FK_NUMEMPL = :numEmpl  ,
                MOV_TIPO = :tipo,
                MOV_INICIO = TO_DATE(:inicio,'YYYY-MM-DD'),
                MOV_FIN = TO_DATE(:fin,'YYYY-MM-DD'),
                MOV_FK_CATEGORIA = :categoria,
                MOV_FK_URE = :ure,
                MOV_SUSTITUYE =:sustituye,
                MOV_OBSERVA= :observaciones,
                MOV_FK_NUMPLAZA= :plaza,
                MOV_TEXT = :text
            WHERE MOV_ID = :id";
        }else{
            $sqlId="SELECT DECODE(MAX(MOV_ID),NULL,0,MAX(MOV_ID)) +1 AS ID FROM PLT_MOVIMIENTOS_2";
            $idNomb = $this->ssql($sqlId);    
            $idNomb = $idNomb[0][ID]; 

            $nombramiento = array(
                ':id' => $idNomb,
                ':numEmpl' => $post['numempl'],
                ':tipo' => $post['tipoNombramiento'],
                ':inicio' => $post['inicio'],
                ':fin' => $post['fin'],
                ':categoria' => $post['categorias'],
                ':ure' => $post['ure'],
                ':sustituye' => $post['sustituye'],
                ':observaciones' => $post['observaicones'],
                ':text' => $post['contenido'],
                ':plaza' => $post['plaza']
            );

          $sql="INSERT INTO PLT_MOVIMIENTOS_2 (MOV_ID,MOV_FK_NUMEMPL,MOV_TIPO,MOV_INICIO,MOV_FIN,MOV_FK_CATEGORIA,MOV_FK_URE,MOV_SUSTITUYE,MOV_OBSERVA, MOV_FK_NUMPLAZA, MOV_TEXT)
            VALUES (:id,:numEmpl,:tipo,TO_DATE(:inicio,'YYYY-MM-DD'),TO_DATE(:fin,'YYYY-MM-DD'),:categoria,:ure,:sustituye,:observaciones,:plaza,:text)";
        
        }
        $res = $this->ssql($sql,$nombramiento);

        } catch (Exception $e){
            $mensaje["msg"]   = $e->getMessage();
            $mensaje["res"]   = 0;
            return($mensaje);
        }
        
        $mensaje["msg"]   = "guardado";
        $mensaje["idNomb"]   = $idNomb;
        //echo $sql;
        return($mensaje);     
    }

    public function getNombraminetoTexto($id){

        $sql = "SELECT MOV_TEXT AS TEXTO, '20,20,10,20,05,10' AS MARGENES FROM PLT_MOVIMIENTOS_2
        WHERE MOV_ID =$id";

        $post = $this->_db->query($sql);

        return $post->fetch();

    }
}
?>