<?php

namespace src\Models;

use PDO;

class ProductosModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Inserta un nuevo producto en la base de datos.
     * @param string $name
     * @param int $status
     * @return bool
     */
    public function insertProductos($name, $status, $idCategoria) {
        $query = 'INSERT INTO productos (name, status, idCategoria) VALUES (:name, :status, :idCategoria)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':idCategoria', $idCategoria);
        return $stmt->execute();
    }

    /**
     * Recupera todos los productos de la base de datos.
     * @return array
     */
    public function getAllProductos() {
        $query = 'SELECT p.id, p.name, p.status, c.name as nameCategoria FROM productos p
                    INNER JOIN categorias c ON p.idCategoria = c.id';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupera un producto por su ID.
     * @param int $id
     * @return array
     */
    public function getProductoById($id) {
        $query = 'SELECT * FROM productos WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Actualiza un producto existente en la base de datos.
     * @param int $id
     * @param string $name
     * @param int $status
     * @return bool
     */
    public function updateProductos($id, $name, $idCategoria, $status) {
        $query = 'UPDATE productos SET name = :name, status = :status, idCategoria = :idCategoria WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':idCategoria', $idCategoria);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
