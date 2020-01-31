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
    caja.dataset.idFalla = falla.id;

    caja.innerHTML = `
        <img src="${falla.boceto}" alt="emblema">

        <h3>${falla.nombre}</h3>

        <button>Ubicación</button>

         <form>
            <label for=${falla.infantil ? falla.id + 1 : falla.id + 2}><i class="fas fa-star"></i></label>
            <input id=${falla.infantil ? falla.id + 1 : falla.id + 2} name="voto" type="radio" value="5">
    
            <label for=${falla.infantil ? falla.id + 3 : falla.id + 4}><i class="fas fa-star"></i></label>
            <input id=${falla.infantil ? falla.id + 3 : falla.id + 4} name="voto" type="radio" value="4">
        
            <label for=${falla.infantil ? falla.id + 5 : falla.id + 6}><i class="fas fa-star"></i></label>
            <input id=${falla.infantil ? falla.id + 5 : falla.id + 6} name="voto" type="radio" value="3">
        
            <label for=${falla.infantil ? falla.id + 7 : falla.id + 8}><i class="fas fa-star"></i></label>
            <input id=${falla.infantil ? falla.id + 7 : falla.id + 8} name="voto" type="radio" value="2">
        
            <label for=${falla.infantil ? falla.id + 9 : falla.id + 10}><i class="fas fa-star"></i></label>
            <input id=${falla.infantil ? falla.id + 9 : falla.id + 10} name="voto" type="radio" value="1">
         </form>
     `;

    let inputs = caja.querySelectorAll('input');

    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('click', () => {
            let puntuacion;
            for (let i = 1; i <= 10; i++) {
                if (document.getElementById(`${falla.id + i}`).checked)
                    puntuacion = document.getElementById(`${falla.id + i}`).value;
            }
            puntuar(falla.id, puntuacion);
        });
    }
    return caja;
}

async function puntuar(idFalla, puntuacion) {
    console.log(ipCliente.ip);
    let esValido = await get_Id(idFalla, ipCliente.ip);
    //console.log('es valido: ' + esValido.puntuaciones._id);
    //console.log(esValido);

    let datos = {
        idFalla: idFalla,
        ip: ipCliente.ip,
        puntuacion: puntuacion
    };
    //let valido = esValido.puntuaciones._id);
    console.log(esValido.puntuaciones);
    console.log(datos);
    if (esValido.puntuaciones === null) {
        fetch('/puntuaciones', {
            method: 'POST',
            body: JSON.stringify(datos),
            headers: {
                "content-type": "application/json"
            }
        }).then(res => (res.json()))
            .catch(error => {
                console.log(error);
            });
    } else {
        fetch('/puntuaciones/' + esValido.puntuaciones._id, {
            method: 'PUT',
            body: JSON.stringify(datos),
            headers: {
                "content-type": "application/json"
            }
        }).then(res => (res.json()))
            .catch(error => {
                console.log(error);
            });
    }
}

function get_Id(idFalla, ip) {
    // petición AJAX que asocia el IdFalla y la IP al Id de la PUNTUACIÓN
    // para no tener que crear cada vez uno y asi actualizar cada puntuación.
    return fetch('/puntuaciones/' + idFalla + '/' + ip).then(res => {
        return res.json();
    }).catch(error => {
        console.log(error);
    });
}

function saveData() {
    return fetch(fallasUrl).then(response => {
        // la pasamos a JSON
        return response.json();
        // Y entonces
    }).then(busqueda => {
          // la funcion reduce itera cada elemento del Json que le asignamos en este caso GAMES
        // y acumula el valor retornado por la función d¡flecha en el buffer
        busquedaDeFallas = busqueda.features.reduce((buffer, element) => buffer.concat([
            {
                id: element.properties.id,
                nombre: element.properties.nombre,
                seccion: element.properties.seccion,
                anyo: element.properties.anyo_fundacion,
                boceto: element.properties.boceto,
                coordenadas: element.geometry.coordinates,
                infantil: false
            },
            {
                id: element.properties.id,
                nombre: element.properties.nombre,
                seccion: element.properties.seccion_i,
                anyo: element.properties.anyo_fundacion_i,
                boceto: element.properties.boceto_i,
                coordenadas: element.geometry.coordinates,
                infantil: true
            }]), [/*estado inicial del acumulador (buffer)*/]);

        busquedaActual = busquedaDeFallas;
    });
}

function getIP() {
    // obtener IP en formato JSON
    return fetch('https://api6.ipify.org?format=json').then(ip => ip.json());
}

function crearMapa(coordenada) {
    // funcion para crear mapa funciona perfecto solo falta pasarle los parametros de las fallas...
    let mymap = L.map('mapid').setView([coordenada[0], coordenada[1]], 18);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2lsb2xtIiwiYSI6ImNrNTl3Mno0bDExYTUzdXBhbWt6MjhxbmsifQ.CbExNLNeHPKK-4mZOGDhEw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        accessToken: 'your.mapbox.access.token'
    }).addTo(mymap);

    return mymap;
}

async function init() {
    await saveData();
    ipCliente = await getIP();
    cargarBocetos();
    secciones();

    //crearMapa();

    document.querySelector('select').addEventListener('change', buscar);
    document.getElementById('desde').addEventListener('change', buscar);
    document.getElementById('hasta').addEventListener('change', buscar);
    document.getElementById('principal').addEventListener('click', buscar);
    document.getElementById('infantil').addEventListener('click', buscar);

}

window.onload = init;