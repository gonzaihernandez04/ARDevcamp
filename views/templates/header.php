<header class="header">
    <div class="header__contenedor">
        <nav class="header__nav">
            <a href="/registro" class="header__enlace text-center">Registro</a>
            <a href="<?php echo isAuth() ? '/logout' : '/login'?>" class="header__enlace text-center">
                <?php echo !empty($_SESSION) ? 'Cerrar Sesion' : 'Iniciar Sesion'?>
            </a>
        </nav>

        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo text-center"><span>&#60;ARG</span> Dev<span>Camp /></span></h1>
            </a>

            <div class="header__footer">
                <div class="header__contenedor__texto">
                    <p class="header__texto">| Octubre 5 - 6 / 2024 </p>
                    <p class="header__texto header__texto--modalidad">| En Linea - Presencial</p>
                </div>

                <div class="header__accion">
                    <a href="/registro" >Comprar pase</a>
                </div>
              
            </div>
        
       
        </div>
    </div>
</header>


<div class="barra">
    <div class="barra__contenido">
        <a href="/">
          <h2 class="barra__logo--white">&#60; ArgDevCamp/></h2>
        </a>

        <div class="navegacion">
            <a href="/" class="navegacion__enlace <?php echo $_SERVER['REQUEST_URI'] == "/" ? 'navegacion__enlace--actual' : '';?>">Evento</a>
            <a href="/paquetes" class="navegacion__enlace <?php echo $_SERVER['REQUEST_URI'] == "/paquetes" ? 'navegacion__enlace--actual' : '';?>">Paquetes</a>
            <a href="/conferencias-workshops" class="navegacion__enlace <?php echo $_SERVER['REQUEST_URI'] == "/conferencias-workshops" ? 'navegacion__enlace--actual' : '';?>">Workshops - Conferencias</a>
            <a href="/registro" class="navegacion__enlace <?php echo $_SERVER['REQUEST_URI'] == "/registro" ? 'navegacion__enlace--actual' : '';?>"> Comprar Pase</a>
        </div>
    </div>
</div>