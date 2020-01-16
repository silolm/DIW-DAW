let Piechart = function (options) {

    this.options = options;

    this.canvas = options.canvas;

    this.ctx = this.canvas.getContext("2d");

    this.colors = options.colors;


    this.draw = function () {

        let total_value = 0;

        let color_index = 0;

        for (let categ in this.options.data) {

            let val = this.options.data[categ];

            total_value += val;

        }


        let start_angle = 0;

        for (categ in this.options.data) {

            let = this.options.data[categ];

            let slice_angle = 2 * Math.PI * val / total_value;


            drawPieSlice(
                this.ctx,

                this.canvas.width / 2,

                this.canvas.height / 2,

                Math.min(this.canvas.width / 2, this.canvas.height / 2),

                start_angle,

                start_angle + slice_angle,

                this.colors[color_index % this.colors.length]
            );


            start_angle += slice_angle;

            color_index++;

        }


    }

};


function buildGrafico() {
    let claves = document.querySelectorAll("input[class='left']");
    let valores = document.querySelectorAll("input[class='right']");

    let dioses = [];

    for (let i = 0; i < claves.length; i++) {
        let dios = {
            nombre: claves[i].value,
            poder: valores[i].value
        };
        dioses.push(dios);
    }
    console.log(dioses);

    const canvas = document.querySelector('canvas');
    canvas.width = 500;
    canvas.height = 500;

    if (canvas && canvas.getContext) {
        // método getContext para recuperar el contexto del canvas
        let ctx = canvas.getContext("2d");
        // y si tenemos contexto
        if (ctx) {
            // dibujamos
            drawLine(ctx, 100, 100, 200, 200);

            drawArc(ctx, 150, 150, 150, 0, Math.PI / 3);

            drawPieSlice(ctx, 150, 150, 150, Math.PI / 2, Math.PI / 2 + Math.PI / 4, '#ff0000');
        }
    }
}

function drawLine(ctx, startX, startY, endX, endY) {
    ctx.beginPath();

    ctx.moveTo(startX, startY);

    ctx.lineTo(endX, endY);

    ctx.stroke();
}

function drawArc(ctx, centerX, centerY, radius, startAngle, endAngle) {
    ctx.beginPath();

    ctx.arc(centerX, centerY, radius, startAngle, endAngle);

    ctx.stroke();
}

function drawPieSlice(ctx, centerX, centerY, radius, startAngle, endAngle, color) {
    ctx.fillStyle = color;

    ctx.beginPath();

    ctx.moveTo(centerX, centerY);

    ctx.arc(centerX, centerY, radius, startAngle, endAngle);

    ctx.closePath();

    ctx.fill();
}

function loadListeners() {
    document.querySelector("input[name='grafiqueame']").addEventListener("click", buildGrafico);
}

function init() {
    loadListeners();
}

window.onload = init;