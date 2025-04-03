<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");

    $id = trim($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $lote = trim($_POST['lote']);
    $caducidad = trim($_POST['caducidad']);
    $stock = trim($_POST['stock']);
    $categoria_id = trim($_POST['categoria_id']);
    $proveedor_id = trim($_POST['proveedor_id']);

    $imagen = null;


    if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0) {
        $archivoTemporal = $_FILES['imagen']['tmp_name'];
        $nombreArchivo = $_FILES['imagen']['name'];

        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        $dirLocal = "imagenes_medicamentos";
        $nombreArchivo = substr(md5(uniqid(rand())), 0, 10) . "." . $extension;
        $rutaDestino = $dirLocal . '/' . $nombreArchivo;

        if (move_uploaded_file($archivoTemporal, $rutaDestino)) {
            $imagen = $nombreArchivo;
        }
    }


    $sql = "UPDATE medicamentos 
            SET nombre='$nombre', lote='$lote', caducidad='$caducidad', stock='$stock', categoria_id='$categoria_id', proveedor_id='$proveedor_id'";

    if ($imagen !== null) {
        $sql .= ", imagen='$imagen'";
    }

    $sql .= " WHERE id='$id'";

    if ($conexion->query($sql) === TRUE) {
        header("location:../medicamentos.php");
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}
?>
