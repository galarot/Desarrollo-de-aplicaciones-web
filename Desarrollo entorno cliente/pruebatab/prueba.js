/**
 * VARIABLES INICIALES
 */
const inputNum = document.getElementById("num"); // Entrada del número de columnas
const contenido = document.getElementById("tabla"); // Contenedor principal del tablero
const form = document.getElementById("formulario"); // Formulario de configuración

// Variables adicionales siguiendo el estilo de la guía
const camposCols = document.getElementById("campos-columnas");
const tableroSeccion = document.getElementById("tablero-seccion");
const configSeccion = document.getElementById("configuracion-inicial");
const btnLimpiar = document.getElementById("limpiar");

/**
 * FUNCIONES DE PERSISTENCIA (Basadas en el Tema 4 y tu ejemplo)
 */

// Obtiene los datos del localStorage y los convierte de texto (string) a Objeto/Array
function obtener() {
    const datos = localStorage.getItem("tablero");
    if (datos) {
        return JSON.parse(datos);
    } else {
        return null; // Si no hay nada guardado, devuelve null
    }
}

// Guarda el Array del tablero convirtiéndolo primero a texto (string)
function guardar(arrayDatos) {
    localStorage.setItem("tablero", JSON.stringify(arrayDatos));
}

/**
 * GENERACIÓN DINÁMICA DE CAMPOS (Entrega 4 - Requisito Formulario)
 */

// Este evento detecta cuando escribes en el número de columnas y crea los inputs necesarios
inputNum.addEventListener("input", () => {
    camposCols.innerHTML = ""; // Limpiamos el contenedor para que no se acumulen
    const cantidad = parseInt(inputNum.value);

    for (let i = 0; i < cantidad; i++) {
        // Creamos un título para cada columna
        const subtitulo = document.createElement("h4");
        subtitulo.textContent = "Columna " + (i + 1);

        // Input para el nombre de la columna (Requisito PDF)
        const inputNombre = document.createElement("input");
        inputNombre.type = "text";
        inputNombre.placeholder = "Nombre de la columna";
        inputNombre.className = "nombre-col"; // Clase para recoger el valor luego

        // Input para el límite de tareas (Requisito PDF)
        const inputLimite = document.createElement("input");
        inputLimite.type = "number";
        inputLimite.placeholder = "Límite de tareas";
        inputLimite.className = "limite-col";

        // Añadimos los elementos al DOM
        camposCols.appendChild(subtitulo);
        camposCols.appendChild(inputNombre);
        camposCols.appendChild(inputLimite);
    }
});

// Evento al pulsar "Generar Tablero"
form.addEventListener("submit", (e) => {
    e.preventDefault(); // Evitamos que la página se recargue
    
    const nombres = document.querySelectorAll(".nombre-col");
    const limites = document.querySelectorAll(".limite-col");

    // Creamos la estructura de datos: un array de objetos
    const estructuraInicial = [];
    nombres.forEach((input, i) => {
        estructuraInicial.push({
            nombre: input.value,
            limite: parseInt(limites[i].value),
            tareas: [] // Empezamos con la lista de tareas vacía
        });
    });

    guardar(estructuraInicial); // Guardamos en localStorage
    mostrarTabla(); // Dibujamos el tablero
});

/**
 * RENDERIZADO DEL TABLERO (Uso de DOM dinámico)
 */

function mostrarTabla() {
    const datosActivos = obtener(); // Recuperamos lo que hay en localStorage
    if (!datosActivos) return; // Si está vacío, no hacemos nada

    // Cambiamos la visibilidad de las secciones
    configSeccion.style.display = "none";
    tableroSeccion.style.display = "block";
    
    contenido.innerHTML = ""; // Limpiamos el tablero antes de pintar (como en tu lista)

    // Recorremos cada columna del array
    datosActivos.forEach((columna, indiceCol) => {
        // Creamos el contenedor de la columna
        const divColumna = document.createElement("div");
        divColumna.className = "columna-kanban";

        // --- Lógica de Drag & Drop (Requisito Entrega 4) ---
        divColumna.ondragover = (e) => e.preventDefault(); // Permitir que se suelten cosas encima
        divColumna.ondrop = (e) => soltarTarea(e, indiceCol); // Acción al soltar

        // Creamos el encabezado con Nombre y el contador de Límite
        const titulo = document.createElement("h3");
        titulo.textContent = columna.nombre + " (" + columna.tareas.length + "/" + columna.limite + ")";

        // Contenedor para las tareas individuales
        const listaTareas = document.createElement("div");
        listaTareas.className = "contenedor-tareas";

        // Recorremos las tareas de esta columna específica
        columna.tareas.forEach((textoTarea, indiceTarea) => {
            const itemTarea = document.createElement("div");
            itemTarea.className = "tarjeta-tarea";
            itemTarea.textContent = textoTarea;
            itemTarea.draggable = true; // Hacemos que se pueda arrastrar

            // --- Eliminar con doble click (Igual que en tu ejemplo) ---
            itemTarea.addEventListener("dblclick", () => {
                eliminarTarea(indiceCol, indiceTarea);
            });

            // Al empezar a arrastrar, guardamos de qué columna viene y qué posición ocupa
            itemTarea.ondragstart = (e) => {
                e.dataTransfer.setData("colOrigen", indiceCol);
                e.dataTransfer.setData("posTarea", indiceTarea);
            };

            listaTareas.appendChild(itemTarea);
        });

        // Input para escribir nueva tarea en esta columna
        const inputNueva = document.createElement("input");
        inputNueva.type = "text";
        inputNueva.placeholder = "Nueva tarea...";

        // Botón para añadir la tarea
        const btnAnadir = document.createElement("button");
        btnAnadir.textContent = "Añadir";
        btnAnadir.onclick = () => {
            anadirTarea(indiceCol, inputNueva.value);
        };

        // Construimos la jerarquía de la columna
        divColumna.appendChild(titulo);
        divColumna.appendChild(listaTareas);
        divColumna.appendChild(inputNueva);
        divColumna.appendChild(btnAnadir);

        // Añadimos la columna al tablero principal (contenido)
        contenido.appendChild(divColumna);
    });
}

/**
 * FUNCIONES DE LÓGICA Y ACCIONES
 */

// Añadir una tarea validando límites (Requisito Entrega 4)
function anadirTarea(indiceCol, texto) {
    const datos = obtener();
    
    if (texto.trim() === "") return alert("No puedes añadir una tarea vacía");
    
    // Comprobamos si la columna ha llegado a su límite máximo
    if (datos[indiceCol].tareas.length >= datos[indiceCol].limite) {
        return alert("Has alcanzado el límite de tareas en esta columna");
    }

    datos[indiceCol].tareas.push(texto); // Añadimos al array
    guardar(datos); // Sincronizamos con localStorage
    mostrarTabla(); // Refrescamos la vista
}

// Eliminar tarea (Actualiza DOM, Estructura y LocalStorage)
function eliminarTarea(indiceCol, indiceTarea) {
    const datos = obtener();
    datos[indiceCol].tareas.splice(indiceTarea, 1); // Quitamos el elemento del array
    guardar(datos);
    mostrarTabla();
}

// Lógica para mover tareas entre columnas (Drag & Drop)
function soltarTarea(e, indiceDestino) {
    const colOrigen = e.dataTransfer.getData("colOrigen");
    const posTarea = e.dataTransfer.getData("posTarea");
    const datos = obtener();

    // Si soltamos en la misma columna, no hacemos nada
    if (colOrigen == indiceDestino) return;

    // Antes de mover, comprobamos si la columna destino tiene hueco
    if (datos[indiceDestino].tareas.length < datos[indiceDestino].limite) {
        // Sacamos la tarea de la columna vieja y la metemos en la nueva
        const tareaMovida = datos[colOrigen].tareas.splice(posTarea, 1)[0];
        datos[indiceDestino].tareas.push(tareaMovida);
        
        guardar(datos); // Guardamos cambios
        mostrarTabla(); // Actualizamos vista
    } else {
        alert("La columna destino está llena");
    }
}

// Persistencia: Al cargar la página, comprobamos si ya había un tablero
window.onload = mostrarTabla;

// Botón Limpiar: Borra el localStorage y reinicia la app (como tu btnLimpiar)
btnLimpiar.addEventListener("click", () => {
    if(confirm("¿Seguro que quieres borrar todo el tablero?")) {
        localStorage.removeItem("tablero");
        location.reload(); // Recargamos para volver al formulario inicial
    }
});