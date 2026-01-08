//Ejercicio 1
function ejercicio1(){
    //Se define el array
const ESTUDIANTES = [
    {nombre: "Ana", nota: 8},
    {nombre: "Luis", nota: 5},
    {nombre: "Maria", nota: 9},
    {nombre: "Antonio", nota: 4}
];

//Mostrar por consola el listado al completo de todo, estudiantes y notas
const mostrarNotasEstudiantes = (estudiantes) => {
    //Iterar con foreach sobre el array estudiantes
    estudiantes.forEach(estudiante =>{
        //Obtener los elementos las propiedades del array
        let{nombre, nota} = estudiante;
        //Mostrar por consola
        console.log(`${nombre}-${nota}`);
    });
}

//Media
const notaMediaGrupo = (estudiantes) =>{
    let media = 0;
    let sumaNotas = 0;
    //Sumar valores con foreach a mano
    estudiantes.forEach(estudiante =>{
        sumaNotas += estudiante.nota; //suma de las notas es igual a sumaNotas + estudiante nota
    });
    
    media = sumaNotas/estudiantes.length; //dividir el resultado y atribuirlo a la media
    console.log(media);
    return media; 
    
}

//Estudiantes aprobados
const estudiantesAprobados = (estudiantes) =>{
    //crear nuevo array
    let estudiantesAprobados= [];
    //filtrar elementos por los que son superiores a 5
    estudiantesAprobados = estudiantes.filter(estudiante => estudiante.nota >= 5);
        console.log("Aprobados"); 
    //bucle en el que se muestra los estudiantes aprobados
    estudiantesAprobados.forEach(estudiante =>{
        console.log(estudiante.nombre);
    });
}  


mostrarNotasEstudiantes(ESTUDIANTES);
notaMediaGrupo(ESTUDIANTES);
estudiantesAprobados(ESTUDIANTES);

//Pedir al usuario el nombre y mostrar su nota

let nombreEstudiante = prompt("Introducir el nombre").toLowerCase().trim();
let encontrado = false;
let estudianteAMostrar;

//foreach para buscar nombre
ESTUDIANTES.forEach(estudiante =>{
    //nombre de estudiante del array es igual al del introducido
    if(estudiante.nombre.toLowerCase() === nombreEstudiante){
       encontrado = true;
       estudianteAMostrar = estudiante;
    }
});

if(encontrado){
    console.log(`${estudianteAMostrar.nombre} con nota de ${estudianteAMostrar.nota}`);

} else{
    console.log(`El estudiante ${nombreEstudiante} no existe`);
}
}


//Ejercicio 2
function ejercicio2(){
const PALABRAS = [
    "programacion",
    "arquitectura",
    "medicina",
    "arboleda",
    "desarrollo",
    "navegador",
    "carpeta",
    "impresora"
];

//palabra aleatoria del array
let palabraAleatoria = Math.floor(Math.random()*PALABRAS.length);
let palabra = PALABRAS[palabraAleatoria];

//crear array de palabra con desestructuracion del array
let [...arrayPalabra] = palabra;

//usar map para que haya tantos _ como mismo numero de letras en la palabra

let progreso = arrayPalabra.map(() => "_");

//variables para la partida
let vidas = 6;
let letrasUsadas = [];
let palabraAdivinada = false;

//muestra el progreso de la partida
const mostrarEstado = (progreso, vidas, letrasUsadas) =>{
    console.log(`Palabra: ${progreso.join(" ")} \n
    Vidas: ${vidas} \n
    Letras usadas: ${letrasUsadas.join(",") || "Ni una"}`
); 
}

//comprobar si lo que hay en el progreso es igual que la palabra o no
const comprobarProgreso = (progreso, palabra) =>{
    return progreso.join("") === palabra;
}

//añadir nueva letra al progreso
const agregarLetraProgreso = (letraIntroducida, progreso, arrayPalabra) =>{
    //usar un foreach para actualizar la variable progreso
    arrayPalabra.forEach((letra, indice) =>{
        if(letra === letraIntroducida){
            //reemplaza el guion bajo en la posicion por la letra
            progreso[indice] = letra;
        }
    });

    return progreso;
}

//bucle en el que se manejen turnos

do{
    //mostrar estado de la partida
    let letra ="";
    let letraValida = false;
    mostrarEstado(progreso, vidas, letrasUsadas);
    //bucle para que el usuario introduzca la letra
    do{
        letra = prompt("Introduzca una letra").trim().toLowerCase();
        //si el usuario no ha metido un caracter al menos
        if(!letra || letra.length !=1){
            alert("Necesitas insertar un caracter")
        }
        //si la letra ya se ha introducido
        else if(letra in letrasUsadas){
            alert("Letra ya usada");
        }
        //todo correcto, push
        else{
            letrasUsadas.push(letra);
            letraValida = true;
        }
    }while(!letraValida) //repetir hasta que letraValida sea true
    //que la palabra introducida incluya la letra que se introdujo

    if(palabra.includes(letra)){
        progreso = agregarLetraProgreso(letra, progreso, arrayPalabra);
    } else{ //no esta la letra, -1 vida
        vidas--;
        alert("Letra incorrecta, -1 vida");
    }

    //comprobar que la palabra se haya adivinado para salir del bucle
    palabraAdivinada = comprobarProgreso(progreso, palabra);

}while(vidas > 0 && !palabraAdivinada)

if(vidas > 0 && palabraAdivinada){
    alert(`Ganaste, era ${palabra}`);
}else{
    alert(`Perdiste, era ${palabra}`);
}

}


//Ejercicio 3
function ejercicio3(){
const productos = [
    {nombre: "Pokeball", precio: 200, stock: 5},
    {nombre: "Superball", precio: 600, stock: 3},
    {nombre: "Pocion", precio: 300, stock: 4},
    {nombre: "Antidoto", precio: 200, stock: 2},
    {nombre: "Revivir", precio: 2000, stock: 1}
];

const jugador= {
    nombre: "Er manu",
    dinero: 2500,
    mochila: []
};

let opcionElegida = "";
let productosFiltrados = [];

//mostrar estado de la tienda
const mostrarTienda = (productos) => {
    console.log("Productos disponibles:");
    //Iterar sobre el array
    productos.forEach(producto =>{
        //obtener propiedades
        let {nombre, precio, stock} = producto;
        console.log(`${nombre}|precio: ${precio}|cantidad disponible: ${stock}`);
    });
}

//que no aparezcan los objetos sin stock
const borrarObjetosSinStock = (productos) => {
    //devolver solo los que tenga stock mayor a 0
    let productosFiltrados = productos.filter(producto => producto.stock >0);

    return productosFiltrados;
}


//mostrar mochila jugador
const mostrarMochila = (jugador) => {
    let {mochila} = jugador;
    mochila.forEach(productoComprado => {
        console.log(`${productoComprado.nombre}`);
    });

}

do{
    //filtrar productos para quitar los que no tienen stock
    productosFiltrados = borrarObjetosSinStock(productos);
    //mostrar productos de la tienda filtrados
    mostrarTienda(productosFiltrados);
    //mostrar pasta
    console.log(`${jugador.nombre} tiene ${jugador.dinero}`)

    //bucle para introducir opciones para comprar objetos
    do{
        opcionElegida = prompt("Introduce lo que quieras comprar, o salir para salir, obvio, xd");
        opcionElegida = opcionElegida.trim().toLowerCase();
    }while(!opcionElegida);

    //objeto existe y tiene stock
    let indiceProducto = productosFiltrados.findIndex(producto => producto.nombre.toLowerCase() == opcionElegida);
    
    //si el producto esta en stock
    if(indiceProducto >=0){
        //si el jugador tiene pasta
        if(jugador.dinero >= productosFiltrados[indiceProducto].precio){
            //obtenemos precio de producto
            let {precio} = productosFiltrados[indiceProducto];

            //reducir el stock en la tienda
            productosFiltrados[indiceProducto].stock--;
            //restar dinero del jugador
            jugador.dinero -= precio;
            //añadir objeto a lista jugador
            jugador.mochila.push(productosFiltrados[indiceProducto]);
        }else{
            console.log(`Tu ser pobre, bobo, no puedes comprar ${opcionElegida}`);
        }
    } else{
        console.log(`Producto no existe`);
    }
    //se cumple el bucle hasta que no escribas salir, el jugador tenga mas de 0 en dinero, y aun haya stock
}while(opcionElegida !== "salir" && jugador.dinero > 0 && productosFiltrados.length !== 0);

console.log(`Final de partida, resultados: `)
console.log(`El jugador ${jugador.nombre} tiene ${jugador.dinero}`);
console.log(`El jugador ${jugador.nombre} ha comprado: \n`);
mostrarMochila(jugador);
mostrarTienda(productosFiltrados);

}

//Ejercicio 4
function ejercicio4(){
const jugador = {
  nombre: "Goku",
  vida: 100,
  ataques: [
    { nombre: "Kame", danio: 20 },
    { nombre: "Combo Meteor", danio: 10 },
    { nombre: "Genki", danio: 30 }
  ]
};

const enemigo = {
  nombre: "Freezer",
  vida: 100,
  ataques: [
    { nombre: "Rayo maligno", danio: 10 },
    { nombre: "Death ball", danio: 20 },
    { nombre: "Supernova", danio: 30 }
  ]
};

//mostrar los ataques que hay disponibles para pelear
const mostrarAtaquesDisponibles = (jugador) => {
    let {ataques} = jugador;
    console.log(`Ataques disponibles`);
    //map para solo nombres de ataque
    let nombreAtaques = ataques.map((ataque)=> ataque.nombre);
    //imprime los nombre con , entre medias
    console.log(nombreAtaques.join(", "));
}

//obtener el daño que nos hace el enemigo con su ataque
const ataqueEnemigo = (enemigo) =>{
    //obtenemos por parte del enemigo un ataque aleatorio
    let indiceAtaqueEnemigo = Math.floor(Math.random()*enemigo.ataques.length);
    //obtenemos el daño del enemigo y se resta a la vida del jugador
    let danio = enemigo.ataques[indiceAtaqueEnemigo].danio;

    return danio;
}

//funcion mostrar vida de enemigo y jugador, controla si tienen valores negativos se muestre 0
const mostrarVidas = (jugador, enemigo) => {
    let vidaJugador = jugador.vida;
    let vidaEnemigo = enemigo.vida;
    // Si la vida es negativa, se establece a 0 para una visualización correcta
    //es decir, si la vida es -20, se muestra 0 para mejor visualizacion
    if(vidaJugador < 0){
        vidaJugador = 0;
    }
    if(vidaEnemigo < 0){
        vidaEnemigo = 0;
    }

    console.log(`Jugador tiene ${vidaJugador} de vida`);
    console.log(`Enemigo tiene ${vidaEnemigo} de vida`);

}

//para saber quien gana, pierde, o empate, o la vida restanten
const mostrarResultadoFinal = (jugador, enemigo) =>{
    let vidaJugador = jugador.vida;
    let vidaEnemigo = enemigo.vida;

    //comprobar quien gana
    let ganador = "";
    if(vidaJugador <= 0 && vidaEnemigo > 0){
        ganador = enemigo.nombre;
    }
    else if(vidaJugador > 0 && vidaEnemigo <= 0){
        ganador = jugador.nombre;
    }
    else{
        ganador = "Empate";
    }
    return ganador;
}

//funcionalidad principal

do{
    let ataqueElegido = "a"; //variable temporal para enreada de usuario

    do{
        mostrarAtaquesDisponibles(jugador);
        ataqueElegido = prompt(`Que ataque usas?`);
        ataqueElegido = ataqueElegido.trim().toLowerCase();
    }while(!ataqueElegido); //si no hay valor introducido, se repite la entrada
    //si ataque existe, devuelve indice mayor
    let indiceAtaque = jugador.ataques.findIndex(ataque => ataque.nombre.toLowerCase() === ataqueElegido);

    //ataque que se usa encontrado (por eso mayor a 0)
    if(indiceAtaque >= 0){
        let danioEnemigo = ataqueEnemigo(enemigo);
        //resta al jugador el daño del enemigo a su vida
        jugador.vida -= danioEnemigo;

        //vida que le quitamos al enemigo con nuestro ataque elegido
        let danio = jugador.ataques[indiceAtaque].danio;
        enemigo.vida -= danio;

        mostrarVidas(jugador, enemigo);
    }else{
        console.log("Este ataque no existe");

    }
}while(jugador.vida > 0 && enemigo.vida >0); //sigue si vida de enemigo y jugador superior a 0
let ganador = mostrarResultadoFinal(jugador, enemigo);
console.log(`El el resultado del finald de la partida es: ${ganador}`);
}

function menuprincipal(){
    let opcion;
    let salir = false;
    do{
        console.log("Ejercicio 1");
        console.log("Ejercicio 2");
        console.log("Ejercicio 3");
        console.log("Ejercicio 4");
        console.log("Salir (0)");

        opcion = prompt("Introduce el numero del ejercicio, o sal");
        let entrada = opcion;

        if (entrada === "salir"){
            salir = true;
            console.log("Chao pescao");
        }else{
            let numOpcion = parseInt(opcion);
            switch(numOpcion){
                case 1:
                    ejercicio1();
                    break;
                case 2:
                    ejercicio2();
                    break;
                case 3:
                    ejercicio3();
                    break;
                case 4:
                    ejercicio4();
                    break;
                default:
                    console.log("Error");
                    break;
            }
        }
    }while(!salir);
}
