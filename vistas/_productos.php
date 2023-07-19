<?php
use App\Models\Producto;

// Obtener la función que devuelve los productos y sus características
$busqueda = [
    ['estados_publicacion_fk', '=', 2],
];

if (!empty($_GET['titulo'])) {
    $busqueda[] = ['productos_title', 'LIKE', '%' . $_GET['titulo'] . '%'];
}

$productos = (new Producto)->Productos($busqueda);

?>

<div class="Vista-Title">
    <h2>Productos</h2>
    <p>Revisa nuestro catálogo de productos</p>
</div>

<div>
    <h2>Buscador:</h2>
    <form action="index.php?s=_productos" method="get" id="Form-container" style="margin: 0px auto; max-width: 600px;">
        <input type="hidden" name="s" value="_productos">
        <div class="form-group">
            <label for="titulo">Titulo</label>
            <input 
                type="search" 
                name="titulo" 
                id="titulo"
                value="<?= $_GET['titulo'] ?? null;?>">
            <button type="submit">Buscar</button>
        </div>
    </form>
</div>

<ul id="Productos">
    <?php
    // Iterar sobre cada producto obtenido
    foreach ($productos as $item) {
        // Obtener el objeto PrecioSimbolo asociado al producto
    ?>
    <li>
        <article class="Producto-card">
            <div class="Producto-header">
                <div class="Producto-Imagen">
                    <!-- Mostrar la imagen del producto -->
                    <picture>
                        <img src="./res/img/productos/big-<?= $item->getProductoImagen(); ?>" alt="<?= $item->getProductoImagenAlt(); ?>" loading="lazy">
                    </picture>
                </div>
            </div>
            <div class="Producto-main">
                <div class="Producto-title">
                    <!-- Mostrar el título del producto -->
                    <h4><?= $item->getProductoTitle(); ?></h4>
                </div>
                <div class="line"></div>
                <div class="Producto-categoria">
                    <!-- Mostrar la categoría del producto -->
                    <p>Tipo: <?= $item->getNombreCategoria()->getCategoriaNombre(); ?></p>
                </div>
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
