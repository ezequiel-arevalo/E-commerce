<?php

// Verificar si existen datos antiguos almacenados en la sesión y asignarlos a la variable $oldData
if (isset($_SESSION['oldData'])) {
    $oldData = $_SESSION['oldData'];
    unset($_SESSION['oldData']);
} else {
    $oldData = [];
}
?>

<div id="Iniciar-Sesion-Container" class="d-block w-50 m-auto mt-5">
    <form action="acciones/iniciar-sesion.php" method="post" id="Form-container" class="m-auto">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" aria-describedby="emailHelp" class="form-control" value="<?= $oldData['email'] ?? null ?>" required>
            <div id="emailHelp" class="form-text">Ingresé el email con el que se registro previamente</div>
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

        <button type="submit" class="btn btn-primary m-auto d-block w-50" id="btn-login">Ingresar</button>
    </form>
</div>
