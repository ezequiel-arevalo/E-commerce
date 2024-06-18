<?php 
use App\Models\Producto;
use App\Models\Carrito;
use App\Auth\Autenticacion;

// Obtenemos la función donde se encuentran los productos y sus características
$productos = (new Producto)->productoID($_GET['id']);

$mensajeError = "Debes iniciar sesión para añadir productos a tu carrito";

// Procesar la adición al carrito si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoId = $_POST['producto_id'];
    $cantidad = 1;

    $autenticacion = new Autenticacion();
    if ($autenticacion->estaAutenticado()) {
        $usuarioId = $autenticacion->getUsuarioId();
        // Crear una instancia del carrito
        $carrito = new Carrito();
        $carrito->agregarProducto($usuarioId, $productoId, $cantidad);
        $mensajeExito = "Producto añadido al carrito con éxito!";
    } else {
        $mensajeError = "Debes iniciar sesión para añadir productos a tu carrito";
    }
}
?>

<div class="Vista-Title">
    <h2>Información acerca de: <?= $productos->getProductoTitle(); ?></h2>
</div>

<div id="Producto-Info">
    <div id="Producto-Info-IMG">
        <img src="./res/img/productos/big-<?= $productos->getProductoImagen(); ?>" alt="<?= $productos->getProductoImagenAlt(); ?>" loading="lazy">
    </div>
    <div id="Producto-Info-TEXT">
        <h3>Descripción:</h3>
        <p><?= $productos->getProductoDescription(); ?></p>
    </div>
</div>

<?php if ((new Autenticacion())->estaAutenticado()): ?>
    <div>
        <?php if (isset($mensajeExito)): ?>
            <div class="alert alert-success alert-dismissible fade show w-50 m-auto text-center text-wrap" role="alert"><?= $mensajeExito; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="hidden" name="producto_id" value="<?= $productos->getProductoId(); ?>">
            <button type="submit" class="btn btn-success m-auto d-flex mt-2 mb-3">
                Añadir al Carrito<i class="bi bi-plus-circle px-2"></i>
            </button>
        </form>
    </div>
<?php else: ?>
    <div class="alert alert-danger alert-dismissible fade show w-50 m-auto text-center text-wrap" role="alert" id="alert-error">
        <strong>Advertencia!</strong> <?= $mensajeError; ?>
    </div>
<?php endif; ?>
