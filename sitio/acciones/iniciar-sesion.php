<?php
use App\Auth\Autenticacion;

// Iniciar la sesión y cargar el archivo de autoloading
session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$email = $_POST['email'];
$password = $_POST['password'];

try {
    $autenticacion = new Autenticacion();
    
    if (!$autenticacion->iniciarSesion($email, $password)) {
        // Autenticación fallida, guardar el correo electrónico en una variable de sesión
        $_SESSION['oldData']['email'] = $email;
        $_SESSION['mensajeError'] = "Las credenciales ingresadas no coinciden con ningún registro de nuestro sistema";
        header("Location: ../index.php?s=_iniciar-sesion");
        exit;
    }
    
    $usuario = $autenticacion->getUsuario();
    
    if ($usuario->getRolesFk() === 1) {
        // Si el rol_fk es 1 (es el rol de administrador), enviar al dashboard
        $_SESSION['mensajeExito'] = "¡Hola de vuelta!";
        header("Location: ../admin/index.php?s=_dashboard");
        exit;
    }
    
    if ($usuario->getRolesFk() === 2) {
        // Si el rol_fk es 2 (es el rol de usuario normal), enviar al perfil
        $_SESSION['mensajeExito'] = "¡Hola de vuelta!";
        header("Location: ../index.php?s=_perfil");
        exit;
    }
    
    // Si el rol_fk no es 1 ni 2, mostrar un mensaje de error y redirigir a otra página
    $_SESSION['mensajeError'] = "No tienes permisos para acceder a esta página.";
    header("Location: ../index.php?s=_home");
    exit;
    
} catch (Exception $e) {
    // Ocurrió un error, guardar el correo electrónico en una variable de sesión y mostrar un mensaje de error
    $_SESSION['oldData']['email'] = $email;
    $_SESSION['mensajeError'] = "Ocurrió un error inesperado. Por favor, inténtalo de nuevo más tarde.";
    header("Location: ../index.php?s=_iniciar-sesion");
    exit;
}
