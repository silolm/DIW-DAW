let urlPokemons;
let pokemons;

async function saveUrl() {
    const response = await fetch(`https://pokeapi.co/api/v2/pokemon?limit=1000`);
    const json = await response.json();
    return urlPokemons = json.results;
}

async function savePokemons() {
    pokemons = await Promise.all(urlPokemons.map(async element => {
        const response = await fetch(element.url);
        const json = await response.json();
        return {
            name: json.name,
            types: json.types[0].type.name,
            weight: json.weight,
            height: json.height,
            img: json.sprites.front_default
        };
    }));
    //console.log(pokemons);
}

function loadPokemons() {
    let contenedor = document.getElementById('pokeResults');
    contenedor.innerHTML = '';
    pokemons.forEach((element) => {
        contenedor.appendChild(loadInfo(element));
    });
}

function loadInfo(pokemon) {
    let container = document.querySelector('#pokeResults');

    let caja = document.createElement('div');
    caja.id = 'pokedexBox';

    let pokedex = document.createElement('div');
    pokedex.classList.add('pokedex');

    pokedex.innerHTML = `
    <section class="wrapper">
        <!-- Row title -->
        <main class="row title">
            <ul>
                <li>Name</li>
                <li>Types</li>
                <li><span class="title-hide">#</span>Moves</li>
                <li>Height</li>
                <li>Weight</li>
            </ul>
        </main>
        <!-- Row 1 - fadeIn -->
        <section class="row-fadeIn-wrapper">
            <article class="row fadeIn nfl">
                <ul>
                    <li><a>${pokemon.name}</a></li>
                    <li>TYPE</li>
                    <li>MOVES</li>
                    <li>${pokemon.height}</li>
                    <li>${pokemon.weight}</li>
                </ul>
            </article>
        </section>
    </section>
    <img class="pokeImg" src="${pokemon.img}">
    `;
    container.appendChild(caja);
    caja.appendChild(pokedex);

    return caja;
}

async function init() {
    await saveUrl();
    await savePokemons();
    loadPokemons();
}

window.onload = init;