<?php
/* @var $this MonsterController */
/* @var $data Monster */
?>

<div class="view">
    <div
         style='float: right; height:150px; width:250px; '
         id='monster<?php echo CHtml::encode($data->id); ?>'>
         Testing
     </div>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('height')); ?>:</b>
	<?php echo CHtml::encode($data->height); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight')); ?>:</b>
	<?php echo CHtml::encode($data->weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hp')); ?>:</b>
	<?php echo CHtml::encode($data->hp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attack')); ?>:</b>
	<?php echo CHtml::encode($data->attack); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('defense')); ?>:</b>
	<?php echo CHtml::encode($data->defense); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('special_attack')); ?>:</b>
	<?php echo CHtml::encode($data->special_attack); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('special_defense')); ?>:</b>
	<?php echo CHtml::encode($data->special_defense); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('speed')); ?>:</b>
	<?php echo CHtml::encode($data->speed); ?>
	<br />
	
	<script type='text/javascript'>
        (function() {
            var srcData = <?php echo CJSON::encode($data->attributes) ?>;
            var srcCategories = <?php echo CJSON::encode($data->attributeLabels()) ?>;
 
            var categories = _.chain(srcCategories)
                .omit(['id', 'weight', 'height', 'name'])
                .values()
                .value();

            var data = _.chain(srcData)
                .omit(['id', 'weight', 'height', 'name'])
                .values()
                .map(function(val) {
                    return parseInt(val, 10);
                })
                .value();
 
            var id = '#monster<?php echo CHtml::encode($data->id); ?>';
            var options = {
                chart: {polar: true, type: 'line'},
                title: {text: null},
                xAxis: {
                    tickmarkPlacement: 'on',
                    categories: categories,
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
                    pointFormat: '<span style="color:series.color}">{series.name}: <b>${point.y:,.0f}    </b><br/>'
                },
                legend: {
                    enabled: false
                },
                series: [{
                    data: data,
                    pointPlacement: 'on'
                }]
            };
 
            jQuery(id).highcharts(options);
        }());
   </script>

</div>
