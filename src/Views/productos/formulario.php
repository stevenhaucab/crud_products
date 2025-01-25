<?php include dirname(__DIR__, 1) . '/layouts/header.php'; ?>

<div class="main-content">
    <div class="container mt-5">
        <h1><?php echo $title; ?></h1>

        <?php if (!empty($error) || !empty($success)): ?>
            <div class="alert <?= !empty($error) ? 'alert-danger' : 'alert-success' ?>">
                <?= !empty($error) ? $error : $success ?>
            </div>
        <?php endif; ?>

        <!-- Si existe el ID del producto, el formulario es para edición -->
        <form action="<?= isset($producto) ? '/editar-producto/' . $producto['id'] : '/nuevo-producto' ?>" method="POST">
            <div class="mb-3">
                <label for="nombreProducto" class="form-label">Nombre del producto</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" 
                               value="<?= isset($producto) ? $producto['name'] : '' ?>" required>
                    </div>
                </div>
            </div>

            <!-- Select para categorias -->
            <div class="mb-3">
                <label for="idCategoria" class="form-label">Categorias</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <select name="idCategoria" id="idCategoria" class="form-control" required>
                            <option value="">Selecciona una categoria</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id']; ?>"
                                    <?= isset($producto) && $producto['idCategoria'] == $categoria['id'] ? 'selected' : ''; ?>>
                                    <?= strtoupper($categoria['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <?php if (isset($producto)): ?>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?= $producto['status'] == 1 ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $producto['status'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">
                <?= isset($producto) ? 'Actualizar producto' : 'Guardar producto' ?>
            </button>
        </form>
    </div>
</div>

<?php include dirname(__DIR__, 1) . '/layouts/footer.php'; ?>
