<?php
require_once __DIR__ . '/../../config/database.php';

class Post {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $stmt = $this->conn->query("
            SELECT posts.*, usuarios.nombre 
            FROM posts
            JOIN usuarios ON posts.usuario_id = usuarios.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($titulo, $contenido, $usuario_id) {
        $stmt = $this->conn->prepare("
            INSERT INTO posts (titulo, contenido, usuario_id)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$titulo, $contenido, $usuario_id]);
    }
}