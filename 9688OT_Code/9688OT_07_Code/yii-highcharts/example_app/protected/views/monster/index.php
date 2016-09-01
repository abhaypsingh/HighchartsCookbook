<?php
/* @var $this MonsterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Monsters',
);

$this->menu=array(
	array('label'=>'Create Monster', 'url'=>array('create')),
	array('label'=>'Manage Monster', 'url'=>array('admin')),
);
?>

<h1>Monsters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
