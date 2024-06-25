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
    <h2>Registrarse</h2>
</div>
<div id="Iniciar-Sesion-Container" class="w-50 m-auto mt-5">
    <form action="acciones/registrarse.php" method="post" class="m-auto" id="Form-container">

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" aria-describedby="usernameHelp" class="form-control" value="<?= $oldData['username'] ?? null ?>">
            <div id="usernameHelp" class="form-text">Su nombre de usuario es opcional</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" aria-describedby="emailHelp" class="form-control" value="<?= $oldData['email'] ?? null ?>" required>
            <div id="emailHelp" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                    <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary m-auto d-block w-50" id="btn-login">Registrarse</button>
    </form>
</div>