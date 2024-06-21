<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class Carrito extends Modelo 
{
    protected string $tabla = 'carrito';
    protected string $clavePrimaria = 'carrito_id';

    /**
     * Obtener el ID del carrito de un usuario.
     *
     * @param int $usuarioId El ID del usuario.
     * @return int|null El ID del carrito o null si no existe.
     */
    public function obtenerCarritoId($usuarioId) {
        $db = DB::getConexion();
        $stmt = $db->prepare('SELECT carrito_id FROM ' . $this->tabla . ' WHERE usuarios_id = :usuarioId');
        $stmt->execute(['usuarioId' => $usuarioId]);
        $carrito = $stmt->fetch(PDO::FETCH_ASSOC);
        return $carrito ? $carrito['carrito_id'] : null;
    }

    /**
     * Agregar un producto al carrito de un usuario.
     *
     * @param int $usuarioId El ID del usuario.
     * @param int $productoId El ID del producto.
     * @param int $cantidad La cantidad del producto a agregar.
     * @return void
     */
    public function agregarProducto($usuarioId, $productoId, $cantidad) {
        $db = DB::getConexion();
        $carritoId = $this->obtenerCarritoId($usuarioId);
        
        if (!$carritoId) {
            $stmt = $db->prepare('INSERT INTO ' . $this->tabla . ' (usuarios_id) VALUES (:usuarioId)');
            $stmt->execute(['usuarioId' => $usuarioId]);
            $carritoId = $db->lastInsertId();
        }

        $stmt = $db->prepare('SELECT cantidad FROM productos_en_carrito WHERE carrito_id = :carritoId AND productos_id = :productoId');
        $stmt->execute(['carritoId' => $carritoId, 'productoId' => $productoId]);
        $productoEnCarrito = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($productoEnCarrito) {
            $stmt = $db->prepare('UPDATE productos_en_carrito SET cantidad = cantidad + :cantidad WHERE carrito_id = :carritoId AND productos_id = :productoId');
            $stmt->execute(['cantidad' => $cantidad, 'carritoId' => $carritoId, 'productoId' => $productoId]);
        } else {
            $stmt = $db->prepare('INSERT INTO productos_en_carrito (carrito_id, productos_id, usuarios_id, cantidad) VALUES (:carritoId, :productoId, :usuarioId, :cantidad)');
            $stmt->execute(['carritoId' => $carritoId, 'productoId' => $productoId, 'usuarioId' => $usuarioId, 'cantidad' => $cantidad]);
        }
    }

    /**
     * Eliminar un producto del carrito de un usuario.
     *
     * @param int $usuarioId El ID del usuario.
     * @param int $productoId El ID del producto.
     * @return void
     */
    public function eliminarProducto($usuarioId, $productoId) {
        $db = DB::getConexion();
        $carritoId = $this->obtenerCarritoId($usuarioId);
        $stmt = $db->prepare('DELETE FROM productos_en_carrito WHERE carrito_id = :carritoId AND productos_id = :productoId');
        $stmt->execute(['carritoId' => $carritoId, 'productoId' => $productoId]);
    }

    /**
     * Actualizar la cantidad de un producto en el carrito de un usuario.
     *
     * @param int $usuarioId El ID del usuario.
     * @param int $productoId El ID del producto.
     * @param int $cantidad La nueva cantidad del producto.
     * @return void
     */
    public function actualizarCantidad($usuarioId, $productoId, $cantidad) {
        $db = DB::getConexion();
        $carritoId = $this->obtenerCarritoId($usuarioId);
        if ($cantidad <= 0) {
            $this->eliminarProducto($usuarioId, $productoId);
        } else {
            $stmt = $db->prepare('UPDATE productos_en_carrito SET cantidad = :cantidad WHERE carrito_id = :carritoId AND productos_id = :productoId');
            $stmt->execute(['cantidad' => $cantidad, 'carritoId' => $carritoId, 'productoId' => $productoId]);
        }
    }

    /**
     * Obtener los productos en el carrito de un usuario.
     *
     * @param int $usuarioId El ID del usuario.
     * @return array Los productos en el carrito.
     */
    public function obtenerProductos($usuarioId) {
        $db = DB::getConexion();
        $carritoId = $this->obtenerCarritoId($usuarioId);
        $stmt = $db->prepare('SELECT p.*, pc.cantidad FROM productos p INNER JOIN productos_en_carrito pc ON p.productos_id = pc.productos_id WHERE pc.carrito_id = :carritoId');
        $stmt->execute(['carritoId' => $carritoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener el total del carrito de un usuario.
     *
     * @param int $usuarioId El ID del usuario.
     * @return float El total del carrito.
     */
    public function obtenerTotal($usuarioId) {
        $db = DB::getConexion();
        $productos = $this->obtenerProductos($usuarioId);
        $total = 0;
        foreach ($productos as $producto) {
            $total += $producto['productos_price'] * $producto['cantidad'];
        }
        return $total;
    }

    /**
     * Vaciar el carrito de un usuario.
     *
     * @param int $usuarioId El ID del usuario.
     * @return void
     */
    public function vaciarCarrito($usuarioId) {
        $db = DB::getConexion();
        $carritoId = $this->obtenerCarritoId($usuarioId);
        $stmt = $db->prepare('DELETE FROM productos_en_carrito WHERE carrito_id = :carritoId');
        $stmt->execute(['carritoId' => $carritoId]);
    }
}
