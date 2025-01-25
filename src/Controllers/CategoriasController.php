<?php

namespace App\Controllers;

use core\Controller;
use core\View;
use core\Database;
use Exception;
use src\Models\CategoriasModel;


class CategoriasController extends Controller
{
    private $conn;

    public function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/config.php';
        $db = new Database($config['db']);
        $this->conn = $db->connect();
    }

    // Mostrar la lista de categorias
    public function index()
    {
        try {
            $categoriasModel = new CategoriasModel($this->conn);
            $categorias = $categoriasModel->getAllCategorias() ?? [];
            $data = ['title' => 'Categorias', 'categorias' => $categorias];
            View::render('categorias/index.php', $data);
        } catch (Exception $e) {
            echo 'Error al obtener las categorias: ' . $e->getMessage();
        }
    }

    // Mostrar el formulario para agregar o editar una categoria
    public function create()
    {
        View::render('categorias/formulario.php', ['title' => 'Agregar Nueva Categoria']);
    }

    // Mostrar el formulario para editar una categoria existente
    public function edit($id)
    {
        try {
            $categoriasModel = new CategoriasModel($this->conn);
            $categorias = $categoriasModel->getCategoriaById($id);

            if (!$categorias) {
                throw new Exception("Categoria no encontrado");
            }

            View::render('categorias/formulario.php', [
                'title' => 'Editar Categoria',
                'categoria' => $categorias
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Procesar la creación de un nuevo categorias
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreCategoria = $_POST['nombreCategoria'] ?? null;
            $status = 1; // Predeterminado

            if (!$nombreCategoria) {
                $this->showFormWithError('El nombre del categorias es obligatorio.');
                return;
            }

            try {
                $categoriasModel = new CategoriasModel($this->conn);
                $categoriasModel->inserCategoria($nombreCategoria, $status);
                $this->showFormWithSuccess('Categorias guardado exitosamente.');
            } catch (Exception $e) {
                $this->showFormWithError('Error al guardar el categorias: ' . $e->getMessage());
            }
        } else {
            $this->create();
        }
    }

    // Procesar la actualización de un categorias existente
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreCategoria = $_POST['nombreCategoria'] ?? null;
            $status = $_POST['status'] ?? 1;

            if (!$nombreCategoria) {
                $this->showFormWithError('El nombre del categorias es obligatorio.', 'Editar Categorias');
                return;
            }

            try {
                $categoriasModel = new CategoriasModel($this->conn);
                $categoriasModel->updateCategoria($id, $nombreCategoria, $status);
                $this->showFormWithSuccess('Categorias actualizado exitosamente.', 'Editar Categorias', $id);
            } catch (Exception $e) {
                $this->showFormWithError('Error al actualizar el categorias: ' . $e->getMessage());
            }
        } else {
            $this->edit($id);
        }
    }

    private function showFormWithError($error)
    {
        // Guardar el error en una variable de sesión temporalmente
        $_SESSION['error'] = $error;

        // Redirigir al index de categorias
        header('Location: /categorias');
        exit; // Asegurarse de que el script no continúe ejecutándose
    }

    private function showFormWithSuccess($success)
    {
        // Guardar el mensaje de éxito en una variable de sesión temporalmente
        $_SESSION['success'] = $success;

        // Redirigir al index de categorias
        header('Location: /categorias');
        exit; // Asegurarse de que el script no continúe ejecutándose
    }
}
