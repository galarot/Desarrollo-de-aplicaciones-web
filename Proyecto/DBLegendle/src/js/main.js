let personajes = [];

const input = document.getElementById("search-input");
const lista = document.getElementById("result-list");

//carga del json, alternativa a hacerlo nativamente
fetch("./src/data/characters.json")
    .then(res => res.json())//convertir a json al responder
    .then(data => personajes = data); //guardar datos array local

//al haber algo en el campo de texto se activa
input.oninput = () =>{
    const text = input.value.toLowerCase().trim();
    lista.classList.toggle("hidden", !text); //muestra y ocuylta si hay texto

    if(!text) return; //volver si no hay texto

    lista.innerHTML = personajes
        .filter(p => p.nombre.toLowerCase().includes(text)) //filtrsar por texto escrito
        .map(p => `
            <div onclick="elegir(${p.id})" class="flex items-center p-3 hover:bg-orange-600/20 cursor-pointer border-b border-white/10">
                <img src="${p.art_cart_url}" class="w-10 h-10 rounded-full border border-orange-500 mr-3">
                <span>${p.nombre}</span>
            </div>
        `).join('');
};

function elegir(id){
    const p = personajes.find(pers => pers.id === id); //buscar personaje por id
    input.value=""; //limpiar
    lista.classList.add("hidden");
}
