<?php
use App\Auth\Autenticacion;

require_once __DIR__ . '/../bootstrap/autoload.php';
session_start();

// Definición de las rutas disponibles y sus opciones
$rutas = [
    '_404' => [
        'title' => 'MyShop: Página no encontrada'
    ],
    '_dashboard' => [
        'title' => 'MyShop: Panel de Administración',
        'requiereAutenticacion' => true,
    ],
    '_productos' => [
        'title' => 'MyShop: Descubre nuestra amplia variedad de productos de calidad',
        'requiereAutenticacion' => true,
    ],
    '_productos-crear' => [
        'title' => 'MyShop: Crea nuevos productos',
        'requiereAutenticacion' => true,
    ],
    '_productos-editar' => [
        'title' => 'MyShop: Editar productos',
        'requiereAutenticacion' => true,
    ],
    '_productos-eliminar' => [
        'title' => 'MyShop: Eliminar productos',
        'requiereAutenticacion' => true,
    ],
    '_iniciar-sesion' => [
        'title' => 'MyShop: Iniciar Sesión'
    ]
];

// Obtener la vista actual
$vista = $_GET['s'] ?? '_dashboard';

// Verificar si la vista existe en las rutas, de lo contrario, mostrar la página 404
if (!isset($rutas[$vista])) {
    $vista = '_404';
}

// Obtener las opciones de la ruta actual
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
    <link type="text/css" rel="stylesheet" href="../res/css/styles.css">
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
        <?php 
            if($Autenticacion->estaAutenticado()):
        ?>
        <!-- Mostrar el menú de navegación solo si el usuario está autenticado -->
        <ul>
            <li><a href="index.php?s=_dashboard" class="list-item-link">Dashboard</a></li>
            <li><a href="index.php?s=_productos" class="list-item-link">Productos</a></li>
            <li>
                <form action="acciones/cerrar-sesion.php" method="post">
                    <!-- Mostrar el nombre de usuario y el botón de cerrar sesión -->
                    <button type="submit" id="Cerrar-Sesion-btn"><?= $Autenticacion->getUsuario()->getUsuariosEmail(); ?> (Cerrar Sesión)</button>
                </form>
            </li>
        </ul>
        
        <?php 
            endif;
        ?>
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
        // Cargar la vista correspondiente
        require 'vistas/' . $vista . '.php';
        ?>
    </main>
    <!--Fin del Main-->

    <!--Inicio del Footer-->
    <footer id="Footer">
        <p>Todos los derechos reservados &copy; 2023 - <a href="https://github.com/Ezearevalodev" target="_blank">@Ezearevalodev</a></p>
    </footer>
    <!--Fin del Footer-->

</body>
</html>
