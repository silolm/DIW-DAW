window.onload = init;

let contador = 0;
let giro = false;
let v = false;

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

function crearGiro() {
    let elemento = document.querySelector('.ultimate');

    elemento.addEventListener('click', () => {
       if (!giro)
           elemento.classList.add('giro');
    });
}


function crearV() {
    let elemento = document.querySelector('.ultimate');

    elemento.addEventListener('click', () => {
        if (!v)
            elemento.classList.add('v');
    });
}


function init() {
    document.querySelector('.original').addEventListener('click', crearCajas);
    document.querySelector('.giratorio').addEventListener('click', crearGiro);
    document.querySelector('.vendetta').addEventListener('click', crearV);
}