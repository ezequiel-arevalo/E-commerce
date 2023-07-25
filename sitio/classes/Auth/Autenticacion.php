<?php

namespace App\Auth;

use App\Models\Usuario;

class Autenticacion
{
    /**
     * Inicia sesión para el usuario con el correo electrónico y la contraseña proporcionados.
     *
     * @param string $email Correo electrónico del usuario.
     * @param string $password Contraseña del usuario.
     * @return bool Devuelve true si la sesión se inicia correctamente, de lo contrario, devuelve false.
     */
    public function iniciarSesion(string $email, string $password): bool
    {
        $usuario = (new Usuario())->porEmail($email);

        if (!$usuario) {
            return false;
        }

        // Verificamos la contraseña
        if (!password_verify($password, $usuario->getUsuariosPassword())) {
            return false;
        }

        // Marcamos al usuario como autenticado
        $this->marcarComoAutenticado($usuario);

        return true;
    }

    /**
     * Marca al usuario como autenticado guardando su ID en la variable de sesión.
     *
     * @param Usuario $usuario Objeto Usuario que se marcará como autenticado.
     * @return void
     */
    public function marcarComoAutenticado(Usuario $usuario): void
    {
        $_SESSION['usuarios_id'] = $usuario->getUsuariosId();
        $_SESSION['roles_id'] = $usuario->getRolesFk();
    }

    /**
     * Cierra la sesión del usuario eliminando su ID de la variable de sesión.
     *
     * @return void
     */
    public function cerrarSesion(): void
    {
        unset($_SESSION['usuarios_id'], $_SESSION['roles_id']);
    }

    /**
     * Verifica si hay un usuario autenticado.
     *
     * @return bool Devuelve true si hay un usuario autenticado, de lo contrario, devuelve false.
     */
    public function estaAutenticado(): bool
    {
        return isset($_SESSION['usuarios_id']);
    }
    
    public function estaAutenticadoComoAdmin(): bool
    {
        return $this->estaAutenticado() && $_SESSION['roles_id'] === 1;
    }

    /**
     * Obtiene el ID del usuario autenticado.
     *
     * @return int|null Devuelve el ID del usuario autenticado si existe, de lo contrario, devuelve null.
     */
    public function getUsuarioId(): ?int
    {
        return $this->estaAutenticado() ? $_SESSION['usuarios_id'] : null;
    }

    /**
     * Obtiene el objeto Usuario correspondiente al usuario autenticado.
     *
     * @return Usuario|null Devuelve el objeto Usuario del usuario autenticado si existe, de lo contrario, devuelve null.
     */
    public function getUsuario(): ?Usuario
    {
        if (!$this->estaAutenticado()) {
            return null;
        }

        return (new Usuario())->porId($_SESSION['usuarios_id']);
    }
}