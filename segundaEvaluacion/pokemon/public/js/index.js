const poke_list = 'https://pokeapi.co/api/v2/pokemon/?offset=0&limit=20';
let pokeFilter;
let currentFilter;
let pokeImgFilter;
let currentImgFilter;

async function savePokemon() {
    const pokeList = await fetch(poke_list);
    const pokeSearch = await pokeList.json();
    pokeFilter = pokeSearch.results.map(element => ({
        name: element.name,
        url: element.url
    }));
    currentFilter = pokeFilter;
    console.log(currentFilter);
}

async function savePokeImg(pokemon) {
    const pokemonImg = await fetch(`https://pokeapi.co/api/v2/pokemon/${pokemon}`);
    const imgSearch = await pokemonImg.json();
    console.log(imgSearch);
    pokeImgFilter = imgSearch.sprites.map(element => ({
        img: element.front_default
    }));
    currentImgFilter = pokeImgFilter;
}

function cargarPokemons() {
    let contenedor = document.getElementById('pokeResults');
    contenedor.innerHTML = '';

    currentFilter.forEach((element) => {
        contenedor.appendChild(cargarPokemon(element));
    });
}


function cargarPokemon(pokemon) {
    let caja = document.createElement('div');
    caja.classList.add('cajaPokemon');
    caja.dataset.name = pokemon.name;

    caja.innerHTML = `
        <h3>${pokemon.name}</h3>
    `;

    return caja;
}

function consulta() {
    mostrar();

    function mostrar() {
        let padre;
        padre = document.getElementById('resultados');
        padre.innerHTML = '';

        for (let i = 0; i < currentFilter.length; i++) {
            let hijo = document.createElement('a');
            hijo.innerText = currentFilter[i].name;
            padre.appendChild(hijo);
        }
    }
}

async function init() {
    await savePokemon();
    cargarPokemons();

    let valorBusqueda = document.querySelector('#myInput');
    document.querySelector('#myInput').addEventListener('keyup', () => {
        consulta(valorBusqueda.value);
    });
}

window.onload = init;