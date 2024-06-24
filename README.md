# MyShop (tienda E-commerce)

Proyecto final de la materia de programación 2.

## Estructura del Proyecto

El proyecto consta de tres carpetas principales:

- **DB**: Contiene el archivo de la base de datos.
- **DER**: Contiene el Diagrama Entidad-Relación (DER) creado con MySQL Workbench 6.3.10.
- **sitio**: Contiene todo el sitio web.

## Contenidos

### DB

Esta carpeta incluye el archivo de la base de datos necesario para el funcionamiento del proyecto.

- `dw3_arevalo_ezequiel.sql`: Archivo SQL para crear y cargar la base de datos.

### DER

Esta carpeta contiene el diagrama entidad-relación del proyecto.

- `dw3_arevalo_ezequiel.mwb`: Archivo del DER creado con MySQL Workbench 6.3.10.
- `dw3_arevalo_ezequiel.mwb.bak`: Imagen del DER (opcional, si has exportado el diagrama como imagen).

### Sitio

Esta carpeta contiene todos los archivos relacionados con el sitio web.

- `index.php`: Archivo principal del sitio web.
- `vistas/`: Carpeta que contiene las vistas del sitio web.
  - `_404.php`: Vista de la página de error 404.
  - `_carrito.php`: Vista del carrito de compras.
  - `_contacto.php`: Vista de la página de contacto.
  - `_home.php`: Vista de la página principal.
  - `_informacion.php`: Vista de la página de información de los productos.
  - `_iniciar-sesion.php`: Vista de la página de inicio de sesión.
  - `_mis-compras.php`: Vista de la página de mis compras.
  - `_perfil.php`: Vista de la página de perfil del usuario.
  - `_registrarse.php`: Vista de la página de registro.
- `res/`: Carpeta que contiene los recursos del sitio web.
  - `css/`: Carpeta que contiene los archivos CSS.
    - `styles.css`: Hoja de estilos principal.
  - `img/`: Carpeta que contiene las imágenes.
    - `404/`: Carpeta que contiene imágenes para la página de error 404.
    - `contenido/`: Carpeta que contiene imágenes de contenido.
    - `icons/`: Carpeta que contiene iconos.
    - `productos/`: Carpeta que contiene imágenes de productos.
  - `js/`: Carpeta que contiene los archivos JavaScript.
    - `app.js`: Archivo principal de JavaScript.
- `logs/`: Carpeta que contiene los registros del sitio.
  - `error.log.txt`: Archivo de log de errores.
- `classes/`: Carpeta que contiene las clases del sitio web.
  - `Auth/`: Carpeta que contiene clases de autenticación.
    - `Autenticacion.php`: Clase para la autenticación de usuarios.
  - `Database/`: Carpeta que contiene clases de base de datos.
    - `DB.php`: Clase para la conexión y manejo de la base de datos.
  - `Models/`: Carpeta que contiene los modelos de datos.
    - `Carrito.php`: Modelo para el carrito de compras.
    - `Categoria.php`: Modelo para las categorías de productos.
    - `Compras.php`: Modelo para las compras.
    - `EstadoPublicacion.php`: Modelo para el estado de las publicaciones.
    - `Modelo.php`: Clase base para los modelos.
    - `PrecioSimbolo.php`: Modelo para el símbolo de precio.
    - `Producto.php`: Modelo para los productos.
    - `Roles.php`: Modelo para los roles de usuario.
    - `Usuario.php`: Modelo para los usuarios.
- `bootstrap/`: Carpeta que contiene los archivos de inicialización.
  - `autoload.php`: Archivo de autoload para cargar las clases automáticamente.
- `admin/`: Carpeta que contiene los archivos del panel de administración.
  - `acciones/`: Carpeta que contiene las acciones del administrador.
    - `cerrar-sesion.php`: Acción para cerrar sesión.
    - `iniciar-sesion.php`: Acción para iniciar sesión.
    - `productos-editar.php`: Acción para editar productos.
    - `productos-eliminar.php`: Acción para eliminar productos.
    - `productos-publicar.php`: Acción para publicar productos.
    - `usuarios-editar.php`: Acción para editar usuarios.
    - `usuarios-eliminar.php`: Acción para eliminar usuarios.
  - `vistas/`: Carpeta que contiene las vistas del administrador.
    - `_404.php`: Vista de la página de error 404 del admin.
    - `_dashboard.php`: Vista del dashboard del admin.
    - `_gestion-usuarios.php`: Vista de gestión de usuarios.
    - `_iniciar-sesion.php`: Vista de inicio de sesión del admin.
    - `_productos-crear.php`: Vista para crear productos.
    - `_productos-editar.php`: Vista para editar productos.
    - `_productos-eliminar.php`: Vista para eliminar productos.
    - `_productos.php`: Vista de la lista de productos.
    - `_usuarios-compras.php`: Vista de las compras de usuarios.
    - `_usuarios-editar.php`: Vista para editar usuarios.
    - `_usuarios-eliminar.php`: Vista para eliminar usuarios.
  - `index.php`: Archivo principal del panel de administración.
- `acciones/`: Carpeta que contiene las acciones del sitio web.
  - `agregar_al_carrito.php`: Acción para agregar productos al carrito.
  - `cerrar-sesion.php`: Acción para cerrar sesión.
  - `iniciar-sesion.php`: Acción para iniciar sesión.
  - `realizar-compra.php`: Acción para realizar una compra.
  - `registrarse.php`: Acción para registrar un nuevo usuario.

## Instalación

Sigue estos pasos para configurar el proyecto en tu entorno local.

1. Clona el repositorio:
    ```bash
    git clone https://github.com/ezequiel-arevalo/E-commerce.git
    ```
2. Navega a la carpeta del proyecto:
    ```bash
    cd E-commerce/sitio
    ```
3. Instala las dependencias del proyecto utilizando Composer:
    ```bash
    composer install
    ```
4. Crea una nueva base de datos en [phpMyAdmin](http://localhost/phpmyadmin/) con el nombre:
    ```sql
    dw3_arevalo_ezequiel
    ```
5. Importa el archivo `dw3_arevalo_ezequiel.sql` que se encuentra en la carpeta `DB` del proyecto.
6. Importa el DER en MySQL Workbench y sincronízalo con la base de datos:
    - Abre MySQL Workbench.
    - Ve a `File` > `Open Model` y selecciona el archivo del DER que se encuentra en la carpeta `DER`.
    - Ve a `Database` > `Synchronize Model` y sigue las instrucciones para sincronizar el modelo con la base de datos `dw3_arevalo_ezequiel`.

## Consideraciones

> [!NOTE]
> Recuerda tener instalado [composer](https://getcomposer.org/)

> [!IMPORTANT]
> Esta tienda e-commerce fue hecha para un final de la facultad, no se recomienda utilizarla como base de un proyecto real, puede contener fallos.

> [!WARNING]
> El precioSimbolo de los productos no está totalmente finalizado por ende se utiliza 1 solo precioSimbolo <br>
> Existen actualmente ciertos fallos con las compras de los usuarios si se actualiza un producto, en las compras de los usuarios también

## Recursos Utilizados

- Para los commits finales se estuvo empleando el uso de [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/).
- Para prácticamente todo el proyecto se estuvo utilizando [PHP Documentation](https://www.php.net/manual/es/).
- Para ciertas cosas de CSS se utilizó [Bootstrap](https://getbootstrap.com/).
- Para algunos iconos del sitio se utilizó [Bootstrap Icons](https://icons.getbootstrap.com/).
- Para validar el HTML se utilizó [W3C VALIDATOR](https://validator.w3.org/#validate_by_input).
- Para validar el CSS se utilizó [W3C VALIDATOR](https://jigsaw.w3.org/css-validator/#validate_by_input).
- Para validar la estructura del sitio y sus headers se utilizó la extensión [HeadingsMap](https://chromewebstore.google.com/detail/headingsmap/flbjommegcjonpdmenkdiocclhjacmbi).
