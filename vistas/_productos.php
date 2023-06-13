<?php 
    // Traigo la biblioteca de productos, donde se encuentra mi función productos()
    require_once __DIR__ . '/../bibliotecas/biblioteca.php';
    
    // Obtenemos la función donde se encuentran los productos y sus características
    $productos = Productos();
?>

<div class="Vista-Title">
    <h2>Productos</h2>
    <p>Revisa nuestro catálogo de productos</p>
</div>
<ul id="Productos">
    <?php 
        foreach($productos as $item){
    ?>
    <li>
        <article class="Producto-card">
            <div class="Producto-header">
                <div class="Producto-Imagen">
                    <img src="./res/img/productos/<?= $item->producto_imagen ?>" alt="<?=$item->producto_imagen_alt?>" loading="lazy">
                </div>
            </div>
            <div class="Producto-main">
                <div class="Producto-title">
                    <h4><?=$item->producto_title?></h4>
                </div>
                <div class="line"></div>
                <div class="Producto-text">
                    <p><?=$item->producto_sinopsis?></p>
                </div>
            </div>
            <div class="Producto-footer">
                <div class="Producto-precio">
                    <span class="Precio">Precio: $<?=$item->producto_price?></span>    
                </div>
                <div class="Producto-button">
                    <a href="index.php?s=_informacion&id=<?=$item->producto_id?>" class="Producto-btn"> Ver más!</a>
                </div>
            </div>
        </article>
    </li>
    <?php
        }
    ?>
</ul>
