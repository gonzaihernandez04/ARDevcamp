<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion del evento</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre Evento</label>
        <input type="text" name="nombre" id="nombre" class="formulario__input" placeholder="Nombre evento" value="<?php echo $evento->nombre ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="descripcion">Descripcion Evento</label>
        <textarea  name="descripcion" id="descripcion" class="formulario__textarea" placeholder="Nombre evento" value="<?php echo $evento->descripcion ?? ''; ?>" rows="8" ></textarea>
    </div>
    <div class="formulario__campo">
        <label for="categorias" class="formulario__label" for="categoria">Categoria</label>
        <select name="categoria_id" id="categorias" class="formulario__select">
            <option value="">Seleccionar</option>
            <?php foreach($categorias as $categoria): ?>
                <option value=<?php echo $categoria->id?> ><?php echo $categoria->nombre ?? '';?></option>

            <?php endforeach;?>
        </select>
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="descripcion">Selecciona el dia</label>
        <div class="formulario__radio">
            <?php foreach($dias as $dia):?>

                <div>
                    <label for="<?php echo strtolower($dia->nombre);?>"><?php echo $dia->nombre;?></label>
                    <input type="radio" name="dia" id="<?php echo strtolower($dia->nombre);?>" value="<?php echo $dia->id;?>">
                </div>

            <?php endforeach?>
        </div>
    </div>

</fieldset>