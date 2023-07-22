<?php

// Verificar si existen datos antiguos almacenados en la sesión y asignarlos a la variable $oldData
if (isset($_SESSION['oldData'])) {
    $oldData = $_SESSION['oldData'];
    unset($_SESSION['oldData']);
} else {
    $oldData = [];
}
?>

<div id="Iniciar-Sesion-Container">
    <form action="acciones/registrarse.php" method="post" id="Iniciar-Sesion-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $oldData['email'] ?? null ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit" id="Iniciar-sesion-btn">Registrarse</button>
    </form>
</div>
