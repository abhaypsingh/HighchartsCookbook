<?php
/* @var $this MonsterController */
/* @var $model Monster */

$this->breadcrumbs=array(
	'Monsters'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Monster', 'url'=>array('index')),
	array('label'=>'Create Monster', 'url'=>array('create')),
	array('label'=>'View Monster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Monster', 'url'=>array('admin')),
);
?>

<h1>Update Monster <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>