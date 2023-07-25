<?php 
use App\Models\Producto;

// Obtenemos la función donde se encuentran los productos y sus características
$productos = (new Producto)->productoID($_GET['id']);

$mensajeError = "Debes iniciar sesión para añadir productos a tu carrito";
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
<?php 
    if($Autenticacion->estaAutenticado()):
?>
    <div>
        <button class="btn btn-success m-auto d-flex mt-2 mb-3">Añadir al Carrito<i class="bi bi-plus-circle px-2"></i></button>
    </div>
<?php 
    else:
?>
    <div class="alert alert-danger alert-dismissible fade show w-50 m-auto text-center text-wrap" role="alert" id="alert-error">
        <strong>Advertencia!</strong> Debes iniciar sesión para añadir productos al carrito.
    </div>
<?php 
    endif;
?>