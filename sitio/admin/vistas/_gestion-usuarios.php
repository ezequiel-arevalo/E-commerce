<?php

// Obtener todos los usuarios desde la base de datos.
$usuarios = (new \App\Models\Usuario())->todo();
$roles    = (new \App\Models\Roles())->todo();
?>

<!-- Vista de administración de usuarios -->
<div class="Vista-Title">
    <h1>Administración de Usuarios</h1>
    
    <!-- Tabla que muestra los usuarios -->
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    // Iterar sobre la lista de usuarios y mostrar cada usuario en una fila de la tabla
                    foreach($usuarios as $usuario):
                        // Buscar el nombre del rol asociado al usuario
                        foreach ($roles as $rol) {
                            if ($rol->getRolId() === $usuario->getRolesFk()) {
                                $nombreRol = $rol->getRolNombre();
                                break;
                            }
                        }
                ?>
                <tr>
                    <td><?= $usuario->getUsuariosId(); ?></td>
                    <td><?= $nombreRol; ?></td>
                    <td><?= $usuario->getUsuariosUsername() ? $usuario->getUsuariosUsername() : 'No especificado'; ?></td>
                    <td><?= $usuario->getUsuariosEmail(); ?></td>
                    <td>
                        <!-- Enlaces para editar, ver compras y eliminar el usuario -->
                        <a href="index.php?s=_usuarios-editar&id=<?= $usuario->getUsuariosId(); ?>" class="btn btn-primary mt-1"><i class="bi bi-pencil"> </i>Editar</a>
                        <a href="index.php?s=_usuarios-compras&id=<?= $usuario->getUsuariosId(); ?>" class="btn btn-success mt-1"><i class="bi bi-cart"> </i>Compras</a>
                        <?php if ($usuario->getRolesFk() === 2): ?>
                            <!-- Botón de eliminar -->
                        <a href="index.php?s=_usuarios-eliminar&id=<?= $usuario->getUsuariosId(); ?>" class="btn btn-danger mt-1"><i class="bi bi-trash3"> </i>Eliminar</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
