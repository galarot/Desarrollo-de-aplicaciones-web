const estudiantes = [
    {nombre: "Ana", nota : 8},
    {nombre: "Raul", nota: 10},
    {nombre: "Pepe", nota: 0},
    {nombre: "Heidi", nota: 2},
    {nombre: "Mohamed", nota: 4}
];

//Lista de estudiantes y sus notas

const mostrarNotas = (estudiantes) => {
    estudiantes.forEach(estudiante => {
        let {nombre, nota} = estudiante;
        console.log(`${nombre} - ${nota}`);
    });
}

//Nota media de grupo
const notaMedia = (estudiantes) => {
    let media = 0;
    //opcion 1:reduce
/*    media = estudiantes.reduce(
        (acumulador, estudiante) => acumulador + estudiante.nota, 0)/estudiantes.length;
    return media;
 */   
    //opcion 2: for each y sumar valores a mano
    let sumaNotas = 0;
    estudiantes.forEach(estudiante => {
        sumaNotas += estudiante.nota;
    });
    media = sumaNotas/estudiantes.length;
    return media;
}

//Mostrar aprobados
const estudianresAprobados = (estudiantes) => {
    //opcion 1: filer + forEach
    /*
    let estudianresAprobados = [];
    estudianresAprobados = estudiantes.filter(estudiante => estudiante.nota >=5);
    console.log("Estudiantes aprobados: ")
    estudianresAprobados.forEach(estudiante => {
        console.log(estudiante.nombre)
    });
        */
    //opcion 2: filter + map
    let estudiantesAprobados = estudiantes.filter(est => est.nota >= 5).map(est => est.nombre);
    console.log(`Arpobados: ${estudiantesAprobados.join(",")}`);
}


mostrarNotas(estudiantes);
let media = notaMedia(estudiantes);
console.log(media);
estudianresAprobados(estudiantes);

//Pedir al usuario un nombre de estudiante y mostrar nota por pantalla
//let nombreEstudiantes = prompt("Introduzca el nombre del estudiante").toLowerCase().trim();
let nombreEstudiante = "Pepe";
let encontrado = false;
let estudianteAMostrar;

//opcion 1: forEach y buscamos nombre
/*estudiantes.forEach(estudiante => {
    if(estudiante.nombre.toLowerCase() === nombreEstudiante){
        encontrado = true;
        estudianteAMostrar = estudiante;
    }
})

if(encontrado){
        console.log(`${estudianteAMostrar.nombre} tiene una nota de ${estudianteAMostrar.nota}`);
    }else{
        console.log(`El estudiante ${nombreEstudiante} no existe`);
}
*/
//opcion 2: find
estudianteAMostrar = estudiantes.find(
    estudiante => estudiante.nombre.toLowerCase() === nombreEstudiante
);

if(estudianteAMostrar){
        console.log(`${estudianteAMostrar.nombre} tiene una nota de ${estudianteAMostrar.nota}`);
    }else{
        console.log(`El estudiante ${nombreEstudiante} no existe`);
}