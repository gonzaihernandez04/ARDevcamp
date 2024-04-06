<main class="registro">
  <h2 class="registro__heading"><?php echo $titulo ?></h2>
  <p class="registro__descripcion">Elige tu plan</p>


  <section class="paquetes">
    <div class="paquetes__grid">
      <div class="paquete" <?php aos_animacion() ?>>
        <h3 class="paquete__nombre">Pase Gratis</h3>
        <ul class="paquete__lista">
          <li class="paquete_elemento">Acceso virtual a ARGDevCamp</li>
        </ul>
        <p class="paquete__precio">$0</p>


        <form action="/finalizar-registro/gratis" method="post">

          <input type="submit" class="paquetes__submit" value="Adquirir">

        </form>
      </div>


      <div class="paquete" <?php aos_animacion() ?>>
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

        <div id="smart-button-container">
          <div style="text-align: center;">
            <div id="paypal-button-container"></div>
          </div>
        </div>
       
      </div>


      <div class="paquete" <?php aos_animacion() ?>>
        <h3 class="paquete__nombre">Pase Virtual</h3>
        <ul class="paquete__lista">
          <li class="paquete_elemento">Acceso virtual a ARGDevCamp</li>
          <li class="paquete_elemento">Pase por 2 dias</li>
          <li class="paquete_elemento">Acceso a talleres y conferencias</li>
          <li class="paquete_elemento">Acceso a las grabaciones</li>
        </ul>
        <p class="paquete__precio">$49</p>

        <div id="smart-button-container">
          <div style="text-align: center;">
            <div id="paypal-button-container2"></div>
          </div>
        </div>


      </div>



    </div>
  </section>


</main>

<!-- <script src="https://www.paypal.com/sdk/js?client-id=BAAEg3bH9QrTc7KqCwevi-6ibN3rD7of1HlekhV9jAC6fo21qT3tUeeUHRBMdsea8ZSuyUF5Ey1wdWxmxs&components=hosted-buttons&disable-funding=venmo&currency=USD"></script> -->

<script src="https://www.paypal.com/sdk/js?client-id=AXrou61vp5FmGBGsz48Uiilryn11atHXvWxRGKZRrBJS-QG4qD-V2ucPIYASyBB1D2z3Aiq5oO2AynH3&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>

<script>
    function initPayPalButton(button = '',price = 199,id = 1) {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":id,"amount":{"currency_code":"USD","value":price}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
            // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
 
            // Show a success message within this page, e.g.
            const element = document.getElementById(`paypal-button-container${button}`);
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3>';
 
            // Or go to another URL:  actions.redirect('thank_you.html');

            // Creamos form data para guardar los datos de POST
            const datos = new FormData();
            datos.append('paquete_id',orderData.purchase_units[0].description);
            datos.append("pago_id",orderData.purchase_units[0].payments.captures[0].id);

            fetch('/finalizar-registro/pagar',{
              method:'POST',
              body:datos
            }).then(respuesta=> respuesta.json())
            .then(resultado => {
              if(resultado.resultado){
                // Window.location.origin extrae nuestro dominio
               const url = window.location.origin + '/finalizar-registro/conferencias';
                window.location.href = url;
              }
            })
            
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render(`#paypal-button-container${button}`);
    }
 
  initPayPalButton();
  initPayPalButton(2,49,2);
</script>

<!-- <script>
  paypal.HostedButtons({
    hostedButtonId: "QWP6YA23FL57Q",
  }).render("#paypal-container-QWP6YA23FL57Q")
</script>

<script>
  paypal.HostedButtons({
    hostedButtonId: "CD2UQ4EUULSDE",
  }).render("#paypal-container-CD2UQ4EUULSDE")
</script> -->