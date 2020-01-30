let filtrado;
let filtradoActual;

async function mostrarPartidas() {
    await saveJson();

    let body = document.querySelector('body');

    filtradoActual.forEach(element => {
        let caja = document.createElement('div');
        caja.classList.add('contenedor');

        caja.innerHTML = `
        <h3>${element.ranked}</h3>
        <h4>${element.pgn}</h4>
        `;

        body.appendChild(caja);
    });
}

function saveJson() {
    let nickname = document.getElementById('nickname').value;
    return fetch(`https://api.chess.com/pub/player/${nickname}/games`).then(response => {
        return response.json();
    }).then(busqueda => {
        filtrado = busqueda.games.reduce((buffer, element) => buffer.concat([
            {
                ranked: element.rated,
                pgn: element.pgn
            }
        ]), []);

        filtradoActual = filtrado;
    });
}

function init() {
    document.getElementById('enviar').addEventListener('click', mostrarPartidas);
}

window.onload = init;