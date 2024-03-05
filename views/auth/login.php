<?php include_once __DIR__ . '/../templates/header.php';?>

<div class="contenedor">
    <main class="auth">
        <h2 class="nombre-pagina auth__heading text-center"> <?php include_once __DIR__ . '/../templates/nombre-pagina.php'; ?> </h2>
        <p class="auth__texto text-center">Inicia sesion en ARDevcamp</p>

            <form class="formulario" method="POST" action="/login">
                <?php include_once __DIR__ . '/../templates/alertas.php';?>
                <div class="formulario__campo">
                    <label for="email" class="formulario__label">Email</label>
                    <input type="email" name="email" id="email" class="formulario__input" placeholder="email@email.com" value="<?php echo $usuario->email ?? '';?>">
                </div>

                <div class="formulario__campo">
                    <label for="pass" class="formulario__label">Contraseña</label>
                    <input type="password" name="pass" id="pass" class="formulario__input" placeholder="Contraseña">
                </div>

                <input type="submit" value="Iniciar sesion"  class="formulario__submit">
            </form>
            <div class="acciones">
                <a href="/registro" class="acciones__enlace">¿Aun no tenes una cuenta? Crea una</a>
                <a href="/olvide" class="acciones__enlace">¡Olvidaste tu contraseña?</a>
            </div>
    </main>
</div>


