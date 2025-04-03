<?php
include("config/config.php");
include("acciones/acciones.php");

if (!isset($_GET['id'])) {
    header("location:./");
    exit;
}

$id = $_GET['id'];
$dataInfo = obtenerDatosMedicamento($conexion, $id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Detalles del Medicamento</title>
</head>
<body>
    <h1>Datos del Medicamento</h1>
    <?php if ($dataInfo): ?>
        <p>Nombre: <?php echo $dataInfo['nombre']; ?></p>
        <p>Lote: <?php echo $dataInfo['lote']; ?></p>
        <p>Fecha de Caducidad: <?php echo $dataInfo['caducidad']; ?></p>
        <p>Stock: <?php echo $dataInfo['stock']; ?></p>
    <?php else: ?>
        <p>No se encontraron los datos del medicamento.</p>
    <?php endif; ?>
</body>
</html>
