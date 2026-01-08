let numMesas = parseInt(prompt("Cuantas mesas hay disponibles?"));

let mesas = [];
for(let i = 0; i < numMesas; i++){
    mesas.push(Math.floor(Math.random() * 5));
}

alert("Estado de las mesas: " + mesas.join(""));

while(true){
    let grupPersonas = parseInt(prompt("Cantidad de personas?"));

    if(grupPersonas < 0){
        alert("Finalizado"); 
        break;
    }
    if(grupPersonas > 4){
        alert(`No se admiten grupos de ${grupPersonas}, el maximo son 4`);
    continue;
    }


let mesaOcup = -1;

for (let i = 0; i < mesas.length; i++){
    if(mesas[i] === 0){
        mesaOcup = i;
        break;
    }
}

if (mesaOcup === -1){
    for (let i = 0; i < mesas.length; i++){
        if (mesas[i] + grupPersonas <=4){
            mesaOcup = i;
            break;
        }
    }
}

if (mesaOcup === -1){
    alert("No queda sitio, vete a un burguer king");

}else{
    mesas[mesaOcup] += grupPersonas;
    alert(`Mesa asignada: ${mesaOcup + 1}`);
}

alert("Estado de las mesas: " + mesas.join(""));
}
