<?php

namespace App\Models;

class PrecioSimbolo extends Modelo
{
    protected string $tabla = "precio_simbolo";
    private int $precio_simbolo_id;
    private string $precio_simbolo_nombre;

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