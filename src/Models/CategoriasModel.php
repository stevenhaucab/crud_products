<?php

namespace src\Models;

use PDO;

class CategoriasModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Inserta una nueva categoria en la base de datos.
     * @param string $name
     * @param int $status
     * @return bool
     */
    public function inserCategoria($name, $status) {
        $query = 'INSERT INTO categorias (name, status) VALUES (:name, :status)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    /**
     * Recupera todas las categorias de la base de datos.
     * @return array
     */
    public function getAllCategorias() {
        $query = 'SELECT * FROM categorias WHERE status = 1';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupera una categorias por su ID.
     * @param int $id
     * @return array
     */
    public function getCategoriaById($id) {
        $query = 'SELECT * FROM categorias WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Actualiza una categoria existente en la base de datos.
     * @param int $id
     * @param string $name
     * @param int $status
     * @return bool
     */
    public function updateCategoria($id, $name, $status) {
        $query = 'UPDATE categorias SET name = :name, status = :status WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

        /**
     * Elimina una categoria existente en la base de datos.
     * @param int $id
     * @return bool
     */
    public function deleteCategoria($id) {
        $query = 'DELETE FROM categorias WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
