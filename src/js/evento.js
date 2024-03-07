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
      // Lleno el dia o la categoria en el objeto segun el seleccionado
      busqueda[e.target.name] = e.target.value;

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
        // Comprobar eventos ya tomados y quitar variable de deshabilitado.
    
        if(eventos){
            const horasTomadas = eventos.map( evento => evento.hora_id);
            

            
            // Obtengo todas las horas y recorro otro listado de horas, el cual devolvera las horas que estan tomadas.
            const listadoHoras = document.querySelectorAll("#horas li");

            // Convierto Node LIST en ARRAY
            const listadoHorasArray = Array.from(listadoHoras);

            const horariosNoTomados = listadoHorasArray.filter(li=> !horasTomadas.includes(li.dataset.horaId));

            horariosNoTomados.forEach(horario=>{
                horario.classList.remove('horas__hora--none');
            })
            
            const horasDisponibles = document.querySelectorAll('#horas li');

            horasDisponibles.forEach(hora=>{
                hora.addEventListener('click',seleccionarHora);
            });
        }
       
    }
    function seleccionarHora(e) {


        // Deshabilita la hora previa si hay un nuevo click

        const horaPrevia = document.querySelector('.horas__hora--seleccionado');
        console.log(horaPrevia);
        if(horaPrevia){
            horaPrevia.classList.remove('horas__hora--seleccionado');
        }
        e.target.classList.add('horas__hora--seleccionado');
        inputHiddenHora.value = e.target.dataset.horaId;

       
    }
 
  }
})();
