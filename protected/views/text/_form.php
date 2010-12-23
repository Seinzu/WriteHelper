<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'text-form',
	'enableAjaxValidation'=>false,
)); 
if (!isset($sections)){
	// cover for situations where sections wasn't set
	$sections = array();
}
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'section'); ?>
		<?php echo $form->dropDownList($model,'section', $sections); ?>
		<?php echo $form->error($model,'section'); ?>
	</div>
	

	<?php $this->widget(
    'application.extensions.ddeditor.DDEditor',
    array(
        'model'=>$model,
        'attribute'=>'text',
        'htmlOptions'=>array('rows'=>40, 'cols'=>110),
        'previewRequest'=>'text/preview')); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->