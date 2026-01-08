let n = prompt("Introduce el numero");
n = Number(n);
if(n>0 && Number.isInteger(n)){
    alert("Numero introducido: " + n);

    let divisores = [];
    for(let i = 1; i <=n; i++)
        if(n % i === 0){
        divisores.push(i);
        alert(`Divisores: ${divisores.join(" , ")}`);
        }
    let sumaC = 0;
    for (i = 0; i < divisores.length; i++){
        sumaC += divisores[i] **2;
    }
    alert("La suma de cuadrados de divisores: " + sumaC);
    let raizC = Math.sqrt(sumaC);
    if (Number.isInteger(raizC)){
        alert(`La suma ${sumaC} es correcta por que ${raizC} X ${raizC} es igual a ${sumaC}`);

    }else{
        alert(`Resultado erroneo, intentalo de nuevo`);
    }
    
}else{
    n = prompt("Introduce el numero");
}

