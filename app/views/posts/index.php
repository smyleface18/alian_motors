<h1>Lista de Posts</h1>

<form method="POST" action="/posts/store">
    <input type="text" name="titulo" placeholder="Titulo">
    <textarea name="contenido"></textarea>
    <input type="number" name="usuario_id" placeholder="Usuario ID">
    <button type="submit">Crear</button>
</form>

<hr>

<?php foreach ($posts as $post): ?>
    <h3><?= $post['titulo'] ?></h3>
    <p><?= $post['contenido'] ?></p>
    <small>Autor: <?= $post['nombre'] ?></small>
<?php endforeach; ?>