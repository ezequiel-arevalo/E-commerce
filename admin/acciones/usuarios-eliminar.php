<?php
// Importar las clases necesarias
use App\Auth\Autenticacion;
use App\Models\Usuario;

// Iniciar la sesión y cargar el archivo de autoloading
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

// Verificar si el usuario está autenticado
if (!(new Autenticacion())->estaAutenticadoComoAdmin()) {
    $_SESSION['mensajeError'] = "¡Se requiere haber iniciado sesión para ver este contenido!";
    header("Location: ../index.php?s=_iniciar-sesion");
    exit;
}

// Obtener el ID del usuario a eliminar desde el parámetro en la URL
$id = $_GET['id'];

try {
    // Eliminar el usuario de la base de datos
    (new Usuario())->eliminar($id);

    $_SESSION['mensajeExito'] = "El usuario con ID " . $id . " se eliminó correctamente.";
    header("Location: ../index.php?s=_gestion-usuarios");
    exit;
} catch (Exception $e) {
    $_SESSION['mensajeError'] = 'Ocurrió un problema inesperado al tratar de eliminar el usuario.';
    header("Location: ../index.php?s=_usuarios-editar&id=" . $id);
    exit;
}
