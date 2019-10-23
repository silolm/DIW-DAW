let mapa = [];
let celdas = [];
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

            // if (i === 1 && j === 6)
            //   div.classList.add('enemigo');

            mapa[i][j] = div;
            juego.appendChild(div);
        }
    }

    //inicializamos celdas
    for (let i = 0; i <= 19; i++)
        celdas[i] = [(i * 4) + 1];

    //  conseguir la esquina izquierda-arriba de cada caja y crear un ARRAY que las almacene de forma que por Ej.: la CELDA[6] es la primera caja
    //  de la segunda fila y las cordenadas que contendria seria: [0,4]


}

crearMapa();

function marcarCeldas() {
    let posY = personaje.y;
    let posX = personaje.x;

    if (posY <= 12 && mapa[posY + 1][posX].className.indexOf('celda') >= 0) {
        mapa[posY + 1][posX].classList.add('X');
        comprobarCeldas(posY + 1, posX);
    }
    if (posY > 0 && mapa[posY - 1][posX].className.indexOf('celda') >= 0) {
        mapa[posY - 1][posX].classList.add('X');
        comprobarCeldas(posY - 1, posX);
    }
    if (posX <= 19 && mapa[posY][posX + 1].className.indexOf('celda') >= 0) {
        mapa[posY][posX + 1].classList.add('X');
        comprobarCeldas(posY, posX + 1);
    }
    if (posX > 0 && mapa[posY][posX - 1].className.indexOf('celda') >= 0) {
        mapa[posY][posX - 1].classList.add('X');
        comprobarCeldas(posY, posX - 1);
    }
}

function comprobarCeldas(y, x) {
    //Pasamos la posición del muro
    let posX = x;
    let posY = y;
    let contador = 0;
    let fuera = false;

    for (let i = 0; i < 6 && !fuera; i++) {
        //**********************************LATERALES**********************************

        //izquierdo
        if (mapa[y][x - 1].classList.contains('celda') && mapa[y][x - 1].classList.contains('X')) {
            x--;
            contador++;
        }
        //derecho
        if (mapa[y][x + 1].classList.contains('celda') && mapa[y][x + 1].classList.contains('X')) {
            x++;
            contador++;
        }
        //arriba
        if (mapa[y - 1][x].classList.contains('celda') && mapa[y - 1][x].classList.contains('X')) {
            y--;
            contador++;
        }
        //abajo
        if (mapa[y + 1][x].classList.contains('celda') && mapa[y + 1][x].classList.contains('X')) {
            y++;
            contador++;
        }

        //**********************************ESQUINAS**********************************

        // arriba-izquierda
        if (mapa[y - 1][x - 1].classList.contains('celda') && mapa[y - 1][x - 1].classList.contains('X')) {
            y++;
            contador++;
        }
    }
    if (contador === 6)
        desbloquearCelda(posY, posX);

}

function desbloquearCelda(y, x) {
    alert("Me corro en tu boca");
}

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
    mapa[personaje.y][personaje.x].classList.add('huella');
    personaje.x = posX;
    personaje.y = posY;
    mapa[personaje.y][personaje.x].classList.add('personaje');




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

function llamada() {
    let posX = personaje.x;
    let posY = personaje.y;

    if ((posX === 0 || posX === 20 || posX % 4 === 0) && (posY === 1 || posY === 13 || (posY - 1) % 3 === 0)) {
        if ((posX === 0 || posX === 20) && (posY === 1 || posY === 13)) {
            // Esquinas del mapa
        } else {
            if (posX === 0 || posX === 20) {
                // intersecciones de tres caminos en los bordes de x
            } else if (posY === 1 || posY === 13) {
                // intersecciones de tres caminos en los bordes de y
            } else {
                //intersecciones de cuatro caminos
            }
        }
    } else if ((posX === 0 || posX === 20) && (posY === 1 || posY === 13)) {
        // esquinas del mapa en x e y sin itersecciones
    } else if (posY !== 0) {
        //centro mapa sin intersecciones
    }
}