<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class Usuario extends Modelo
{
    protected string $tabla = "usuarios";
    protected string $clavePrimaria = "usuarios_id";
    private int $usuarios_id;
    private int $roles_fk;
    private string $usuarios_email;
    private string $usuarios_password;
    private ?string $usuarios_username;

    /**
     * Obtiene un usuario por su dirección de correo electrónico.
     *
     * @param string $email Dirección de correo electrónico del usuario.
     * @return Usuario|null Objeto Usuario si existe, o null si no se encuentra.
     */
    public function porEmail(string $email): ?Usuario
    {
        $db = DB::getConexion();
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
    
    public function crear(array $data)
    {
        $db = DB::getConexion();
        $query = "INSERT INTO usuarios (usuarios_email, usuarios_password, roles_fk, usuarios_username)
                  VALUES (:usuarios_email, :usuarios_password, :roles_fk, :usuarios_username)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'usuarios_username'  => $data['usuarios_username'],
            'usuarios_email'     => $data['usuarios_email'],
            'usuarios_password'  => $data['usuarios_password'],
            'roles_fk'           => $data['roles_fk'],
        ]);
    }

    /**
     * Edita un usuario en la base de datos.
     *
     * @param int $id ID del usuario a editar.
     * @param array $data Datos del usuario a actualizar.
     * @throws \PDOException Si ocurre un error en la consulta.
     * @return void
     */
    public function editar(int $id, array $data): void
    {
        $db = DB::getConexion();
        $query = "UPDATE usuarios 
                  SET usuarios_email = :usuarios_email, 
                      usuarios_username = :usuarios_username 
                  WHERE usuarios_id = :usuarios_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'usuarios_email' => $data['usuarios_email'],
            'usuarios_username' => $data['usuarios_username'],
            'usuarios_id' => $id,
        ]);
    }

    public function eliminar(int $id): void
    {
        $db = DB::getConexion();
        $query = "DELETE FROM usuarios WHERE usuarios_id = :usuarios_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'usuarios_id' => $id,
        ]);
    }

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