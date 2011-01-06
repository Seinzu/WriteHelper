<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'text-form',
	'enableAjaxValidation'=>true,
));

if (isset($model->id)){
	?> <input type='hidden' id='textid' name='textid'
	value='<?php echo $model->id;?>' /> <?php 
}

$nonce = new Nonce;
$nonce->attributes = array('nonce'=>uniqid(), 'active'=>1); 
$nonce->save();
?>
<input type='hidden' id='Text_nonce' name='nonce'
	value='<?php echo $nonce->nonce;?>' />
<p class="note">Fields with <span class="required">*</span> are
required.</p>

<?php 
echo $form->errorSummary($model);

if (!empty($forcedSection)){
	?> <input type='hidden' id='Text_section' name='section'
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
			jQuery('body').delegate('#submittext<?php echo $model->id; ?>','click',function(){jQuery.ajax({'type':'POST','url':'<?php echo CHtml::normalizeUrl(array('ajax/saveText'));?>','success':function(data, status, request){textUpdate(data);},'cache':false,'dataType':'json','data':jQuery(this).parents("form").serialize()});return false;});
			</script>
			<?php 
}
else {
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
}?>
</div>

<?php $this->endWidget(); ?></div>
<!-- form -->
