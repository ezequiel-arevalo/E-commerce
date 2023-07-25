<?php

// Verificar si existen datos antiguos almacenados en la sesión y asignarlos a la variable $oldData
if (isset($_SESSION['oldData'])) {
    $oldData = $_SESSION['oldData'];
    unset($_SESSION['oldData']);
} else {
    $oldData = [];
}
?>

<div id="Iniciar-Sesion-Container" class="w-50 m-auto mt-5">
    <form action="acciones/registrarse.php" method="post" id="Form-container">

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" aria-describedby="usernameHelp" class="form-control" value="<?= $oldData['username'] ?? null ?>">
            <div id="usernameHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" aria-describedby="emailHelp" class="form-control" value="<?= $oldData['email'] ?? null ?>" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>