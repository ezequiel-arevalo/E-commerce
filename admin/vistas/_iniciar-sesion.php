<?php

// Verificar si existen datos antiguos almacenados en la sesión y asignarlos a la variable $oldData
if (isset($_SESSION['oldData'])) {
    $oldData = $_SESSION['oldData'];
    unset($_SESSION['oldData']);
} else {
    $oldData = [];
}
?>

<div class="Vista-Title">
    <h1>Panel de Administración de MyShop</h1>
</div>
<div id="Iniciar-Sesion-Container">
    <form action="acciones/iniciar-sesion.php" method="post" id="Iniciar-Sesion-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $oldData['email'] ?? null ?>">
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
        </div>

        <button type="submit" id="Iniciar-sesion-btn">Ingresar</button>
    </form>
</div>
