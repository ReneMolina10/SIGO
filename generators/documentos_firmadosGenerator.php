<?php
$tablas["p"] = [
    'nom' => "DOC_MINUTA",
    'id' => "MIN_ID",
    'getId' => "SELECT (MAX(MIN_ID)+1) AS ID FROM DOC_MINUTA"
];
/*
\'<a href="' . BASE_URL . 'viewminuta/prefirmado?id=\'|| MD5(MIN_ID||\'_minuta\') ||\'" target="_blank">Ver PDF y detalles</a>\' AS PDF_EXTERNO,


\'<a href="' . BASE_URL . 'viewminuta/previsualizarPDF/\' || MD5(MIN_ID||\'_minuta\') || \'" target="_blank"> <div style="text-align:center"> <i class="far fa-eye nav-icon"></i> </div> </a>\' AS PDF_INTERNO,
*/
// Obtener el correo del usuario logueado
$correoUsuario = '';
if (!empty($_SESSION['infousr']['email'])) {
    $correoUsuario = $_SESSION['infousr']['email'];
} elseif (!empty($_SESSION['getOffice']['nickname'])) {
    $correoUsuario = $_SESSION['getOffice']['nickname'];
}

/*
echo 'correoUsuario: ' . $correoUsuario . '<br>';
exit();*/

$bd = array(
    'sqlDeplegar' => "SELECT 
                DM.MIN_PROCESO, 
                DM.MIN_FOLIO, 
                DM.MIN_ID,
                DM.FOLIO_DOC,
                DM.TIPO_DOCUMENTO, 
                UPPER(MD5(CONCAT(DM.MIN_ID, '_minuta'))) AS HASH_MINUTA,
                 \'<a href= \'' . BASE_URL . 'viewminuta/prefirmado/\'|| MD5(MIN_ID||\'_minuta\') ||\' target=\'_blank\'>
            <div style=\'background:#007bff;color:#fff;border:none;padding:6px 12px;border-radius:4px;text-align:center;\'>
                \' ||
                (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID) || \'/\' ||
                (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID) || \' Completado
            </div>
        </a>\' AS URL,
                MF.FIR_ID_SEGUIMIENTO
            FROM DOC_MINUTA DM
            INNER JOIN DOC_MIN_FIRMANTES MF ON DM.MIN_ID = MF.FIR_FK_MINUTA
            WHERE MF.FIR_STATUS_FIRMANTE_DOC = '3'
            AND MF.FIR_CORREO = '$correoUsuario'
            ",

    

    'idDeplegar' => '',
    'idFiltro' => '',
    'busqLike' => '',
    'busqIgual' => '',
    'nomPlural' => '',
    'nomSingular' => '',

    'btnOpciones' => array(
        'editar' => false,
        'detalles' => false,
        'duplicar' => false,
        'eliminar' => false,
        ),
    
    'cssEditar' => ''
);



$form = array(
);


/*
// Configuración adicional de templates
$template = array(
    'editForm' => 'modal'
);*/







?>