let colores = ["red", "yellow", "green", "while", "blue", "brown", "pink", "black"];

let palabrasEsenciales = []

for (let i = 0; i < 8; i++) {
    let word = prompt(`Introduce la palabra ${i + 1}`)
    palabrasEsenciales.push(word);
}

console.log("Array de palabras de usuario", palabrasEsenciales);

palabrasEsenciales.sort((a,b)=>{
    let colora = colores.includes(a);
    let colorb = colores.includes(b);

    if (colora && !colorb) {
        return -1;
    } else if (!colora && colorb) {
        return 1;
    } else {
        return 0;
    }
});

console.log("Array resultante", palabrasEsenciales);
