<?php 
use App\Models\Producto;
    
// Obtenemos la función donde se encuentran los productos y sus características
$productos = (new Producto())->productoID($_GET['id']);
?>
<div class="Vista-Title">
    <h2>Se requiere confirmación para eliminar</h2>
    <p>Estás por eliminar este producto de manera definitiva</p>
</div>        
<div id="Producto-Info">
    <div id="Producto-Info-IMG">
        <img src="<?= './../res/img/productos/' . $productos->getProductoImagen();?>" alt="<?= $productos->getProductoImagenAlt();?>" width="150" height="410" loading="lazy">
    </div>    
    <div id="Producto-Info-TEXT">
        <h3>Descripción:</h3>
        <p><?= $productos->getProductoDescription(); ?></p>
        <div id="Producto-Eliminar">
        <h2>Esperando confirmación</h2>
        <form action="acciones/productos-eliminar.php?id=<?= $productos->getProductoId();?>" method="post">
            <button type="submit">Eliminar</button>
        </form>
    </div>
    </div>
</div>    
