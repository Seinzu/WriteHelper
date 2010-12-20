<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'section-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'document'); ?>
		<?php echo $form->dropDownList($model,'document', $documents); ?>
		<?php echo $form->error($model,'document'); ?>
	</div>
	
	<div class='row'>
		<?php echo $form->labelEx($model, 'title');?>
		<?php echo $form->textField($model, 'title');?>
		<?php echo $form->error($model, 'title');?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->