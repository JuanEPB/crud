<?php

$limite = 5; 
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina > 1) ? ($pagina * $limite) - $limite : 0;

$totalRegistros = contarMedicamentos($conexion);
$totalPaginas = ceil($totalRegistros / $limite);

$medicamentos = obtenerMedicamentosPaginados($conexion, $inicio, $limite);
?>

<div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Lote</th>
                <th>Caducidad</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medicamentos as $medicamento) { ?>
                <tr>
                    <td><?php echo $medicamento['id']; ?></td>
                    <td><?php echo $medicamento['nombre']; ?></td>
                    <td><?php echo $medicamento['lote']; ?></td>
                    <td><?php echo date("d/m/Y", strtotime($medicamento['caducidad'])); ?></td>
                    <td><?php echo $medicamento['stock']; ?></td>
                    <td>
                        <a href="visualizar.php?id=<?php echo $medicamento['id']; ?>" class="btn btn-success btn-sm"><i class="bi bi-eye"></i></a>
                        <a href="index.php?id=<?php echo $medicamento['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="acciones/delete.php?id=<?php echo $medicamento['id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Paginación -->
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item <?php echo ($pagina <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="index.php?pagina=<?php echo $pagina - 1; ?>">Anterior</a>
        </li>
        <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>
            <li class="page-item <?php echo ($pagina == $i) ? 'active' : ''; ?>">
                <a class="page-link" href="index.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php } ?>
        <li class="page-item <?php echo ($pagina >= $totalPaginas) ? 'disabled' : ''; ?>">
            <a class="page-link" href="index.php?pagina=<?php echo $pagina + 1; ?>">Siguiente</a>
        </li>
    </ul>
</nav>
