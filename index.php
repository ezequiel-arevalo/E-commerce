<?php
use App\Auth\Autenticacion;

// Agregamos que siempre esté presente la clase DB.
require_once __DIR__ . '/bootstrap/autoload.php';
session_start();

/** 
 * 
 * Cambio de Vistas mediante el query string s?=
 * Prevención si el usuario entra y no hay un query string en la URL, se muestre por defecto la vista de _Home 
 * Prevención por si el usuario ingresa en el query string ../index mediante el uso de una whitelist, misma está definida con un array mediante $rutas
 * 
 **/

// Obtener la vista actual del query string o establecerla como "_home" por defecto
$vista = isset($_GET['s']) ? $_GET['s'] : '_home';

// Definir las rutas y títulos correspondientes para cada vista
$rutas = [
    '_404' => [
        'title' => 'MyShop: Página no encontrada'
    ],
    '_home' => [
        'title' => 'MyShop: Tienda en línea de productos de calidad'
    ],
    '_productos' => [
        'title' => 'MyShop: Descubre nuestra amplia variedad de productos de calidad'
    ],
    '_informacion' => [
        'title' => 'MyShop: Encuentra aquí toda la información que necesitas sobre nuestra tienda en línea'
    ],
    '_contacto' => [
        'title' => 'MyShop: Contáctanos para cualquier consulta o sugerencia'
    ],
    '_iniciar-sesion' => [
        'title' => 'MyShop: Logueo de usuarios'
    ],
    '_registrarse' => [
        'title' => 'MyShop: Registro de usuarios'
    ],
    '_perfil' => [
        'title' => 'MyShop: My Account',
        'requiereAutenticacion' => true,
    ]
];

// Verificar si la vista actual existe en las rutas definidas, de lo contrario, establecerla como "_404"
if (!isset($rutas[$vista])) {
    $vista = '_404';
}

// Obtener las opciones de la vista actual
$rutasOpciones = $rutas[$vista];
$title = $rutasOpciones['title'];

// Crear instancia del objeto Autenticacion
$Autenticacion = new Autenticacion();

// Verificar si la vista requiere autenticación y el usuario no está autenticado, redirigir a la página de inicio de sesión
$requiereAutenticacion = $rutasOpciones['requiereAutenticacion'] ?? false;
if ($requiereAutenticacion && !$Autenticacion->estaAutenticado()) {
    $_SESSION['mensajeError'] =  "¡Se requiere haber iniciado sesión para ver este contenido!";
    header("Location: index.php?s=_iniciar-sesion");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!--Definición del documento-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Información del sitio-->
    <title><?= $title; ?></title> <!-- Utilizando la variable $title asignada con el título correspondiente -->
    <meta name="description" content="MyShop es una tienda en línea que ofrece productos de calidad a precios asequibles. ¡Visítanos hoy mismo!">
    <meta name="author" content="Ezequiel Thomas Arevalo">
    <meta name="keywords" content="MyShop, tienda en línea, productos, calidad, precios asequibles">

    <!--CSS-->
    <link type="text/css" rel="stylesheet" href="./res/css/styles.css">
</head>

<body>
    <!--Inicio de Header-->
    <header>
        <div id="Header-Logo">
            <h1>MyShop</h1>
        </div>
    </header>
    <!--Fin de Header-->

    <!--Inicio de Nav-->
    <nav>
        <ul>
            <li><a href="index.php?s=_home" class="list-item-link">Home</a></li>
            <li><a href="index.php?s=_productos" class="list-item-link">Productos</a></li>
            <li><a href="index.php?s=_contacto" class="list-item-link">Contacto</a></li>
        <?php 
            if($Autenticacion->estaAutenticado()):
        ?>
            <li><a href="index.php?s=_perfil" class="list-item-link">Perfil</a></li>
            <li>
                <form action="acciones/cerrar.sesion.php" method="post">
                    <!-- Mostrar el nombre de usuario y el botón de cerrar sesión -->
                    <button type="submit" id="Cerrar-Sesion-btn"><?= $Autenticacion->getUsuario()->getUsuariosEmail(); ?> (Cerrar Sesión)</button>
                </form>
            </li>
        <?php 
            else:
        ?>
            <li><a href="index.php?s=_iniciar-sesion" class="list-item-link">Iniciar Sesión</a></li>
            <li><a href="index.php?s=_registrarse" class="list-item-link">Registrarse</a></li>
        <?php 
            endif;
        ?>
        </ul>
    </nav>
    <!--Fin de Nav-->

    <!--Inicio del Main-->
    <main> 
        <div>
            <!-- Imprimir el mensaje de éxito, si existe -->
            <?php
            if (isset($_SESSION['mensajeExito'])):
            ?>
                <div class="mensajeExito"><?= $_SESSION['mensajeExito']; ?></div>
            <?php
                // Una vez que usamos el valor, lo eliminamos
                unset($_SESSION['mensajeExito']);
            endif;
            ?>

            <!-- Imprimir el mensaje de error, si existe -->
            <?php
            if (isset($_SESSION['mensajeError'])):
            ?>
                <div class="mensajeError"><?= $_SESSION['mensajeError']; ?></div>
            <?php
                // Una vez que usamos el valor, lo eliminamos
                unset($_SESSION['mensajeError']);
            endif;
            ?>
        </div>
        <?php
        // Incluir la vista correspondiente según la variable $vista
        require './vistas/' . $vista . '.php';
        ?>
    </main>
    <!--Fin del Main-->

    <!--Inicio del Footer-->
    <footer id="Footer">
        <p>Todos los derechos reservados &copy; 2023 - <a href="https://github.com/Ezearevalodev" target="_blank">@Ezearevalodev</a></p>
    </footer>
    <!--Fin del Footer-->

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
