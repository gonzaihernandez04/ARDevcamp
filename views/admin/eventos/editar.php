<h2 class="dashboard__heading"><?php include_once __DIR__ . '/../../templates/nombre-pagina.php'?></h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>


<div class="dashboard__formulario dashboard__formulario--bgwhite">
    <?php include_once __DIR__ . '/../../templates/alertas.php';?>

    <form  method="POST"  class="formulario">
        <?php include_once __DIR__ . '/formulario.php';?>
        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Guardar Cambios">
    </form>
</div>


<?php
$script = "<script src= '/build/js/evento.js'></script>";
$script .= "<script src= '/build/js/ponente.js'></script>";

echo $script;

?>