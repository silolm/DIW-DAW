const poke_list = 'https://pokeapi.co/api/v2/pokemon/?offset=0&limit=964';
let filter;
let currentFilter;

async function consulta(element) {
    const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${element}`);
    const search = await response.json();
    filter = search.forms.map(element => ({
        name: element.name,
        url: element.url
    }));
    currentFilter = filter;

    mostrar();

    function mostrar() {
        let padre;

        padre = document.getElementById('resultados');
        padre.innerHTML = '';

        for (let i = 0; i < 5; i++) {
            let hijo = document.createElement('a');
            hijo.innerText = currentFilter.name;
            padre.appendChild(hijo);
        }
    }
}

function init() {
    let valorBusqueda = document.querySelector('#myInput');

    document.querySelector('#myInput').addEventListener('keyup', () => {
        consulta(valorBusqueda.value);
    });
}

window.onload = init;