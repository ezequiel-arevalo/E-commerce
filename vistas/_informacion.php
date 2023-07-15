<?php 
use App\Models\Producto;
use App\Models\Categoria; // Agrega la clase Categoria
    
// Obtenemos la función donde se encuentran los productos y sus características
$productosInfo = (new Producto)->productoID($_GET['id']);
// Obtener el objeto Categoria asociado al producto
$categoria = Categoria::categoriaPorId($productosInfo->getCategoriasFk());
?>

<div class="Vista-Title">
    <h2>Información acerca de: <?= $productosInfo->getProductoTitle(); ?></h2>
</div>

<div id="Producto-Info">
    <div id="Producto-Info-IMG">
        <img src="./res/img/productos/big-<?= $productosInfo->getProductoImagen(); ?>" alt="<?= $productosInfo->getProductoImagenAlt(); ?>" width="150" height="410" loading="lazy">
    </div>
    <div id="Producto-Info-TEXT">
        <h3>Descripción:</h3>
        <p><?= $productosInfo->getProductoDescription(); ?></p>
    </div>
    <div class="Producto-categoria"> <!-- Agrega una nueva sección para mostrar la categoría -->
        <!-- Mostrar la categoría del producto -->
        <p>Tipo: <?= $categoria ? $categoria->getCategoriaNombre() : 'Sin categoría'; ?></p>
    </div>
</div>
