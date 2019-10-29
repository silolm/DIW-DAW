let mapa = [];
let celdas = [];
let personaje = {
    y: 0,
    x: 8
};

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

            // if (i === 1 && j === 6)
            //   div.classList.add('enemigo');

            mapa[i][j] = div;
            juego.appendChild(div);
        }
    }
    inicializarCeldas();
}

crearMapa();

function marcarCeldas() {
    let posY = personaje.y;
    let posX = personaje.x;

    if (posY <= 12 && mapa[posY + 1][posX].className.indexOf('celda') >= 0) {
        mapa[posY + 1][posX].classList.add('X');
        llamada(posY + 1, posX);
    }
    if (posY > 0 && mapa[posY - 1][posX].className.indexOf('celda') >= 0) {
        mapa[posY - 1][posX].classList.add('X');
        llamada(posY - 1, posX);
    }
    if (posX <= 19 && mapa[posY][posX + 1].className.indexOf('celda') >= 0) {
        mapa[posY][posX + 1].classList.add('X');
        llamada(posY, posX + 1);
    }
    if (posX > 0 && mapa[posY][posX - 1].className.indexOf('celda') >= 0) {
        mapa[posY][posX - 1].classList.add('X');
        llamada(posY, posX - 1);
    }
}

function comprobarCeldas(celda) {
    //Pasamos la posición del muro
    let posX = celda.x;
    let posY = celda.y;
    let contador = 0;

    for (let i = 0; i < 5; i++) {
        if (mapa[posY][posX].classList.contains('X')) {
            posX--;
            contador++;
        }
    }

    posX = celda.x;

    for (let i = 0; i < 4; i++) {
        if (mapa[posY][posX].classList.contains('X')) {
            posY--;
            contador++;
        }
    }

    if (contador === 9)
        desbloquearCelda(celda);
}

function desbloquearCelda(celda) {
    alert(celda);
}

function inicializarCeldas() {
    for (let i = 0; i < 5; i++) {
        celdas[i] = [];
        for (let j = 0; j < 4; j++)
            celdas[i][j] = {
                x: i * 4,
                y: 1 + (3 * j),
                tipo: "null"
            };
    }
}

function moverAbajo() {
    let posY = personaje.y + 1;
    let posX = personaje.x;

    if (posY <= 13 && esValido(posY, posX)) {
        mover(posY, posX);
        mapa[personaje.y][personaje.x].classList.add('personajeAbajo');
    }
}

function moverArriba() {
    let posY = personaje.y - 1;
    let posX = personaje.x;

    if (posY >= 0 && esValido(posY, posX)) {
        mover(posY, posX);
        mapa[personaje.y][personaje.x].classList.add('personaje');
    }
}

function moverDerecha() {
    let posY = personaje.y;
    let posX = personaje.x + 1;

    if (posX <= 20 && esValido(posY, posX)) {
        mover(posY, posX);
        mapa[personaje.y][personaje.x].classList.add('personaje');
    }
}

function moverIzquierda() {
    let posY = personaje.y;
    let posX = personaje.x - 1;

    if (posX >= 0 && esValido(posY, posX)) {
        mover(posY, posX);
        mapa[personaje.y][personaje.x].classList.add('personajeIzquierda');
    }
}

function mover(posY, posX) {
    console.log(posX);
    console.log(posY);

    // Eliminar anterior posicion
    mapa[personaje.y][personaje.x].classList.remove('personaje', 'personajeIzquierda', 'personajeAbajo');
    // Renovar
    mapa[personaje.y][personaje.x].classList.add('huella');
    personaje.x = posX;
    personaje.y = posY;

    marcarCeldas();
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

function llamada(posY, posX) {

    if ((posX === 0 || posX === 20 || posX % 4 === 0) && (posY === 1 || posY === 13 || (posY - 1) % 3 === 0)) {
        if ((posX === 0 || posX === 20) && (posY === 1 || posY === 13)) {
            // Esquinas del mapa
        } else {
            if (posX === 0 || posX === 20) {
                // intersecciones de tres caminos en los bordes de x
            } else if (posY === 1 || posY === 13) {
                // intersecciones de tres caminos en los bordes de y
            } else {
                comprobarCeldas(celdas[(posX - 4) / 4][(posY - 4) / 3]);
                comprobarCeldas(celdas[(posX + 4) / 4][(posY - 4) / 3]);
                comprobarCeldas(celdas[(posX + 4) / 4][(posY + 2) / 3]);
                comprobarCeldas(celdas[(posX - 4) / 4][(posY + 2) / 3]);
            }
        }
    } else if ((posX === 0 || posX === 20) && (posY === 1 || posY === 13)) {
        // esquinas del mapa en x e y sin itersecciones
    } else if (posY !== 0) {
        //centro mapa sin intersecciones
    }
}