<?php
<?php
// Conexión a la base de datos aquí...
$numempl = $_GET['numempl'] ?? '';
if (!$numempl) {
    echo json_encode(['error' => 'Falta numempl']);
    exit;
}
$sql = "SELECT FE_NUMEMPL, FE_NOMBRE, FE_CURP, FE_CORREO FROM SAU.PADRON_FIRMAELECTRONICA WHERE FE_NUMEMPL = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$numempl]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($data ?: []);
?>