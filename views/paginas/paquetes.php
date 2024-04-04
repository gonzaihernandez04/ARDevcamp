<main class="paquetes">
    <h2 class="nombre-pagina paquetes__heading text-center"><?php include_once __DIR__ . '/../templates/nombre-pagina.php';?></h2>
    <p class="paquetes__descripcion">Compara los paquetes de ARGDevCamp</p>

    <div class="paquetes__grid">
        <div class="paquete" <?php aos_animacion()?> >
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete_elemento">Acceso virtual a ARGDevCamp</li>
            </ul>
            <p class="paquete__precio">$0</p>
        </div>


        <div class="paquete"<?php aos_animacion()?> >
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete_elemento">Acceso presencial a ARGDevCamp</li>
                <li class="paquete_elemento">Pase por 2 dias</li>
                <li class="paquete_elemento">Acceso a talleres y conferencias</li>
                <li class="paquete_elemento">Acceso a las grabaciones</li>
                <li class="paquete_elemento">Camisa del evento</li>
                <li class="paquete_elemento">Comida y bebida</li>
            </ul>
            <p class="paquete__precio">$199</p>
        </div>


        <div class="paquete" <?php aos_animacion()?> >
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
            <li class="paquete_elemento">Acceso virtual a ARGDevCamp</li>
                <li class="paquete_elemento">Pase por 2 dias</li>
                <li class="paquete_elemento">Acceso a talleres y conferencias</li>
                <li class="paquete_elemento">Acceso a las grabaciones</li>
            </ul>
            <p class="paquete__precio">$49</p>
        </div>



    </div>
</main>

