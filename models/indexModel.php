<?php



class indexModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    


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

}
?>