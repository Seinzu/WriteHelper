<div class="form"><?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'text-form',
	'enableAjaxValidation'=>true,
));
if (!isset($sections)){
	// cover for situations where sections wasn't set
	$sections = false;
}
if (isset($model->id)){
	?> <input type='hidden' id='textid' name='textid'
	value='<?php echo $model->id;?>' /> <?php 
}
?>

<p class="note">Fields with <span class="required">*</span> are
required.</p>

<?php echo $form->errorSummary($model);

if ($sections !==false){?>
<div class="row"><?php echo $form->labelEx($model,'section'); ?> <?php echo $form->dropDownList($model,'section', $sections); ?>
<?php echo $form->error($model,'section'); ?></div>


<?php
}
else if (!empty($forcedSection)){
	?> <input type='hidden' id='Text_section' name='Text[section]'
	value='<?php echo $forcedSection;?>' /> <?php 
}
$this->widget(
    			'application.extensions.ddeditor.DDEditor',
array(
    	    'model'=>$model,
    	    'attribute'=>'text',
    	    'htmlOptions'=>array('rows'=>20, 'cols'=>90),
    	    'previewRequest'=>'text/preview')); ?>
<div class="row buttons">
<?php 
if (isset($ajax) && $ajax === true) {
	$ajaxoptions = array();
	$htmloptions = array();
	$htmloptions['id'] = 'submittext' . $model->id;
	if (isset($return)){
		$ajaxoptions['success'] = $return;
	}
	echo CHtml::ajaxSubmitButton($model->isNewRecord? 'Create' : 'Save', CHtml::normalizeUrl(array('ajax/saveText')), $ajaxoptions, $htmloptions);
	// we will have to write our own javascript here to handle button presses in the ajax forms
			?>
			<script type="text/javascript">
			jQuery('body').delegate('#submittext<?php echo $model->id; ?>','click',function(){jQuery.ajax({'type':'POST','url':'<?php echo CHtml::normalizeUrl(array('ajax/saveText'));?>','cache':false,'data':jQuery(this).parents("form").serialize()});return false;});
			</script>
			<?php 
}
else {
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
}?>
</div>

<?php $this->endWidget(); ?></div>
<!-- form -->
