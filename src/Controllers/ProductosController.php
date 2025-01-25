<?php

namespace App\Controllers;

use core\Controller;
use core\View;
use core\Database;
use Exception;
use src\Models\ProductosModel;
use src\Models\CategoriasModel;

class ProductosController extends Controller
{
    private $conn;

    public function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/config.php';
        $db = new Database($config['db']);
        $this->conn = $db->connect();
    }

    // Mostrar la lista de productos
    public function index()
    {
        try {
            $ProductosModel = new ProductosModel($this->conn);
            $productos = $ProductosModel->getAllProductos() ?? [];
            $data = ['title' => 'productos', 'productos' => $productos];
            View::render('productos/index.php', $data);
        } catch (Exception $e) {
            echo 'Error al obtener los productos: ' . $e->getMessage();
        }
    }

    // Mostrar el formulario para agregar o editar un producto
    public function create()
    {
        $categoriasModel = new CategoriasModel($this->conn);
        $categorias = $categoriasModel->getAllCategorias();
        View::render('productos/formulario.php', 
                    ['title' => 'Agregar Nuevo Producto',
                    'categorias' => $categorias]);
    }

    // Mostrar el formulario para editar un producto existente
    public function edit($id)
    {
        try {
            $productosModel = new ProductosModel($this->conn);
            $producto = $productosModel->getProductoById($id);

            $categoriasModel = new CategoriasModel($this->conn);
            $categorias = $categoriasModel->getAllCategorias();

            if (!$producto) {
                throw new Exception("Producto no encontrado");
            }

            View::render('productos/formulario.php', [
                'title' => 'Editar producto',
                'producto' => $producto,
                'categorias' => $categorias
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Procesar la creación de un nuevo producto
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreProducto = $_POST['nombreProducto'] ?? null;
            $idCategoria = $_POST['idCategoria'] ?? null;
            $status = 1; // Predeterminado

            if (!$nombreProducto) {
                $this->showFormWithError('El nombre del producto es obligatorio.');
                return;
            }

            try {
                $ProductosModel = new ProductosModel($this->conn);
                $ProductosModel->insertProductos($nombreProducto, $status, $idCategoria);
                $this->showFormWithSuccess('producto guardado exitosamente.');
            } catch (Exception $e) {
                $this->showFormWithError('Error al guardar el producto: ' . $e->getMessage());
            }
        } else {
            $this->create();
        }
    }

    // Procesar la actualización de un producto existente
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreProducto = $_POST['nombreProducto'] ?? null;
            $idCategoria = $_POST['idCategoria'] ?? null;
            $status = $_POST['status'] ?? 1;

            if (!$nombreProducto) {
                $this->showFormWithError('El nombre del producto es obligatorio.', 'Editar producto');
                return;
            }

            try {
                $ProductosModel = new ProductosModel($this->conn);
                $ProductosModel->updateProductos($id, $nombreProducto, $idCategoria, $status);
                $this->showFormWithSuccess('Producto actualizado exitosamente.', 'Editar producto', $id);
            } catch (Exception $e) {
                $this->showFormWithError('Error al actualizar el producto: ' . $e->getMessage());
            }
        } else {
            $this->edit($id);
        }
    }

    private function showFormWithError($error)
    {
        // Guardar el error en una variable de sesión temporalmente
        $_SESSION['error'] = $error;

        // Redirigir al index de productos
        header('Location: /productos');
        exit; // Asegurarse de que el script no continúe ejecutándose
    }

    private function showFormWithSuccess($success)
    {
        // Guardar el mensaje de éxito en una variable de sesión temporalmente
        $_SESSION['success'] = $success;

        // Redirigir al index de productos
        header('Location: /productos');
        exit; // Asegurarse de que el script no continúe ejecutándose
    }
}
