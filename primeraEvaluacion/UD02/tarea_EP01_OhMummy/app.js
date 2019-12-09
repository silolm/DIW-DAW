let mapa = [];
let celdas = [];
let personaje = {
    y: 0,
    x: 8,
    salud: 5
};
let pergamino = false;
let llave = false;
let urna = false;
// let enemigo = {
//     y: 0,
//     x: 8,
//     temporizador: undefined
// };

class Enemigo {
    x = 0;
    y = 0;
    temporizador = undefined
}

let enemigos = [];

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
    inicializarCeldas();
    crearMomia()
}

crearMapa();

function pasarPantalla() {
    document.querySelector('.juego').innerHTML = '';
    crearMapa();
    urna = false;
    llave = false;
    pergamino = false;
}

function marcarCeldas() {
    let posY = personaje.y;
    let posX = personaje.x;

    if (posY <= 12 && mapa[posY + 1][posX].className.indexOf('celda') >= 0)
        mapa[posY + 1][posX].classList.add('X');

    if (posY > 0 && mapa[posY - 1][posX].className.indexOf('celda') >= 0)
        mapa[posY - 1][posX].classList.add('X');

    if (posX <= 19 && mapa[posY][posX + 1].className.indexOf('celda') >= 0)
        mapa[posY][posX + 1].classList.add('X');

    if (posX > 0 && mapa[posY][posX - 1].className.indexOf('celda') >= 0)
        mapa[posY][posX - 1].classList.add('X');


    llamada(posY, posX);
}

function inicializarCeldas() {
    let urnaAl = [Math.round((Math.random().toFixed(2) * 100) % 5),
        Math.round((Math.random().toFixed(2) * 100) % 4)];
    let llaveAl = [];
    let pergaminoAl = [];
    do {
        llaveAl = [Math.round((Math.random().toFixed(2) * 100) % 5),
            Math.round((Math.random().toFixed(2) * 100) % 4)];
    } while (llaveAl === urnaAl);
    do {
        pergaminoAl = [Math.round((Math.random().toFixed(2) * 100) % 5),
            Math.round((Math.random().toFixed(2) * 100) % 4)];
    } while (pergaminoAl === urnaAl || pergaminoAl === llaveAl);

    for (let i = 0; i < 5; i++) {
        celdas[i] = [];
        for (let j = 0; j < 4; j++) {
            let tipo = "null";

            if (i === urnaAl[0] && j === urnaAl[1]) tipo = "urna";
            if (i === llaveAl[0] && j === llaveAl[1]) tipo = "llave";
            if (i === pergaminoAl[0] && j === pergaminoAl[1]) tipo = "pergamino";

            celdas[i][j] = {
                x: i * 4,
                y: 1 + (3 * j),
                tipo: tipo,
                estaDescubierta: false
            };
        }
    }
}

function comprobarCeldas(celda) {
    if (celdas[celda.x / 4][(celda.y - 1) / 3].estaDescubierta === true) return;
    //Pasamos la posición del muro
    let posX = celda.x;
    let posY = celda.y;
    let contador = 0;

    for (let i = 0; i < 5; i++) {
        if (mapa[posY][posX].classList.contains('huella') && mapa[posY + 3][posX].classList.contains('huella')) {
            posX++;
            contador++;
        }
    }

    posX = celda.x;

    for (let i = 0; i < 4; i++) {
        if (mapa[posY][posX].classList.contains('huella') && mapa[posY][posX + 4].classList.contains('huella')) {
            posY++;
            contador++;
        }
    }

    if (contador === 9)
        desbloquearCelda(celda);
}

function desbloquearCelda(celda) {
    celdas[celda.x / 4][(celda.y - 1) / 3].estaDescubierta = true;

    for (let i = 1; i < 4; i++) {
        for (let j = 1; j < 3; j++) {
            mapa[celda.y + j][celda.x + i].classList.add(celda.tipo);
        }
    }
    switch (celda.tipo) {
        case 'urna':
            urna = true;
            break;
        case 'pergamino':
            pergamino = true;
            break;
        case 'llave':
            llave = true;
            break;
    }

}

function llamada(posY, posX) {
    // ********************* el 1er IF se cumple cuando el personaje se encuentra en un cruce de caminos *********************
    if ((posX === 0 || posX === 20 || posX % 4 === 0) && (posY === 1 || posY === 13 || (posY - 1) % 3 === 0)) {
        if ((posX === 0 || posX === 20) && (posY === 1 || posY === 13))
            comprobarCeldas(celdas[posX / 5][(posY - 1) / 4]);
        else {
            if (posX === 0 || posX === 20) {
                comprobarCeldas(celdas[posX / 5][(posY - 4) / 3]);
                comprobarCeldas(celdas[posX / 5][(posY - 1) / 3]);
            } else if (posY === 1 || posY === 13) {
                comprobarCeldas(celdas[(posX - 4) / 4][(posY === 13 ? posY - 4 : posY - 1) / 3]);
                comprobarCeldas(celdas[posX / 4][(posY === 13 ? posY - 4 : posY - 1) / 3]);
            } else {
                comprobarCeldas(celdas[(posX - 4) / 4][(posY - 4) / 3]);
                comprobarCeldas(celdas[posX / 4][(posY - 4) / 3]);
                comprobarCeldas(celdas[posX / 4][(posY - 1) / 3]);
                comprobarCeldas(celdas[(posX - 4) / 4][(posY - 1) / 3]);
            }
        }
    }
    //******************************************************************************************************************************

    // Este se cumple está en límite de Y CUANDO NO ES esquina o intersección, es decir cruce de caminos...
    else if (posY === 1 || posY === 13)
        comprobarCeldas(celdas[(posX / 5).toFixed(0)][(posY - 1) / 4]);
    //******************************************************************************************************************************

    // Es el mismo que el de arriba pero con los límetes de X...
    else if (posX === 0 || posX === 20)
        comprobarCeldas(celdas[posX / 5][((posY - 1) / 4).toFixed(0)]);
    //******************************************************************************************************************************

    // Este se ejecuta cuando se encuentra EN LOS LATERALES de las CELDAS....
    else if (posY !== 0) {
        if (posX % 4 !== 0) {
            comprobarCeldas(celdas[Math.trunc(posX / 4)][Math.trunc((posY - 1) / 3)]);
            comprobarCeldas(celdas[Math.trunc(posX / 4)][Math.trunc((posY - 4) / 3)]);
        } else {
            comprobarCeldas(celdas[Math.trunc(posX / 4)][Math.trunc((posY - 1) / 3)]);
            comprobarCeldas(celdas[Math.trunc((posX - 4) / 4)][Math.trunc((posY - 1) / 3)]);
        }
    }
    //******************************************************************************************************************************
}

function crearMomia() {
    let enemigo = new Enemigo;

    var newX = 0;
    var newY = 0;
    while (!mapa[newY][newX].classList.contains("pasillo")) {
        newX = Math.floor(Math.random() * 20);
        newY = Math.floor(Math.random() * 12);
    }
    mapa[newY][newX].classList.add("enemigo");

    enemigo.x = newX;
    enemigo.y = newY;
    enemigo.temporizador = setInterval(() => moverMomia(enemigo), 300);

    enemigos.push(enemigo)
}

function moverMomia(enemigo) {

    if (enemigo.y < 13 && !mapa[enemigo.y + 1][enemigo.x].classList.contains('celda') && enemigo.y < personaje.y) {
        borrarRastroMomia(enemigo);
        enemigo.y++;
        mapa[enemigo.y][enemigo.x].classList.add("enemigo");
    }
    if (enemigo.x < 20 && !mapa[enemigo.y][enemigo.x + 1].classList.contains('celda') && enemigo.x < personaje.x) {
        borrarRastroMomia(enemigo);
        enemigo.x++;
        mapa[enemigo.y][enemigo.x].classList.add("enemigo");
    }
    if ((enemigo.y > 1 || (enemigo.x === 8 && enemigo.y > 0)) && !mapa[enemigo.y - 1][enemigo.x].classList.contains('celda') && enemigo.y > personaje.y) {
        borrarRastroMomia(enemigo);
        enemigo.y--;
        mapa[enemigo.y][enemigo.x].classList.add("enemigo");
    }
    if (enemigo.x > 0 && !mapa[enemigo.y][enemigo.x - 1].classList.contains('celda') && enemigo.x > personaje.x) {
        borrarRastroMomia(enemigo);
        enemigo.x--;
        mapa[enemigo.y][enemigo.x].classList.add("enemigo");
    }

    cruceDeCaminos(enemigo);
}

function borrarRastroMomia(enemigo) {
    mapa[enemigo.y][enemigo.x].classList.remove("enemigo");
}

function cruceDeCaminos(enemigo) {
    if (enemigo === undefined) {
        enemigos.filter(ele => ele.x === personaje.x && ele.y === personaje.y).forEach(enemigo => {
            matarMomia(enemigo);
        });
    }

    else if (enemigo.x === personaje.x && enemigo.y === personaje.y)
        matarMomia(enemigo);
}

function matarMomia() {
    if (!pergamino) quitarVida();
    else pergamino = false;

    enemigos.filter(element => element.x === personaje.x && element.y === personaje.y).forEach(enemigo => {
        clearInterval(enemigo.temporizador);
        borrarRastroMomia(enemigo);
    });

    enemigos = enemigos.filter(element => !(element.x === personaje.x && element.y === personaje.y))
}

function quitarVida() {
    personaje.salud--;
    console.log(personaje.salud);

    if (personaje.salud < 1) {
        // GAME OVER
    }

}

// Movimientos
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
    // console.log(posX);
    // console.log(posY);

    // Eliminar anterior posicion
    mapa[personaje.y][personaje.x].classList.remove('personaje', 'personajeIzquierda', 'personajeAbajo');
    // Renovar
    mapa[personaje.y][personaje.x].classList.add('huella');
    personaje.x = posX;
    personaje.y = posY;

    marcarCeldas();
    cruceDeCaminos();

    if ((personaje.x === 8 && personaje.y === 0) && urna && llave)
        pasarPantalla();
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
// Fin Movimientos