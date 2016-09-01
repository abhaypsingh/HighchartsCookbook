<?php
/* @var $this MonsterController */
/* @var $model Monster */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hp'); ?>
		<?php echo $form->textField($model,'hp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'attack'); ?>
		<?php echo $form->textField($model,'attack'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'defense'); ?>
		<?php echo $form->textField($model,'defense'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special_attack'); ?>
		<?php echo $form->textField($model,'special_attack'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special_defense'); ?>
		<?php echo $form->textField($model,'special_defense'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'speed'); ?>
		<?php echo $form->textField($model,'speed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->