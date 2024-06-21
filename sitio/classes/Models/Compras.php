<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class Compras extends Modelo 
{
    protected string $tabla = 'compras';
    protected string $clavePrimaria = 'carrito_id';

    /**
     * Obtiene todas las compras realizadas por un usuario específico.
     *
     * @param int $usuarioId ID del usuario.
     * @return array Lista de compras del usuario.
     */
    public function getComprasByUsuarioId(int $usuarioId): array
    {
        $db = DB::getConexion();
        // Join the compras and detalles_de_compras tables to get the product details
        $query = "SELECT dc.*, p.*
                  FROM detalles_de_compras dc
                  INNER JOIN compras c ON dc.compras_fk = c.compras_id
                  INNER JOIN productos p ON dc.productos_fk = p.productos_id
                  WHERE c.usuarios_fk = :usuarioId";
        $stmt = $db->prepare($query);
        $stmt->execute(['usuarioId' => $usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene todas las compras de la base de datos.
     *
     * @return array Lista de todas las compras.
     */
    public function obtenerCompras(): array
    {
        $db = DB::getConexion();
        $query = "SELECT * FROM compras";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Realiza una compra y la guarda en la base de datos.
     *
     * @param int $usuarioId ID del usuario que realiza la compra.
     * @param array $detallesCompras Detalles de los productos comprados.
     * @throws Exception Si ocurre algún error durante la inserción.
     */
    public function realizarCompra(int $usuarioId, array $detallesCompras)
    {
        $db = DB::getConexion();

        // Insertar en la tabla compras
        $queryCompra = "INSERT INTO compras (usuarios_fk) VALUES (:usuarioId)";
        $stmtCompra = $db->prepare($queryCompra);
        $stmtCompra->execute(['usuarioId' => $usuarioId]);
        $compraId = $db->lastInsertId();

        // Insertar detalles de la compra
        $queryDetalle = "INSERT INTO detalles_de_compras (productos_fk, compras_fk, fecha, cantidad) 
                        VALUES (:productoId, :compraId, :fecha, :cantidad)";
        $stmtDetalle = $db->prepare($queryDetalle);

        foreach ($detallesCompras as $detalle) {
            $stmtDetalle->execute([
                'productoId' => $detalle['productoId'],
                'compraId' => $compraId,
                'fecha' => date('Y-m-d'),  // Asumimos que la fecha es la actual
                'cantidad' => $detalle['cantidad']
            ]);
        }
    }
}