<?php
/* @var $this MonsterController */
/* @var $model Monster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'monster-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hp'); ?>
		<?php echo $form->textField($model,'hp'); ?>
		<?php echo $form->error($model,'hp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attack'); ?>
		<?php echo $form->textField($model,'attack'); ?>
		<?php echo $form->error($model,'attack'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'defense'); ?>
		<?php echo $form->textField($model,'defense'); ?>
		<?php echo $form->error($model,'defense'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'special_attack'); ?>
		<?php echo $form->textField($model,'special_attack'); ?>
		<?php echo $form->error($model,'special_attack'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'special_defense'); ?>
		<?php echo $form->textField($model,'special_defense'); ?>
		<?php echo $form->error($model,'special_defense'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'speed'); ?>
		<?php echo $form->textField($model,'speed'); ?>
		<?php echo $form->error($model,'speed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->