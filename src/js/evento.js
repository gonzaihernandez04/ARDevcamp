(() => {
    const ulHoras = document.querySelector(".horas");
  
    if (ulHoras) {
      let busqueda = {
        categoria_id: "",
        dia: "",
      };
  
      const dias = document.querySelectorAll('[name="dia"]');
      const inputHiddenDia = document.querySelector('[name="dia_id"]');
      const inputHiddenHora = document.querySelector('[name="hora_id"]');
      const categoria = document.querySelector('[name="categoria_id"]');
  
      categoria.addEventListener("change", terminoBusqueda);
      dias.forEach((dia) => dia.addEventListener("change", terminoBusqueda));
  
      function terminoBusqueda(e) {
  
              // Reiniciar los campos ocultos: selector de horas y de dia, esto permite que no permanezca el valor anterior.
        inputHiddenHora.value = '';
        inputHiddenDia.value = '';
  
        // Lleno el dia o la categoria en el objeto segun el seleccionado
        busqueda[e.target.name] = e.target.value;
  
        const horaPrevia = document.querySelector('.horas__hora--seleccionado');
  
  
        if(horaPrevia){
            horaPrevia.classList.remove('horas__hora--seleccionado');
        }
  
        buscarEventos();
      }
  
      async function buscarEventos(){
  
          if(Object.values(busqueda).includes("")){
              return;
          }
          const url = `/api/eventos-horario?categoria_id=${busqueda.categoria_id}&dia_id=${busqueda.dia}`
          console.log(url);
          
          if(url){
              const respuesta = await fetch(url);
              
              const eventos = await respuesta.json();
              obtenerHorasDisponibles(eventos);
              
          }
      }
      function obtenerHorasDisponibles({eventos}){
  
          // Reiniciar las horas
          // Obtengo todas las horas y recorro otro listado de horas, el cual devolvera las horas que estan tomadas.
           const listadoHoras = document.querySelectorAll("#horas li");
          listadoHoras.forEach(li => li.classList.add('horas__hora--none'));
  
      
          if(eventos){
              // Comprobar eventos ya tomados y quitar variable de deshabilitado.
              const horasTomadas = eventos.map( evento => evento.hora_id);
  
              // Eliminamos el evento de las horas no disponibles
              const horasNoDisponibles = document.querySelectorAll('.horas__hora--none');
              Array.from(horasNoDisponibles).map(hora => {
                              hora.removeEventListener('click', seleccionarHora);
              })  
              
         
  
              // Convierto Node LIST en ARRAY
              const listadoHorasArray = Array.from(listadoHoras);
  
              const horariosNoTomados = listadoHorasArray.filter(li=> !horasTomadas.includes(li.dataset.horaId));
  
              horariosNoTomados.forEach(horario=>{
                  horario.classList.remove('horas__hora--none');
              })
              
              // Permite deshabilitar el evento de click para el LI que tiene la clase de .horas__hora--none
              const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--none)');
  
              horasDisponibles.forEach(hora=>{
                  hora.addEventListener('click',seleccionarHora);
              });
          }
         
      }
      function seleccionarHora(e) {
  
  
          // Deshabilita la hora previa si hay un nuevo click
  
          const horaPrevia = document.querySelector('.horas__hora--seleccionado');
          if(horaPrevia){
              horaPrevia.classList.remove('horas__hora--seleccionado');
          }
          e.target.classList.add('horas__hora--seleccionado');
          inputHiddenHora.value = e.target.dataset.horaId;
  
  
          // Llenar el value del campo oculto de dia
  
          inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
  
         
      }
   
    }
  })();
  