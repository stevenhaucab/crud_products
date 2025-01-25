<!-- src/views/dashboard.php -->
<?php include dirname(__DIR__, 1) . '/layouts/header.php'; ?>

<!-- Aquí puedes poner el contenido específico de la página -->
<div class="main-content">
    <div class="row">
        <!-- Otros elementos de contenido... -->
        <div class="container">
            <div class="d-flex justify-content-between mb-3">
                <h3>Lista de Categorias</h3>
                <a href="/nueva-categoria" class="btn btn-primary">Agregar Nueva Categorias</a>
            </div>

            <!-- Mostrar mensaje de error si existe -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); // Eliminar el mensaje de error después de mostrarlo 
                ?>
            <?php endif; ?>

            <!-- Mostrar mensaje de éxito si existe -->
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success']; ?>
                </div>
                <?php unset($_SESSION['success']); // Eliminar el mensaje de éxito después de mostrarlo 
                ?>
            <?php endif; ?>

            <div class="table-responsive">
                <!-- Mostrar la lista de categorias -->
                <?php if (!empty($categorias)): ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categorias as $categoria): ?>
                                <tr>
                                    <td><?= strtoupper($categoria['name']); ?></td>
                                    <td>
                                        <a href="/editar-categoria/<?= $categoria['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <button name="<?=$categoria['name'];?>" data-id="<?= $categoria['id']; ?>" data-route="eliminar-categoria" data-type="categoria" class="btn btn-danger btn-sm eliminar">Eliminar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No hay categorias disponibles.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include dirname(__DIR__, 1) . '/layouts/footer.php'; ?>