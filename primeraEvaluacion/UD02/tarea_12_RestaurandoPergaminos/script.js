window.onload = init;

let contador = 0;

function crearCajas() {
    if (contador <= 17) {
        let padre = document.querySelector('container');
        let caja = document.createElement('box');

        caja.addEventListener('click', () => {
            if (!caja.classList.contains('evoluciona') && !caja.classList.contains('desevoluciona') && !caja.classList.contains('ultimate'))
                caja.classList.add('evoluciona');
            else if (caja.classList.contains('evoluciona') && !caja.classList.contains('ultimate')) {
                caja.classList.remove('evoluciona');
                caja.classList.add('desevoluciona');
            } else if (caja.classList.contains('desevoluciona')) {
                caja.classList.remove('desevoluciona');
                caja.classList.add('ultimate');
            }
        });

        padre.appendChild(caja);
        contador++;
    }
}

function init() {
    document.querySelector('button').addEventListener('click', crearCajas);
}

window.onload = init;

let contador = 0;

function crearCajas() {
    if (contador <= 17) {
        let padre = document.querySelector('container');
        let caja = document.createElement('box');

        caja.addEventListener('click', () => {
            if (!caja.classList.contains('evoluciona') && !caja.classList.contains('desevoluciona') && !caja.classList.contains('ultimate'))
                caja.classList.add('evoluciona');
            else if (caja.classList.contains('evoluciona') && !caja.classList.contains('ultimate')) {
                caja.classList.remove('evoluciona');
                caja.classList.add('desevoluciona');
            } else if (caja.classList.contains('desevoluciona')) {
                caja.classList.remove('desevoluciona');
                caja.classList.add('ultimate');
            }
        });

        padre.appendChild(caja);
        contador++;
    }
}

function init() {
    document.querySelector('button').addEventListener('click', crearCajas);
}