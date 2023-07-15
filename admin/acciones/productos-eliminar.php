<?php 

use App\Auth\Autenticacion;
use App\Models\Producto;

session_start();

require_once __DIR__ . '/../../bootstrap/autoload.php';

// Verificar si el usuario está autenticado
if (!(new Autenticacion())->estaAutenticado()) {
    $_SESSION['mensajeError'] =  "¡Se requiere haber iniciado sesión para ver este contenido!";
    header("Location: ../index.php?s=_iniciar-sesion");
    exit;
}

$id = $_GET['id'];

// Obtener el producto a eliminar por su ID
$producto = (new Producto)->productoID($id);

// Verificar si el producto existe
if (!$producto) {
    $_SESSION['mensajeError'] = 'El producto que quieres eliminar ya no existe.';
    header('Location: ../index.php?s=productos');
    exit;
}

try {
    // Eliminar el producto de la base de datos
    (new Producto)->eliminar($id);

    // Eliminar la imagen asociada si existe
    if ($producto->getProductoImagen() !== null) {
        unlink(__DIR__ . '/../../res/img/productos/big-' . $producto->getProductoImagen());
    }

    $_SESSION['mensajitoExito'] = "El producto fue eliminado con éxito";
    header('Location: ../index.php?s=_productos');
    exit;
} catch (Exception $e) {
    // Si ocurre un error, redirigir a la página de productos
    $_SESSION['mensajeError'] = 'Ocurrió un problema inesperado al tratar de eliminar el producto';
    $_SESSION['oldData'] = $_POST;
    header('Location: ../index.php?s=_productos');
    exit;
}
