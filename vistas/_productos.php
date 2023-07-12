<?php
use App\Models\Producto;
use App\Models\PrecioSimbolo;

// Obtener la función que devuelve los productos y sus características
$productos = (new Producto)->Productos([
    ['estados_publicacion_fk', '=', 2],
]);
?>

<div class="Vista-Title">
    <h2>Productos</h2>
    <p>Revisa nuestro catálogo de productos</p>
</div>
<ul id="Productos">
    <?php
    // Iterar sobre cada producto obtenido
    foreach ($productos as $item) {
        // Obtener el objeto PrecioSimbolo asociado al producto
        $precioSimbolo = (new PrecioSimbolo)->precioSimboloID($item->getPrecioSimboloFk());
    ?>
    <li>
        <article class="Producto-card">
            <div class="Producto-header">
                <div class="Producto-Imagen">
                    <!-- Mostrar la imagen del producto -->
                    <img src="./res/img/productos/<?= $item->getProductoImagen(); ?>" alt="<?= $item->getProductoImagenAlt(); ?>" loading="lazy">
                </div>
            </div>
            <div class="Producto-main">
                <div class="Producto-title">
                    <!-- Mostrar el título del producto -->
                    <h4><?= $item->getProductoTitle(); ?></h4>
                </div>
                <div class="line"></div>
                <div class="Producto-text">
                    <!-- Mostrar la sinopsis del producto -->
                    <p><?= $item->getProductoSinopsis(); ?></p>
                </div>
            </div>
            <div class="Producto-footer">
                <div class="Producto-precio">
                    <!-- Mostrar el precio del producto junto con el símbolo del precio -->
                    <span class="Precio">Precio: <?= $precioSimbolo->getPrecioSimboloNombre(); ?> <?= number_format($item->getProductoPrice(), 2); ?></span>
                </div>
                <div class="Producto-button">
                    <!-- Enlace para ver más detalles del producto -->
                    <a href="index.php?s=_informacion&id=<?= $item->getProductoId(); ?>" class="Producto-btn">¡Ver más!</a>
                </div>
            </div>
        </article>
    </li>
    <?php
    }
    ?>
</ul>