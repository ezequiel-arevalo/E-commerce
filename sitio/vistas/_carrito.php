<?php
use App\Models\Carrito;
use App\Auth\Autenticacion;

// Obtener el usuario autenticado
$usuario = (new Autenticacion())->getUsuario();

$usuarioId = $usuario->getUsuariosId();
$carrito = new Carrito();

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
                    foreach($productosEnCarrito as $producto){
                    // La idea de implementar estp aqui y en el codigo es que al validar el HTML el input y ID count se veia duplicado, al añadir el ID del producto ya no
                    // Error: Duplicate ID count.
                    $productoID = $producto['productos_id'];
                ?>
                <tr>
                    <td class="fix-col"><img src="<?= './res/img/productos/' . $producto['productos_img']; ?>" alt="<?= $producto['productos_img_alt']; ?>" class="m-auto d-block"></td>
                    <td class="fix-col"><?= $producto['productos_title']; ?></td>
                    <td class="text-center">
                        <div class="input-group flex justify-content-center">
                            <div class="input-group-prepend">
                                <form action="acciones/realizar-compra.php" method="POST">
                                    <input type="hidden" name="producto_id" value="<?= $producto['productos_id']; ?>">
                                    <input type="hidden" name="cantidad" value="<?= $producto['cantidad']; ?>">
                                    <button class="btn btn-danger btn-sm btn-square" type="submit" name="restar_cantidad">-</button>
                                </form>
                            </div>
                            <input type="number" name="count<?=$productoID?>" id="count<?=$productoID?>" class="input-square text-center" value="<?= $producto['cantidad']; ?>" readonly>
                            <div class="input-group-append">
                                <form action="acciones/realizar-compra.php" method="POST">
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
                        <form action="acciones/realizar-compra.php" method="POST">
                            <input type="hidden" name="producto_id" value="<?= $producto['productos_id']; ?>">
                            <button type="submit" name="eliminar_producto" class="btn btn-danger accion-btn w-100"><i class="bi bi-trash3"> </i>Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php }; ?>
            </tbody>
        </table>
    </div>
    <div class="row justify-content-center m-auto mb-5 mt-3">
        <div class="col-auto w-50">
            <h3 class="text-center"><strong>Total: </strong><?= number_format($total, 2); ?> $</h3>
            <div class="d-flex justify-content-between mb-3">
                <form action="acciones/realizar-compra.php" method="POST" class="w-50 me-2">
                    <button type="submit" name="vaciar_carrito" class="btn btn-danger w-100">Vaciar Carrito</button>
                </form>
                <form action="acciones/realizar-compra.php" method="POST" class="w-50">
                    <button type="submit" name="realizar_compra" class="btn btn-success w-100">Pagar</button>
                </form>
            </div>
        </div>
    </div>
</div>
