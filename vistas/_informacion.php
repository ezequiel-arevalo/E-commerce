<?php 
    // Traigo la biblioteca de productos, donde se encuentra mi función productos()
    require_once __DIR__ . '/../bibliotecas/biblioteca.php';
    
    // Obtenemos la función donde se encuentran los productos y sus características
    $productosInfo = productoID($_GET['id']);
?>
<div class="Vista-Title">
    <h2>Información acerca de: <?= $productosInfo->producto_title;?></h2>
</div>
<div id="Producto-Info">
    <div id="Producto-Info-IMG">
        <img src="./res/img/productos/<?=$productosInfo->producto_imagen;?>" alt="<?=$productosInfo->producto_imagen_alt;?>" width="150" height="410" loading="lazy">
    </div>
    <div id="Producto-Info-TEXT">
        <h3>Descripción:</h3>
        <p><?=$productosInfo->producto_description;?></p>
    </div>
</div>
