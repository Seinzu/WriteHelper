<?php
Yii::import('zii.widgets.CPortlet');
 
class AuthorDocuments extends CPortlet {
	
	public function getUserDocuments(){
		$author = Yii::app()->user->id;
		$documents = Document::model()->
		return $documents;
	}
	
	public function renderContent(){
		$this->render('AllDocuments');
	}
	
}

?>