let tablerog = [];
let sizeg = 0;

function genTabDom() {
    let cantidad = sizeg; 
    
    if (cantidad === 0) {
        // si el tamaño no se ha inicializado, pedir
        cantidad = parseInt(prompt("Introduce el tamaño: "));
    }
    
    if (isNaN(cantidad) || cantidad <= 0) return;

    const tabla = document.getElementById("tabla");
    // por ambos lados, columnas y filas, se repiten por la cantidad que se haya puesto
    tabla.style.gridTemplateColumns = `repeat(${cantidad}, 30px)`;
    tabla.style.gridTemplateRows = `repeat(${cantidad}, 30px)`;
    // limpiar contenido
    tabla.innerHTML = "";
    // crear celdas
    for (let i = 0; i < cantidad * cantidad; i++){
        const celda = document.createElement("div");
        celda.classList.add("celda");
        tabla.appendChild(celda);
    }
}



// crear tablero
function genTab(tamaño) {
    return Array.from({ length: tamaño }, 
        () => Array(tamaño).fill(0)); //cada espacio en filas con el 0
}

// colocar minas
function colMinas(tablero, cantidad) {
    let minas = 0;
    const size = tablero.length;
    while (minas < cantidad) {
        let fl = Math.floor(Math.random() * size); // fila aleatoria
        let col = Math.floor(Math.random() * size); // columna aleatoria
        if (tablero[fl][col] !== "M") {  // colocar mina
            tablero[fl][col] = "M";
            minas++;
        }
    }
}


// contar minas cercanas
function countMinas(tablero, fl, col) {
    let count = 0;
    const size = tablero.length;
    for (let i = fl - 1; i <= fl + 1; i++) { // celdas rango
        for (let j = col - 1; j <= col + 1; j++) {
            if (i >= 0 && j >= 0 && i < size && j < size && tablero[i][j] === "M") // comprueba que haya una mina
                count++;
        }
    }
    return count;
}

// rellenar números
function rellenarNum(tablero) {
    const size = tablero.length;
    for (let i = 0; i < size; i++) {
        for (let j = 0; j < size; j++) {
            if (tablero[i][j] !== "M") 
                tablero[i][j] = countMinas(tablero, i, j); // poner numero minas cercanas
        }
    }
}

function eventDOM(){
    const celdas = document.querySelectorAll(".celda");
    celdas.forEach((celda, index) => {
        let fl = Math.floor(index / sizeg);
        let col = index % sizeg;

        // coords del doom guardado
        celda.dataset.fl = fl;
        celda.dataset.col = col;

        // eventos
        celda.addEventListener("click", clickIzquierdo)
        celda.addEventListener("contextmenu", clickDerecho)
        celda.addEventListener("dblclick", quitarBandera)
    });
}


function clickIzquierdo(e) {

    let celda = e.target;

    if (!celda.classList.contains("celda")) celda = celda.parentNode;

    let fl = parseInt(celda.dataset.fl);
    let col = parseInt(celda.dataset.col);
    // no descrubrir banderas
    if (celda.classList.contains("bandera")) 
        return;
    // condicion caer mina
    if (tablerog[fl][col] === "M"){
        celda.classList.add("mina");
        celda.innerHTML = `<img src="multimedia/bomba.png" width="30" height="30">`;
        perder();
        return;
    }

    if(!celda.classList.contains("descubierta")){
        alert("Descubierto");
    }

    revelar(fl, col);
    haGanao();
}

function clickDerecho(e){
    e.preventDefault();
    let celda = e.target;
    if (!celda.classList.contains("celda")) celda = celda.parentNode;

    if (celda.classList.contains("descubierta")) 
        return;
    // colocar bandera si no hay
    if(!celda.classList.contains("bandera")){
        celda.classList.add("bandera");
        celda.innerHTML = `<img src="multimedia/bandera.png" width="30" height="30">`;
    }
}

function quitarBandera(e){
    let celda = e.target;
    if (!celda.classList.contains("celda")) celda = celda.parentNode;
    if(!celda.classList.contains("bandera")) // si no contiene la clase, no hacer nada
        return;
    // quitar bandera y dejar espacio vacío
    celda.classList.remove("bandera");
    celda.innerHTML = "";
}

function revelar(fl, col){
    let tablaDOM = document.querySelectorAll(".celda");
    let celda = tablaDOM[fl * sizeg + col];
    // si bandera ya esta descu, parar
    if (celda.classList.contains("descubierta"))
        return;
    // si tiene bandera, no revelar
    if (celda.classList.contains("bandera")) return;
    
    celda.classList.add("descubierta");
    celda.style.backgroundColor = "#ddd";

    let valor = tablerog[fl][col];
    //celda es 0, se expande
    if(valor === 0){
        celda.textContent="";

        for (let i=fl - 1; i <= fl + 1; i++){
            for(let j = col-1; j <= col + 1; j++){
                if(i>=0 && j>= 0 && i < sizeg && j < sizeg){
                if(!(i === fl && j === col)){
                    revelar(i,j);
                }
            }
            }
            
        }
    }else{ // no es = muestra num
        celda.innerHTML=`<span class="numero">${valor}</span>`;
    }
}

// si pisa una mina
function perder() {
    alert("Perdiste");
    const celdas = document.querySelectorAll(".celda");

    celdas.forEach((celda,index) =>{
        let fl = Math.floor(index/sizeg);
        let col = index % sizeg;
        // mostrar minas si ha perdido
        if(tablerog[fl][col]==="M"){
            celda.classList.add("mina");
            
            celda.innerHTML = `<img src="multimedia/bomba.png" width="30" height="30">`;
        }
        // bloquear tablero al perder
        celda.style.pointerEvents="none";
        
    })
}

function haGanao(){
    const celdas = document.querySelectorAll(".celda");
    // si queda celda sin descubrir y no hay bandera, aun no gana
    for (let celda of celdas){
        if(!celda.classList.contains("descubierta") && !celda.classList.contains("bandera")){
            return;
        }
    }
    alert("Ha ganao")
    bloquear(); // tras ganas, bloquear
}

// bloquear funcion
function bloquear(){
    const celdas = document.querySelectorAll(".celda");
    celdas.forEach(col=> col.style.pointerEvents="none")
}

// boton inciar partida
document.getElementById("btn").addEventListener("click",()=>{

    let cantidad = parseInt(prompt("Introduce tamaño del tablero: "));
    sizeg = cantidad; // dar tamaño
    
    if(isNaN(sizeg) || sizeg <= 0) return;
    // el 20% de las celdas son minas
    const minas = Math.floor(sizeg * sizeg * 0.1);
    
    // crear el tablero y aisgnarlo al tablerog
    tablerog = genTab(sizeg); 
    colMinas(tablerog, minas);
    rellenarNum(tablerog);

    genTabDom();
    eventDOM();
});

/*
Codigo antiguo
// mostrar tablero
function mostrarTab(tablero, visibles) {
    const vista = tablero.map((fila, i) =>
        fila.map((v, j) => (visibles[i][j] ? 
            (v === 0 ? " " : v) : "[]")) // mostrat [] o valor
    );
    console.table(vista);
}
/*
// descubrir casillas
function descu(tablero, visibles, fl, col) {
    const size = tablero.length;
    if (fl < 0 || col < 0 || fl >= size || col >= size || visibles[fl][col]) // igual si fuera de tablero o visible
         return;
    visibles[fl][col] = true; // marcar visible

    if (tablero[fl][col] === 0) { // casilla es 0, descubrir
        for (let i = fl - 1; i <= fl + 1; i++) {
            for (let j = col - 1; j <= col + 1; j++) {
                if (!(i === fl && j === col)) // no llamar misma celda
                    descu(tablero, visibles, i, j);
            }
        }
    }
}

// comprobar victoria
function win(tablero, visibles) {
    const size = tablero.length;
    for (let i = 0; i < size; i++) {
        for (let j = 0; j < size; j++) {
            if (tablero[i][j] !== "💥" && !visibles[i][j]) // celda sin mina sin descubrir, aun no gana
                return false;
        }
    }
    return true;
}

// jugar
function play() {
    const size = parseInt(prompt(`Inserta el tamaño del tablero anda bobo: `));
    if (isNaN(size) || size <= 0) return alert(`Error, que hiciste ya? Qué has tocado?`);

    const tablero = genTab(size);
    const visibles = Array.from({ length: size }, () => Array(size).fill(false));
    const minas = Math.floor(size * size * 0.2);

    colMinas(tablero, minas);
    rellenarNum(tablero);

    alert(`Hay unas ${minas} minas en el tablero.`);

    while (true) {
        mostrarTab(tablero, visibles);

        const fl = parseInt(prompt(`Fila (0-${size - 1}):`));
        const col = parseInt(prompt(`Columna (0-${size - 1}):`));

        if (isNaN(fl) || isNaN(col) || fl < 0 || fl >= size || col < 0 || col >= size) {
            alert(`Error, que has hecho otra vez?`);
            continue;
        }

        if (tablero[fl][col] === "💥") {
            alert(`Has perdido, cuchame tu sabes jugar a esto?`);
            console.table(tablero);
            break;
        }

        descu(tablero, visibles, fl, col);
        if (win(tablero, visibles)) {
            mostrarTab(tablero, visibles);
            alert(`Has ganao, tu sí que vales, ahora dame todo tu dinero`);
            break;
        }
    }
}
*/