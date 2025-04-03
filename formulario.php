<form action="<?php echo isset($datoMedicamentoEdit['id']) ? 'acciones/updateMedicamento.php' : 'acciones/acciones.php'; ?>" method="POST">
    <?php if (isset($datoMedicamentoEdit['id'])) { ?>
        <input type="hidden" name="id" value="<?php echo $datoMedicamentoEdit['id']; ?>" />
    <?php } ?>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?php echo isset($datoMedicamentoEdit['nombre']) ? $datoMedicamentoEdit['nombre'] : ''; ?>" required />
    </div>
    <div class="mb-3">
        <label class="form-label">Lote</label>
        <input type="text" name="lote" class="form-control" value="<?php echo isset($datoMedicamentoEdit['lote']) ? $datoMedicamentoEdit['lote'] : ''; ?>" required />
    </div>
    <div class="mb-3">
        <label class="form-label">Fecha de Caducidad</label>
        <input type="date" name="caducidad" class="form-control" value="<?php echo isset($datoMedicamentoEdit['caducidad']) ? $datoMedicamentoEdit['caducidad'] : ''; ?>" required />
    </div>
    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" value="<?php echo isset($datoMedicamentoEdit['stock']) ? $datoMedicamentoEdit['stock'] : ''; ?>" required />
    </div>

    <!-- Categoría -->
    <div class="mb-3">
        <label class="form-label">Categoría</label>
        <select name="categoria_id" class="form-control" required>
            <option value="">Seleccionar Categoría</option>
            <?php
            // Obtener categorías desde la base de datos
            $categorias = obtenerCategorias($conexion);
            foreach ($categorias as $categoria) {
                $selected = (isset($datoMedicamentoEdit['categoria_id']) && $datoMedicamentoEdit['categoria_id'] == $categoria['id']) ? 'selected' : '';
                echo "<option value='{$categoria['id']}' $selected>{$categoria['nombre']}</option>";
            }
            ?>
        </select>
    </div>

    <!-- Proveedor -->
    <div class="mb-3">
        <label class="form-label">Proveedor</label>
        <select name="proveedor_id" class="form-control" required>
            <option value="">Seleccionar Proveedor</option>
            <?php
            // Obtener proveedores desde la base de datos
            $proveedores = obtenerProveedores($conexion);
            foreach ($proveedores as $proveedor) {
                $selected = (isset($datoMedicamentoEdit['proveedor_id']) && $datoMedicamentoEdit['proveedor_id'] == $proveedor['id']) ? 'selected' : '';
                echo "<option value='{$proveedor['id']}' $selected>{$proveedor['nombre']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn_add">
            <?php echo isset($datoMedicamentoEdit['id']) ? 'Editar' : 'Agregar'; ?> Medicamento
        </button>
    </div>
</form>
