<?php

namespace App\Models;
use App\Database\DB;
use PDO;

class PrecioSimbolo extends Modelo
{
    protected string $tabla = "precio_simbolo";
    private int $precio_simbolo_id;
    private string $precio_simbolo_nombre;

    /**
     * Carga los datos de un array en el objeto.
     *
     * @param array $data Los datos a cargar en el objeto, con claves 'precio_simbolo_id' y 'precio_simbolo_nombre'.
     * @return void
     */
    public function cargarDatosDeArray(array $data): void
    {
        $this->setPrecioSimboloId($data['precio_simbolo_id']);
        $this->setPrecioSimboloNombre($data['precio_simbolo_nombre']);
    }

    /**
     * Obtiene el nombre del símbolo de precio por su ID.
     *
     * @param int $id El ID del símbolo de precio.
     * @return string|null El nombre del símbolo de precio o null si no se encuentra.
     */
    public function getNombrePorId(int $id): ?string
    {
        $db = DB::getConexion();
        $query = "SELECT precio_simbolo_nombre FROM precio_simbolo WHERE precio_simbolo_id = :id";
        $stmt = $db->prepare($query);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['precio_simbolo_nombre'] : null;
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