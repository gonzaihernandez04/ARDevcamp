<?php include_once __DIR__ . '/../templates/header.php';?>

<div class="contenedor">
    <main class="auth">
        <h2 class="auth__heading"><?php include_once __DIR__ . '/../templates/nombre-pagina.php';?></h2>
        <p class="text-center">Cambia tu contraseña</p>

        <form class="formulario" method="POST" >
            <div class="formulario__campo">
                <label for="pass" class="formulario__label">Contraseña</label>

                <input type="password" name="pass" id="pass" class="formulario__input" placeholder="Ej: 1922222">
            </div>

            <input type="submit" value="Enviar instrucciones" class="formulario__submit">

        </form>
    </main>
</div>