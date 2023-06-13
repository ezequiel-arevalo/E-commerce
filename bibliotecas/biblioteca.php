<?php

require_once __DIR__ . '/../classes/Producto.php';
/** 
 * 
 * Esta función obtiene de nuestra base de datos local, (archivo json)
 * @return array[] devuelve un array con los valores:
 * 1. ID
 * 2. TITULO
 * 3. DESCRIPCIÓN
 * 4. SINOPSIS
 * 5. PRECIO
 * 6. IMAGEN
 * 7. ALT DE IMAGEN
 * 
**/
//Debemos tomar el dato que retorna la función con (): que valor retornará la función
function Productos(): array {
    $data = json_decode(file_get_contents(__DIR__ . "/../db/productos.json"), true);

    $productos = [];

    foreach($data as $datos){
        $producto = new Producto;
        $producto->producto_id          = $datos['producto_id'];
        $producto->producto_title       = $datos['producto_title'];
        $producto->producto_description = $datos['producto_description'];
        $producto->producto_sinopsis    = $datos['producto_sinopsis'];
        $producto->producto_price       = $datos['producto_price'];
        $producto->producto_imagen      = $datos['producto_imagen'];
        $producto->producto_imagen_alt  = $datos['producto_imagen_alt'];

        $productos[] = $producto;
    }

    return $productos;
}

function productoID(int $id): ?Producto {
    $productosInfo = Productos();
    
    foreach($productosInfo as $productoID){
        if ($productoID->producto_id == $id) {
            return $productoID;
        }
    }
    
    return null;
}
