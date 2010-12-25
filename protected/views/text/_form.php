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

	<?php echo $form->errorSummary($model); 

	if ($sections !==false){?>
	<div class="row">
		<?php echo $form->labelEx($model,'section'); ?>
		<?php echo $form->dropDownList($model,'section', $sections); ?>
		<?php echo $form->error($model,'section'); ?>
	</div>
	

	<?php 
	}
	else if (!empty($forcedSection)){
		?>
		<input type='hidden' id='Text_section' name='Text[section]' value='<?php echo $forcedSection;?>' />
		<?php 
	}
		$this->widget(
    			'application.extensions.ddeditor.DDEditor',
    	array(
    	    'model'=>$model,
    	    'attribute'=>'text',
    	    'htmlOptions'=>array('rows'=>40, 'cols'=>110),
    	    'previewRequest'=>'text/preview')); ?>
	<div class="row buttons">
	
	<?php if (isset($ajax) && $ajax !==true) {?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	<?php } 
		  else {
		  	$options = array();
			if (isset($return)){
				$options['success'] = $return;
			}
			echo CHtml::ajaxSubmitButton($model->isNewRecord? 'Create' : 'Save', CHtml::normalizeUrl(array('ajax/createSection')), $options);
		  	 
		  }?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->