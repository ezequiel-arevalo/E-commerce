<?php 

// Obtener la lista de productos utilizando el método "Productos" de la clase Producto
$productos = (new App\Models\Producto())->Productos();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Mi Carrito</h2>
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
                    <th class="fix-col" scope="col"></th>
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
                    <td class="text-center">
                        <div class="input-group flex justify-content-center">
                            <div class="input-group-prepend">
                                <button class="btn btn-danger btn-sm btn-square" type="button">-</button>
                            </div>
                            <input type="number" name="count" id="count" class="input-square text-center" value="<?= $producto->getProductoId();?>">
                            <div class="input-group-append">
                                <button class="btn btn-success btn-sm btn-square" type="button">+</button>
                            </div>
                        </div>
                    </td>
                    <td class="fix-col"><?= $producto->getPrecioSimbolo()->getPrecioSimboloNombre(); ?> <?= number_format($producto->getProductoPrice() , 2); ?></td>
                    <td class="fix-col"><?= $producto->getPrecioSimbolo()->getPrecioSimboloNombre(); ?> <?= number_format($producto->getProductoPrice() , 2); ?></td>
                    <td class="fix-col">
                        <!-- Enlaces para editar y eliminar el producto -->
                        <button class="btn btn-danger accion-btn w-100"><i class="bi bi-trash3"> </i>Borrar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row justify-content-center m-auto mb-5 mt-3">
      <div class="col-auto w-50">
        <h4 class="text-center"><strong>Total: </strong>$347.98</h4>
        <button class="btn btn-success w-100 p-2">Pagar</button>
      </div>
    </div>
  </div>