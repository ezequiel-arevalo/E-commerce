<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class Usuario
{
    private int $usuarios_id;
    private int $roles_fk;
    private string $usuarios_email;
    private string $usuarios_password;
    private ?string $usuarios_username;

    /**
     * Obtiene un usuario por su ID.
     *
     * @param string $id ID del usuario.
     * @return Usuario|null Objeto Usuario si existe, o null si no se encuentra.
     */
    public function porId(string $id): ?Usuario
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM usuarios
                  WHERE usuarios_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, Usuario::class);
        $usuario = $stmt->fetch();

        // Si no existe el usuario, se retorna null
        if (!$usuario) {
            return null;
        }

        return $usuario;
    }

    /**
     * Obtiene un usuario por su dirección de correo electrónico.
     *
     * @param string $email Dirección de correo electrónico del usuario.
     * @return Usuario|null Objeto Usuario si existe, o null si no se encuentra.
     */
    public function porEmail(string $email): ?Usuario
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM usuarios
                  WHERE usuarios_email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, Usuario::class);
        $usuario = $stmt->fetch();

        // Si no existe el usuario, se retorna null
        if (!$usuario) {
            return null;
        }

        return $usuario;
    }

    // Métodos getters y setters para las propiedades de la clase...

    public function getUsuariosId(): int
    {
        return $this->usuarios_id;
    }

    public function setUsuariosId(int $usuarios_id): void
    {
        $this->usuarios_id = $usuarios_id;
    }

    public function getRolesFk(): int
    {
        return $this->roles_fk;
    }

    public function setRolesFk(int $roles_fk): void
    {
        $this->roles_fk = $roles_fk;
    }

    public function getUsuariosEmail(): string
    {
        return $this->usuarios_email;
    }

    public function setUsuariosEmail(string $usuarios_email): void
    {
        $this->usuarios_email = $usuarios_email;
    }

    public function getUsuariosPassword(): string
    {
        return $this->usuarios_password;
    }

    public function setUsuariosPassword(string $usuarios_password): void
    {
        $this->usuarios_password = $usuarios_password;
    }

    public function getUsuariosUsername(): ?string
    {
        return $this->usuarios_username;
    }

    public function setUsuariosUsername(?string $usuarios_username): void
    {
        $this->usuarios_username = $usuarios_username;
    }
}