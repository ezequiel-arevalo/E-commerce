<?php

namespace App\Database;

use Exception;
use PDO;

class DB
{
    protected static string $host = '127.0.0.1'; // Dirección IP o nombre de host del servidor de la base de datos
    protected static string $user = 'root'; // Usuario de la base de datos
    protected static string $pass = ''; // Contraseña de la base de datos
    protected static string $name = 'dw3_arevalo_ezequiel'; // Nombre de la base de datos

    protected static ?PDO $db = null;

    /**
     * Obtiene una conexión a la base de datos utilizando los detalles de configuración.
     *
     * @return PDO Objeto PDO que representa la conexión a la base de datos.
     */
    public static function getConexion(): PDO
    {
        if (self::$db === null) {
            $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$name . ';charset=utf8mb4';
            
            try {
                echo "<br> Conexión a la db <br>" ;
                self::$db = new PDO($dsn, self::$user, self::$pass);
            } catch (Exception $e) {
                echo "Error al conectar con MySQL :(";
                echo "<br>";
                echo "El error ocurrido es: " . $e->getMessage();
                exit;
            }
        }
        return self::$db;
    }
}