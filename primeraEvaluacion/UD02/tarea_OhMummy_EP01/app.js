window.addEventListener('load', () => {

    let mapa = [];

    function crearMapa() {
        let juego = document.querySelector('.juego');

        for (let i = 0; i < 13; i++) {
            mapa[i] = [];
            for (let j = 0; j < 21; j++) {
                let div = document.createElement('div');

                if (i % 3 === 0 || i === 0 || j === 0 || j % 4 === 0)
                    div.classList.add('pasillo');
                else
                    div.classList.add('celda');

                mapa[i][j] = div;
                juego.appendChild(div);
            }
        }
    }

    // i === [1, 5, 9, 13, 17, 21] || j === [0, 4, 8, 12, 16, 20]

    crearMapa();

});