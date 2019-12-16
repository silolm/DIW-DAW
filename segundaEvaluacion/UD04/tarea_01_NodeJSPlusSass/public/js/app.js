const fallasUrl = 'http://mapas.valencia.es/lanzadera/opendata/Monumentos_falleros/JSON';
let busquedaDeFallas;


function secciones(){    
    let opciones = document.querySelector('select');

    // Set -> ArrayList que sólo nos añade los valores que no se repitan dentro de un array;
    let seccion = new Set;

    // Primer valor del Select [Sección] -> TODAS
    seccion.add('Todas');

    seccion.array.forEach(option => {
        let list;
        
        // Obtener un 'option' por cada sección del JSON
        list = document.createElement('option');
        
        // Le añadimos su valor;
        list.innerText = option;

        // Le decimos a quien pertenece;
        opciones.appendChild(list);
    });


    // Alojamos la lista de Fallas del JSON en -> featureSearch;
    let featureSearch = busquedaDeFallas.features;

    featureSearch.array.forEach(element => {
        seccion.add(element.propierties.seccion);
    });

    
    document.querySelector('label[for="selector"]').insertBefore(opciones, document.querySelector('form'));
}

function buscar() {
   
}

function safeData() {
    fetch(fallasUrl).then(response => {
        // la pasamos a JSON
        return response.json();
        // Y entonces
    }).then(busqueda => {
        console.log(busqueda);
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