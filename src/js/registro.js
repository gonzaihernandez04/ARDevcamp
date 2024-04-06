import Swal from "sweetalert2";
(() => {
  let eventos = [];
  const resumen = document.querySelector("#registro-resumen");

  if (resumen) {
    const btnEventos = document.querySelectorAll(".evento__agregar");
    btnEventos.forEach((btn) =>
      btn.addEventListener("click", seleccionarEvento)
    );
    const formularioRegistro = document.querySelector('#registro');
    formularioRegistro.addEventListener('submit',submitFormulario)

    // Llamo a la funcion para que me muestre el texto de no hay eventos
    mostrarEventos();
    function seleccionarEvento(e) {
      const { target } = e;

      const eventoExistente = eventos.find(
        (evento) => evento.id === target.dataset.id
      );

      if (!eventoExistente && eventos.length < 5) {
        eventos = [
          ...eventos,
          {
            id: target.dataset.id,
            titulo: target.parentElement
              .querySelector(".evento__nombre")
              .textContent.trim(),
          },
        ];

        // Deshabilitar el boton
        e.target.disabled = true;

        mostrarEventos();
      } else {
        Swal.fire({
          title: "Advertencia!",
          text: "no podes agregar mas de 5 eventos",
          icon: "warning",
          confirmButtonText: "OK",
        });
      }
    }

    function mostrarEventos() {
      //LIMPIAR HTML
      limpiarEventos();

      if (eventos.length > 0) {
        eventos.forEach((evento) => {
          const eventoDOM = document.createElement("DIV");
          eventoDOM.classList.add("registro__evento");

          const titulo = document.createElement("H3");
          titulo.classList.add("registro__nombre");
          titulo.textContent = evento.titulo;

          const btnEliminar = document.createElement("BUTTON");
          btnEliminar.classList.add("registro__eliminar");
          btnEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;
          btnEliminar.onclick = () => {
            eliminarEvento(evento.id);
          };

          // Renderizar en el html
          eventoDOM.appendChild(titulo);
          eventoDOM.appendChild(btnEliminar);
          resumen.appendChild(eventoDOM);
        });
      }else{
        const noRegistro = document.createElement('P');
        noRegistro.textContent = "No hay eventos, añade hasta 5 del lado izquierdo ";
        noRegistro.classList.add("registro__texto");
        resumen.appendChild(noRegistro)
      }
    }

    function eliminarEvento(id) {
      eventos = eventos.filter((evento) => evento.id != id);
      const btnEventoAHabilitar = document.querySelector(`[data-id="${id}"]`);
      btnEventoAHabilitar.disabled = false;
      mostrarEventos();
    }

    function limpiarEventos() {
      while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
      }
    
    }

    async function submitFormulario(e){
        e.preventDefault();
        const regaloId = document.querySelector('#regalo').value;

        // Extraigo la ID de los eventos
        const eventosId = eventos.map(evento=>evento.id);
      
        if(eventosId == 0 || regaloId == 0){
            Swal.fire({
                title: "Advertencia!",
                text: "Debes agregar al menos 1 evento y 1 regalo",
                icon: "warning",
                confirmButtonText: "OK",
              });
              return;
        }

        // Objeto de formdata
        const datos = new FormData();
        datos.append('eventos',eventosId)
        datos.append('regalo_id',regaloId)

        const url = window.location.origin + '/finalizar-registro/conferencias';
       
        const respuesta = await fetch(url,{
            method:"POST",
            body: datos
        })
        const resultado = await respuesta.json();
        
        if(resultado.resultado){
            Swal.fire({
                title: "Exitoso!",
                text: "Tus conferencias se han almacenado y tu registro fue exitoso",
                icon: "success",
                confirmButtonText: "OK",
              })

              window.location.href = window.location.origin + `/boleto?id=${resultado.token}`

              return;

        }else{
            Swal.fire({
                title: "Error!",
                text: "Hubo un error, hay algun evento agotado",
                icon: "error",
                confirmButtonText: "OK",
              }).then(()=> location.reload());
              return;
        }

    }
  }
})();
