/*
const elementos = [];
localStorage.setItem("elemento", JSON.stringify(elementos));

let elemento = localStorage.getItem("elemento");
*/
const inputElemento = document.getElementById("elemento");

const btnAnadir = document.getElementById("añadir");

const btnMostrar = document.getElementById("mostrar");

const btnLimpiar = document.getElementById("limpiar");

const ulLista = document.getElementById("lista");

function obtener(){
    const datos = localStorage.getItem("list"); //donde se guardan los datos ingresados
    if(datos){
        return JSON.parse(datos); //convierte el texto en array
    } else {
        return []; //si no hay nada, devuelve array vacio
    }
    
}

function guardar(arrayDatos){ 
    localStorage.setItem("list", JSON.stringify(arrayDatos)); //pasar a string el texto al guardar
}

function mostrarLista(){
    ulLista.innerHTML= ""; //limpiar para no repetir
    const listaActiva = obtener();

    listaActiva.forEach((texto, indice) =>{ //recorrer array y crear li
        const li = document.createElement("li");
        li.textContent = texto;

        li.addEventListener("dblclick", (event) => { //eliminar doble click
            event.preventDefault();
            eliminar(indice);
            console.log("Eliminado");
        });

        ulLista.appendChild(li);
    });
}

function eliminar(indice){
    const listaActiva = obtener();
    listaActiva.splice(indice, 1); //borra elemento en indicie
    guardar(listaActiva); //actualizar el localstorage

    mostrarLista(); //actualiza la lista
}


btnAnadir.addEventListener("click", (event)=> {
    event.preventDefault();
    const nuevoElemento = inputElemento.value;
    
    const listaActiva = obtener();
    listaActiva.push(nuevoElemento);
    guardar(listaActiva);
    inputElemento.value =""; //limpiar el input de escribir
    console.log("Elemento: " + nuevoElemento);

});

btnMostrar.addEventListener("click", (event) => {
    event.preventDefault();
    mostrarLista();
});

btnLimpiar.addEventListener("click", (event) =>{
    event.preventDefault();
    localStorage.removeItem("list");
    // localStorage.clear() eso es para borrar TODO

    mostrarLista();
});

/*
function mostrando(){
    Object.keys(localStorage).forEach(clave =>{
    const valor = localStorage.getItem(clave);
    console.log(clave + ": " + valor);
});
}

function limpiar(elementos){
    localStorage.clear(elementos);
}

limpiar();

mostrar.addEventListener("click", (event)=>{
    mostrando(event);
});

añadir.addEventListener("click", (event)=>{
    event.preventDefault();
    console.log("Contenido añadido");
});

*/
