<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class Producto
{
    private int $productos_id;
    private int $usuario_fk;
    private int $categorias_fk;
    private int $estados_publicacion_fk;
    private int $precio_simbolo_fk;
    private string $productos_title;
    private string $productos_description;
    private string $productos_sinopsis;
    private float $productos_price;
    private ?string $productos_img;
    private ?string $productos_img_alt;
    
    private EstadoPublicacion $estado_publicacion;
    private Categoria $nombre_categoria;
    private PrecioSimbolo $precio_simbolo;

    /**
     * Carga los datos del producto desde un array.
     *
     * @param array $data Array con los datos del producto.
     * @return void
     */
    public function cargarDatosDeArray(array $data): void
    {
        $this->setProductoId($data['productos_id']);
        $this->setUsuarioFk($data['usuario_fk']);
        $this->setCategoriasFk($data['categorias_fk']);
        $this->setEstadosPublicacionFk($data['estados_publicacion_fk']);
        $this->setPrecioSimboloFk($data['precio_simbolo_fk']);
        $this->setProductoTitle($data['productos_title']);
        $this->setProductoDescription($data['productos_description']);
        $this->setProductoSinopsis($data['productos_sinopsis']);
        $this->setProductoPrice($data['productos_price']);
        $this->setProductoImagen($data['productos_img']);
        $this->setProductoImagenAlt($data['productos_img_alt']);
    }

    /**
     * Obtiene productos de la base de datos según los criterios de búsqueda.
     *
     * @param array $busqueda Criterios de búsqueda para filtrar los productos.
     * @return array Arreglo de objetos Producto que coinciden con la búsqueda.
     */
    public function Productos(array $busqueda = []): array
    {
        $db = (new DB())->getConexion();
        $query = "SELECT 
                        n.*,
                        ep.nombre AS 'estado_publicacion',
                        c.categoria_nombre AS 'nombre_categoria',
                        ps.precio_simbolo_nombre AS 'nombre_precio_simbolo'
                  FROM productos n
                  INNER JOIN estados_publicacion ep
                  ON n.estados_publicacion_fk = ep.estado_publicacion_id
                  INNER JOIN categorias c
                  ON n.categorias_fk = c.categoria_id
                  INNER JOIN precio_simbolo ps
                  ON n.precio_simbolo_fk = ps.precio_simbolo_id";

        $queryParams = [];
        if (count($busqueda) > 0) {
            $whereConditions = [];
            foreach ($busqueda as $busquedaDatos) {
                $whereConditions[] = $busquedaDatos[0] . ' ' . $busquedaDatos[1] . ' ?';
                $queryParams[] = $busquedaDatos[2];
            }

            $query .= " WHERE " . implode(' AND ', $whereConditions);
        }

        $stmt = $db->prepare($query);
        $stmt->execute($queryParams);

        $productos = [];

        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $producto = new Producto();
            $producto->cargarDatosDeArray($registro);

            $estado = new EstadoPublicacion();
            $estado->cargarDatosDeArray([
                'estado_publicacion_id' => $registro['estados_publicacion_fk'],
                'nombre' => $registro['estado_publicacion'],
            ]);
            $producto->setEstadoPublicacion($estado);

            $categoria = new Categoria();
            $categoria->cargarDatosDeArray([
                'categoria_id' => $registro['categorias_fk'],
                'categoria_nombre' => $registro['nombre_categoria'],
            ]);
            $producto->setNombreCategoria($categoria);

            $precioSimbolo = new PrecioSimbolo();
            $precioSimbolo->cargarDatosDeArray([
                'precio_simbolo_id' => $registro['precio_simbolo_fk'],
                'precio_simbolo_nombre' => $registro['nombre_precio_simbolo'],
            ]);
            $producto->setPrecioSimbolo($precioSimbolo);

            $productos[] = $producto;
        }

        return $productos;
    }

    /**
     * Obtiene un producto por su ID.
     *
     * @param int $id ID del producto.
     * @return Producto|null El producto encontrado o null si no existe.
     */
    public function productoID(int $id): ?Producto
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM productos
                    WHERE productos_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);

        $producto = $stmt->fetch();

        if (!$producto) return null;

        return $producto;
    }

    /**
     * Crea un nuevo producto en la base de datos.
     *
     * @param array $data Datos del producto a crear.
     * @return void
     */
    public function crear(array $data)
    {
        $db = (new DB)->getConexion();
        $query = "INSERT INTO productos
        (usuario_fk, productos_title, productos_description, productos_sinopsis, productos_price, productos_img, productos_img_alt, categorias_fk, estados_publicacion_fk, precio_simbolo_fk)
        VALUES (:usuario_fk, :titulo, :descripcion, :sinopsis, :price, :img, :img_alt, :categorias_fk, :estados_publicacion_fk, :precio_simbolo_fk)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'usuario_fk'                => $data['usuario_fk'],
            'titulo'                    => $data['productos_title'],
            'descripcion'               => $data['productos_description'],
            'sinopsis'                  => $data['productos_sinopsis'],
            'price'                     => $data['productos_price'],
            'img'                       => $data['productos_img'],
            'img_alt'                   => $data['productos_img_alt'],
            'categorias_fk'             => $data['categorias_fk'],
            'estados_publicacion_fk'    => $data['estados_publicacion_fk'],
            'precio_simbolo_fk'         => $data['precio_simbolo_fk'],
        ]);
    }

    /**
     * Edita un producto existente en la base de datos.
     *
     * @param int $id ID del producto a editar.
     * @param array $data Datos actualizados del producto.
     * @return void
     */
    public function editar(int $id, array $data)
    {
        $db = (new DB)->getConexion();
        $query = "UPDATE productos
                  SET    productos_title          = :titulo,
                         productos_description    = :descripcion,
                         productos_sinopsis       = :sinopsis,
                         productos_price          = :price,
                         productos_img            = :img,
                         productos_img_alt        = :img_alt,
                         categorias_fk            = :categorias_fk,
                         estados_publicacion_fk   = :estados_publicacion_fk,
                         precio_simbolo_fk        = :precio_simbolo_fk
                  WHERE productos_id              = :productos_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'titulo'                 => $data['productos_title'],
            'descripcion'            => $data['productos_description'],
            'sinopsis'               => $data['productos_sinopsis'],
            'price'                  => $data['productos_price'],
            'img'                    => $data['productos_img'],
            'img_alt'                => $data['productos_img_alt'],
            'categorias_fk'          => $data['categorias_fk'],
            'estados_publicacion_fk' => $data['estados_publicacion_fk'],
            'precio_simbolo_fk'      => $data['precio_simbolo_fk'],
            'productos_id'           => $id,
        ]);
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param int $id ID del producto a eliminar.
     * @return void
     */
    public function eliminar(int $id)
    {
        $db = (new DB)->getConexion();
        $query = "DELETE FROM productos
                  WHERE productos_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }

    // Getter para productos_id
    public function getProductoId(): int
    {
        return $this->productos_id;
    }

    // Setter para productos_id
    public function setProductoId(int $productos_id): void
    {
        $this->productos_id = $productos_id;
    }

    // Getter para usuario_fk
    public function getUsuarioFk(): int
    {
        return $this->usuario_fk;
    }

    // Setter para usuario_fk
    public function setUsuarioFk(int $usuario_fk): void
    {
        $this->usuario_fk = $usuario_fk;
    }

    // Getter para categorias_fk
    public function getCategoriasFk(): int
    {
        return $this->categorias_fk;
    }

    // Setter para categorias_fk
    public function setCategoriasFk(int $categorias_fk): void
    {
        $this->categorias_fk = $categorias_fk;
    }

    // Getter para estados_publicacion_fk
    public function getEstadosPublicacionFk(): int
    {
        return $this->estados_publicacion_fk;
    }

    // Setter para estados_publicacion_fk
    public function setEstadosPublicacionFk(int $estados_publicacion_fk): void
    {
        $this->estados_publicacion_fk = $estados_publicacion_fk;
    }

    // Getter para productos_title
    public function getProductoTitle(): string
    {
        return $this->productos_title;
    }

    // Setter para productos_title
    public function setProductoTitle(string $productos_title): void
    {
        $this->productos_title = $productos_title;
    }

    // Getter para productos_description
    public function getProductoDescription(): string
    {
        return $this->productos_description;
    }

    // Setter para productos_description
    public function setProductoDescription(string $productos_description): void
    {
        $this->productos_description = $productos_description;
    }

    // Getter para productos_sinopsis
    public function getProductoSinopsis(): string
    {
        return $this->productos_sinopsis;
    }

    // Setter para productos_sinopsis
    public function setProductoSinopsis(string $productos_sinopsis): void
    {
        $this->productos_sinopsis = $productos_sinopsis;
    }

    // Getter para productos_price
    public function getProductoPrice(): float
    {
        return $this->productos_price;
    }

    // Setter para productos_price
    public function setProductoPrice(float $productos_price): void
    {
        $this->productos_price = $productos_price;
    }

    // Getter para precio_simbolo_fk
    public function getPrecioSimboloFk(): int
    {
        return $this->precio_simbolo_fk;
    }

    // Setter para precio_simbolo_fk
    public function setPrecioSimboloFk(int $precio_simbolo_fk): void
    {
        $this->precio_simbolo_fk = $precio_simbolo_fk;
    }

    // Getter para productos_img
    public function getProductoImagen(): ?string
    {
        return $this->productos_img;
    }

    // Setter para productos_img
    public function setProductoImagen(?string $productos_img): void
    {
        $this->productos_img = $productos_img;
    }

    // Getter para productos_img_alt
    public function getProductoImagenAlt(): ?string
    {
        return $this->productos_img_alt;
    }

    // Setter para productos_img_alt
    public function setProductoImagenAlt(?string $productos_img_alt): void
    {
        $this->productos_img_alt = $productos_img_alt;
    }

    // Getter para estado_publicacion
    public function getEstadoPublicacion(): EstadoPublicacion
    {
        return $this->estado_publicacion;
    }

    // Setter para estado_publicacion
    public function setEstadoPublicacion(EstadoPublicacion $estado_publicacion): void
    {
        $this->estado_publicacion = $estado_publicacion;
    }

    // Getter para nombre_categoria
    public function getNombreCategoria(): Categoria
    {
        return $this->nombre_categoria;
    }

    // Setter para nombre_categoria
    public function setNombreCategoria(Categoria $nombre_categoria): void
    {
        $this->nombre_categoria = $nombre_categoria;
    }

    // Getter para precio_simbolo
    public function getPrecioSimbolo(): PrecioSimbolo
    {
        return $this->precio_simbolo;
    }

    // Setter para precio_simbolo
    public function setPrecioSimbolo(PrecioSimbolo $precio_simbolo): void
    {
        $this->precio_simbolo = $precio_simbolo;
    }
}