<?php
namespace App\Database;

use Exception;
use PDO;

class DB
{
    protected static string $host = '127.0.0.1';
    protected static string $user = 'root';
    protected static string $pass = '';
    protected static string $name = 'dw3_arevalo_ezequiel';

    protected static ?PDO $db = null;

    public static function getConexion(): PDO
    {
        if(self::$db === null) {
            $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$name . ';charset=utf8mb4';

            try {
                self::$db = new PDO($dsn, self::$user, self::$pass);
            } catch(Exception $e) {
                exit;
            }
        }

        return self::$db;
    }
}
