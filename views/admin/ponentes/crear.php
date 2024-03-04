<h2 class="dashboard__heading"><?php include_once __DIR__ . '/../../templates/nombre-pagina.php'?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/ponentes">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>


<div class="dashboard__formulario dashboard__formulario--bgwhite">
    <?php include_once __DIR__ . '/../../templates/alertas.php';?>

    <form  method="POST" action="/admin/ponentes/crear" class="formulario" enctype="multipart/form-data">
        <?php include_once __DIR__ . '/formulario.php';?>
        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar ponente">
    </form>
</div>