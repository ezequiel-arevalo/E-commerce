<?php

// Importar las clases necesarias
use App\Auth\Autenticacion;
use App\Models\Producto;
use App\Models\PrecioSimbolo;

// Iniciar la sesión y cargar el archivo de autoloading
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

// Verificar si el usuario está autenticado
if (!(new Autenticacion())->estaAutenticado()) {
    $_SESSION['mensajeError'] =  "¡Se requiere haber iniciado sesión para ver este contenido!";
    header("Location: ../index.php?s=_iniciar-sesion");
    exit;
}

// Obtener el ID del producto y los datos enviados por el formulario
$id                          = $_GET['id'];
$titulo                      = $_POST['titulo'];
$sinopsis                    = $_POST['sinopsis'];
$descripcion                 = $_POST['descripcion'];
$price                       = $_POST['price'];
$imagen                      = $_FILES['imagen'];
$imagen_alt                  = $_POST['imagen_alt'];
$estados_publicacion_fk      = $_POST['estados_publicacion_fk'];
$categorias_fk               = $_POST['categorias_fk'];
$precio_simbolo_fk           = $_POST['precio_simbolo_fk'];

// Obtener el producto a editar por su ID
$producto = (new Producto)->productoID($id);
$PrecioSimbolo = (new PrecioSimbolo())->todos();

// Verificar si el producto existe
if (!$producto) {
    header('Location: ../index.php?s=productos');
    exit;
}

$errores = [];

// Validar los datos del formulario
if (empty($titulo)) {
    $errores['titulo'] = "Tenés que escribir el título del producto!";
} else if(strlen($titulo) < 2) {
    $errores['titulo'] = "El título del producto debe tener al menos 2 caracteres.";
}

if (empty($sinopsis)) {
    $errores['sinopsis'] = "Tenés que escribir la sinopsis del producto!";
}

if (empty($descripcion)) {
    $errores['descripcion'] = "Tenés que escribir la descripción del producto!";
}

if (empty($price)) {
    $errores['price'] = "Tenés que ingresar el precio del producto!";
}

if(count($errores) > 0) {
    $_SESSION['errores'] = $errores;
    $_SESSION['oldData'] = $_POST;
    header("Location: ../index.php?s=_productos-editar&id=" . $id);
    exit;
}

if (!empty($_FILES['imagen']['tmp_name'])) {
    $nombreImagen = date('YmdHis') . "_" . $imagen['name'];
    move_uploaded_file($imagen['tmp_name'], __DIR__ . '/../../res/img/productos/' . $nombreImagen);
}

try {
    // Editar el producto en la base de datos
    (new Producto)->editar($id, [
        'productos_title'        => $titulo,
        'productos_sinopsis'     => $sinopsis,
        'productos_description'  => $descripcion,
        'productos_price'        => $price,
        'productos_img'          => $nombreImagen ?? $producto->getProductoImagen(),
        'productos_img_alt'      => $imagen_alt,
        'estados_publicacion_fk' => $estados_publicacion_fk,
        'categorias_fk'          => $categorias_fk,
        'precio_simbolo_fk'      => $precio_simbolo_fk,
    ]);

    // Eliminar la imagen anterior si se cargó una nueva
    if (isset($nombreImagen) && $producto->getProductoImagen() !== null) {
        unlink(__DIR__ . '/../../res/img/productos/' . $producto->getProductoImagen());
    }

    $_SESSION['mensajeExito'] = "El producto <b>" . $titulo . "</b> se editó correctamente.";
    header("Location: ../index.php?s=_productos");
    exit;
} catch (Exception $e) {
    header("Location: ../index.php?s=_productos-editar&id=" . $id);
    exit;
}
