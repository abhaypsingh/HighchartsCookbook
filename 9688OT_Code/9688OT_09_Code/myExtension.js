/* jshint strict: true, browser: true */
(function(w, H, $) {
    var me,
        NAME,
        MAJOR,
        MINOR,
        PUBLISHED,
        formatDate;

    w.MyExtension = w.MyExtension || {};
    me = w.MyExtension;
    
    // --- Private variables ---
    NAME = 'MyExtension';
    MAJOR = 1;
    MINOR = 0;
    PUBLISHED = new Date(2013, 11, 26);
    
    // --- Private function ---
    formatDate = function(d) {
        return "" + d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
    };
    
    // --- Global functions ---
    me.Chart = me.Chart || Highcharts.Chart;
    
    me.SpiderWebChart = function (options) {
        // create options if they don't exist
        var modifiedOptions = options || {};
        
        // create a chart option if it does not exist
        modifiedOptions.chart = modifiedOptions.chart || {};
        modifiedOptions.chart.polar = true;
        
        // create an xAxis option if it does not exist
        modifiedOptions.xAxis = modifiedOptions.xAxis || {};
        modifiedOptions.xAxis.tickmarkPlacement = 'on';
        modifiedOptions.xAxis.lineWidth = 0;

        // create a yAxis option if it does not exist
        modifiedOptions.yAxis = modifiedOptions.xAxis || {};
        modifiedOptions.yAxis.gridLineInterpolation = 'polygon';
        modifiedOptions.yAxis.lineWidth = 0;
        
        new me.Chart(modifiedOptions);
    };
    
    // Privileged functions
    me.getVersionInfo = function() {
        return "" +
            NAME + " - " + MAJOR + "." + MINOR +
            " (" + formatDate(PUBLISHED) + ")";
    };
    
    // Define single function for our jQuery adapter
    $.fn.spiderwebchart = function() {
        var args = arguments,
			options,
			chart;

		options = args[0];

		// Create the chart
		options.chart = options.chart || {};
		options.chart.renderTo = this[0]; // use just the first element
		chart = new me.SpiderWebChart(options);
		
		return this;
    };
}(window, Highcharts, jQuery));
