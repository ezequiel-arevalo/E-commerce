<?php

$usuario = (new App\Models\Usuario())->porId($_GET['id']);

// Verificar si existen errores almacenados en la sesión y asignarlos a la variable $errores
if (isset($_SESSION['errores'])) {
    $errores = $_SESSION['errores'];
    unset($_SESSION['errores']);
} else {
    $errores = [];
}

// Verificar si existen datos antiguos almacenados en la sesión y asignarlos a la variable $oldData
if (isset($_SESSION['oldData'])) {
    $oldData = $_SESSION['oldData'];
    unset($_SESSION['oldData']);
} else {
    $oldData = [];
}


echo "<pre>";
var_dump($usuario);
echo "</pre>";
?>

<section id="eliminar-usuarios">
    <div class="Vista-Title">
        <h2>Eliminar un usuario</h2>
    </div>

    <form action="acciones/usuarios-eliminar.php?id=<?= $usuario->getUsuariosId(); ?>" method="post" id="eliminar-usuarios-form">
        <div class="form-fila">
            <label for="username">Nombre de usuario</label>
            <input type="text" name="username" id="username" value="<?= $usuario->getUsuariosUsername() ? $usuario->getUsuariosUsername() : 'No especificado'; ?>" disabled>
        </div>

        <div class="form-fila">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" value="<?= $usuario->getUsuariosEmail(); ?>" disabled>
        </div>

        <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i> Eliminar</button>
    </form>
</section>
