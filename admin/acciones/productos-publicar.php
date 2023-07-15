<?php

// Importar las clases necesarias
use App\Auth\Autenticacion;
use App\Models\Producto;
use Intervention\Image\ImageManagerStatic as Image;

// Iniciar la sesión y cargar el archivo de autoloading
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

// Verificar si el usuario está autenticado
if (!(new Autenticacion())->estaAutenticado()) {
    $_SESSION['mensajeError'] =  "¡Se requiere haber iniciado sesión para ver este contenido!";
    header("Location: ../index.php?s=_iniciar-sesion");
    exit;
}

// Obtener los datos enviados por el formulario
$titulo                      = $_POST['titulo'];
$sinopsis                    = $_POST['sinopsis'];
$descripcion                 = $_POST['descripcion'];
$simbolo                     = $_POST['precio_simbolo_fk'];
$price                       = $_POST['price'];
$imagen                      = $_FILES['imagen'];
$imagen_alt                  = $_POST['imagen_alt'];
$estados_publicacion_fk      = $_POST['estados_publicacion_fk'];
$categoria                   = $_POST['categorias_fk'];

$errores = [];

// Validar los datos ingresados

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

// Si hay errores, redireccionar al formulario con los errores y los datos ingresados anteriormente
if(count($errores) > 0) {
    $_SESSION['errores'] = $errores;
    $_SESSION['oldData'] = $_POST;
    header("Location: ../index.php?s=_productos-crear");
    exit;
}

// Procesar la imagen del producto si se ha subido una
if (!empty($imagen['tmp_name'])) {
    $nombreImagen = date('YmdHis') . "_" . $imagen['name'];
    
    Image::make($imagen['tmp_name'])
    ->resize(150, 150, function($constraint){
        $constraint->aspectRatio();
    })
    ->save(__DIR__ . '/../../res/img/productos/' . $nombreImagen);

    Image::make($imagen['tmp_name'])
    ->resize(400, 400, function($constraint){
        $constraint->aspectRatio();
    })
    ->save(__DIR__ . '/../../res/img/productos/big-' . $nombreImagen);
}
try {
    // Crear un nuevo producto en la base de datos
    (new Producto)->crear([
        'usuario_fk'              => (new Autenticacion())->getUsuarioId(),
        'categorias_fk'           => $categoria,
        'estados_publicacion_fk'  => $estados_publicacion_fk,
        'productos_title'         => $titulo,
        'productos_sinopsis'      => $sinopsis,
        'productos_description'   => $descripcion,
        'precio_simbolo_fk'       => $simbolo,
        'productos_price'         => $price,
        'productos_img'           => $nombreImagen ?? null,
        'productos_img_alt'       => $imagen_alt,
    ]);
    $_SESSION['mensajeExito'] = "El producto <b>" . $titulo . "</b> se publicó correctamente.";
    header("Location: ../index.php?s=_productos");
    exit;
} catch (Exception $e) {
    // Registrar el error en el archivo de log
    file_put_contents(__DIR__ . '/../../logs/error.log.txt', date('Y-m-d H:i:s') . "-" . $e->getMessage() . "\r\n", FILE_APPEND);
    $_SESSION['mensajeError'] = 'Ocurrió un problema inesperado al tratar de publicar el producto';
    $_SESSION['oldData'] = $_POST;
    header("Location: ../index.php?s=_productos-crear");
    exit;
}