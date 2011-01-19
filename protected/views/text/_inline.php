<?php 
$nonce = new Nonce;
$nonce->attributes = array('nonce'=>uniqid(), 'active'=>1); 
$nonce->save();
$columns = 80;
$rows = (strlen($data->text) / 80) +2;
$options = array('rows'=>$rows, 'columns'=>$columns, 'loadurl'=> CHtml::normalizeUrl(array('ajax/viewMarkdownText', 'textid'=>$data->id)), 'submitdata'=>array('nonce'=>$nonce->nonce, 'section'=>$section, 'returnText'=>1), "submit"=>"ok", "indicator"=>'Saving...', "tooltip"=>'Click to edit...', 'type'=>'textarea'); 
$markdown = new CMarkdown;
?>
<script type='text/javascript' src='<?php echo Yii::app()->baseUrl;?>/assets/js/jquery.jeditable.js'></script>
<script type='text/javascript'>

jQuery('#<?php echo $data->id;?>').editable('<?php echo CHtml::normalizeUrl(array('ajax/saveText'));?>', <?php echo CJavaScript::encode($options);?> );

</script>
<div id='<?php echo $data->id;?>'><?php echo $markdown->transform($data->text);?></div>
