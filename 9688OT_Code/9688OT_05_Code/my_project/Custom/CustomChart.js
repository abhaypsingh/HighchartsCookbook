Ext.require('Chart.ux.Highcharts.SplineSerie');
Ext.define('Custom.CustomChart', {
    extend: 'Chart.ux.Highcharts',

    constructor:function(config) {
        this.callParent(arguments);
        this.initConfig(config);
        
        this.chartConfig = this.chartConfig || {};
        this.chartConfig.chart = this.chartConfig.chart || {};
        this.chartConfig.chart.type = 'spline';
    }
});
