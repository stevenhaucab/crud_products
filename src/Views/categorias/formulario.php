<?php include dirname(__DIR__, 1) . '/layouts/header.php'; ?>

<div class="main-content">
    <div class="container mt-5">
        <h1><?php echo $title; ?></h1>

        <?php if (!empty($error) || !empty($success)): ?>
            <div class="alert <?= !empty($error) ? 'alert-danger' : 'alert-success' ?>">
                <?= !empty($error) ? $error : $success ?>
            </div>
        <?php endif; ?>

        <!-- Si existe el ID del categoria, el formulario es para edición -->
        <form action="<?= isset($categoria) ? '/editar-categoria/' . $categoria['id'] : '/nuevo-categoria' ?>" method="POST">
            <div class="mb-3">
                <label for="nombreCategoria" class="form-label">Nombre de la Categoria</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" 
                               value="<?= isset($categoria) ? $categoria['name'] : '' ?>" required>
                    </div>
                </div>
            </div>

            <?php if (isset($categoria)): ?>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?= $categoria['status'] == 1 ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $categoria['status'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">
                <?= isset($categoria) ? 'Actualizar Categoria' : 'Guardar Categoria' ?>
            </button>
        </form>
    </div>
</div>

<?php include dirname(__DIR__, 1) . '/layouts/footer.php'; ?>
