const poke_list = 'https://pokeapi.co/api/v2/pokemon/?offset=0&limit=964';
let filter;
let currentFilter;

async function savePokemon() {
    const response = await fetch(poke_list);
    const search = await response.json();
    filter = search.results.map(element => ({
        name: element.name,
        url: element.url
    }));
    currentFilter = filter;
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

    let valorBusqueda = document.querySelector('#myInput');
    document.querySelector('#myInput').addEventListener('keyup', () => {
        consulta(valorBusqueda.value);
    });
}

window.onload = init;