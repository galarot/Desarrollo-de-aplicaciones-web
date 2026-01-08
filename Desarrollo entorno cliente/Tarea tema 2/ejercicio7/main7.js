let numeros = [];

for (let i = 0; i < 10; i++) {
    let num1;
    do {
        num1 = parseInt(prompt(`Por favor, introduzca un numero ${i + 1} de 10`));
    } while (isNaN(num1));
    numeros.push(num1);
}

console.log(`Array:`);
numeros.forEach((valor, indice) => {
    console.log(`Indice ${indice}: ${valor}`);
});

let inicial;
let final;

do {
    inicial = parseInt(prompt(`Posicion inicial:`), 10);
    final = parseInt(prompt(`Posicion final:`), 10);
} while (isNaN(inicial) || isNaN(final) || inicial < 0 || inicial > 9 || final < 0 || final > 9 || inicial >= final);

let vInicial = numeros[inicial];

for (let i = inicial; i < final; i++) {
    numeros[i] = numeros[i + 1];
}

numeros[final] = vInicial;

let last = numeros[numeros.length - 1];
for (let i = numeros.length - 1; i > 0; i--) {
    numeros[i] = numeros[i - 1];
}
numeros[0] = last;

console.log(`Array despues del cambio:`);
numeros.forEach((valor, indice) => {
    console.log(`Indice ${indice}: ${valor}`);
});
