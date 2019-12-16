const fallasUrl = 'http://mapas.valencia.es/lanzadera/opendata/Monumentos_falleros/JSON';
let busquedaDeFallas;

function secciones() {
    let select = document.querySelector('select');

    // Set -> ArrayList que sólo nos añade los valores que no se repitan dentro de un array;
    let seccion = new Set;
    // Primer valor del Select [Sección] -> TODAS
    seccion.add('Todas');

    // Alojamos la lista de Fallas del JSON en -> featureSearch;
    let featureSearch = busquedaDeFallas.features;

    featureSearch.forEach(element => {
        // Obtener un 'option' por cada sección del JSON
        seccion.add(element.properties.seccion);
    });

    seccion.forEach(element => {
        //Creamos el elemento option para el select;
        let option = document.createElement('option');
        // Y le añadimos el valor dentro del List;
        option.innerText = element;
        select.appendChild(option);
    });
}

function buscar() {

}

function safeData() {
    return fetch(fallasUrl).then(response => {
        // la pasamos a JSON
        return response.json();
        // Y entonces
    }).then(busqueda => {
        busquedaDeFallas = busqueda;
    });
}

async function init() {
    await safeData();

    secciones();

    document.querySelector('select').addEventListener('change', buscar);
    document.getElementById('desde').addEventListener('change', buscar);
    document.getElementById('hasta').addEventListener('change', buscar);
    document.getElementById('principal').addEventListener('click', buscar);
    document.getElementById('infantil').addEventListener('click', buscar);
}

window.onload = init;