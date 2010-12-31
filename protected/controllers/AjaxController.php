<?php

class AjaxController extends CController
{
	
	public function actionCreateSection(){
		$model=new Section;
		if(isset($_POST['Section'])){
			$model->attributes=$_POST['Section'];
			if($model->save()){
				echo json_encode(true);
			}
			else {
				echo json_encode(false);
			}
		}
	}
	
	public function actionReorderSectionItem(){
		if (isset($_POST['section']))
			$section = $_POST['section'];
		else
			die('false no section');
		if (isset($_POST['sortArray']))
			$sortArray = $_POST['sortArray'];
		else 
			die('false no order');
		// delete existing sort records - this might be refactored later to not require deletion
		$deletion = SectionTexts::model()->deleteAll('section=:section', array('section'=>$section));
		$success = true;
		foreach ($sortArray as $order => $textid){
			$st = new SectionTexts();
			$attributes = array('id'=>null, 'section'=>$section, 'text'=>$textid, 'order'=>$order);
			$st->attributes = $attributes;
			$success = $success & $st->save();	
		}
		echo ($success) ? "true" : "false";
	}
	
	public function actionSaveText(){
		if (isset($_POST['textid']))
			$model = Text::model()->findByPk((int)$_POST['textid']);
		else 
			$model = new Text;
			
		if (isset($_POST['Text'])){
			$model->attributes = $_POST['Text'];
			if ($model->save()){
				echo json_encode(array($_POST['Text']['section'], true));
			}
			else {
				echo json_encode(array($_POST['Text']['section'], false));
			}
		}
	}
	
	
}