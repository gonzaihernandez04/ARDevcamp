<?php include_once __DIR__ . '/../templates/header.php';?>
<div class="contenedor">
    <main class="auth">
        <h2 class="auth__heading"><?php include_once __DIR__ . '/../templates/nombre-pagina.php';?></h2>
        <p class="text-center">Restablece tu contraseña</p>

        <form class="formulario">
            <div class="formulario__campo">
                <label for="email" class="formulario__label">Email</label>

                <input type="email" name="email" id="" class="formulario__input" placeholder="email@email.com">
            </div>

            <input type="submit" value="Enviar instrucciones" class="formulario__submit">

        </form>
        <div class="acciones">
            <a href="/login" class="acciones__enlace">¿Tienes una cuenta? Inicia sesión</a>
            <a href="/registro" class="acciones__enlace">¿Aun no tenes una cuenta? Crea una</a>
        </div>
    </main>
</div>