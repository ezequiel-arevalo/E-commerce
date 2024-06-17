<?php

$producto          = (new App\Models\Producto())          ->productoID($_GET['id']);
$EstadoPublicacion = (new \App\Models\EstadoPublicacion())->todo();
$PrecioSimbolo     = (new \App\Models\PrecioSimbolo())    ->todo();
$Categoria         = (new \App\Models\Categoria())        ->todos();

// Obtener el producto utilizando el método "productoID" de la clase Producto y pasando el ID obtenido de $_GET['id']

// Verificar si existen errores almacenados en la sesión y asignarlos a la variable $errores
if (isset($_SESSION['errores'])) {
    $errores = $_SESSION['errores'];
    unset($_SESSION['errores']);
} else {
    $errores = [];
}

// Verificar si existen datos antiguos almacenados en la sesión y asignarlos a la variable $oldData
if (isset($_SESSION['oldData'])) {
    $oldData = $_SESSION['oldData'];
    unset($_SESSION['oldData']);
} else {
    $oldData = [];
}
?>

<section id="editar-productos">
    <div class="Vista-Title">
        <h2>Editar un producto</h2>
    </div>

    <form action="acciones/productos-editar.php?id=<?= $producto->getProductoId(); ?>" method="post" id="editar-productos-form" enctype="multipart/form-data">
        <div class="form-fila">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="<?= $oldData['titulo'] ?? $producto->getProductoTitle(); ?>" aria-describedby="help-titulo <?php if (isset($errores['titulo'])): ?> error-titulo <?php endif; ?>">
            <div class="form-help" id="help-titulo">El título debe tener al menos 2 caracteres.</div>
            <?php if (isset($errores['titulo'])): ?>
                <div class="msg-error" id="error-titulo"><?= $errores['titulo']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-fila">
            <label for="sinopsis">Sinopsis</label>
            <textarea name="sinopsis" id="sinopsis" <?php if (isset($errores['sinopsis'])): ?>aria-describedby="error-sinopsis"<?php endif; ?>><?= $oldData['sinopsis'] ?? $producto->getProductoSinopsis(); ?></textarea>

            <?php if (isset($errores['sinopsis'])): ?>
                <div class="msg-error" id="error-sinopsis"><?= $errores['sinopsis']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-fila">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" <?php if (isset($errores['descripcion'])): ?>aria-describedby="error-descripcion"<?php endif; ?>><?= $oldData['descripcion'] ?? $producto->getProductoDescription(); ?></textarea>

            <?php if (isset($errores['descripcion'])): ?>
                <div class="msg-error" id="error-descripcion"><?= $errores['descripcion']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-fila">
            <label for="simbolo">Tipo de moneda:</label>
            <select name="precio_simbolo_fk" id="precio_simbolo_fk">
                <!-- <?php foreach ($PrecioSimbolo as $item): ?>
                    <option 
                        value="<?= $item->getPrecioSimboloId(); ?>"
                        <?= $item->getPrecioSimboloId() == ($oldData['precio_simbolo_fk'] ?? $producto->getPrecioSimboloFk()) ? 'selected' : ''; ?>
                    >
                        <?= $item->getPrecioSimboloNombre(); ?>
                    </option>
                <?php endforeach; ?> -->
                <option 
                    value="<?= $PrecioSimbolo[0]->getPrecioSimboloId();?>"
                    <?= $PrecioSimbolo[0]->getPrecioSimboloId() == ($oldData['precio_simbolo_fk'] ?? $producto->getPrecioSimboloFk()) ? 'selected' : ''; ?>
                >
                    <?= $PrecioSimbolo[0]->getPrecioSimboloNombre();?>
                </option>
            </select>
        </div>

        <div class="form-fila">
            <label for="price">Precio</label>
            <input type="number" name="price" id="price" step="0.01" value="<?= $oldData['price'] ?? $producto->getProductoPrice(); ?>" <?php if (isset($errores['price'])): ?>aria-describedby="error-price"<?php endif; ?>>

            <?php if (isset($errores['price'])): ?>
                <div class="msg-error" id="error-price"><?= $errores['price']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-fila">
            <p>Imagen actual</p>
            <?php if ($producto->getProductoImagen()): ?>
                <picture>
                    <img src="<?= './../res/img/productos/' . $producto->getProductoImagen(); ?>" alt="<?= $producto->getProductoImagenAlt(); ?>" loading="lazy">
                </picture>
            <?php else: ?>
                <p>No tiene imagen.</p>
            <?php endif; ?>
        </div>

        <div class="form-fila">
            <label for="imagen">Imagen <span class="msg-opcional">(opcional)</span></label>
            <input type="file" name="imagen" id="imagen">
        </div>

        <div class="form-fila">
            <label for="imagen_alt">Descripción de la imagen <span class="msg-opcional">(opcional)</span></label>
            <input type="text" name="imagen_alt" id="imagen_alt" value="<?= $oldData['imagen_alt'] ?? $producto->getProductoImagenAlt(); ?>">
        </div>
        
        <div class="form-fila">
            <label for="estados_publicacion_fk">Estado de publicación</label>
            <select name="estados_publicacion_fk" id="estados_publicacion_fk">
                <?php foreach ($EstadoPublicacion as $estado): ?>
                    <option 
                        value="<?= $estado->getEstadoPublicacionId(); ?>"
                        <?= $estado->getEstadoPublicacionId() == ($oldData['estados_publicacion_fk'] ?? $producto->getEstadosPublicacionFk()) ? 'selected' : ''; ?>
                    >
                        <?= $estado->getNombre(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-fila">
            <label for="categorias_fk">Categoría</label>
            <select name="categorias_fk" id="categorias_fk">
                <?php foreach ($Categoria as $item): ?>
                    <option 
                        value="<?= $item->getCategoriaId(); ?>"
                        <?= $item->getCategoriaId() == ($oldData['categorias_fk'] ?? $producto->getCategoriasFk()) ? 'selected' : ''; ?>
                    >
                        <?= $item->getCategoriaNombre(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" id="crear-productos-btn">Actualizar</button>
    </form>
</section>
