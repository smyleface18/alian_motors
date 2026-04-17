<?php
require_once __DIR__ . '/../models/Post.php';

class PostController {
    private $model;

    public function __construct() {
        $this->model = new Post();
    }

    public function index() {
        $posts = $this->model->getAll();
        require __DIR__ . '/../views/posts/index.php';
    }

    public function store() {
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        $usuario_id = $_POST['usuario_id'];

        $this->model->create($titulo, $contenido, $usuario_id);

        header("Location: /posts");
    }
}