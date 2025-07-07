<?php
//require_once '/opt/sitios/gesco/models/obtenerfirmantesModel.php'; // Ruta a tu modelo

$numempl = isset($_GET['numempl']) ? $_GET['numempl'] : '';
$campo = isset($_GET['campo']) ? $_GET['campo'] : '';

if (!$numempl || !$campo) {
    echo '<option value="">Sin datos</option>';
    exit;
}

// Se asume que la conexión a la base de datos ya está establecida en el modelo

switch ($campo) {
    case 'nombre':
        $sql = "SELECT (GETPREFIJOESTUDIOS(PERS_PERSONA) || ' ' || PERS_NOMBRE || ' ' || PERS_APEPAT || ' ' || PERS_APEMAT) AS NOMBRE
                FROM FINANZAS.FPERSONAS WHERE PERS_PERSONA = :numempl";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':numempl', $numempl);
        oci_execute($stmt);
        if ($row = oci_fetch_assoc($stmt)) {
            echo '<option value="' . htmlspecialchars($row['NOMBRE']) . '">' . htmlspecialchars($row['NOMBRE']) . '</option>';
        } else {
            echo '<option value="">Sin datos</option>';
        }
        break;

    case 'cargo':
        $sql = "SELECT INITCAP(PTO_PUESTO) AS CARGO
                FROM PLT_PUESTOS
                LEFT JOIN FINANZAS.FPERSONAS FF ON FF.PERS_PERSONA = TMP_NUMEMPL
                WHERE FF.PERS_PERSONA = :numempl";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':numempl', $numempl);
        oci_execute($stmt);
        if ($row = oci_fetch_assoc($stmt)) {
            echo '<option value="' . htmlspecialchars($row['CARGO']) . '">' . htmlspecialchars($row['CARGO']) . '</option>';
        } else {
            echo '<option value="">Sin datos</option>';
        }
        break;

    case 'correo':
        $sql = "SELECT PERS_CORREO AS CORREO
                FROM FINANZAS.FPERSONAS WHERE PERS_PERSONA = :numempl";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':numempl', $numempl);
        oci_execute($stmt);
        if ($row = oci_fetch_assoc($stmt)) {
            echo '<option value="' . htmlspecialchars($row['CORREO']) . '">' . htmlspecialchars($row['CORREO']) . '</option>';
        } else {
            echo '<option value="">Sin datos</option>';
        }
        break;

    default:
        echo '<option value="">Sin datos</option>';
        break;
}

oci_free_statement($stmt);
?>