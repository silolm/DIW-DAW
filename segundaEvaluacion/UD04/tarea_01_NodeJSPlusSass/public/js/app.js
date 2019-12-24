const fallasUrl = 'http://mapas.valencia.es/lanzadera/opendata/Monumentos_falleros/JSON';
let busquedaDeFallas;
let busquedaActual;

function secciones() {
    let select = document.querySelector('select');

    // Set -> ArrayList que sólo nos añade los valores que no se repitan dentro de un array;
    let seccion = new Set;
    // Primer valor del Select [Sección] -> TODAS
    seccion.add('Todas');

    // Alojamos la lista de Fallas del JSON en -> featureSearch;
    busquedaDeFallas.forEach(element => {
        // Obtener un 'option' por cada sección del JSON
        seccion.add(element.seccion);
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
    let selector = document.getElementById('selector').value;
    let principal = document.getElementById('principal').checked;
    let infantil = document.getElementById('infantil').checked;

    let desde = document.getElementById('desde').value;
    if (desde === '') desde = 0;

    let hasta = document.getElementById('hasta').value;
    if (hasta === '') hasta = 3000;

    busquedaActual = busquedaDeFallas.filter((element) => {
        if (selector === 'Todas' || selector === element.seccion) {
            if (infantil === element.infantil || (!principal && !infantil)) {
                if (element.anyo >= desde && element.anyo <= hasta) {
                    return true;
                }
            }
        }
        return false
    });

    cargarBocetos();
}

function cargarBocetos() {


}

function saveData() {
    return fetch(fallasUrl).then(response => {
        // la pasamos a JSON
        return response.json();
        // Y entonces
    }).then(busqueda => {
        busquedaDeFallas = busqueda.features.reduce((buffer, element) => buffer.concat([
            {
                nombre: element.properties.nombre,
                seccion: element.properties.seccion,
                anyo: element.properties.anyo_fundacion,
                boceto: element.properties.boceto,
                infantil: false
            },
            {
                nombre: element.properties.nombre,
                seccion: element.properties.seccion_i,
                anyo: element.properties.anyo_fundacion_i,
                boceto: element.properties.boceto_i,
                infantil: true
            }]), []);

        busquedaActual = busquedaDeFallas;
    });
}

async function init() {
    await saveData();

    secciones();

    document.querySelector('select').addEventListener('change', buscar);
    document.getElementById('desde').addEventListener('change', buscar);
    document.getElementById('hasta').addEventListener('change', buscar);
    document.getElementById('principal').addEventListener('click', buscar);
    document.getElementById('infantil').addEventListener('click', buscar);
}

window.onload = init;