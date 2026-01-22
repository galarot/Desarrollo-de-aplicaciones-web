const inputNum = document.getElementById("num");
const contenido = document.getElementById("tabla");
const form = document.getElementById("formulario");
const cols = document.getElementById("columnas");
const configSec = document.getElementById("configSec");
const tabSec = document.getElementById("tableroSec");
const limpiarbtn = document.getElementById("limpiar");


function obtener (){
    const datos = localStorage.getItem("tablero");
    if(datos){
        return JSON.parse(datos);
    } else {
        return null;
    }
}

function guardar(arrayDatos){
    localStorage.setItem("tablero", JSON.stringify(arrayDatos));
}

inputNum.addEventListener("input", () =>{
    cols.innerHTML = "";
    const cant = parseInt(inputNum.value);

    for(let i = 0; i < cant; i++){
        //titulo col
        const titulo = document.createElement("h3");
        titulo.textContent = "Columna numero " + (" | ") + "Tarea numero ";

        //nombre col
        const inputNombre = document.createElement("input");
        inputNombre.type = "text";
        inputNombre.placeholder = "Nombre";
        inputNombre.className = "nombreCol";

        //limite tareas
        const inputMax = document.createElement("input"); 
        inputMax.type = "number";
        inputMax.placeholder = "Limite de tareas"
        inputMax.className = "limiteCol";

        
        cols.appendChild(titulo);
        cols.appendChild(inputNombre);
        cols.appendChild(inputMax);
    }
})

form.addEventListener("submit", (e) =>{
    e.preventDefault();
    const nombre = document.querySelectorAll(".nombreCol");
    const max = document.querySelectorAll(".limiteCol");

    const inicial = [];
    nombre.forEach((input, i) =>{
        inicial.push({
            nombre:inputNum.value,
            maxs: parseInt(max[i].value),
            tareas: [] //tareas vacias
        });
    });
    guardar(inicial); 
    mostrarTabla();


    /**for (let i = 0; i <cantidad; i++){
        const div = document.createElement("div");

        const inputNombre = document.createElement("input");
        inputNombre.type = "text";
        inputNombre.placeholder = "Nombre: ";
    }**/
})

limpiarbtn.addEventListener("click", () =>{
    localStorage.removeItem("tablero");
    location.reload();
})

function mostrarTabla(){
    const datos = obtener();

    configSec.style.display = "none";
    tabSec.style.display = "block";
    contenido.innerHTML = "";

    //recorre las columnas del array
    datos.forEach((columna, indiceCol) =>{
        const div = document.createElement("div");
        div.className = "columna";
        div.ondragover = (e) => e.preventDefault(); //permite que se pongan cosas por encima
        div.ondrop = (e) => mover(e, indiceCol); //accion para soltar/mover
        
        //encabezado y contador de limite
        const titulo = document.createElement("h2");
        titulo.textContent = columna.nombre + columna.tareas.length + columna.maxs;
        
        // tareas
        const lista = document.createElement("div");
        lista.className = "contenedor";

    
        columna.tareas.forEach((textTarea, indiceTarea)=>{
            const itemTarea = document.createElement("div");
            itemTarea.className = "itTarea";
            itemTarea.textContent = textTarea;
            itemTarea.draggable = true;

            //eliminar dbl click
            itemTarea.addEventListener("dblclick", () =>{
                eliminar(indiceCol, indiceTarea);
            });
            
            //drag para guardar posicion
            itemTarea.ondragstart = (e) => {
                e.dataTransfer.setData("colInicio", indiceCol);
                e.dataTransfer.setData("posicion", indiceTarea);
            };

            lista.appendChild(itemTarea);
        });

        const inputNew = document.createElement("input");
        inputNew.type = "text";
        inputNew.placeholder = "Nueva..."

        const btnAñadir = document.createElement("button");
        btnAñadir.textContent = "añadir"



    });

    /** 
    contenido.innerHTML= "";
    const tablaActivo = obtener();

    tablaActivo.forEach((texto, indice) =>{
        const tab = document.createElement("tablero");
        tab.textContent = texto;
     
        
        
    })  */ 
}

function añadir(indiceCol, texto){
    const datos = obtener();
    
    if(texto.trim() === "")
        return alert ("No se puede añadir contenido vacio")

    //si la colimna llega a su limite, devuelve mensaje
    if(datos[indiceCol].tareas.length >= datos[indiceCol].maxs){
        return alert("Demasiadas tareas")
    }

    datos[indiceCol].tareas.push(texto); //añadir al array
    guardar(datos); //en local storage guardar
    mostrarTabla();
}


function eliminar(indiceCol,indiceTarea){
    const datos = obtener();
    datos[indiceCol].tareas.splice(indiceTarea, 1); //quitar elemento del array
    guardar(datos);
    mostrarTabla()
}

//mover con drag y drop
function mover(e, indiceDes){
    const colInicio = e.dataTransfer.getData("colInicio");
    const indiceTarea = e.dataTransfer.getData("poscion");
    const datos = obtener();

    if(colInicio == indiceDes) 
        return;
    if(){
        
    } else {
        alert("Columna llena")
    }
}


// si hay tablero o no al recargar
window.onload = mostrarTabla;
