<?php
use App\Auth\Autenticacion;

// Iniciar la sesión y cargar el archivo de autoloading
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

$email = $_POST['email'];
$password = $_POST['password'];

try {
    $autenticacion = new Autenticacion();
    if ($autenticacion->iniciarSesion($email, $password)) {
        // Autenticación exitosa, puedes redirigir al usuario a la página deseada o realizar otras acciones
        $_SESSION['mensajeExito'] =  "¡Hola de vuelta!";
        header("Location: ../index.php?s=_dashboard");
        exit;
    } else {
        // Autenticación fallida, guardar el correo electrónico en una variable de sesión
        $_SESSION['oldData']['email'] = $email;
        $_SESSION['mensajeError'] =  "Las credenciales ingresadas no coinciden con ningún registro de nuestro sistema";
        header("Location: ../index.php?s=_iniciar-sesion");
        exit;
    }
} catch (Exception $e) {
    // Ocurrió un error, puedes mostrar un mensaje de error o redirigir al formulario de inicio de sesión nuevamente
    $_SESSION['oldData']['email'] = $email;
    $_SESSION['mensajeError'] =  "Ocurrió un error inesperado. Por favor, inténtalo de nuevo más tarde.";
    header("Location: ../index.php?s=_iniciar-sesion");
    exit;
}
?>