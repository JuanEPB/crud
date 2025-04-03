<?php
include_once("config/config.php");
include_once("acciones/acciones.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Medicamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            font-size: 14px;
        }
        .table th, .table td {
            padding: 8px;
            text-align: center;
        }
        .form-container {
            background: #f1f1f1;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4 fw-bold">Sistema de Medicamentos</h2>
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-container">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $datoMedicamentoEdit = obtenerDatosMedicamento($conexion, $id);
                    }
                    include("formulario.php");
                    ?>
                </div>
            </div>

            <div class="col-md-8">
                <h4 class="text-center">Lista de Medicamentos
                    <a href="acciones/exportar.php" class="btn btn-success btn-sm float-end" title="Exportar a CSV">
                        <i class="bi bi-filetype-csv"></i>
                    </a>
                </h4>
                <hr>
                <?php include("medicamentos.php"); ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
