const Puntuacion = require('../models/puntuacion.model.js');

// Obtener todos los puntuaciones
exports.findAll = (req, res) => {

    Puntuacion.find().then(puntuaciones => {
        res.send(puntuaciones);
    }).catch(err => {
        res.status(500).send({
            message: err.message || " Algo fue mal mientras los capturabamos a todos"
        });
    });

};

// Crear y salvar
exports.create = (req, res) => {

    // Validamos el puntuacion
    if (!req.body) {
        console.log(req.body);
        return res.status(400).send({
            message: "puntuacion Vacio..."
        });
    }

    const puntuacion = new Puntuacion({
        idFalla: req.body.idFalla || "NULL",
        ip: req.body.ip || "0.0.0.0",
        puntuacion: req.body.puntuacion || 9999
    });
    console.log(puntuacion);
    puntuacion.save().then(data => {
        res.send(data);
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Something was wrong creating puntuacion"
        });
    });
};