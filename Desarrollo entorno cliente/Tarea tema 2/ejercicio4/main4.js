let colores = ["red", "yellow", "green", "while", "blue", "brown", "pink", "black"];
let maxRepeticiones = [1,2,3,1,2,3,1,2];
let contadores = [0,0,0,0,0,0,0,0];

let cantfranjas;

do {
    cantfranjas = prompt("Introduce el numero de franjas, majete");
} while (cantfranjas < 1 || cantfranjas > 5);

let colorinesband = []

/*A*/
for(let i = 0; i < cantfranjas; i++){
    let posicion = maxRepeticiones[Math.floor(Math.random())]
    //let colorAleatorio = colores[Math.floor(Math.random() * colores.length)]
    colorinesband.push(colorAleatorio);
    if (contadores[posicion] < maxRepeticiones[posicion]){
        contadores = contadores[i + 1];
        let colorAleatorio = colores[posicion];
    }else{

    }
    return posicion
}

/*B
let coloresPorUtl = [...colores];
for (let i = 0; i < cantfranjas; i++) {
    let norep = Math.floor(Math.random() * coloresPorUtl.length)
    colorinesband.push(coloresPorUtl[norep]);
    coloresPorUtl.splice(norep, 1);
}*/

/*C
let anterior = null;
for (let i = 0; i < cantfranjas; i++) {
    let actual;
    do {
        actual= colores[Math.floor(Math.random() * colores.length)]
    }while (anterior == actual)
        colorinesband.push(actual);
        anterior = actual;
}*/




/*Para ejecutar todas las funciones por separado, se ha de comentar y descomentar alternativamente */
document.writeln('<table border="1"><tr>');
for (let i = 0; i < colorinesband.length; i++) {
    document.writeln('<td style="width:400px; height:900px; background-color:' + colorinesband[i] + ';"></td>');
}
document.writeln('</tr></table>');
