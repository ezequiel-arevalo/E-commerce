<?php

//Agregamos el autoload de composter para tener acceso a sus clases
require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function(string $className) {
    // Se remueve el prefijo 'App\' del nombre de la clase
    $className = substr($className, 4);

    // Se reemplazan las barras invertidas (\) por barras diagonales (/) en el nombre de la clase
    $className = str_replace('\\', '/', $className);

    // Se construye la ruta del archivo de la clase en función del nombre de la clase
    $classPath = __DIR__ . '/../classes/' . $className . '.php';

    // Si el archivo de la clase existe, se requiere (incluye) el archivo
    if (file_exists($classPath)) {
        require_once $classPath;
    }
});