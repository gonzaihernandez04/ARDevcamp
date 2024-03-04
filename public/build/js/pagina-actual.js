function paginaActual(){const a=window.location.pathname;if(a.split("/").length<=3){document.querySelector(`a[href="${a}"]`).classList.add("dashboard__enlace--actual")}}window.addEventListener("load",()=>{paginaActual()});
//# sourceMappingURL=pagina-actual.js.map
