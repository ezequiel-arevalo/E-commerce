<?php

namespace App\Models;
use App\Database\DB;

use PDO;

class Modelo{

    protected string $tabla = "";
    protected string $clavePrimaria = "";

    public function todo(): array
    {
        $db = DB::getConexion();
        $query = "SELECT * FROM " . $this->tabla;
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene un usuario por su ID.
     *
     * @param string $id ID del usuario.
     * @return Usuario|null Objeto Usuario si existe, o null si no se encuentra.
     */
    public function porId(int $id): ?static
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM " . $this->tabla . "
                  WHERE " . $this->clavePrimaria . " = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        $instancia = $stmt->fetch();

        if (!$instancia) {
            return null;
        }

        return $instancia;
    }
}