const lista = document.getElementById('lista');
const boton = document.getElementById('boton');
let count=1;

boton.addEventListener('click',()=>{
    const li = document.createElement('li');
    const imagen = document.createElement('img');
    imagen.src="freddy.png";
    imagen.alt="Descripcion cuatrifasica"
    li.appendChild(imagen);
    lista.appendChild(li);
    count++;
});


lista.addEventListener("click", function(event){
    if(event.target.tagName === "li"){
        event.target.classList.toggle("Activo");
    }
});


lista.addEventListener('dbclick',function(event){
    if(event.target.getElementById === "li"){
        event.target.removeEventListener("li");
        count--;
    }
});
