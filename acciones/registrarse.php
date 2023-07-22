<?php
session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$email     = $_POST['email'];
$password  = $_POST['password'];

try {
    (new App\Models\Usuario())->crear([
        'usuarios_email' => $email,
        'usuarios_password' => password_hash($password, PASSWORD_DEFAULT),
        'roles_fk' => 2,
    ]);

    $_SESSION['mensajeExito'] = "Tu cuenta fue creada con Exito";
    header("Location: ../index.php?s=_iniciar-sesion");
    exit;
} catch (Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrió un error al crear la cuenta";
    header("Location: ../index.php?s=_registrarse");
    exit;
}