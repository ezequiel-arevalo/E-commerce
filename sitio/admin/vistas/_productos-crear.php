<?php

if (isset($_SESSION['errores'])) {
    $errores = $_SESSION['errores'];
    unset($_SESSION['errores']);
} else {
    $errores = [];
}

if (isset($_SESSION['oldData'])) {
    $oldData = $_SESSION['oldData'];
    unset($_SESSION['oldData']);
} else {
    $oldData = [
        'estados_publicacion_fk' => null,
        'categorias_fk' => null,
        'precio_simbolo_fk' => null,
    ];
}

$EstadoPublicacion = (new \App\Models\EstadoPublicacion())->todo();
$PrecioSimbolo     = (new \App\Models\PrecioSimbolo())    ->todo();
$Categoria         = (new \App\Models\Categoria())        ->todos();
?>

<section id="crear-productos">
    <div class="Vista-Title">
        <h2>Crea un nuevo producto</h2>
    </div>

    <form action="acciones/productos-publicar.php" method="POST" id="crear-productos-form" enctype="multipart/form-data">
        <div class="form-fila">
            <label for="titulo">Título</label>
            <input
            type="text"
            id="titulo"
            name="titulo"
            value="<?= $oldData['titulo'] ?? null ;?>"
            aria-describedby="help-titulo <?php if (isset($errores['titulo'])): ?> error-titulo <?php endif; ?>"
            >
            <div class="form-help" id="help-titulo">El título debe tener al menos 2 caracteres.</div>
            <?php
            if (isset($errores['titulo'])):
            ?>
                <div class="msg-error" id="error-titulo"><?= $errores['titulo'];?></div>
            <?php
            endif;
            ?>
        </div>

        <div class="form-fila">
            <label for="sinopsis">Sinopsis</label>
            <textarea name="sinopsis" id="sinopsis" <?php if (isset($errores['sinopsis'])): ?>aria-describedby="error-sinopsis"<?php endif; ?>><?= $oldData['sinopsis'] ?? null ;?></textarea>

            <?php if (isset($errores['sinopsis'])): ?>
                <div class="msg-error" id="error-sinopsis"><?= $errores['sinopsis']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-fila">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" <?php if (isset($errores['descripcion'])): ?>aria-describedby="error-descripcion"<?php endif; ?>><?= $oldData['descripcion'] ?? null ;?></textarea>

            <?php if (isset($errores['descripcion'])): ?>
                <div class="msg-error" id="error-descripcion"><?= $errores['descripcion']; ?></div>
            <?php endif; ?>
        </div>

        
        <div class="form-fila">
            <label for="precio_simbolo_fk">Tipo de moneda:</label>
            <!-- Descontinuado de momento -->
            <!-- <select name="precio_simbolo_fk" id="precio_simbolo_fk">
                <?php
                foreach ($PrecioSimbolo as $item):
                ?>
                    <option 
                        value="<?= $item->getPrecioSimboloId();?>"
                        <?= $item->getPrecioSimboloId() == $oldData['precio_simbolo_fk'] ? 'selected' : '';?>
                        >
                        <?= $item->getPrecioSimboloNombre();?>
                    </option>
                    <?php
                endforeach;
                ?>
            </select> -->
            <select name="precio_simbolo_fk" id="precio_simbolo_fk">
                <option 
                    value="<?= $PrecioSimbolo[0]->getPrecioSimboloId();?>"
                    <?= $PrecioSimbolo[0]->getPrecioSimboloId() == $oldData['precio_simbolo_fk'] ? 'selected' : '';?>
                >
                    <?= $PrecioSimbolo[0]->getPrecioSimboloNombre();?>
                </option>
            </select>
        </div>
        <div class="form-fila">
            <label for="price">Precio</label>
            <input type="number" name="price" id="price" step="0.01" value="<?= $oldData['price'] ?? null ;?>" <?php if (isset($errores['price'])): ?>aria-describedby="error-price"<?php endif; ?>>
                
                <?php if (isset($errores['price'])): ?>
                    <div class="msg-error" id="error-price"><?= $errores['price']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-fila">
                    <label for="imagen">Imagen <span class="msg-opcional">(opcional)</span></label>
            <input type="file" name="imagen" id="imagen">
        </div>
        
        <div class="form-fila">
            <label for="imagen_alt">Descripción de la imagen <span class="msg-opcional">(opcional)</span></label>
            <input type="text" name="imagen_alt" id="imagen_alt" value="<?= $oldData['imagen_alt'] ?? null ;?>">
        </div>
        
        
        <div class="form-fila">
            <label for="estados_publicacion_fk">Estado de publicación</label>
            <select name="estados_publicacion_fk" id="estados_publicacion_fk">
                <?php
                foreach ($EstadoPublicacion as $estado):
                ?>
                    <option 
                    value="<?= $estado->getEstadoPublicacionId();?>"
                    <?= $estado->getEstadoPublicacionId() == $oldData['estados_publicacion_fk'] ? 'selected' : '';?>
                    >
                    <?= $estado->getNombre();?>
                </option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        
        <div class="form-fila">
            <label for="categorias_fk">Categoría</label>
            <select name="categorias_fk" id="categorias_fk">
                <?php
                foreach ($Categoria as $item):
                ?>
                    <option 
                        value="<?= $item->getCategoriaId();?>"
                        <?= $item->getCategoriaId() == $oldData['categorias_fk'] ? 'selected' : '';?>
                    >
                        <?= $item->getCategoriaNombre();?>
                    </option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        
        <button type="submit" id="crear-productos-btn">Publicar</button>
    </form>
</section>
