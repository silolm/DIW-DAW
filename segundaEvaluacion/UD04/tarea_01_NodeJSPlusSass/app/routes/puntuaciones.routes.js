module.exports = (app) => {
    const puntuaciones = require('../controllers/puntuacion.controller.js');

    // Create a new puntuaciones
    app.post('/puntuaciones', puntuaciones.create);

    // Retrieve all puntuaciones
    app.get('/puntuaciones', puntuaciones.findAll);

    // Retrieve a single puntuaciones with puntuacionId
    app.get('/puntuaciones/:idFalla/:ip', puntuaciones.findOne);

    // Update a puntuaciones with puntuacionId
    app.put('/puntuaciones/:puntuacionId', puntuaciones.update);
};