<?php
use App\Models\Carrito;
use App\Models\Compras;

session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$usuarioId = $usuario->getUsuariosId();
$carrito = new Carrito();
$compras = new Compras();

if (isset($_POST['eliminar_producto'])) {
    // Eliminar producto del carrito
    $productoId = $_POST['producto_id'];
    $carrito->eliminarProducto($usuarioId, $productoId);
}

if (isset($_POST['vaciar_carrito'])) {
    // Vaciar carrito
    $carrito->vaciarCarrito($usuarioId);
}

if (isset($_POST['restar_cantidad'])) {
    // Restar cantidad de producto en el carrito
    $productoId = $_POST['producto_id'];
    $cantidadActual = $_POST['cantidad'];
    $nuevaCantidad = max(1, $cantidadActual - 1);
    $carrito->actualizarCantidad($usuarioId, $productoId, $nuevaCantidad);
}

if (isset($_POST['sumar_cantidad'])) {
    // Sumar cantidad de producto en el carrito
    $productoId = $_POST['producto_id'];
    $cantidadActual = $_POST['cantidad'];
    $nuevaCantidad = $cantidadActual + 1;
    $carrito->actualizarCantidad($usuarioId, $productoId, $nuevaCantidad);
}

if (isset($_POST['realizar_compra'])) {
    // Realizar compra
    $productosEnCarrito = $carrito->obtenerProductos($usuarioId);
    $detallesCompras = [];
    foreach ($productosEnCarrito as $producto) {
        $detallesCompras[] = [
            'productoId' => $producto['productos_id'],
            'cantidad' => $producto['cantidad']
        ];
    }

    try {
        $compras->realizarCompra($usuarioId, $detallesCompras);
        $carrito->vaciarCarrito($usuarioId);
        $_SESSION['mensajeExito'] = "Compra realizada con éxito.";
    } catch (Exception $e) {
        $_SESSION['mensajeError'] = "Error al realizar la compra: " . $e->getMessage();
    }
}

// Redirigir de vuelta al carrito después de procesar la solicitud
header("Location: ../index.php?s=_carrito");
exit;