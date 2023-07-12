<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class PrecioSimbolo
{
    private int $precio_simbolo_id;
    private string $precio_simbolo_nombre;
    
    /**
     * Obtiene todos los símbolos de precio.
     *
     * @return array Arreglo de objetos PrecioSimbolo.
     */
    public function todos(): array
    {
        $db = (new DB())->getConexion();
        $query = "SELECT * FROM precio_simbolo";
        $stmt = $db->prepare($query);
        $stmt->execute();
    
        $preciosSimbolo = [];
    
        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $precioSimbolo = new PrecioSimbolo();
            $precioSimbolo->setPrecioSimboloId($registro['precio_simbolo_id']);
            $precioSimbolo->setPrecioSimboloNombre($registro['precio_simbolo_nombre']);
    
            $preciosSimbolo[] = $precioSimbolo;
        }
    
        return $preciosSimbolo;
    }
    
    /**
     * Obtiene un objeto PrecioSimbolo por su ID.
     *
     * @param int $id ID del precio símbolo.
     * @return PrecioSimbolo|null El objeto PrecioSimbolo encontrado o null si no existe.
     */
    public function precioSimboloID(int $id): ?PrecioSimbolo
    {
        $db = (new DB())->getConexion();
        $query = "SELECT * FROM precio_simbolo WHERE precio_simbolo_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$registro) {
            return null;
        }
    
        $precioSimbolo = new PrecioSimbolo();
        $precioSimbolo->cargarDatosDeArray($registro);
    
        return $precioSimbolo;
    }
    
    /**
     * Carga los datos del precio símbolo desde un array.
     *
     * @param array $data Array con los datos del precio símbolo.
     * @return void
     */
    public function cargarDatosDeArray(array $data): void
    {
        $this->setPrecioSimboloId($data['precio_simbolo_id']);
        $this->setPrecioSimboloNombre($data['precio_simbolo_nombre']);
    }

    // Getter para precio_simbolo_id
    public function getPrecioSimboloId(): int
    {
        return $this->precio_simbolo_id;
    }

    // Setter para precio_simbolo_id
    public function setPrecioSimboloId(int $precio_simbolo_id): void
    {
        $this->precio_simbolo_id = $precio_simbolo_id;
    }

    // Getter para precio_simbolo_nombre
    public function getPrecioSimboloNombre(): string
    {
        return $this->precio_simbolo_nombre;
    }

    // Setter para precio_simbolo_nombre
    public function setPrecioSimboloNombre(string $precio_simbolo_nombre): void
    {
        $this->precio_simbolo_nombre = $precio_simbolo_nombre;
    }

}
