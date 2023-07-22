<?php 
use App\Models\Producto;
    
// Obtenemos la función donde se encuentran los productos y sus características
$productos = (new Producto)->productoID($_GET['id']);
// Obtener el objeto Categoria asociado al producto
?>

<div class="Vista-Title">
    <h2>Información acerca de: <?= $productos->getProductoTitle(); ?></h2>
</div>

<div id="Producto-Info">
    <div id="Producto-Info-IMG">
        <img src="./res/img/productos/big-<?= $productos->getProductoImagen(); ?>" alt="<?= $productos->getProductoImagenAlt(); ?>" width="150" height="410" loading="lazy">
    </div>
    <div id="Producto-Info-TEXT">
        <h3>Descripción:</h3>
        <p><?= $productos->getProductoDescription(); ?></p>
    </div>
</div>
