let arrayOne = ["we", "are", "not", "gonna", "take", "it"];
let arrayTwo = ["no", "we", "are", "not", "gonna", "take", "it"];

let ambos = arrayOne.concat(arrayTwo);

let recuento = {};

for (let i = 0; i < ambos.length;i++){
    let valor = ambos[i];
    if(recuento[valor]){
        recuento[valor]++;
    }else{
        recuento[valor] = 1;
    }
}

let arrayresult = [];

for (let i = 0; i < arrayOne.length; i++) {
    let valor = arrayOne[i];
    if (recuento[valor] === 1) {
        arrayresult.push(valor);
    }
}

for (let i = 0; i < arrayTwo.length; i++) {
    let valor = arrayTwo[i];
    if (recuento[valor] === 1) {
        arrayresult.push(valor);
    }
}

console.log("Resultado", arrayresult)