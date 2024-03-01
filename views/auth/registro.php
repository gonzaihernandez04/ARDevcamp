<?php include_once __DIR__ . '/../templates/header.php';?>

<div class="contenedor">
    <main class="auth">
        <h2 class="auth__heading text-center nombre-pagina"><?php include_once __DIR__ . '/../templates/nombre-pagina.php';?></h2>
        <p class="auth__texto text-center">Registrate en ARDevcamp</p>

        <form class="formulario">

            <div class="formulario__campo">
                <label for="nombre" class="formulario__label">Nombre</label>
                <input type="text" name="nombre" id="" class="formulario__input" placeholder="Ej: John">
            </div>

            <div class="formulario__campo">
                <label for="apellido" class="formulario__label">Apellido</label>
                <input type="text" name="apellido" id="" class="formulario__input" placeholder="Ej: Doe">
            </div>

            <div class="formulario__campo">
                <label for="email" class="formulario__label">Email</label>
                <input type="email" name="email" id="email" class="formulario__input" placeholder="email@email.com">
            </div>

            <div class="formulario__campo">
                <label for="pass" class="formulario__label">Contraseña</label>
                <input type="password" name="pass" id="pass" class="formulario__input" placeholder="Contraseña">
            </div>
            
            <div class="formulario__campo">
                <label for="pass2" class="formulario__label">Repetir contraseña</label>
                <input type="password" name="pass2" id="pass2" class="formulario__input" placeholder="Repetir contraseña">
            </div>

            <input type="submit" value="Iniciar sesion"  class="formulario__submit">
        </form>
        <div class="acciones">
            <a href="/login" class="acciones__enlace">¿Tienes una cuenta? Inicia sesión</a>
            <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
        </div>

    </main>
</div>