window.addEventListener('load',()=>{
    paginaActual();
})

function paginaActual(){
    const urlActual = window.location.pathname;
     const elemento = document.querySelector(`a[href="${urlActual}"]`);
     elemento.classList.add('dashboard__enlace--actual');
}