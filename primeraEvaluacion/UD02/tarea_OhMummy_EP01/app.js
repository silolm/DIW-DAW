let mapa = [];
let personaje = {};
personaje.y = 0;
personaje.x = 8;

function crearMapa() {
    let juego = document.querySelector('.juego');

    mapa[0] = [];


    for (let z = 0; z < 21; z++) {
        let div = document.createElement('div');

        if (z !== 8)
            div.classList.add('body');
        else {
            div.classList.add('pasillo');
            div.classList.add('personaje');
        }

        mapa[0][z] = div;
        juego.appendChild(div);
    }

    for (let i = 1; i < 14; i++) {
        mapa[i] = [];
        for (let j = 0; j < 21; j++) {
            let div = document.createElement('div');

            if (i === 1 || i % 3 === 1 || j % 4 === 0 || j === 0)
                div.classList.add('pasillo');
            else
                div.classList.add('celda');

            mapa[i][j] = div;
            juego.appendChild(div);
        }
    }
}

crearMapa();

console.log(mapa);

function moverAbajo() {

    let posY = personaje.y + 1;
    let posX = personaje.x;

    if (posY <= 13 && esValido(posY, posX))
        mover(posY, posX);
}

function moverArriba() {

    let posY = personaje.y - 1;
    let posX = personaje.x;

    if (posY >= 0 && esValido(posY, posX))
        mover(posY, posX);
}

function moverDerecha() {

    let posY = personaje.y;
    let posX = personaje.x + 1;

    if (posX <= 20 && esValido(posY, posX))
        mover(posY, posX);
}

function moverIzquierda() {

    let posY = personaje.y;
    let posX = personaje.x - 1;

    if (posX >= 0 && esValido(posY, posX))
        mover(posY, posX);
}

function mover(posY, posX) {

    console.log(posX);
    console.log(posY);
    // Eliminar anterior posicion
    mapa[personaje.y][personaje.x].classList.remove('personaje');
    // Renovar
    personaje.x = posX;
    personaje.y = posY;
    mapa[personaje.y][personaje.x].classList.add('personaje');

}

function esValido(y, x) {
    return mapa[y][x].classList.contains("pasillo");
}

window.addEventListener('keydown', (event) => {
    if (event.key === 'ArrowDown')
        moverAbajo();

    if (event.key === 'ArrowUp')
        moverArriba();

    if (event.key === 'ArrowRight')
        moverDerecha();

    if (event.key === 'ArrowLeft')
        moverIzquierda();
});