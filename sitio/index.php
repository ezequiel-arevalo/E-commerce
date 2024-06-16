<?php
use App\Auth\Autenticacion;

require_once __DIR__ . '/bootstrap/autoload.php';
session_start();

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
    ],
    '_carrito' => [
        'title' => 'MyShop: My carrito',
        'requiereAutenticacion' => true,
    ],
    '_mis-compras' => [
        'title' => 'MyShop: My carrito',
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link type="text/css" rel="stylesheet" href="./res/css/styles.css">
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
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">MyShop</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?s=_home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?s=_productos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?s=_contacto">Contacto</a>
                    </li>
                    <?php 
                        if($Autenticacion->estaAutenticado()):
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mi cuenta
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="index.php?s=_perfil">Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="index.php?s=_carrito">Carrito</a></li>
                        <!-- <li><a class="dropdown-item" href="index.php?s=_mis-compras">Mis compras</a></li> -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-item">
                            <form action="acciones/cerrar-sesion.php" method="post">
                            <button type="submit" class="btn bg-danger text-white"><?= $Autenticacion->getUsuario()->getUsuariosEmail(); ?> (Cerrar Sesión)</button>
                            </form>
                        </li>
                        </ul>
                    </li>
                    <?php 
                        else:
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?s=_iniciar-sesion">Iniciar Sesión</a>
                            <a class="nav-link" href="index.php?s=_registrarse">Registrarse</a>
                        </li>
                    <?php 
                        endif;
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
            if (isset($_SESSION['mensajeExito'])):
            ?>
                <div class="mensajeExito alert fade show">
                    <?= $_SESSION['mensajeExito']; ?>
                    <button type="button" class="btn-close px-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                // Una vez que usamos el valor, lo eliminamos
                unset($_SESSION['mensajeExito']);
            endif;
            ?>

            <!-- Imprimir el mensaje de error, si existe -->
            <?php
            if (isset($_SESSION['mensajeError'])):
            ?>
                <div class="mensajeError alert fade show">
                    <?= $_SESSION['mensajeError']; ?>
                    <button type="button" class="btn-close px-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
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
        <p>Todos los derechos reservados &copy; 2023 - <a href="https://github.com/Ezequiel-Arevalo" target="_blank">@Ezequiel-Arevalo</a></p>
    </footer>
    <!--Fin del Footer-->

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
