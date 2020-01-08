const fallasUrl = 'http://mapas.valencia.es/lanzadera/opendata/Monumentos_falleros/JSON';
let busquedaDeFallas;
let busquedaActual;
let ipCliente;

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
    let contenedor = document.getElementById('resultados');
    contenedor.innerHTML = '';

    busquedaActual.forEach((element) => {
        contenedor.appendChild(cargarBoceto(element));
    });
}

function cargarBoceto(falla) {
    let caja = document.createElement('div');
    caja.classList.add('contenedorFalla');
    caja.setAttribute('id_falla', falla.id);

    let nombre = document.createElement('h3');
    nombre.innerText = falla.nombre;

    let boceto = document.createElement('img');
    boceto.setAttribute('src', falla.boceto);

    let ubicacion = document.createElement('button');
    ubicacion.innerText = 'Ubicación';

    let puntuacion = document.createElement('input');
    puntuacion.setAttribute('type', 'number');
    puntuacion.addEventListener('change', () => {
        puntuar(falla.id, puntuacion);
    });

    caja.appendChild(boceto);
    caja.appendChild(nombre);
    caja.appendChild(ubicacion);
    caja.appendChild(puntuacion);

    return caja;
}

function puntuar(idFalla, puntuacion) {

    let datos = {
        idFalla: idFalla,
        ip: ipCliente.ip,
        puntuacion: puntuacion
    };

    console.log(datos);

    fetch('/puntuaciones', {
        method: 'POST',
        body: JSON.stringify(datos),
        headers: {
            "content-type": "application/json"
        }

    }).then(res => (res.json()))
        .catch(error => {
            console.log(error);
        })
}

function saveData() {
    return fetch(fallasUrl).then(response => {
        // la pasamos a JSON
        return response.json();
        // Y entonces
    }).then(busqueda => {
        busquedaDeFallas = busqueda.features.reduce((buffer, element) => buffer.concat([
            {
                id: element.properties.id,
                nombre: element.properties.nombre,
                seccion: element.properties.seccion,
                anyo: element.properties.anyo_fundacion,
                boceto: element.properties.boceto,
                infantil: false
            },
            {
                id: element.properties.id,
                nombre: element.properties.nombre,
                seccion: element.properties.seccion_i,
                anyo: element.properties.anyo_fundacion_i,
                boceto: element.properties.boceto_i,
                infantil: true
            }]), []);

        busquedaActual = busquedaDeFallas;
    });
}

function getIP() {
    return fetch('https://api6.ipify.org?format=json').then(ip => ip.json());
}

async function init() {
    await saveData();
    ipCliente = await getIP();
    cargarBocetos();
    secciones();

    document.querySelector('select').addEventListener('change', buscar);
    document.getElementById('desde').addEventListener('change', buscar);
    document.getElementById('hasta').addEventListener('change', buscar);
    document.getElementById('principal').addEventListener('click', buscar);
    document.getElementById('infantil').addEventListener('click', buscar);
}

window.onload = init;