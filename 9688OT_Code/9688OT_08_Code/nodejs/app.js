// Import necessary modules
var express = require('express');

var r = function(minimum, maximum) {
    var randomNum, rangedNum;
    
    if (minimum === undefined && maximum === undefined) {
        // Do default Math.random();
        maximum = 1;
        minimum = 0;
    } else if (maximum === undefined) {
        // Use provided value as maximum
        maximum = minimum;
        minimum = 0;
    }
    
    randomNum = Math.random();
    rangedNum = (randomNum * (maximum - minimum)) + minimum;
    
    return rangedNum;
};

var app = express();
app.use(express.json());

app.use(express.static('static'));

app.get('/ajax/point', function(request, response) {
    var result = {
        "y": r(0, 100)
    };
    
    response.json(result);
});

app.get('/ajax/series', function(request, response) {
    var count = 10,
        results = [];
    
    for(var i = 0; i < count; i++) {
        results.push({
            "y": r(0, 100)
        });
    }
    
    response.json(results);
});

app.listen(8888);
console.log('Listening on port 8888')
