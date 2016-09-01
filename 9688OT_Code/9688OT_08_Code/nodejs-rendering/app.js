// Import necessary modules
var express = require('express');
var app = express();

var nhe = require('node-highcharts-exporter');
var fs = require('fs');

app.use(express.bodyParser());
app.use(express.static('static'));

app.post('/generate', function(req, response) {
    nhe.exportChart(req.body, function (error, chart) {
        if (error) {
            console.log(error)
            response.writeHead(500);
            response.end(error);
        } else {
            var img = fs.readFileSync(chart.filePath);
            console.log(req.body.type)
            response.writeHead(200, {'Content-Type': req.body.type });
            response.end(img, 'binary');
        };
    });
});

app.listen(8888);
console.log('Listening on port 8888')
