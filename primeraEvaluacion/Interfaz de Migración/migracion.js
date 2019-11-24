function sleep(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}

async function startMigration() {
    let progreso = document.querySelectorAll('progress');
    let label = document.querySelectorAll('steplabel');
    let msg = document.querySelectorAll('finalmsg');

    for (let i = 0; i < progreso.length; i++) {
        label[i].classList.add('estabaEscondido');
        await sleep(1100);
        progreso[i].classList.add('estabaEscondido');

        for (let j = 0; j < 100; j++) {
            progreso[i].value += 1;
            await sleep(50);
        }

        msg[i].classList.add('estabaEscondido');
        await sleep(1500);
    }
}

function init() {
    console.info(" * Init envirnoment ");

    // Set click function on button
    document.querySelector("button").addEventListener("click", startMigration);
}

// Init the environment when all is ready
window.onload = init;
