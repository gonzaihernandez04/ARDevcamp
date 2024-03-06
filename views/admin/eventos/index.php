<h2 clas="dashboard__heading"><?php include_once __DIR__ . '/../../templates/nombre-pagina.php'?></h2>



<h2 class="dashboard__heading"><?php include_once __DIR__ . '/../../templates/nombre-pagina.php'?></h2>


<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir evento
    </a>
</div>


<div class="dashboard__contenedor">
    <?php if(!empty($ponentes)){?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Ubicacion</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($ponentes as $ponente){?>

                    <tr class="table__tr">
                        <td class="table__td"><?php echo $ponente->nombre .' ' . $ponente->apellido;?></td>
                        <td class="table__td"><?php echo $ponente->ciudad .' ' . $ponente->pais;?></td>

                        <td class="table__td--acciones">
                            <a  class="table__accion table__accion--editar" href="/admin/ponentes/editar?id=<?php echo $ponente->id;?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar 
                            </a>

                            <form action="/admin/ponentes/eliminar" method="POST" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $ponente->id;?>">
                                <button class="table__accion table__accion--eliminar" type="submit">
                                <i class="fa-solid fa-circle-xmark"></i>
                                Eliminar</button>
                            </form>
                        </td>
                    </tr>
                 <?php } ?>
            </tbody>

        </table>


    <?php } else {?>
        <div class="alerta">
             <p class="alerta--advertencia  text-center">No hay eventos aun</p>
        </div>
  

    <?php   }  ?>
</div>

<?php
    echo $paginacion ?? '';
 
?>