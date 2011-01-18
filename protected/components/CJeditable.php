<?php
Yii::import('zii.widgets.CWidget');

class CJEditable extends CWidget {
	
	public $url = '';
	
	public $id = '';
	
	public $text = '';
	
	public $options = array();
	
	public function init(){
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/assets/js/jquery.jeditable.js');
	}
	
	public function run(){
		$id = !empty($this->id)? $this->id : $this->getId(true);
		
		$text = isset($this->options['text']) ? $this->options['text'] : '';
		
		echo "<div id={$id}>{$this->text}</div>";
		
		$options=empty($this->options) ? '' : CJavaScript::encode($this->options);
		
		Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$id,"jQuery('#{$id}').editable('{$this->url}', {$options});");
	}
	
}