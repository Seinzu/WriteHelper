<?php
Yii::import('zii.widgets.CPortlet');
 
class AuthorDocuments extends CPortlet {
	
	public function getUserDocuments(){
		$author = Yii::app()->user->id;
		$documents = new CActiveDataProvider('document', array('criteria'=>array('condition'=>'author='.$author)));
		return $documents;
	}
	
	public function renderContent(){
		$this->render('AllDocuments');
	}
	
}

?>