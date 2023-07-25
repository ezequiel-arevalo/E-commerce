<?php 

// Obtener la lista de productos utilizando el método "Productos" de la clase Producto
$productos = (new App\Models\Producto())->Productos();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Mis Compras</h2>
    <!-- Tabla que muestra los productos -->
    <div class="table-container">
        <table class="mb-5">
            <thead>
                <tr>
                    <th class="fix-col" scope="col">Producto</th>
                    <th class="fix-col" scope="col">Nombre</th>
                    <th class="fix-col" scope="col">Cantidad</th>
                    <th class="fix-col" scope="col">Precio Unitario</th>
                    <th class="fix-col" scope="col">Total</th>
                    <th class="fix-col" scope="col">Fecha de compra</th>
                    <th class="fix-col" scope="col">Factura de compra</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Iterar sobre la lista de productos y mostrar cada producto en una fila de la tabla
                    foreach($productos as $producto):
                ?>
                <tr>
                    <td class="fix-col"><img src="<?= './res/img/productos/' . $producto->getProductoImagen(); ?>" alt="<?= $producto->getProductoImagenAlt(); ?>" class="m-auto d-block"></td>
                    <td class="fix-col"><?= $producto->getProductoTitle(); ?></td>
                    <td class="fix-col">
                        <?= $producto->getProductoId();?>
                    </td>
                    <td class="fix-col"><?= $producto->getPrecioSimbolo()->getPrecioSimboloNombre(); ?> <?= number_format($producto->getProductoPrice() , 2); ?></td>
                    <td class="fix-col"><?= $producto->getPrecioSimbolo()->getPrecioSimboloNombre(); ?> <?= number_format($producto->getProductoPrice() , 2); ?></td>
                    <td class="fix-col">12/12/2222</td>
                    <td class="fix-col">
                        <!-- Enlaces para editar y eliminar el producto -->
                        <button class="btn btn-success accion-btn w-100"><i class="bi bi-cloud-arrow-down-fill"> </i>Descargar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>