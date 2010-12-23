<?php
Yii::import('zii.widgets.CPortlet');
 
class AuthorDocuments extends CPortlet {
	
	public function getUserDocuments(){
		$author = Yii::app()->user->id;
		$documents = new CActiveDataProvider('Document', array('criteria'=>array('condition'=>'author='.$author)));
		return $documents;
	}
	
	public function getUserDocumentsMenu($key = 'id', $value = 'title'){
		$documents = $this->getUserDocuments()->getData();
		$return = array();
		foreach ($documents as $document){
			
			$return[$document->$key] = $document->$value;
		}
		return $return;
	}
	
	public function renderContent(){
		$this->render('AllDocuments');
	}
	
}

?>