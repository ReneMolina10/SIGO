<?php



$tablas["p"] = [
    'nom' => "DOC_MINUTA",
    'id' => "MIN_ID",
    'getId' => "SELECT (MAX(MIN_ID)+1) AS ID FROM DOC_MINUTA"
];



$bd = array(
    'sqlDeplegar' => 'SELECT
    MIN_ID AS ID,
    MIN_PROCESO AS PROCESO,
    MIN_FOLIO AS FOLIO,
    MIN_FECHA AS FECHA,
    MIN_HINICIO AS HINICIO,
    MIN_HFIN AS HFIN,
    MIN_LUGAR AS LUGAR,
    MIN_FK_AREAS_PARTICIPA AS AREAS_PARTICIPA,
    STATUS_DOC,


    

   CASE
    -- 1. Sin firmantes
    WHEN (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID) = 0 THEN
        \'<a style="display:inline-block;min-width:100px;background:#dc3545;color:#fff;border:none;padding:6px 12px;border-radius:4px;text-align:center;font-size:1em;word-break:break-word;" class="btn btn-danger btn-block" disabled>Sin Firmantes</a>\'
    -- 2. Ya se solicitó la firma (FOLIO_DOC no es null) y todos firmaron
    WHEN FOLIO_DOC IS NOT NULL AND
         (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID AND F.FIR_STATUS_FIRMANTE_DOC = 3) =
         (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID)
    THEN
        \'<a href="' . BASE_URL . 'viewminuta/prefirmado/\'|| MD5(MIN_ID||\'_minuta\') ||\'" target="_blank">
            <div style="background:#007bff;color:#fff;border:none;padding:6px 12px;border-radius:4px;text-align:center;">
                \' ||
                (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID) || \'/\' ||
                (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID) || \' Completado
            </div>
        </a>\'
    -- 3. Ya se solicitó la firma (FOLIO_DOC no es null) pero faltan firmas
    WHEN FOLIO_DOC IS NOT NULL THEN
        \'<a href="' . BASE_URL . 'viewminuta/prefirmado/\'|| MD5(MIN_ID||\'_minuta\') ||\'" target="_blank">
            <div style="background:#ffc107;color:#212529;border:none;padding:6px 12px;border-radius:4px;text-align:center;">
                \' ||
                (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID AND F.FIR_STATUS_FIRMANTE_DOC = 3) || \'/\' ||
                (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID) || \' Firmantes
            </div>
        </a>\'
    -- 4. Hay firmantes y aún no se ha solicitado la firma
    ELSE
        \'<a href="' . BASE_URL . 'viewminuta/prefirmado/\'|| MD5(MIN_ID||\'_minuta\') ||\'" target="_blank">
            <div style="background:#28A745;color:#FFFFFF;border:none;padding:6px 12px;border-radius:4px;text-align:center;">
                Solicitar Firmas
            </div>
        </a>\'
END AS FIRMANTES

    FROM DOC_MINUTA ORDER BY MIN_ID DESC
    ',

    'columnas' => array(
        array('campo' => 'ID', 'width' => '2%'),
        array('campo' => 'PROCESO', 'width' => '30%'),
        array('campo' => 'FOLIO', 'width' => '10%'),
        array('campo' => 'LUGAR', 'width' => '10%'),

        // array('campo' => 'PDF_EXTERNO', 'width' => '5%'),
        // array('campo' => 'PDF_INTERNO', 'width' => '5%'),

        array('campo' => 'FIRMANTES', 'width' => '10%'),
        /*array(
            'campo' => 'STATUS_DOC',
            'status_style' => array(
                array('value' => '0', 'background_color' => '#6c757d', 'text_color' => 'white', 'text' => 'Sin Estatus', ),
                array('value' => '2', 'background_color' => '#007bff', 'text_color' => 'white', 'text' => 'En Proceso'),
                array('value' => '3', 'background_color' => '#28a745', 'text_color' => 'white', 'text' => 'Finalizado'),
            ),
        ),*/
    ),

    'idDeplegar' => 'ID',
    'idFiltro' => 'MIN_ID',
    'busqLike' => '',
    'busqIgual' => '',
    'nomPlural' => 'Minutas',
    'nomSingular' => 'Minutas',

    'btnOpciones' => array(
        'editar' => array(
            'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
        ),
        'detalles' => true,
        'duplicar' => false,
        'eliminar' => array(
            'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
        ),
    ),
    'cssEditar' => ''
);
$partes = explode('/', $_SERVER['REQUEST_URI']);
$pos = 0;
foreach ($partes as $key => $fila) {
    if ($fila == "editar_modal")
        $pos = $key;
}

if ($pos == 0) {
    $idFiltro = 0;
} else {
    $idFiltro = $partes[$pos + 1];
}



// Configuración del formulario para crear/editar registros
$form = array(

    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'MIN_ID',
        'tipo' => 'oculto',
        //'tabla' => 'p'
    ),




    array('etiq' => '</div>'),
    array('etiq' => '<h5 style="font-weight:bold; color:#28a745; margin-top:20px; margin-bottom:10px;">Información General</h5>'),
    array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),
    array('etiq' => '<div class="row">'),




    array(
        'col' => 'col-md-8',
        'campo' => 'MIN_PROCESO',
        'tipo' => 'text',
        'holder' => 'Proceso',
        'label' => 'Proceso',
        'tabla' => 'p',
        'required' => 'true',
    ),
    array(
        'col' => 'col-md-4',
        'campo' => 'MIN_FOLIO',
        'tipo' => 'text',
        'holder' => 'Folio',
        'label' => 'No./Folio (interno)',
        'tabla' => 'p',
        'required' => 'true',
    ),

    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-md-3',
        'campo' => 'MIN_FECHA',
        'tipo' => 'date',
        'holder' => 'Fecha',
        'label' => 'Fecha',
        'tabla' => 'p',
        'value' => date('Y-m-d'),
    ),
    array(
        'col' => 'col-md-3',
        'campo' => 'MIN_HINICIO',
        'tipo' => 'time',
        'holder' => 'Hora de Inicio',
        'label' => 'Hora de Inicio',
        'tabla' => 'p',
        'value' => date('H:i'),
    ),
    
    array(
        'col' => 'col-md-3',
        'campo' => 'MIN_HFIN',
        'tipo' => 'time',
        'holder' => 'Hora de Fin',
        'label' => 'Hora de Fin',
        'tabla' => 'p',
        'value' => date('H:i', strtotime('+1 hour')),
    ),

    array(
        'col' => 'col-md-3',
        'campo' => 'MIN_LUGAR',
        'tipo' => 'text',
        'holder' => 'Lugar',
        'label' => 'Lugar',
        'tabla' => 'p',
        'value' => 'CTIC'
    ),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),

    // Selección de áreas participantes
    // Esta sección utiliza un dual listbox para seleccionar múltiples áreas
    array(
        'col' => 'col-md-12',
        'campo' => 'MIN_FK_AREAS_PARTICIPA', //Id (name) con el que se nombrará en el formulario, no debe repetirse.
        'tipo' => 'dual_listbox',
        'class' => 'select2',
        'id_local' => 'MIN_ID',//Tabla origen
        'tabla_g' => 'DOC_FIR_AREAS_PARTICIPA', //nombre de la tabla en donde quieres guardar 
        'id_tabla_g' => 'ID_FK_MINUTA', //nombre de la columna en donde se guarda el id del registro
        'valor_tabla_g' => 'ID_URE_PAR', //nombre de la columna en la tabla donde se el valor de la opcion del check

        'datosSQL' => "SELECT URES AS ID, URES || '-' ||LURES AS CAMPO FROM SISRH.TURESH WHERE FECHA_FIN IS NULL AND ESTATUS ='1'",
        'label' => 'Áreas participantes',
    ),

    array('etiq' => '</div>'),


    //**------------------------------------------------------------------------------------------------------------------------ */

    //*TABLA CRUD PARA ASUNTOS*//
    array(

        'name_crud_table' => 'DOC_MIN_ASUNTO',
        'tipo' => 'crud-table',
        'label' => 'Asuntos',
        'col' => 'col-12',

        // 1) Campos del formulario del sub‐Generator
        'form' => array(

            array('etiq' => '<div class="row">'),
            array(
                'col' => 'col-md-6',
                'campo' => 'ASU_TEMA',
                'tipo' => 'text',
                'holder' => 'Escriba el tema del asunto',
                'label' => 'Tema',
                'tabla' => 'p'
            ),

            array(
                'col' => 'col-md-6',
                'campo' => 'ASU_PRESENTA',
                'tipo' => 'select',
                'class' => 'select2',
                'datosSQL' => "SELECT ID_URE_PAR AS ID, ID_URE_PAR||' - '||LURES AS CAMPO FROM DOC_FIR_AREAS_PARTICIPA 
                        LEFT JOIN TURESH ON URES = ID_URE_PAR
                        WHERE ID_FK_MINUTA= $idFiltro",
                'holder' => 'Presenta el asunto',
                'label' => 'Área que presenta',
                'tabla' => 'p'
            ),

            array(
                'col' => 'col-md-12',
                'campo' => 'ASU_RESUMEN',
                'tipo' => 'textarea',
                'holder' => 'Resumen del asunto',
                'label' => 'Resumen del asunto',
                'tabla' => 'p',
                'alto' => '150px',
                'max' => '4000',
                //'encrypt' => true,
            ),
            array(
                'campo' => 'ASU_ID',
                'tipo' => 'oculto',
            ),
            array(
                'campo' => 'ASU_FK_MINUTA',
                'tipo' => 'oculto',
                'value' => '[IDPADRE]'
            ),
            array('etiq' => '</div>'),
        ),

        // 2) Definición de tablas del sub‐Generator
        'tablas' => array(
            'p' => array(
                'nom' => "DOC_MIN_ASUNTO",
                'id' => "ASU_ID",
                'getId' => "SELECT (MAX(ASU_ID)+1) AS ID FROM DOC_MIN_ASUNTO",
                'tRel' => 'h',          // índice de tabla padre en $tablas principal
                'cRel' => 'ASU_FK_MINUTA'     // FK al registro padre
            )
        ),

        // 3) Parámetros de BD (listado, columnas, botones…) del sub‐Generator
        'bd' => array(
            'sqlDeplegar' => "SELECT 
                                    ASU_ID AS ID,
                                    ASU_TEMA AS TEMA,
                                    ASU_PRESENTA||' - '||LURES AS PRESENTA,
                                    ASU_RESUMEN as RESUMEN,
                                    ASU_FK_MINUTA,
                                    DM.STATUS_DOC AS STATUS_DOC
                                    FROM DOC_MIN_ASUNTO DA
                                    LEFT JOIN DOC_MINUTA DM ON DM.MIN_ID = DA.ASU_FK_MINUTA
                                    LEFT JOIN TURESH ON URES = ASU_PRESENTA
                                    WHERE ASU_FK_MINUTA = [IDPADRE]
                                    ORDER BY ASU_ID DESC
                                    ",
            'idDeplegar' => 'ID',
            'busqLike' => '"ID"',
            'busqIgual' => '"ID"',
            'nomPlural' => 'Asuntos',
            'nomSingular' => 'Asunto',

            

            //* Parámetros de la tabla
            'bPaginate' => false,       // o true
            'bFilter' => false,         // o true
            'bInfo' => false,           // o true
            'mostrarTfoot' => false, // o true


            'columnas' => array(
                array('campo' => 'ID', 'width' => '5%'),
                array('campo' => 'TEMA', 'width' => '15%'),
                array('campo' => 'PRESENTA', 'width' => '25%'),
                array('campo' => 'RESUMEN', 'width' => '50%'),
                array('campo' => 'OPCIONES', 'width' => '5%'),

            ),
            'btnOpciones' => array(
                'editar' => array(
                    'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
                ),
                'detalles' => false,
                'duplicar' => false,
                'eliminar' => array(
                    'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
                ),
            )  // usa los botones por defecto
        ),
        'template' => [
            'editForm' => 'modal',
            //'btnRegistrar' => false,
        ],


    ),

    //**------------------------------------------------------------------------------------------------------------------------ */


    //* TABLA CRUD PARA ACUERDOS*//

    array(
        'name_crud_table' => 'DOC_MIN_ACUERDOS',
        'tipo' => 'crud-table',
        'label' => 'Acuerdos',
        'col' => 'col-12',



        // 1) Campos del formulario del sub‐Generator
        'form' => array(
            array('etiq' => '<div class="row">'),
            array(
                'col' => 'col-md-5',
                'campo' => 'ACU_RESPONSABLE',
                'tipo' => 'select',
                'datosSQL' => "SELECT ID_URE_PAR AS ID, ID_URE_PAR||' - '||LURES AS CAMPO FROM DOC_FIR_AREAS_PARTICIPA 
                        LEFT JOIN TURESH ON URES = ID_URE_PAR
                        WHERE ID_FK_MINUTA= $idFiltro",
                'holder' => 'Responsable del acuerdo',
                'label' => 'Responsable del acuerdo',
                'tabla' => 'p'
            ),

            array(
                'col' => 'col-md-5',
                'campo' => 'ACU_FK_ASUNTO',
                'tipo' => 'select',
                'datosSQL' => "SELECT ASU_ID AS ID, ASU_TEMA AS CAMPO FROM DOC_MIN_ASUNTO 
                       WHERE ASU_FK_MINUTA= $idFiltro",
                'placeholder' => 'Asunto',
                'label' => 'Asunto',
                'tabla' => 'p'
            ),

            array(
                'col' => 'col-md-2',
                'campo' => 'ACU_FECHA_FIN',
                'tipo' => 'date',
                'placeholder' => 'Fecha de finalización',
                'label' => 'Fecha de finalización',
                'tabla' => 'p',
                'value' => date('Y-m-d')
            ),

            array('etiq' => '</div>'),
            array('etiq' => '<div class="row">'),
            array(
                'col' => 'col-md-12',
                'campo' => 'ACU_DESCRIPCION',
                'tipo' => 'textarea',
                'holder' => 'Descripción del acuerdo',
                'label' => 'Descripción',
                'tabla' => 'p',
                'alto' => '200px', //agregar px si no, no funciona
                'max' => '1000',
                //'encrypt' => true, // Si se requiere cifrado
            ),

            array(
                'campo' => 'ACU_ID',
                'tipo' => 'oculto',
            ),

            array(
                'campo' => 'ACU_FK_MINUTA',
                'tipo' => 'oculto',
                'value' => '[IDPADRE]'
            ),

            array('etiq' => '</div>'),

        ),

        // 2) Definición de tablas (MVS) del sub‐Generator
        'tablas' => array(
            'p' => array(
                'nom' => 'DOC_MIN_ACUERDOS',
                'id' => 'ACU_ID',
                'getId' => 'SELECT (MAX(ACU_ID)+1) AS ID FROM DOC_MIN_ACUERDOS',
                'tRel' => 'h',          // índice de tabla padre en $tablas principal
                'cRel' => 'ACU_FK_MINUTA'     // FK al registro padre
            )
        ),

        // 3) Parámetros de BD (listado, columnas, botones…) del sub‐Generator
        'bd' => array(
            'sqlDeplegar' => "SELECT
                            ACU_ID AS ID,
                            ACU_DESCRIPCION AS DESCRIPCION,
                            LURES AS RESPONSABLE,
                            ACU_FECHA_FIN   AS FECHA_FIN,
                            ASU_TEMA AS ASUNTO,
                            ACU_FK_MINUTA,
                            DM.STATUS_DOC
                                FROM DOC_MIN_ACUERDOS DA
                                LEFT JOIN TURESH ON URES = ACU_RESPONSABLE
                                LEFT JOIN DOC_MINUTA DM ON DM.MIN_ID = DA.ACU_FK_MINUTA
                                LEFT JOIN DOC_MIN_ASUNTO ON ASU_ID = ACU_FK_ASUNTO
                                WHERE ACU_FK_MINUTA = [IDPADRE]",
            'idDeplegar' => 'ID',
            'busqLike' => '"ID"',
            'busqIgual' => '"ID"',
            'nomPlural' => 'Acuerdos',
            'nomSingular' => 'Acuerdo',

            //* Parámetros de la tabla
            'bPaginate' => false, // o true
            'bFilter' => false, // o true
            'bInfo' => false, // o true
            'mostrarTfoot' => false, // o true
            'columnas' => array(
                array('campo' => 'ID', 'width' => '5%'),
                array('campo' => 'RESPONSABLE', 'width' => '15%'),
                array('campo' => 'ASUNTO', 'width' => '15%'),
                array('campo' => 'DESCRIPCION', 'width' => '30%'),
                array('campo' => 'OPCIONES', 'width' => '5%'),
            ),
            'btnOpciones' => array(
                'editar' => array(
                    'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
                ),
                'detalles' => false,
                'duplicar' => false,
                'eliminar' => array(
                    'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
                ),
            )  // usa los botones por defecto
        ),
        'template' => [
            'editForm' => 'modal',
            //'btnRegistrar' => false,
        ],
    ),

    //**------------------------------------------------------------------------------------------------------------------------ */


    //** TABLA CRUD PARA MEJORAS */

    array(
        'name_crud_table' => 'DOC_MIN_MEJORAS',
        'tipo' => 'crud-table',
        'label' => 'Mejoras',
        'col' => 'col-12',

        // 1) Campos del formulario del sub‐Generator
        'form' => array(
            array('etiq' => '<div class="row">'),
            array(
                'campo' => 'MEJ_ID',
                'tipo' => 'oculto',
            ),

            array(
                'campo' => 'MEJ_FK_MINUTA',
                'tipo' => 'oculto',
                'value' => '[IDPADRE]'
            ),

            array('etiq' => '</div>'),


            array('etiq' => '<div class="row">'),




            array(
                'col' => 'col-md-8',
                'campo' => 'MEJ_TIPO',
                'tipo' => 'select',
                'datos' => array(
                    array('ID' => '0', 'CAMPO' => 'Seleccione...'),
                    array('ID' => '1', 'CAMPO' => 'Mejora(s) al proceso concluidas'),
                    array('ID' => '2', 'CAMPO' => 'Nuevas mejora(s) al proceso identificadas y comprometidas para la sig. reunión'),
                ),
                'label' => 'Tipo de mejora',
                'tabla' => 'p'
            ),


            array('etiq' => '</div>'),
            array('etiq' => '<div class="row">'),
            array(
                'col' => 'col-md-12',
                'campo' => 'MEJ_DESCRIPCION',
                'tipo' => 'textarea',
                'holder' => 'Descripción del acuerdo',
                'label' => 'Descripción',
                'tabla' => 'p',
                'alto' => '300px', //agregar px si no, no funciona
                'max' => '300',
                //'encrypt' => true,
            ),
            array('etiq' => '</div>')
        ),

        // 2) Definición de tablas (MVS) del sub‐Generator
        'tablas' => array(
            'p' => array(
                'nom' => "DOC_MIN_MEJORAS",
                'id' => "MEJ_ID",
                'getId' => "SELECT (MAX(MEJ_ID)+1) AS ID FROM DOC_MIN_MEJORAS",
                'tRel' => 'p',          // índice de tabla padre en $tablas principal
                'cRel' => 'MEJ_FK_MINUTA'     // FK al registro padre
            )
        ),

        // 3) Parámetros de BD (listado, columnas, botones…) del sub‐Generator
        'bd' => array(
            'sqlDeplegar' => "SELECT
                                    MEJ_ID AS ID, 
                                    MEJ_TIPO AS TIPO, 
                                    MEJ_DESCRIPCION AS DESCRIPCION, 
                                    MEJ_FK_MINUTA, 
                                    DM.STATUS_DOC
                                    FROM DOC_MIN_MEJORAS DMJ
                                    LEFT JOIN DOC_MINUTA DM ON DM.MIN_ID = DMJ.MEJ_FK_MINUTA
                                    WHERE MEJ_FK_MINUTA = [IDPADRE]",
            'idDeplegar' => 'ID',
            'busqLike' => '"ID"',
            'busqIgual' => '"ID"',
            'nomPlural' => 'Mejoras',
            'nomSingular' => 'Mejora',

            //* Parámetros de la tabla
            'bPaginate' => false, // o true
            'bFilter' => false, // o true
            'bInfo' => false, // o true
            'mostrarTfoot' => false, // o true
            'columnas' => array(
                array('campo' => 'ID', 'width' => '5%'),
                array('campo' => 'TIPO', 'width' => '15%'),
                array('campo' => 'DESCRIPCION', 'width' => '30%'),
                array('campo' => 'OPCIONES', 'width' => '1%'),

            ),
            'btnOpciones' => array(
                'editar' => array(
                    'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
                ),
                'detalles' => false,
                'duplicar' => false,
                'eliminar' => array(
                    'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
                ),
            ),
            // usa los botones por defecto
        ),

        'template' => [
            'editForm' => 'modal',
            //'btnRegistrar' => false,
        ],
    ),

    //**------------------------------------------------------------------------------------------------------------------------ */
    //** TABLA CRUD DE FIRMANTES */

    array(
        'name_crud_table' => 'DOC_MIN_FIRMANTES',
        'tipo' => 'crud-table',
        'label' => 'Firmantes',
        'col' => 'col-12',

        // 1) Campos del formulario del sub‐Generator
        'form' => array(
            array('etiq' => '<div class="row">'),

            array(
                'col' => 'col-md-12',
                'campo' => 'FIR_NUMEMPL',
                'tipo' => 'select',
                'datosSQL' => "SELECT FE_NUMEMPL AS ID, FE_NUMEMPL || ' - ' || 
                FE_PREFIJOESTUDIO || ' ' ||FE_NOMBRE|| ' - ' ||  FE_CARGO || ' - ' || FE_CURP || ' - ' || FE_CORREO  AS CAMPO 
                FROM SAU.PADRON_FIRMAELECTRONICA
                WHERE FE_NUMEMPL NOT IN (
                    SELECT FIR_NUMEMPL FROM DOC_MIN_FIRMANTES WHERE FIR_FK_MINUTA = $idFiltro
                )",
                'label' => 'Número de Empleado',
                'holder' => 'Escriba su número de empleado',
                'tabla' => 'p'
            ),

            array(
                'col' => 'col-md-2',
                'campo' => 'FIR_PREFIJOESTUDIOS',
                'tipo' => 'text',
                'label' => 'Prefijo de Estudios',
                'holder' => 'Prefijo',
                'tabla' => 'p',
                //'readonly' => true,
            ),
            array(
                'col' => 'col-md-6',
                'campo' => 'FIR_NOMBRE',
                'tipo' => 'text',
                'label' => 'Nombre',
                'holder' => 'Nombre del firmante',
                'tabla' => 'p',
                'readonly' => true,
            ),
            array(
                'col' => 'col-md-4',
                'campo' => 'FIR_CURP',
                'tipo' => 'text',
                'label' => 'CURP',
                'holder' => 'CURP',
                'tabla' => 'p',
                'readonly' => true,
            ),

            array(
                'col' => 'col-md-6',
                'campo' => 'FIR_CARGO',
                'tipo' => 'text',
                'label' => 'Cargo',
                'holder' => 'Cargo',
                'tabla' => 'p',
                //'readonly' => true,
            ),

            array(
                'col' => 'col-md-6',
                'campo' => 'FIR_CORREO',
                'tipo' => 'text',
                'label' => 'Correo',
                'holder' => 'Correo electrónico',
                'tabla' => 'p',
                'readonly' => true,
            ),



            array('etiq' => '</div>'),



            array('etiq' => '<div class="row">'),
            array(
                'campo' => 'FIR_ID',
                'tipo' => 'oculto',
            ),
            array(
                'campo' => 'FIR_FK_MINUTA',
                'tipo' => 'oculto',
                'value' => '[IDPADRE]'
            ),
            array('etiq' => '</div>'),

        ),

        // 2) Definición de tablas (MVS) del sub‐Generator
        'tablas' => array(
            'p' => array(
                'nom' => "DOC_MIN_FIRMANTES",
                'id' => "FIR_ID",
                'getId' => "SELECT (MAX(FIR_ID)+1) AS ID FROM DOC_MIN_FIRMANTES",
                'tRel' => 'p',          // índice de tabla padre en $tablas principal
                'cRel' => 'FIR_FK_MINUTA'     // FK al registro padre
            )
        ),

        // 3) Parámetros de BD (listado, columnas, botones…) del sub‐Generator
        'bd' => array(
            'sqlDeplegar' => "SELECT 
                                    FIR_ID AS ID,
                                    FIR_NUMEMPL AS NUMEMPL,
                                    FIR_PREFIJOESTUDIOS AS PREFIJO,
                                    FIR_NOMBRE AS NOMBRE, 
                                    FIR_PREFIJOESTUDIOS||' '|| FIR_NOMBRE AS FIRMANTE,
                                    FIR_CURP AS CURP, 
                                    FIR_CORREO AS CORREO, 
                                    FIR_CARGO AS CARGO, 
                                    FIR_FK_MINUTA,
                                    DM.STATUS_DOC
                                    FROM DOC_MIN_FIRMANTES DF
                                    LEFT JOIN DOC_MINUTA DM ON DM.MIN_ID = DF.FIR_FK_MINUTA
                                    WHERE FIR_FK_MINUTA = [IDPADRE]",
            'idDeplegar' => 'ID',
            'busqLike' => '"FIR_ID"',
            'busqIgual' => '"ID"',
            'nomPlural' => 'Firmantes',
            'nomSingular' => 'Firmante',

            //* Parámetros de la tabla
            'bPaginate' => false, // o true
            'bFilter' => false, // o true
            'bInfo' => false, // o true
            'mostrarTfoot' => false, // o true
            'columnas' => array(
                array('campo' => 'ID', 'width' => '5%'),
                array('campo' => 'NUMEMPL', 'width' => '15%'),
                array('campo' => 'FIRMANTE', 'width' => '30%'),
                array('campo' => 'CARGO', 'width' => '20%'),
                array('campo' => 'CORREO', 'width' => '30%'),
                array('campo' => 'OPCIONES', 'width' => '5%'),

            ),
            'btnOpciones' => array(
                'editar' => array(
                    'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
                ),
                'detalles' => false,
                'duplicar' => false,
                'eliminar' => array(
                    'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
                ),
            )  // usa los botones por defecto
        ),
        'template' => [
            'editForm' => 'modal',
            //'btnRegistrar' => false,
        ],
        ),

      array('etiq' => '</div>'),
      array('etiq'=> '<div class="row">'),

      array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),
        array(
        'col' => 'col-6',
        'campo' => 'DOCUMENTO',
        'tipo' => 'uploadfile', // Para subida de archivo
        'format' => ["jpeg", "jpg", "pdf", "png"],
        'multiple' => 'true',
        'size' => '10000', //En KB
        'path' => '/opt/docs_minutas/minutas', //Ruta para guardar
        'label' => 'Documento adjunto',
        'file_name' => 'documento_adjunto_minuta', //Nombre del archivo para guardar
        ),
        array(
            'col' => 'col-6',
            'campo' => 'DOCUMENTO2',
            'tipo' => 'uploadfile', // Para subida de archivo
            'format' => ["jpeg", "jpg", "pdf", "png"],
            'multiple' => 'true',
            'size' => '10000', //En KB
            'path' => '/opt/docs_minutas/minutas', //Ruta para guardar
            'label' => 'Documento adjunto',
            'file_name' => 'documento_adjunto_minuta', //Nombre del archivo para guardar
        ),

        
        

        array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),
        array('etiq' => '</div>'),

);


/*
// Configuración adicional de templates
$template = array(
    'editForm' => 'modal'
);*/
$baseUrl = BASE_URL;



$codigoJS = <<<JS


$(document).on('change', 'select[name="FIR_NUMEMPL"]', function() {
    var selected = $(this).find('option:selected');
    var txt = selected.text();
    var parts = txt.split(' - ');
    // parts[0]: FE_NUMEMPL
    // parts[1]: FE_PREFIJOESTUDIO + ' ' + FE_NOMBRE
    // parts[2]: FE_CARGO
    // parts[3]: FE_CURP
    // parts[4]: FE_CORREO

    var nombreCompleto = parts.length > 1 ? parts[1].trim() : '';
    var cargo = parts.length > 2 ? parts[2].trim() : '';
    var curp = parts.length > 3 ? parts[3].trim() : '';
    var correo = parts.length > 4 ? parts[4].trim() : '';

    // Si quieres separar prefijo y nombre:
    var prefijo = '';
    var nombre = '';
    if (nombreCompleto) {
        var nombreParts = nombreCompleto.split(' ');
        prefijo = nombreParts.shift();
        nombre = nombreParts.join(' ').trim();
    }

    $('input[name="FIR_NOMBRE"]').val(nombre);
    $('input[name="FIR_CURP"]').val(curp);
    $('input[name="FIR_CORREO"]').val(correo);
    $('input[name="FIR_PREFIJOESTUDIOS"]').val(prefijo);
    $('input[name="FIR_CARGO"]').val(cargo);
});

function solicitarFirmas(minutaId) {
    $.ajax({
        url:  '{$baseUrl}viewminuta/exec/generarCadenaYFirma/' + minutaId,
        type: 'POST',
        dataType: 'text', // <-- Cambia a text
        success: function(response) {
    try {
        var data = JSON.parse(response);
        Swal.fire({
            icon: 'success',
            title: '¡Firmas solicitadas!',
            text: 'La cadena y la solicitud de firmas se generaron correctamente.'
        }).then(() => {
            setTimeout(function() {
                location.reload(); // Recarga la página después de 5 segundos
            }, 1000);
        });
    } catch (e) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Respuesta inesperada del servidor: ' + response
        });
    }
},
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al solicitar las firmas.'
            });
        }
    });
}






JS;







?>