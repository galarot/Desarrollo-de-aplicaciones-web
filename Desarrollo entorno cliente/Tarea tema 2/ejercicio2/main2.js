let runnerkm = prompt("Introduce la cantidad de kilometros");
runnerkm = Number(runnerkm);

let semanakm = runnerkm * 7;
let categorias ="";

if(semanakm <=0){
    alert(`Error, numero invalido`)
    categorias="corredor que debe aprender a escribir numeros positivos"
}else if(semanakm <=10){
    categorias="corredor novato";
}else if(semanakm <=30){
    categorias="corredor iniciado";
}else if(semanakm <=40){
    categorias="corredor experto";
}else if(semanakm >50){
    categorias="corredor de elite"
}
document.writeln(`El runner hace ${semanakm} semanales, por lo tando es un ${categorias}`);