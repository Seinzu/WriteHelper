<?php
$nonce = new Nonce;
$nonce->attributes = array('nonce'=>uniqid(), 'active'=>1); 
$nonce->save();
$this->widget('CJEditable', array('id'=>$data->id,'url'=>Yii::app()->baseUrl . '/index.php/ajax/saveText', 'text'=>$data->text, 'options'=>array('submitdata'=>array('nonce'=>$nonce->nonce, 'section'=>$section))));
//echo $data->text;
?>
