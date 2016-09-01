$(function() {
    var Monster = Backbone.Model.extend({
        defaults: {
            name: 'Unknown',
            height: 0.0,
            weight: 0.0,
            hp: 0,
            attack: 0,
            defense: 0,
            special_attack: 0,
            special_defense: 0,
            speed: 0
        }
    });
    
    var MonsterCollection = Backbone.Collection.extend({
        model: Monster,
        localStorage: new Backbone.LocalStorage("example")
    });
    
    var Monsters = new MonsterCollection();
    
    var MonsterView = Backbone.View.extend({
        tagName: 'li',
        
        chartOptions: {
            chart: {
                polar: true,
                type: 'line'
            },
            legend: {
                enabled: false
            },
            xAxis: {
                tickmarkPlacement: 'on',
                labels: {
                    overflow: 'justify',
                    style: {
                        fontSize: '10px'
                    }
                }
            },
            yAxis: {gridLineInterpolation: 'polygon', min: 0},
            tooltip: {
                pointFormat: '<span style="color:series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
            }
        },
        
        events: {
            'keyup .row input': 'statChange'
        },
        
        template: _.template($('#monster-template').html()),

        initialize: function () {
            this.listenTo(this.model, 'change', this.render);
        },
        
        statChange: function(event) {
            var $target = this.$(event.target)
            var value = parseInt($target.val(), 10);
            var key = $target.attr('name');
            if (!_.isNumber(value) || _.isNaN(value) || value < 0) {
                return;
            }
            this.model.set(key, value);
        },

        render: function() {
            this.$el.html(this.template({
                'stats': this.model.toJSON()
            }));
            
            this.renderChart();
            
            return this;
        },
        
        renderChart: function () {
            var key_stats = this.model.pick([
                'hp',
                'attack',
                'defense',
                'special_attack',
                'special_defense',
                'speed'
            ]);
            
            var series = _.chain(key_stats).map(function(value, key) {
                return parseInt(value, 10);
            });
        
            var options = _.extend(this.chartOptions, {
                title: {
                    text: this.model.get('name')
                },
                xAxis: {
                    categories: _.chain(key_stats).keys().value()
                },
                series: [{
                    data: series.value()
                }]
            });
        
            this.$('.graph').highcharts(options);
        }
    });
    
    var AppView = Backbone.View.extend({
        el: $('#main'),
        
        events: {
            'click #new-monster': 'createMonster',
            'keypress #monster-name': 'createMonster'
        },
        
        initialize: function() {
            this.listenTo(Monsters, 'add', this.addMonster);
        },
        
        createMonster: function(event) {
            var $name = $('#monster-name');
        
            if (event.type === 'keypress' && event.keyCode !== 13) {
                return;
            }
            if (!$name.val()) {
                return;
            }
            
            Monsters.create({name: $name.val()});
            
            $name.val('');
        },
        
        addMonster: function(monster) {
            var view = new MonsterView({model: monster});
            this.$("#monsters").append(view.render().el);
        },
    });
    
    var App = new AppView();
});
