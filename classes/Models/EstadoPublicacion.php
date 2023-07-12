<?php

namespace App\Models;
use App\Database\DB;
use PDO;

class EstadoPublicacion
{
    private int $estado_publicacion_id;
    private string $nombre;

    // Método para cargar los datos de un array en la instancia de la clase
    public function cargarDatosDeArray(array $data): void
    {
        $this->setEstadoPublicacionId($data['estado_publicacion_id']);
        $this->setNombre($data['nombre']);
    }

    // Método para obtener todos los estados de publicación
    public function todos(): array
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM estados_publicacion";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, EstadoPublicacion::class);
        return $stmt->fetchAll();
    }

    // Getter para estado_publicacion_id
    public function getEstadoPublicacionId(): int
    {
        return $this->estado_publicacion_id;
    }

    // Setter para estado_publicacion_id
    public function setEstadoPublicacionId(int $estado_publicacion_id): void
    {
        $this->estado_publicacion_id = $estado_publicacion_id;
    }

    // Getter para nombre
    public function getNombre(): string
    {
        return $this->nombre;
    }

    // Setter para nombre
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
}