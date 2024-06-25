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
?>

<section id="editar-usuarios">
    <div class="Vista-Title">
        <h2>Editar un usuario</h2>
    </div>

    <form action="acciones/usuarios-editar.php?id=<?= $usuario->getUsuariosId(); ?>" method="post" id="editar-usuarios-form">
        <div class="form-fila">
            <label for="username">Nombre de usuario</label>
            <input type="text" name="username" id="username" value="<?= $oldData['username'] ?? $usuario->getUsuariosUsername(); ?>">
            <?php if (isset($errores['username'])){ ?>
                <span class="error"><?= $errores['username']; ?></span>
            <?php }; ?>
        </div>

        <div class="form-fila">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" value="<?= $oldData['email'] ?? $usuario->getUsuariosEmail(); ?>">
            <?php if (isset($errores['email'])){ ?>
                <span class="error"><?= $errores['email']; ?></span>
            <?php }; ?>
        </div>

        <button type="submit" class="btn btn-success w-100"><i class="bi bi-check2"></i> Actualizar</button>
    </form>
</section>
