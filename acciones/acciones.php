<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("../config/config.php");
    $medicamentos = "medicamentos";

 
    $nombre = trim($_POST['nombre']);
    $lote = trim($_POST['lote']);
    $caducidad = trim($_POST['caducidad']);
    $stock = trim($_POST['stock']);
    $categoria_id = trim($_POST['categoria_id']);
    $proveedor_id = trim($_POST['proveedor_id']);

    if (isset($_POST['id']) && !empty($_POST['id'])) {

        $id = $_POST['id'];
        $sql = "UPDATE $medicamentos 
                SET nombre = '$nombre', lote = '$lote', caducidad = '$caducidad', stock = '$stock', categoria_id = '$categoria_id', proveedor_id = '$proveedor_id' 
                WHERE id = $id";
        
        if ($conexion->query($sql) === TRUE) {
            header("location:../");
        } else {
            echo "Error al actualizar el registro: " . $conexion->error;
        }
    } else {

        $sql = "INSERT INTO $medicamentos (nombre, lote, caducidad, stock, categoria_id, proveedor_id) 
                VALUES ('$nombre', '$lote', '$caducidad', '$stock', '$categoria_id', '$proveedor_id')";

        if ($conexion->query($sql) === TRUE) {
            header("location:../");
        } else {
            echo "Error al crear el registro: " . $conexion->error;
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_id']) && !empty($_POST['eliminar_id'])) {

    $id = $_POST['eliminar_id'];


    $sql = "SELECT nombre FROM medicamentos WHERE id = $id";
    $result = $conexion->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        $imagenNombre = $row['nombre']; 

        $sqlDelete = "DELETE FROM medicamentos WHERE id = $id";
        if ($conexion->query($sqlDelete) === TRUE) {
    
            $dirLocal = "imagenes_medicamentos";
            $filePath = $dirLocal . '/' . $imagenNombre;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            echo "Medicamento eliminado correctamente";
            header("location:../");
        } else {
            echo "Error al eliminar el medicamento: " . $conexion->error;
        }
    } else {
        echo "No se encontró el medicamento con el ID proporcionado.";
    }
}


function obtenerMedicamentos($conexion)
{
    $sql = "SELECT * FROM medicamentos ORDER BY id ASC";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        die("Error al ejecutar la consulta: " . $conexion->error);
    }
    return $resultado;
}


function obtenerDatosMedicamento($conexion, $id)
{
    $sql = "SELECT * FROM medicamentos WHERE id = $id";
    $query = $conexion->query($sql);
    if (!$query) {
        die("Error al ejecutar la consulta: " . $conexion->error);
    }
    $medicamento = $query->fetch_assoc();
    return $medicamento ? $medicamento : null;
}

function contarMedicamentos($conexion) {
    $query = "SELECT COUNT(*) as total FROM medicamentos";
    $resultado = mysqli_query($conexion, $query);
    $fila = mysqli_fetch_assoc($resultado);
    return $fila['total'];
}

function obtenerMedicamentosPaginados($conexion, $inicio, $limite) {
    $query = "SELECT * FROM medicamentos LIMIT $inicio, $limite";
    $resultado = mysqli_query($conexion, $query);
    $medicamentos = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $medicamentos[] = $fila;
    }
    return $medicamentos;
}


function obtenerCategorias($conexion) {
    $sql = "SELECT * FROM categorias ORDER BY nombre ASC";
    $resultado = $conexion->query($sql);
    $categorias = [];
    while ($categoria = $resultado->fetch_assoc()) {
        $categorias[] = $categoria;
    }
    return $categorias;
}


function obtenerProveedores($conexion) {
    $sql = "SELECT * FROM proveedores ORDER BY nombre ASC";
    $resultado = $conexion->query($sql);
    $proveedores = [];
    while ($proveedor = $resultado->fetch_assoc()) {
        $proveedores[] = $proveedor;
    }
    return $proveedores;
}
