<?php
$usuario = (new App\Auth\Autenticacion())->getUsuario();
?>
<div id="Profile">
    <h1>Bievenido <?=$usuario->getUsuariosEmail();?></h1>
    <h1>Bievenido <?=$usuario->getUsuariosUsername() ?? 'No especificado' ;?></h1>
</div>