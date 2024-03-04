(()=>{
    const tagsDiv = document.querySelector('#tags');
    const tagsInputHidden = document.querySelector('[name="tags"]');

    let tagsArray = [];
    tags();
    function tags(){
        const inputTag = document.querySelector('#tags-input');
        if(!inputTag) return;

        inputTag.addEventListener('keypress',(event)=>{

   
  
                guardarTag(event)
            

        
        });
    }

    
    function guardarTag(input){

          if(input.keyCode == 44){
            if(input.target.value.trim() === '' || input.target.value<1 || input.target.value.trim() === ','){
                input.target.value = '';
                return;
            } 

            input.preventDefault();
             tagsArray = [...tagsArray,input.target.value.trim()];
             input.target.value = '';

             mostrarTags();
 
         }
      
    }

    function mostrarTags(){
        tagsDiv.textContent = '';
        tagsArray.forEach(tag=>{
            const etiqueta = document.createElement('LI');
            etiqueta.classList.add('formulario__tag');
            etiqueta.textContent = tag;
            etiqueta.onclick = eliminarTag;
            tagsDiv.appendChild(etiqueta);
        });
        tagsDiv.appendChild(tagsInputHidden)
        actualizarInputHidden();
      
    }

    function eliminarTag(tag){
        tag.target.remove();
        tagsArray = tagsArray.filter(etiqueta => etiqueta.toString() != tag.target.textContent);
        actualizarInputHidden();
    
    }
    function actualizarInputHidden(){
        tagsInputHidden.value = tagsArray.toString();

    }
})();