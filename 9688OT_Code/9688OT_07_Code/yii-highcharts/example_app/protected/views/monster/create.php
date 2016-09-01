<?php
/* @var $this MonsterController */
/* @var $model Monster */

$this->breadcrumbs=array(
	'Monsters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Monster', 'url'=>array('index')),
	array('label'=>'Manage Monster', 'url'=>array('admin')),
);
?>

<h1>Create Monster</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>