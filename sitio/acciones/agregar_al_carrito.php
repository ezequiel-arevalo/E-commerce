<?php
use App\Models\Carrito;
use App\Auth\Autenticacion;

session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$productoId = $_POST['producto_id'];
$cantidad = 1;

$autenticacion = new Autenticacion();
if ($autenticacion->estaAutenticado()) {
    $usuarioId = $autenticacion->getUsuarioId();
    $carrito = new Carrito();
    $carrito->agregarProducto($usuarioId, $productoId, $cantidad);
    $_SESSION['mensajeExito'] = "El producto fue agregado al carrito!";
} else {
    $_SESSION['mensajeError'] = "El producto no fue agregado al carrito!.";
}

header("Location: ../index.php?s=_informacion&id=$productoId");
exit;