window.addEventListener('load',()=>{
    paginaActual();
})

function paginaActual(){
    const urlActual = window.location.pathname;
   

     if(urlActual.split('/').length<=3){
        const elemento = document.querySelector(`a[href="${urlActual}"]`);
        elemento.classList.add('dashboard__enlace--actual');
     }
}