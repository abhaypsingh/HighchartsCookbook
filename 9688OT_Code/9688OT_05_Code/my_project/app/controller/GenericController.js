Ext.define('MyApp.controller.GenericController', {
    extend: 'Ext.app.Controller',
    
    init: function() {
        console.log('Initialized GenericController!');
        this.control({
            '#refresh': {
                click: function() {
                    var chart = Ext.getCmp('chart');
                    chart.store.reload();
                }
            }
        });
    }
});
