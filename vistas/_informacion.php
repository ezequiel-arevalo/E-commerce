<?php 
use App\Models\Producto;
    
// Obtenemos la función donde se encuentran los productos y sus características
$productosInfo = (new Producto)->productoID($_GET['id']);
?>

<div class="Vista-Title">
    <h2>Información acerca de: <?= $productosInfo->getProductoTitle(); ?></h2>
</div>

<div id="Producto-Info">
    <div id="Producto-Info-IMG">
        <img src="./res/img/productos/<?= $productosInfo->getProductoImagen(); ?>" alt="<?= $productosInfo->getProductoImagenAlt(); ?>" width="150" height="410" loading="lazy">
    </div>
    <div id="Producto-Info-TEXT">
        <h3>Descripción:</h3>
        <p><?= $productosInfo->getProductoDescription(); ?></p>
    </div>
</div>
