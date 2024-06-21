<?php 

// Obtener la lista de productos utilizando el método "Productos" de la clase Producto
$productos = (new App\Models\Producto())->Productos();

?>

<!-- Vista de administración de productos -->
<div class="Vista-Title">
    <h1>Administración de Productos</h1>
    
    <!-- Botón para crear un nuevo producto -->
    <div id="container-admin-productos">
        <a href="index.php?s=_productos-crear"> 
            <span> ✘ </span> Crear un nuevo
        </a>
    </div>
    
    <!-- Tabla que muestra los productos -->
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Estado</th>
                <th>Título</th>
                <th>Categoría</th>
                <th class="table-texto">Sinopsis</th>
                <th>Simbolo</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    // Iterar sobre la lista de productos y mostrar cada producto en una fila de la tabla
                    foreach($productos as $producto):
                ?>
                <tr>
                    <td><?= $producto->getProductoId(); ?></td>
                    <td><?= $producto->getEstadoPublicacion()->getNombre(); ?></td>
                    <td><?= $producto->getProductoTitle(); ?></td>
                    <td><?= $producto->getNombreCategoria()->getCategoriaNombre(); ?></td>
                    <td class="table-texto"><?= $producto->getProductoSinopsis(); ?></td>
                    <td><?= $producto->getPrecioSimbolo()->getPrecioSimboloNombre(); ?></td>
                    <td><?= number_format($producto->getProductoPrice() , 2); ?></td>
                    <td><img src="<?= './../res/img/productos/' . $producto->getProductoImagen(); ?>" alt="<?= $producto->getProductoImagenAlt(); ?>"></td>
                    <td>
                        <!-- Enlaces para editar y eliminar el producto -->
                        <a href="index.php?s=_productos-editar&id=<?= $producto->getProductoId(); ?>" class="btn btn-primary mb-1 accion-btn"><i class="bi bi-pencil"> </i>Editar</a>
                        <a href="index.php?s=_productos-eliminar&id=<?= $producto->getProductoId(); ?>" class="btn btn-danger mt-1 accion-btn"><i class="bi bi-trash3"> </i>Borrar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
