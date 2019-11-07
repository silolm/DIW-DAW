window.onload = init;
let contador = 0;

function crearCajas() {
    if (contador <= 17) {
        let padre = document.querySelector('container');
        let caja = document.createElement('box');

        caja.addEventListener('click', click);

        padre.appendChild(caja);
        contador++;
    }
}

function click() {

    if (!this.classList.contains('evoluciona'))
        this.classList.add('evoluciona');

}

function init() {
    document.querySelector('button').addEventListener('click', crearCajas);
}