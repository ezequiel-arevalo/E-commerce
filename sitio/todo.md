# Cambios a realizar
## Administración
- ~~Actualizar el footer de la vista de administración, cambio de url en el github~~
- ~~Deshabilitar el uso de otro tipo de moneda en el crear y editar productos y dejar uno solo por defecto (Temporal)~~
- ~~Actualizar la funcionalidad de eliminación y tal vez Edición de usuarios con respecto a la implementación de carritos~~
- Añadir la funcionalidad de ver las compras realizadas de forma individual por cada usuario
- ~~Actualizar la funcionalidad de registro de usuarios para inicializar un carrito apenas se registra el usuario~~
- ~~Añadir ojito en el inicio de sesión y registro~~

## Usuarios
- ~~Añadir una redirección al carrito y mejorar el mensaje de cuando un producto se añade al carrito~~
- Añadir la funciónalidad de actualización de cantidad de productos en el carrito
- ~~Añadir el listado de "mis compras" en las opciones de los usuarios~~

## Errores y/o fallos conocidos

<pre>
> Error en el tipo de moneda de precio de productos:
Los usuarios a la hora de adquirir mas de un producto con distinto tipo de moneda utiliza una sola moneda unica en vez de separar por tipo de moneda o realizar una conversión de la misma debería desarollarse una logica con respecto a una conversión de monedas, de momento deshabilitar la opción de selección de otras monedas    

> Archivo de cerrar sesión duplicado

> Al fallar el eliminar usuario lo redirige al admin a editar usuario
</pre>

En este [repositorio](https://github.com/ezequiel-arevalo/e-commerce) se encuentrá este proyecto el cual incluye el sitio mismo, base de datos, y tabla DER


5