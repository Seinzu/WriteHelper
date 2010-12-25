<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'section-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model);
		if ($documents !== false){
	?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'document'); ?>
		<?php echo $form->dropDownList($model,'document', $documents); ?>
		<?php echo $form->error($model,'document'); ?>
	</div>
	
	<?php } 
			else if (!empty($forcedDocument)){?>
		<input type='hidden' name='Section[document]' id='Section_document' value='<?php echo $forcedDocument;?>' /> 
	<?php } ?>
	
	<div class='row'>
		<?php echo $form->labelEx($model, 'title');?>
		<?php echo $form->textField($model, 'title');?>
		<?php echo $form->error($model, 'title');?>
	</div>
	
	<?php if ($ajax !== true) {?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	<?php } 
		  else {
		  	
	?>
	<div class="row buttons">
		<?php 	$options = array();
				if (isset($return)){
					$options['success'] = $return;
				}
				echo CHtml::ajaxSubmitButton($model->isNewRecord? 'Create' : 'Save', CHtml::normalizeUrl(array('ajax/createSection')), $options);?>
	</div>
	
	<?php } ?>

<?php $this->endWidget(); ?>

</div><!-- form -->