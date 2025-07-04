<?php



class contratoModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    
    /*

    public function getEdificiosByIdCampus($idCampus)
  { 

    $sqlx = "
    SELECT ES.ID_ESPACIO AS ID, 'Edificio ' || ED.EDIFICIO || ' - ' || ES.DENOMINACION || ' ' || ES.NIVEL  AS NOMBRE 
    FROM SAU_ESPACIOS ES
    LEFT JOIN SAU_EDIFICIOS ED
    ON ES.ID_EDIFICIO = ED.ID_EDIFICIO
    WHERE ES.STATUS = 1 AND ID_CAMPUS = $idCampus
    ORDER BY NOMBRE ASC";

    $sql = "
    SELECT ED.ID_EDIFICIO ID, 'Edificio: ' || EDIFICIO ||' - ' || DENOMINACION  AS NOMBRE 
    FROM SAU_EDIFICIOS ED
    WHERE STATUS = 1 AND ID_CAMPUS = $idCampus
    ORDER BY DENOMINACION DESC
    ";



    $edificios = $this->ssql($sql);
    return $edificios;
}



function getDatosUsuario2($idUsuario)
{
    $sql = "

   

        SELECT *  FROM VW_ESTUDIANTES WHERE MATRICULA = '19-25172' 

        -- SELECT * FROM SAU_SOLICITUDES WHERE SOL_NUM_EMPLDO = '691'


    
    ";
    $datos = $this->ssql($sql);
    return $datos;
}


    function getDatosUsuario($idUsuario)
    {
        $sql = "

            SELECT NUMEMPL,NOMBRE,APPATERNO,APMATERNO,TO_CHAR(IDUREH) AS IDUREH,NURESH,IDUREP,NURESP,
            IDUBICA,UBICACION,IDTIPOP,TIPOP,TELEFONO,CORREOI FROM VP_PLANTILLA_BASICA WHERE NUMEMPL= '$idUsuario'
            UNION ALL

			SELECT *  FROM (
			SELECT MATRICULA AS NUMEMPL,NOMBRE,A_PATERNO,A_MATERNO,
			PROGACAD AS IDUREH, NM_PROGACAD AS  NURESH,0 AS IDUREP,'' AS NURESP,0 AS IDUBICA,NM_CAMPUS AS UBICACION,
            4 AS IDTIPOP,'Alumno' AS TIPOP,
            '' AS TELEFONO,replace(MATRICULA,'-','')||'@uqroo.mx' AS CORREOI
            
			FROM 
			VW_ESTUDIANTES WHERE MATRICULA = '$idUsuario' )

            UNION ALL
            SELECT * FROM (  
SELECT 'NR'||INV_ID as  NUMEMPL,INV_NOMBRE AS NOMBRE, INV_APPATERNO AS APPATERNO,INV_APMATERNO AS APMATERNO,
'' AS IDUREH,'' AS NURESH,0 AS IDUREP,
'' AS NURESP,0 AS IDUBICA,'' AS UBICACION,0 AS IDTIPOP,
'' AS TIPOP,'' AS TELEFONO,INV_CORREO AS CORREOI 
FROM SAU_INVITADOS 
)

WHERE NUMEMPL = '$idUsuario'
        
        ";
        $datos = $this->ssql($sql);
        return $datos;
    }

    function getUres()
    {
        $sql = "
        
        SELECT TO_CHAR(URESH) AS IDURE, URESH||' - '||NURESH AS URE FROM SISRH.VP_URES WHERE ACTIVO = 1 
        UNION ALL
        SELECT PROG_ID AS IDURE, PROG_NOMBRE AS URE
        FROM 
        SAU_PROGRAMAS
        
        ";
        $ures = $this->ssql($sql);
        return $ures;
    }

    function getEdificios()
    {
        $sql = "SELECT ES.ID_ESPACIO AS ID, 'Edificio ' || ED.EDIFICIO || ' - ' || ES.DENOMINACION || ' ' || ES.NIVEL  AS NOMBRE FROM SAU_ESPACIOS ES
        LEFT JOIN SAU_EDIFICIOS ED
        ON ES.ID_EDIFICIO = ED.ID_EDIFICIO
        WHERE ES.STATUS = 1
        ORDER BY NOMBRE ASC";
        $edificios = $this->ssql($sql);
        return $edificios;
    }

    function getCampus()
    {
        $sql = "SELECT UBI_ID AS ID, ubi_denominacion AS NOMBRE FROM PLT_UBICACIONES ORDER BY ubi_denominacion ASC";
        $ures = $this->ssql($sql);
        return $ures;
    }

    function getCampusById()
    {
        $sql = "SELECT C.ID_CAMPUS, C.SHORTNAME, CA.ID_AREA FROM SAU_CAMPUS_X_AREAS CA
        LEFT JOIN SAU_CAMPUS C
        ON C.ID_CAMPUS = CA.ID_CAMPUS
        WHERE C.ACTIVO = 1
        ORDER BY C.ID_CAMPUS ASC";
        $ures = $this->ssql($sql);
        return $ures;
    }

    function getAreas()
    {
        $sql = "SELECT A_ID, U.NURESP, A_DENOMINACION AS AREA, A_DESCRIPCION, A_VISITA FROM SAU_AREAS
        LEFT JOIN SISRH.VP_URES U
        ON A_URE = U.URESH
        ORDER BY U.NURESH ASC";
        $acceso = $this->ssql($sql);
        return $acceso;
    }

    function areasHasForm($idarea)
    {
        $sql = "SELECT CASE WHEN EXISTS (SELECT * FROM FORM WHERE ID_AREA = $idarea AND ACTIVO = 1) THEN 1 ELSE 0 END AS FLAG FROM DUAL";
        $flag = $this->ssql($sql);
        return $flag[0]['FLAG'];
    }
    
    function getServicios($idArea)
    {
        $sql = "SELECT SRV_ID AS ID, SRV_DENOMINACION AS S FROM SAU_SERVICIOS WHERE SRV_DISPONIBLE = 1 AND SRV_IDAREA = $idArea";
        $r = $this->ssql($sql);
        return $r;
    }
    
    function getTutoriales($busqueda)
    {
        $sql = "SELECT C_TITULO AS T, C_DESCRIPCION AS D, C_URL AS U 
            FROM BDC_CONTENIDOS
            WHERE INSTR(C_KEYWORDS, '$busqueda[0]') > 0 ";

        if (count($busqueda) == 1) {
            $tutoriales = $this->ssql($sql);
        } else {
            foreach ($busqueda as $key => $tuto) {
                $sql .= "OR INSTR(C_KEYWORDS, '$tuto') > 0 ";
            }
            $tutoriales = $this->ssql($sql);
        }

        return $tutoriales;
    }
    
    function setSolicitud($noctrl, $idCampus, $idarea, $asunto, $detalles, $archivo,$nombreArchivo, $fechaSolicitud, $rol, $depa, $campus, $correo, $telefono, $edificio, $fechayhora, $arrayFormulario)
    {
        $sql = "SELECT LLAVE_SOLICITUDES.NEXTVAL AS ID FROM DUAL";
        $idSolicitud = $this->ssql($sql);
        $idSolicitud = $idSolicitud[0]['ID'];

        //Subir archivo para obtener la ruta y guardarla en la solicitud
        if (empty($archivo['name'])) {
            $ruta = '';
        } else {
            $ruta = md5($idSolicitud) . '/' . $nombreArchivo;
        }

        if ($edificio=="undefined")
        {
            $edificio=0;
        }

        $array = array(':asunto' =>trim($asunto) , ':detalles' =>trim($detalles) );

        $sql = "
        INSERT INTO SAU_SOLICITUDES 
        (SOL_ID, SOL_NUM_EMPLDO, SOL_DENOMINACION, SOL_FECHA_REG, SOL_STATUS, SOL_DESCRIPCION, SOL_ARCHIVO, SOL_IMPORTANCIA, SOL_FECHA_SOL, SOL_URE, SOL_ENVIO, SOL_CORREO_EMPLDO, SOL_TELEFONO_EMPLDO, SOL_ID_AREA, SOL_CAMPUS_EMPLDO, SOL_IDTIPOP_EMPLDO, SOL_ID_EDIFICIO_VISITA_EMPLDO, SOL_HORA_VISITA_EMPLDO, SOL_ID_CAMPUS) 
        VALUES ($idSolicitud, '$noctrl', :asunto, SYSDATE, 1, :detalles , '$ruta', 1, TO_TIMESTAMP('$fechaSolicitud', 'DD/MM/YYYY HH24:MI:SS') , '$depa', 0, '$correo', '$telefono', $idarea, $campus, $rol, $edificio, '$fechayhora', $idCampus)";
        $insertSol = $this->ssql($sql,$array);

        $status = array();
        //Insertar formulario de solicitud
        foreach ($arrayFormulario as $key => $datos) {
            $sql = "SELECT LLAVE_RESP_FORM.NEXTVAL AS ID FROM DUAL";
            $nextid = $this->ssql($sql);
            $nextid = $nextid[0]['ID'];
            $datos[0] = intval($datos[0]);

            $respuesta = $datos[1];

            //convertir $datos[1] en string separado por comas si es un array
            if (gettype($datos[1]) == "array")
                $respuesta = implode(',', $datos[1]);
            


            //formatear string
            $respuesta = addslashes($respuesta);
            $respuesta = str_replace("\n", "<br/>", $respuesta);


            $sql = "INSERT INTO FORM_RESPUESTAS (ID_RESPUESTAS, ID_REACTIVO, RESPUESTA, ID_SOLICITUD) 
                VALUES ($nextid, " . $datos[0] . ", '" . $respuesta . "', $idSolicitud)";
            $r = $this->ssql($sql);
            $status .= $key;
        }

        $response = array();
        $response['idsol'] = $idSolicitud;
        $response['ok'] = true;
        
        return $response;
    }

    function setRespuestaForm($idReactivo,$respuesta,$idSolicitud)
    {

        $sql = "SELECT LLAVE_RESP_FORM.NEXTVAL AS ID FROM DUAL";
        $nextid = $this->ssql($sql);
        $nextid = $nextid[0]['ID'];
    

        $sql = "INSERT INTO FORM_RESPUESTAS (ID_RESPUESTAS, ID_REACTIVO, RESPUESTA, ID_SOLICITUD) 
            VALUES ($nextid, " . $idReactivo . ", '" . $respuesta . "', $idSolicitud)";
        $r = $this->ssql($sql);
        $status .= $key;

    }

    
    function getForm($idArea)
    {
        // Consulta SQL para obtener información sobre un formulario basado en el ID del área.
        $sql = "SELECT ID_FORM, TEXT_HEADER, TEXT_FOOTER FROM FORM WHERE ID_AREA = $idArea AND ACTIVO = 1";
        $form = $this->ssql($sql); // Ejecuta la consulta SQL y almacena el resultado en la variable $form.

        if (isset($form[0])) {
            // Si se encontró al menos un formulario para el área especificada, procede con la obtención de detalles adicionales.

            // Consulta SQL para obtener los reactivos relacionados con el formulario.
            $sql = "SELECT ID_REACTIVO, DENOMINACION, ANCHO, PLACEHOLDER, REQUERIDO, MAXLENGTH, ID_TIPO, ID_REACTIVO_PADRE, ID_PADRE_SHOW FROM FORM_REACTIVOS WHERE ID_FORM = " . $form[0]['ID_FORM'] . " AND ACTIVO = 1 ORDER BY ORDEN ASC";
            $reactivos = $this->ssql($sql); // Ejecuta la consulta SQL y almacena el resultado en la variable $reactivos.

            $arrayFormulario = null; // Inicializa un array vacío para almacenar los datos del formulario.
            $arrayFormulario[0]['ID_FORM'] = $form[0]['ID_FORM'];
            $arrayFormulario[0]['TEXT_HEADER'] = $form[0]['TEXT_HEADER'];
            $arrayFormulario[0]['TEXT_FOOTER'] = $form[0]['TEXT_FOOTER'];

            foreach ($reactivos as $idReactivo => $reactivo) {
                $idReactivo++;
                // Recorre los reactivos obtenidos y procesa cada uno.

                if ($reactivo['ID_TIPO'] == 3 || $reactivo['ID_TIPO'] == 4 || $reactivo['ID_TIPO'] == 5 || $reactivo['ID_TIPO'] == 6) {
                    // Si el tipo de reactivo es 3, 4, 5 o 6, se trata de un reactivo de opciones múltiples.

                    // Consulta SQL para obtener la suma de órdenes de opciones múltiples relacionadas con el reactivo.
                    $sql = "SELECT SUM(ORDEN) AS ORDEN FROM FORM_OPCIONES_MULTIPLES WHERE ID_REACTIVO = " . $reactivo['ID_REACTIVO'];
                    $flagOrden = $this->ssql($sql); // Ejecuta la consulta SQL y almacena el resultado en la variable $flagOrden.

                    // Consulta SQL para obtener las opciones múltiples relacionadas con el reactivo.
                    $sql = "SELECT ID_OPCION_MULTIPLE, DENOMINACION FROM FORM_OPCIONES_MULTIPLES WHERE ID_REACTIVO = " . $reactivo['ID_REACTIVO'] . " ORDER BY ";
                    if ($flagOrden[0]['ORDEN'] == 0)
                        $sql .= "DENOMINACION ASC";
                    else
                        $sql .= "ORDEN ASC";

                    $opciones = $this->ssql($sql); // Ejecuta la consulta SQL y almacena el resultado en la variable $opciones.

                    // Almacena las opciones múltiples en el arrayFormulario.
                    $arrayFormulario[$idReactivo]['opciones'] = $opciones;
                }
                $arrayFormulario[$idReactivo]['reactivo'] = $reactivo;
            }

            return $arrayFormulario; // Devuelve el arrayFormulario con los datos del formulario y reactivos.
        } else {
            // Si no se encontró ningún formulario para el área especificada, devuelve falso.
            return false;
        }
    }
    */

    public function getTiposContratos()
    { 
        $sql = "SELECT * FROM CNT_TIPOCONT WHERE TCNT_STATUS=1";
        $res = $this->ssql($sql);
        return $res;
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

    public function getCategoriasContrato($id=2)
    { 
        $sql = "SELECT CAT_ID AS ID_CATEGORIA,CAT_DENOMINA_MAS AS CATEGORIA FROM CNT_CATEGORIAS --WHERE CAT_CLASIFICA = $id";
        $res = $this->ssql($sql);
        return $res;
    }
    public function getUA()
    { 
        $sql = "SELECT * FROM CNT_UACADEMICAS WHERE UA_STATUS=1";
        $res = $this->ssql($sql);
        return $res;
    }
    public function getUbicaciones(){
        $sql = "SELECT UBI_ID,UBI_DENOMINACION FROM PLT_UBICACIONES";
        $res = $this->ssql($sql);
        return $res;
    }
    /*public function getListURES($idSel=""){
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
    }*/

    public function getListURES($idSel = ""){
        $sql = "SELECT URES AS ID, DECODE(FECHA_FIN, NULL, (URES || ' - ' || LURES), (URES || ' - ' || LURES || '(CERRADO)')) AS DENOMINA, URESP AS IDP 
                FROM TURESH 
                WHERE fecha_fin IS NULL 
                ORDER BY URES ASC";
        
        // Se obtiene el array de resultados a través de la función ssql.
        $row = $this->ssql($sql);
        
        $option = "";
        foreach ($row as $fila) {
            $sel = ($idSel == $fila["ID"]) ? " selected " : "";
            if (($fila["IDP"] == "114000" && strpos($fila["DENOMINA"], "DEPARTAMENTO") === false 
                 && strpos($fila["DENOMINA"], "TRANSPARENCIA") === false) || $fila["ID"] == "114000") {
                $c = "»";
            } else {
                $c = "&nbsp;&nbsp;";
            }
            $option .= '<option value="' . $fila["ID"] . '" ' . $sel . '>' . $c . ' ' . $fila["DENOMINA"] . '</option>';
        }
        return $option;
    }

    public function getpersonas($palabra)
    {
        // Definimos la consulta SQL inicial para obtener el ID y el texto de las personas.
        $sql = 'SELECT VEMP_EMPL AS "id", VEMP_EMPL || \' - \' || VEMP_NOMBRE || \' \' || VEMP_APEPAT || \' \' || VEMP_APEMAT AS "text" FROM PVEMPLDOS';
        /*$sql = 'SELECT p.pers_persona AS "id", '
            . '       p.pers_persona || \' - \' || p.pers_nombre || \' \' || p.PERS_APEPAT || \' \' || p.PERS_APEMAT AS "text" '
            . 'FROM   finanzas.fpersonas p';*/

        // Convertimos la palabra de búsqueda a mayúsculas para hacer la búsqueda insensible a mayúsculas/minúsculas.
        $palabra = strtoupper($palabra);

        // Dividimos la palabra de búsqueda en partes (palabras individuales) utilizando el espacio como delimitador.
        $partes = explode(" ", $palabra);

        // Inicializamos la condición WHERE.
        $condicion = "";

        // Iteramos a través de cada parte de la palabra de búsqueda para construir la condición.
        foreach ($partes as $key => $parte) {
            // Si no es la primera parte, agregamos un "AND" para combinar las condiciones.
            if ($key > 0) {
                $condicion .= "AND ";
            }
            // Construimos la condición LIKE para buscar la parte actual de la palabra en el texto (sin acentos).
            $condicion .= "(translate(upper(\"text\"), 'ÁÉÍÓÚÑ', 'AEIOUN')) LIKE :parte_$key ";
        }

        // Construimos la consulta SQL final, incluyendo la condición WHERE.
        $sql = "SELECT \"id\", \"text\" FROM ( $sql ) T WHERE $condicion";

        // Preparamos los parámetros para la consulta. Esto es importante para prevenir la inyección SQL.
        $params = [];
        foreach ($partes as $key => $parte) {
            $params[":parte_$key"] = '%' . $parte . '%';
        }

        // Ejecutamos la consulta SQL utilizando la función ssql y los parámetros preparados.
        $res = $this->ssql($sql, $params);

        // Opcional: Puedes descomentar esta línea si necesitas convertir las claves del array resultante a minúsculas.
        // $res = array_change_key_case($res, CASE_LOWER );

        // Devolvemos el resultado de la consulta.
        return $res;
    }
    
    public function getInfoempl($numempl){
        $sql = "
            SELECT 
                VEMP_NOMBRE, 
                VEMP_APEPAT, 
                VEMP_APEMAT 
            FROM PVEMPLDOS 
            WHERE VEMP_EMPL = '{$numempl}'
        ";
        $res = $this->ssql($sql,null,1);
        return $res;
    }


    public function getestudios($numempl){
        $sql = "
            SELECT 
                ENIV_DESCRIP AS GRADO,
                ESCU_NOMBRE  AS INSTITUTO,
                TO_CHAR(EGRA_FOBGRADO,'DD/MM/YYYY')   AS TITULO,
                ECAR_NOMBRE
                  || DECODE(ECAR_ESPECIALIDAD, NULL, '', '-')
                  || ECAR_ESPECIALIDAD                AS CARRERA,
                EGRA_CEDULA                          AS NUM_CEDULA,
                TO_CHAR(EGRA_FEXPCDLA,'DD/MM/YYYY')  AS FECHA_CEDULA
            FROM PEGRADOACAD P
            LEFT JOIN PENIVELACAD A ON P.EGRA_GRADO   = A.ENIV_GRADO
            LEFT JOIN PECARRERAS  C ON P.EGRA_CARRERA = C.ECAR_CARRERA
            LEFT JOIN PEDESCU     PE ON P.EGRA_ESCU    = PE.EDES_ID
            LEFT JOIN PESCUELAS   E  ON PE.EDES_ESCU   = E.ESCU_ESCU
            WHERE EGRA_PERSONA = '{$numempl}'
        ";
        return $this->ssql($sql, null, 2);
    }
    
    public function getPlantillasByTipo($id){
        $sql = "
            SELECT *
            FROM CNT_PLANTILLAS
            WHERE PLT_STATUS   = 1
              AND PLT_FK_ID_CNT = '{$id}'
        ";
        return $this->ssql($sql, null, 2);
    }

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
            $SQL = "SELECT LURES AS INFO FROM CNT_CONTRATOS C
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
        $row  = $post->fetch(PDO::FETCH_ASSOC);

        return isset($row['INFO']) ? $row['INFO'] : '';
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
    
    public function getInfoPlantilla($info, $numEmpl){
        if($info=="categoria")
            $SQL = "SELECT CATEGORIA AS INFO FROM VPLANTILLA WHERE NUM_EMPL = '$numEmpl'";
        if($info=="ure" or $info=="ures_del_dela")
            $SQL = "SELECT URE AS INFO FROM VPLANTILLA WHERE NUM_EMPL = '$numEmpl'"; 
        $post = $this->_db->query($SQL); 
        $row  = $post->fetch(PDO::FETCH_ASSOC);

        return isset($row['INFO']) ? $row['INFO'] : '';
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

    public function getURE($idusr)
    {
        $sql = "SELECT UA_ID AS IDURE, UA_DENOMINACION AS UA, UA_CLAVE AS CLAVE FROM CNT_UACADEMICAS U
                WHERE UA_ID = '$idusr'";
        $res = $this->_db->query($sql,null,1); 
        $row = $res->fetch();
        return($row);
    }

    public function putContratos($post){
        // Evitar 'undefined index' en estos campos
        $post = array_merge([
            'numempl'  => '',
            'deptosae' => '',
            'per'      => '',
            'da'       => '',
            // si salen más notices, añádelos aquí con valor ''
        ], $post);
        
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

    public function getIdUAByClave($clave)
    { 
        $sql = "SELECT UA_ID FROM CNT_UACADEMICAS WHERE UA_CLAVE = '$clave'";
        $res = $this->_db->query($sql);
        $row = $res->fetch();
        return ($row["UA_ID"]);
    }

    public function delContrato($claveNum, $anio, $numC)
    {
        $sql = "
        DELETE FROM CNT_CONTRATOS
        WHERE CNT_PK_ANIO     = :anio
            AND CNT_PK_CONTRATO = :numC
            AND CNT_PK_UA       = :claveNum
            AND ROWNUM          = 1
        ";

        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->execute([
                ':anio'     => $anio,
                ':numC'     => $numC,
                ':claveNum' => $claveNum,
            ]);

            // Si llegamos aquí, el DELETE se ejecutó sin errores
            return [
                'code' => 1,
                'msg'  => 'Contrato eliminado correctamente',
            ];

        } catch (PDOException $e) {
            // Cualquier fallo de prepare/execute cae aquí
            return [
                'code' => 0,
                'msg'  => 'Error al eliminar: ' . $e->getMessage(),
            ];
        }
    }

    public function getDA()
    { 
        $post = $this->_db->query("SELECT * FROM CNT_DA WHERE DA_STATUS=1");
        return $post->fetchall();
    }

    public function getTestigos(){
        $sql = "SELECT TES_ID,TES_NOMBRE || ' - ' || TES_CARGO AS TES_NOMBRE FROM CNT_TESTIGOS WHERE TES_STATUS=1";
        $res = $this->_db->query($sql); 
        $row = $res->fetchall();
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

    public function get_empleado($id)
    {
        $sql = 'SELECT VEMP_EMPL AS "id", VEMP_EMPL || \' - \' || VEMP_NOMBRE || \' \' || VEMP_APEPAT || \' \' || VEMP_APEMAT AS "text" FROM PVEMPLDOS';
        $res  = $this->ssql("SELECT \"id\",\"text\" FROM ( ".$sql.") T WHERE \"id\" = :id AND ROWNUM = 1 " ,array(":id"=>$id),1);

        return($res);
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
    

}
?>