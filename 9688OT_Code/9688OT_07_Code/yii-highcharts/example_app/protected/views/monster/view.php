<?php
/* @var $this MonsterController */
/* @var $model Monster */

$this->breadcrumbs=array(
	'Monsters'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Monster', 'url'=>array('index')),
	array('label'=>'Create Monster', 'url'=>array('create')),
	array('label'=>'Update Monster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Monster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Monster', 'url'=>array('admin')),
);
?>

<h1>View Monster #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'height',
		'weight',
		'hp',
		'attack',
		'defense',
		'special_attack',
		'special_defense',
		'speed',
	),
)); ?>
