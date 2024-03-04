<fieldset class="formulario__fieldset formulario__fieldset">
    <legend class="formulario__legend">Informacion Personal</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="formulario__input" placeholder="Nombre ponente" value="<?php echo $ponente->nombre ?? ''; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido" class="formulario__input " placeholder="apellido ponente" value="<?php echo $ponente->apellido ?? ''; ?>">
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad" class="formulario__input " placeholder="Ciudad ponente" value="<?php echo $ponente->ciudad ?? ''; ?>">
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="pais">Pais</label>
        <input type="text" name="pais" id="pais" class="formulario__input " placeholder="Pais ponente" value="<?php echo $ponente->pais ?? ''; ?>">
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="imagen">Imagen ponente</label>
        <input type="file" name="imagen" id="imagen" class="formulario__input formulario__input--file">
    </div>

    <?php if(isset($ponente->imagen_actual)){?>
            <p class="formulario__texto"></p>
            <div class="formulario__imagen">
                <picture>
                    <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen . '.webp'?>" alt="Imagen ponente WEBP" type="image/webp">
                    <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen . '.png'?>" alt="Imagen ponente png" type="image/png">
                    <img src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen . '.png'?>" alt="Imagen ponente">
                </picture>
            </div>
    <?php }?>

</fieldset>


<fieldset class="formulario__fieldset formulario__fieldset">
    <legend class="formulario__legend">Informacion Extra</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="tags-input">Areas de experiencia (Separadas por coma,)</label>
        <input type="text" id="tags-input" class="formulario__input " placeholder="Ej: NodeJS, PHP, CSS, Laravel, UX, UI">
    </div>

    <div class="formulario__listado" id="tags">
        <input type="hidden" name="tags" value="<?php echo $ponente->tags ?? ''; ?>">
    </div>

</fieldset>



<fieldset class="formulario__fieldset formulario__fieldset">
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input type="text" name="redes[facebook]" class="formulario__input formulario__input--sociales" placeholder="Facebook" value="<?php echo $ponente->facebook ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input type="text"  name="redes[twitter]" class="formulario__input formulario__input--sociales" placeholder="Twitter" value="<?php echo $ponente->twitter ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input type="text"  name="redes[tiktok]" class="formulario__input formulario__input--sociales" placeholder="TikTok" value="<?php echo $ponente->tiktok ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input type="text"  name="redes[youtube]" class="formulario__input formulario__input--sociales" placeholder="Youtube" value="<?php echo $ponente->youtube ?? ''; ?>">
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input type="text"  name="redes[instagram]" class="formulario__input formulario__input--sociales" placeholder="Instagram" value="<?php echo $ponente->instagram ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input type="text"  name="redes[github]" class="formulario__input formulario__input--sociales" placeholder="Github" value="<?php echo $ponente->github ?? ''; ?>">
        </div>
    </div>


    <?php $script = "<script src='/build/js/tags.js' defer></script>"?>
    <?php echo $script ?? ''?>


</fieldset>