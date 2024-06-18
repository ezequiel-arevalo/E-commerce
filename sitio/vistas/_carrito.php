<?php
use App\Models\Carrito;
use App\Auth\Autenticacion;

// Iniciar la sesión si aún no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtener el usuario autenticado
$usuario = (new Autenticacion())->getUsuario();

// Redirigir al usuario a la página de inicio de sesión si no está autenticado
if (!$usuario) {
    header('Location: login.php');
    exit;
}

$usuarioId = $usuario->getUsuariosId();
$carrito = new Carrito();

// Procesar solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $nuevaCantidad = max(1, $cantidadActual - 1); // Asegurar que no se baje de 1
        $carrito->actualizarCantidad($usuarioId, $productoId, $nuevaCantidad);
    }

    if (isset($_POST['sumar_cantidad'])) {
        // Sumar cantidad de producto en el carrito
        $productoId = $_POST['producto_id'];
        $cantidadActual = $_POST['cantidad'];
        $nuevaCantidad = $cantidadActual + 1;
        $carrito->actualizarCantidad($usuarioId, $productoId, $nuevaCantidad);
    }
}

// Obtener los productos y el total después de posibles cambios
$productosEnCarrito = $carrito->obtenerProductos($usuarioId);
$total = $carrito->obtenerTotal($usuarioId);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Mi Carrito</h2>
    <div class="table-container">
        <table class="mb-5">
            <thead>
                <tr>
                    <th class="fix-col" scope="col">Producto</th>
                    <th class="fix-col" scope="col">Nombre</th>
                    <th class="fix-col" scope="col">Cantidad</th>
                    <th class="fix-col" scope="col">Precio Unitario</th>
                    <th class="fix-col" scope="col">Total</th>
                    <th class="fix-col" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Iterar sobre la lista de productos en el carrito y mostrar cada producto en una fila de la tabla
                    foreach($productosEnCarrito as $producto):
                ?>
                <tr>
                    <td class="fix-col"><img src="<?= './res/img/productos/' . $producto['productos_img']; ?>" alt="<?= $producto['productos_img_alt']; ?>" class="m-auto d-block"></td>
                    <td class="fix-col"><?= $producto['productos_title']; ?></td>
                    <td class="text-center">
                        <div class="input-group flex justify-content-center">
                            <div class="input-group-prepend">
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="producto_id" value="<?= $producto['productos_id']; ?>">
                                    <input type="hidden" name="cantidad" value="<?= $producto['cantidad']; ?>">
                                    <button class="btn btn-danger btn-sm btn-square" type="submit" name="restar_cantidad">-</button>
                                </form>
                            </div>
                            <input type="number" name="count" id="count" class="input-square text-center" value="<?= $producto['cantidad']; ?>" readonly>
                            <div class="input-group-append">
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="producto_id" value="<?= $producto['productos_id']; ?>">
                                    <input type="hidden" name="cantidad" value="<?= $producto['cantidad']; ?>">
                                    <button class="btn btn-success btn-sm btn-square" type="submit" name="sumar_cantidad">+</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td class="fix-col"><?= $producto['productos_price']; ?> $</td>
                    <td class="fix-col"><?= number_format($producto['productos_price'] * $producto['cantidad'], 2); ?> $</td>
                    <td class="fix-col">
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="producto_id" value="<?= $producto['productos_id']; ?>">
                            <button type="submit" name="eliminar_producto" class="btn btn-danger accion-btn w-100"><i class="bi bi-trash3"> </i>Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row justify-content-center m-auto mb-5 mt-3">
        <div class="col-auto w-50">
            <h4 class="text-center"><strong>Total: </strong><?= number_format($total, 2); ?> $</h4>
            <form action="" method="POST" style="display:inline;">
                <button type="submit" name="vaciar_carrito" class="btn btn-success w-100 p-2">Pagar</button>
            </form>
        </div>
    </div>
</div>
