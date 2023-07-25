<?php

namespace App\Models;

class EstadoPublicacion extends Modelo
{
    protected string $tabla = "estados_publicacion";
    
    private int $estado_publicacion_id;
    private string $nombre;
    
    // Método para cargar los datos de un array en la instancia de la clase
    public function cargarDatosDeArray(array $data): void
    {
        $this->setEstadoPublicacionId($data['estado_publicacion_id']);
        $this->setNombre($data['nombre']);
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