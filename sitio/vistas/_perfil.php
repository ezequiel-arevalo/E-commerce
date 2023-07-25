<?php
$usuario = (new App\Auth\Autenticacion())->getUsuario();
?>
<div class="container mb-5" id="profile">
    <div class="profile-container">
      <h2>¡Bienvenido, <?=$usuario->getUsuariosUsername() ?? 'Usuario' ;?>!</h2>
      <p class="text-center">Descubre nuestra selección exclusiva de productos para ti.</p>
      <div class="profile-circle mt-5">
        <img src="./res/img/contenido/profile-pic.webp" alt="Foto de perfil" class="profile-image">
      </div>
      <div class="profile-name"><?=$usuario->getUsuariosUsername() ?? 'No especificado' ;?></div>
      <div class="profile-email"><?=$usuario->getUsuariosEmail();?></div>
    </div>
</div>