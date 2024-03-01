<?php include_once __DIR__ . '/../templates/header.php'; ?>
<?php include_once __DIR__ . '/../templates/alertas.php' ?>
<div class="contenedor">
    <main class="auth">
        <h2 class="auth__heading"><?php include_once __DIR__ . '/../templates/nombre-pagina.php'; ?></h2>
        <?php if ($token_valido) { ?>

            <p class="text-center">Cambia tu contraseña</p>

            <form class="formulario" method="POST">
                <div class="formulario__campo">
                    <label for="pass" class="formulario__label">Nueva Contraseña</label>
                    <input type="password" name="pass" id="pass" class="formulario__input" placeholder="Ej: 1922222">
                </div>
                <div class="formulario__campo">
                    <label for="pass2" class="formulario__label">Repetir Contraseña</label>
                    <input type="password" name="pass2" id="pass2" class="formulario__input" placeholder="Ej: 1922222">
                </div>

                <input type="submit" value="Cambiar contraseña" class="formulario__submit">

            </form>

        <?php } ?>
        <div class="acciones">
            <a href="/registro" class="acciones__enlace">¿Aun no tenes una cuenta? Crea una</a>
            <a href="/olvide" class="acciones__enlace">¡Olvidaste tu contraseña?</a>
        </div>
    </main>
</div>