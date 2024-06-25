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
    '_gestion-usuarios' => [
        'title' => 'MyShop: Gestionar Usuarios',
        'requiereAutenticacion' => true,
    ],
    '_usuarios-editar' => [
        'title' => 'MyShop: Editar Usuarios',
        'requiereAutenticacion' => true,
    ],
    '_usuarios-eliminar' => [
        'title' => 'MyShop: Eliminar Usuarios',
        'requiereAutenticacion' => true,
    ],
    '_usuarios-compras' => [
        'title' => 'MyShop: Compras de usuarios',
        'requireAutenticacion' => true,
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
if ($requiereAutenticacion && !$Autenticacion->estaAutenticadoComoAdmin()) {
    $_SESSION['mensajeError'] =  "¡Se requiere haber iniciado sesión como administrador para ver este contenido!";
    header("Location: ../index.php?s=_iniciar-sesion");
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

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="../res/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../res/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../res/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../res/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../res/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../res/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../res/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../res/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../res/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../res/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../res/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../res/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../res/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../res/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../res/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!--CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link type="text/css" rel="stylesheet" href="../res/css/styles.css">
</head>

<body>
    <!--Inicio de Header-->
    <header>
    <nav class="navbar navbar-dark h-10">
        <div class="container-fluid">
            <div id="Header-Logo">
                <a href="index.php">
                    <h1>MyShop</h1>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <span class="offcanvas-title" id="offcanvasDarkNavbarLabel">MyShop</span>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?php 
                        if($Autenticacion->estaAutenticadoComoAdmin()){
                    ?>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?s=_dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?s=_productos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?s=_gestion-usuarios">Usuarios</a>
                    </li>
                    <li>
                        <form action="../acciones/cerrar-sesion.php" method="post">
                            <button type="submit" class="btn bg-danger text-white"><?= $Autenticacion->getUsuario()->getUsuariosEmail(); ?> (Cerrar Sesión)</button>
                        </form>
                    </li>
                    <?php 
                        } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php?s=_iniciar-sesion">Iniciar Sesión</a>
                        </li>
                    <?php 
                        };
                    ?>
                    </ul>
                </div>
            </div>
        </div>
        </nav>
    </header>
    <!--Fin de Header-->
    
    <!--Inicio del Main-->
    <main>
        <div>
            <!-- Imprimir el mensaje de éxito, si existe -->
            <?php
            if (isset($_SESSION['mensajeExito'])){
            ?>
                <div class="mensajeExito alert fade show">
                    <?= $_SESSION['mensajeExito']; ?>
                    <button type="button" class="btn-close px-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                // Una vez que usamos el valor, lo eliminamos
                unset($_SESSION['mensajeExito']);
            }
            ?>

            <!-- Imprimir el mensaje de error, si existe -->
            <?php
            if (isset($_SESSION['mensajeError'])){
            ?>
                <div class="mensajeError">
                    <?= $_SESSION['mensajeError']; ?>
                    <button type="button" class="btn-close px-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                // Una vez que usamos el valor, lo eliminamos
                unset($_SESSION['mensajeError']);
            }
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
        <p>Todos los derechos reservados &copy; 2024 - <a href="https://github.com/Ezequiel-Arevalo" target="_blank">@Ezequiel-Arevalo</a></p>
    </footer>
    <!--Fin del Footer-->

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
