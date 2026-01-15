const inputNum = document.getElementById("num");
const contenido = document.getElementById("tabla")

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

function mostrarTabla(){
    contenido.innerHTML= "";
    const tablaActivo = obtener();

    tablaActivo.forEach(())
}

