const inputNum = document.getElementById("num");
const contenido = document.getElementById("tabla");
const form = document.getElementById("formulario");
const cols = document.getElementById("columnas");
const configSec = document.getElementById("configSec")
const tabSec = document.getElementById("tabSec")


function obtener (){
    const datos = localStorage.getItem("tablero");
    if(datos){
        return JSON.parse(datos);
    } else {
        return [];
    }
}

function guardar(arrayDatos){
    localStorage.setItem("tablero", JSON.stringify(arrayDatos));
}

inputNum.addEventListener("input", () =>{
    cols.innerHTML = "";
    const cant = parseInt(inputNum.value);

    for(let i = 0; i < cantidad; i++){
        const titulo = document.createElement("h4");
        titulo.textContent.Content = "Configurar columna: " + (i + 1);

        const inputNombre = document.createElement("input");
        inputNombre.type = "text";
        inputNombre.placeholder = "Nombre";
        inputNombre.className = "nombreCol";

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
    const cant = parseInt(inputNum.value);

    for (let i = 0; i <cantidad; i++){
        const div = document.createElement("div");

        const inputNombre = document.createElement("input");
        inputNombre.type = "text";
        inputNombre.placeholder = "Nombre: ";
    }
})

function mostrarTabla(){
    const datos = obtener();

    configSec.style.display = "none";
    tabSec.style.display = "block";
    contenido.innerHTML = "";

    datos.forEach((columna, indiceCol) =>{
        const div = document.createElement("div");
        div.className = "columna";
        

    })

    contenido.innerHTML= "";
    const tablaActivo = obtener();

    tablaActivo.forEach((texto, indice) =>{
        const tab = document.createElement("tablero");
        tab.textContent = texto;

        
        
    })
}

