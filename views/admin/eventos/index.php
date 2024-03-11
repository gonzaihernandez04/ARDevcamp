<h2 clas="dashboard__heading"><?php include_once __DIR__ . '/../../templates/nombre-pagina.php'?></h2>



<h2 class="dashboard__heading"><?php include_once __DIR__ . '/../../templates/nombre-pagina.php'?></h2>


<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir evento
    </a>
</div>


<div class="dashboard__contenedor">
    <?php if(!empty($eventos)){?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Evento</th>
                    <th scope="col" class="table__th">Categoria</th>
                    <th scope="col" class="table__th">Dia y Hora</th>
                    <th scope="col" class="table__th">Ponente</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($eventos as $evento){?>

                    <tr class="table__tr">
                        <td class="table__td"><?php echo $evento->nombre;?></td>
                        <td class="table__td"><?php echo $evento->categoria->nombre;?></td>
                        <td class="table__td"><?php echo $evento->dia->nombre . ' de ' . $evento->hora->hora;?></td>
                        <td class="table__td"><?php echo $evento->ponente->nombre . " " . $evento->ponente->apellido;?></td>

                        <td class="table__td--acciones">
                            <a  class="table__accion table__accion--editar" href="/admin/eventos/editar?id=<?php echo $evento->id;?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar 
                            </a>

                            <form action="/admin/eventos" method="POST" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $evento->id;?>">
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