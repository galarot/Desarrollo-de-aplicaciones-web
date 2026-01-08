let presu = prompt("Introduzca el presupuesto total de la obra");
presu = parseFloat(presu);

if (presu > 0){
    let materiales = presu * 0.50;
    let manoobra = presu * 0.20;
    let licencia = presu * 0.30;

    document.writeln(`<li> El coste de los materiales de obra es ${materiales}€</li>`);
    document.writeln(`<li>El coste de la mano de obra es ${manoobra}€</li>`);
    document.writeln(`<li>El coste de la licenca es ${licencia}€</li>`);
}else{
    document.writeln(`<h1>Error, introduzca un numero valido`)
}
