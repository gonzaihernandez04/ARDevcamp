
<h2 class="dashboard__heading"><?php include_once __DIR__ . '/../../templates/nombre-pagina.php'?></h2>


<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/ponentes/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir ponente
    </a>
</div>


<div class="dashboard__contenedor">
    <?php if(!empty($ponentes)){?>



    <?php } else {?>
        <div class="alerta">
             <p class="alerta--advertencia  text-center">No hay ponentes aun</p>
        </div>
  

    <?php   }  ?>
</div>