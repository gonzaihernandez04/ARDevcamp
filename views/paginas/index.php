<?php
include_once __DIR__ . '/conferencias-workshops.php';
?>

<section class="resumen">
    <div class="resumen__grid">
        <div class="resumen__bloque" <?php aos_animacion();?> >
            <p class="resumen__texto--numero"><?php echo $ponentes ?></p>
            <p class="resumen__texto resumen__texto">Speakers</p>
        </div>

        <div class="resumen__bloque" data-aos="fade-left">
            <p class="resumen__texto--numero"><?php echo $conferencias; ?></p>
            <p class="resumen__texto resumen__texto">Conferencias</p>
        </div>

        <div class="resumen__bloque" <?php aos_animacion();?>>
            <p class="resumen__texto--numero"><?php echo $workshops ?></p>
            <p class="resumen__texto resumen__texto">Workshops</p>
        </div>

        <div class="resumen__bloque" <?php aos_animacion();?> >
            <p class="resumen__texto--numero">500</p>
            <p class="resumen__texto resumen__texto">Asistentes</p>
        </div>
    </div>
</section>

<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__descripcion">Conoce a nuestros expertos de ARGDevCamp</p>
    <div class="speakers__grid">
    <?php foreach ($ponentesAll as $ponenteSingle) { ?>
     

        <div class="speaker" <?php aos_animacion();?> >
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponenteSingle->imagen; ?>.webp " type='image/webp'>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $ponenteSingle->imagen; ?>.webp " type='image/png'>
                <img class="speaker__imagen" loading="lazy" width="200" height="300" src="<?php echo $_ENV['HOST'] . '/img/sepakers/' . $ponenteSingle->imagen ?>.png" alt="Imagen ponente">
            </picture>

            <div class="speaker__informacion">
                <h4 class="speaker__nombre"><?php echo $ponenteSingle->nombre . ' ' . $ponenteSingle->apellido;?></h4>
                <p class="speaker__ubicacion">
                    <?php echo $ponenteSingle->ciudad . ', ' . $ponenteSingle->pais;?>
                </p>

                <nav class="speaker-sociales">
                    <?php $redes = json_decode($ponenteSingle->redes); ?>
                   
                    <?php if($redes->facebook){?>
                    <a class=speakers-sociales__enlace href="<?php echo $redes->facebook?>"><span class="speakers-sociales__ocultar">Facebook</span></a>
                    <?php } ?>

                    <?php if($redes->twitter){?>
                    <a class=speakers-sociales__enlace href="<?php echo $redes->twitter?>">  <span class="speakers-sociales__ocultar">Twitter</span></a>
                    <?php } ?>

                    <?php if($redes->tiktok){?>
                    <a class=speakers-sociales__enlace href="<?php echo $redes->tiktok?>">  <span class="speakers-sociales__ocultar">Tiktok</span></a>


                    <?php } ?>

                    <?php if($redes->youtube){?>

                    <a class="speakers-sociales__enlace" href="<?php echo $redes->youtube?>">  <span class="speakers-sociales__ocultar">Youtube</span></a>

                    <?php } ?>


                    <?php if($redes->instagram){?>

                    <a class="speakers-sociales__enlace" href="><?php echo $redes->instagram?>">  <span class="speakers-sociales__ocultar">Instagram</span></a>
                    <?php }?>

                    <?php if($redes->github){?>

                    <a class="speakers-sociales__enlace" href="<?php echo $redes->github?>"><span class="speakers-sociales__ocultar">GitHub</span></a>
                    <?php }?>

                </nav>

                <ul class="speaker__listado-skills">
                    <?php $tags = explode(',',$ponenteSingle->tags);
                        foreach($tags as $tag){?>
                            <li class="speaker__skill">
                                <?php echo $tag;?>
                            </li>

                    <?php }?>
                    
                </ul>
            </div>
        </div>

    <?php } ?>
    </div>
</section>


<section class="mapa" id="mapa"></section>

<section class="boletos">
    <h2 class="boletos__heading">Boletos & Precios</h2>
    <p class="boletos__descripcion">Precios para ARGDevCamp</p>

    <div class="boletos__grid">
        <div class="boleto boleto--presencial" <?php aos_animacion();?>>
            <h4 class="boleto__logo">&#60;ARGDevCamp/></h4>
            <p class="boleto__plan">Presencial</p>
            <p class="boleto__precio">$199</p>
        </div>

        <div class="boleto boleto--virtual" <?php aos_animacion();?>>
            <h4 class="boleto__logo">&#60;ARGDevCamp/></h4>
            <p class="boleto__plan">Virtual</p>
            <p class="boleto__precio">$48</p>
        </div>

        <div class="boleto boleto--gratis" <?php aos_animacion();?>>
            <h4 class="boleto__logo">&#60;ARGDevCamp/></h4>
            <p class="boleto__plan">Presencial</p>
            <p class="boleto__precio">Gratis - $0 </p>
        </div>
    </div>

    <div class="boleto__enlace-contenedor">
        <a href="/paquetes" class="boleto__enlace">Ver paquetes</a>
    </div>
</section>