<?php 
$this->widget('CJEditable', array('url'=>'this', 'text'=>$data->text));
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/protected/component/jquery.editable.js');
//echo $data->text;
?>
<script type='text/javascript' src='<?php echo Yii::app()->baseUrl;?>/assets/js/jquery.jeditable.js'></script>
<script type='text/javascript'>
	$('#yw0').editable('<?php echo Yii::app()->baseUrl;?>');
</script>