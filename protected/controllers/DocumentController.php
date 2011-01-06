<?php

class DocumentController extends Controller
{
	public function actionEdit()
	{
		$this->render('edit');
	}

	public function actionIndex($author = null)
	{
		if ($author === null){
			$author = Yii::app()->user->getId();
		}
		$documents = new CActiveDataProvider('Document', array('criteria'=>array('condition'=>'author='.$author)));
		$this->render('index', array('documents'=>$documents));
	}

	public function actionCreate()
	{
		$model = new Document;
		if(isset($_POST['Document']))
		{
			$model->attributes=$_POST['Document'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create', array('model'=>$model));
	}

	public function actionView($id)
	{
		$document = $this->loadModel($id);
		// it's hacky permissions time @todo proper permissions functionality
		if ($document->author == Yii::app()->user->getId()){
			$sections = new CActiveDataProvider('DocumentSections', array('criteria'=>array('with'=>array('documentSection'), 'condition'=>'document=' . $id, 'order'=>"`order` ASC")));
			$this->render('view', array('model'=>$document, 'sections'=>$sections));
		}
		else {
			$this->render('//site/error', array('message'=>'Permission denied', 'code'=>403));
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Document::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}