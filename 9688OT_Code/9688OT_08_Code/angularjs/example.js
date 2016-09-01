var app = angular.module('example', ['highcharts-ng']);

app.controller('ctrl', function($scope){
    $scope.config = {
        options: {
            chart: {
                type: 'column'
            },
        },
        xAxis: {
            categories: ['Yes', 'No']
        },
        series: [{
            name: 'Votes',
            data: [0, 0]
        }],
        title: {
            text: 'Data-binding Example'
        },
        subtitle: {
            text: 'Is this easy?'
        },
        credits: {
            enabled: false
        },
        loading: false
    };
});
