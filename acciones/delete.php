<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");

    $json_data = file_get_contents("php://input");

    $data = json_decode($json_data, true);

    if ($data !== null) {
        $id = $data['id']; 
        $imagenNombre = isset($data['nombre']) ? $data['nombre'] : null; 


        $sql = "DELETE FROM medicamentos WHERE id = $id";
        if ($conexion->query($sql) === TRUE) {
           
            echo json_encode(array("success" => true, "message" => "Medicamento eliminado correctamente"));
        } else {
            echo json_encode(array("success" => false, "message" => "Error al eliminar el medicamento: " . $conexion->error));
        }
    } else {

        echo json_encode(array("success" => false, "message" => "Datos inválidos"));
    }
}
?>
