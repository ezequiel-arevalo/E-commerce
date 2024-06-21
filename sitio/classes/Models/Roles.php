<?php

namespace App\Models;

class Roles extends Modelo
{
    protected string $tabla = "roles";
    private int $rol_id;
    private ?string $rol_nombre;

    public function getRolId(): int
    {
        return $this->rol_id;
    }

    // Setter para rol_id
    public function setRolId(int $rol_id): void
    {
        $this->rol_id = $rol_id;
    }

    // Getter para rol_nombre
    public function getRolNombre(): ?string
    {
        return $this->rol_nombre;
    }

    // Setter para rol_nombre
    public function setRolNombre(?string $rol_nombre): void
    {
        $this->rol_nombre = $rol_nombre;
    }
}
