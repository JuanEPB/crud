<?php
include("../config/config.php");

$fecha_actual = date("Y-m-d");
$filename = "medicamentos_" . $fecha_actual . ".csv";


$fields = array('ID', 'Nombre', 'Lote', 'Fecha de Caducidad', 'Stock', 'Categoría ID', 'Proveedor ID');


$sql = "SELECT * FROM medicamentos";

$result = $conexion->query($sql);


if ($result->num_rows > 0) {

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $fp = fopen('php://output', 'w');


    fputcsv($fp, $fields);

    while ($row = $result->fetch_assoc()) {

        $row = array_map('utf8_encode', $row);
        fputcsv($fp, $row);
    }

    fclose($fp);
    exit();
} else {

    echo "No hay medicamentos para generar el reporte.";
}


$conexion->close();
?>
