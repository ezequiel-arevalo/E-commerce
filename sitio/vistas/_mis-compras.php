<?php

use App\Auth\Autenticacion;
use App\Models\Compras;
use App\Models\PrecioSimbolo;

$auth = new Autenticacion();
$usuarioId = $auth->getUsuarioId();
$comprasModel = new Compras();
$compras = $comprasModel->getComprasByUsuarioId($usuarioId);
$precioSimboloModel = new PrecioSimbolo();

?>

<div class="container mt-5 mb-4">
    <h2 class="text-center mb-4">Mis Compras</h2>
    <div class="table-container">
        <?php if (empty($compras)) { ?>
            <p>No has realizado ninguna compra.</p>
        <?php } else { ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Fecha de Compra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($compras as $compra) { ?>
                        <?php
                        $simboloNombre = $precioSimboloModel->getNombrePorId($compra['precio_simbolo_fk']);
                        ?>
                        <tr>
                            <td class="fix-col"><img src="<?= './res/img/productos/' . $compra['productos_img']; ?>" alt="<?= $compra['productos_img_alt']; ?>" class="m-auto d-block"></td>
                            <td><?= $compra['productos_title']; ?></td>
                            <td><?= $compra['cantidad']; ?></td>
                            <td><?= $simboloNombre . ' ' . $compra['productos_price']; ?></td>
                            <td><?= $simboloNombre . ' ' . ($compra['cantidad'] * $compra['productos_price']); ?></td>
                            <td><?= $compra['fecha']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>