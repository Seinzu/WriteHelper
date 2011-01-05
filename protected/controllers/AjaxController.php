<?php

class AjaxController extends CController
{
	
	public function actionCreateSection(){
		$model=new Section;
		if(isset($_POST['Section'])){
			$model->attributes=$_POST['Section'];
			if($model->save()){
				echo json_encode(array(true, 'Session created'));
			}
			else {
				echo json_encode(array(false, 'Error encountered while saving'));
			}
		}
	}
	
	public function actionReorderSectionItem(){
		if (isset($_POST['section']))
			$section = $_POST['section'];
		else
			die(json_encode(array(false, 'Needs to provide session information')));
		if (isset($_POST['sortArray']))
			$sortArray = $_POST['sortArray'];
		else 
			die(json_encode(array(false, 'Needs to provide sort information')));
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
		$section = isset($_POST['section']) ? $_POST['section'] : null;	
		if (isset($_POST['Text'])){
			$model->attributes = $_POST['Text'];
			if ($model->save()){
				echo json_encode(array($section, true));
			}
			else {
				echo json_encode(array($section, false));
			}
		}
	}
	
	public function actionRenderTextForm($sectionid, $textid=null){
		if ($textid !== null)
			$textmodel = Text::model()->find("id=:id", array('id'=>$textid));
		else
			$textmodel = new Text;
	 	$this->renderPartial('//text/_form', array('model'=>$textmodel, 'forcedSection'=>$sectionid, 'sections'=>false, 'return'=>'updateText','ajax'=>true));  			
	}
	
	public function actionRenderSectionPreview($sectionid){
		$section = Section::model()->find('id=:id', array('id'=>$sectionid));
		$this->renderPartial('//section/_preview', array('data'=>$section));
	}
	
	public function actionRenderSectionView($sectionid){
		$section = Section::model()->find('id=:id', array('id'=>$sectionid));
		$this->renderPartial('//section/view', array('model'=>$section));
	}
	
	public function actionRenderSectionForm($documentid){
		$this->renderPartial('//section/_form', array('model'=>new Section, 'documents'=>false, 'ajax'=>true, 'forcedDocument'=>$documentid));
	}
	
	public function actionRenderDocumentPreview($documentid){
		$document = Document::model()->findByPk($documentid);
		$sections = new CActiveDataProvider('Section', array('criteria'=>array('condition'=>'document=' .$documentid)));
		$this->renderPartial('//document/_display', array('model'=>$document, 'sections'=>$sections));
	}
	
	
}