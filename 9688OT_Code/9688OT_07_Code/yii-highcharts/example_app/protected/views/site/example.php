<?php
$this->pageTitle=Yii::app()->name . ' - Example';
$this->breadcrumbs=array(
    'Example',
);
?>
<h1>Example page</h1>

<div id='container'>
</div>

<center>
    Give a treat to:
    <div class='buttons'>
    </div>
<center>

<script type='text/javascript'>
var getStats = function(categories) {
    return _.chain(categories)
       .omit(['id', 'weight', 'height', 'name'])
       .keys()
       .map(function(elem) {
           return elem.split('_').join(' ');
       }).value();
};

var getSeries = function(series) {
    return _.chain(series)
       .map(function(elem){
           var result = {};
           result.name = elem.name;
           result.data = _.chain(elem)
               .omit(['id', 'weight', 'height', 'name'])
               .values()
               .map(function(val) {
                   return parseInt(val, 10);
               })
               .value();
             return result;
       }).value();
};

var drawChart = function (response) {
    var options = {
        chart: {
            polar: true,
            type: 'line'
        },
        title: {text: 'Monster'},
        xAxis: {
            tickmarkPlacement: 'on',
            categories: getStats(response.data.monster[0]),
            labels: {
                overflow: 'justify',
                style: {
                    fontSize: '10px'
                }
            }
        },
        yAxis: {gridLineInterpolation: 'polygon', min: 0},
        tooltip: {
            shared: true,
            pointFormat: '<span style="color:series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
        },
        series: getSeries(response.data.monster)
    };
    $('#container').highcharts(options);
};

var levelUpMonster = function (monster) {
    var id = monster.id
    $.ajax({
        url: '/example_app/api/monster/' + id,
        type: 'PUT',
        headers: {
            "X_REST_USERNAME": "admin@restuser",
            "X_REST_PASSWORD": "admin@Access"
        },
        data: JSON.stringify(monster),
        success: function() {
            reload();
        }
    });
};

var feedMonster = function(data) {
    // Randomly select a stat
    key = _.chain(data).omit(['id', 'weight', 'height', 'name']).keys().shuffle().first().value();
        
    // Randomly increase the stat
    data[key] = parseInt(data[key], 10) + _.random(1,10);
        
    levelUpMonster(data);
};

var createButtons = function (monsters) {
    $('.buttons').empty();
    _.chain(monsters)
        .each(function(data) {
            var $button = $('<input>', {
                type: 'button',
                value: data.name,
                id: data.name
            });
            $button.click(function() {
                feedMonster(data);
            });
            $('.buttons').append($button);
        });
};

var reload = function() {
    jQuery.ajax({
        url: '/example_app/api/monster',
        type: 'GET',
        headers: {
            "X_REST_USERNAME": "admin@restuser",
            "X_REST_PASSWORD": "admin@Access"
        },
        success: function(response) {
            drawChart(response);
            createButtons(response.data.monster);
        }
    });
};
reload();
</script>
