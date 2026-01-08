const elementos = {};
localStorage.setItem("elemento", JSON.stringify(elementos));

let elemento = localStorage.getItem("elemento");

const btnAnadir = document.getElementById("añadir");

const btnMostrar = document.getElementById("mostrar");

mostrar.addEventListener("click", (event)=>{
    Object.keys(localStorage).forEach(clave =>{
    const valor = localStorage.getItem(clave);
    console.log(clave + ": " + valor);
})
});

añadir.addEventListener("click", (event)=>{
    event.preventDefault();
    console.log("Contenido añadido");
});