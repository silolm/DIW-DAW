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

async function saveJson() {
    let nickname = document.getElementById('nickname').value;
    const response = await fetch(`https://api.chess.com/pub/player/${nickname}/games`);
    const busqueda = await response.json();
    filtrado = busqueda.games.map(element => ({
        ranked: element.rated,
        pgn: element.pgn
    }));
    filtradoActual = filtrado;
}

function init() {
    document.getElementById('enviar').addEventListener('click', mostrarPartidas);
}

window.onload = init;