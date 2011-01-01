<?php
$this->breadcrumbs=array(
	'Sections'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Section', 'url'=>array('index')),
	array('label'=>'Create Section', 'url'=>array('create')),
	array('label'=>'Update Section', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Section', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Section', 'url'=>array('admin')),
);
?>

<h1>View Section <?php echo $model->title; ?></h1>
<?php
$sections  = Text::getAvailableSections();
	 	  	$texts = new CActiveDataProvider('Text', array('criteria'=>array('condition'=>'section=' . $model->id)));
	 	  	if (method_exists($texts, "getData")){
		  		$textData = $texts->getData();
	 	  	}
	 	  	else {
	 	  		$textData = false;
	 	  	}
		  	$tabs = array();
		  	$viewData = array();
		  	$tabs['overview'] = array('title'=>'Overview', 'view'=>'//section/_display', 'data'=>array('data'=>$model, "texts"=>$texts, 'textData'=>$textData));
	 	  	$i = 1;
		  	if (!empty($textData)){
		  		foreach ($textData as $text){
	 	  			$tabs["section" .$model->id . "text" . $i] = array('title'=>'Edit text ' . $i, 'view'=>'//text/_form', 'data'=>array('id'=>$text->id, 'sections'=>$sections,'model'=>Text::model()->find('id=:id', array('id'=>$text->id))));
	 	  			$i++;
		  		}
	 	  	}
	 	  	$tabs['section'.$model->id.'addtext'] = array('title'=>'Add a new text', 'view'=>'//text/_form', 'data'=>array('model'=>new Text, 'sections'=>$sections, 'ajax'=>true));
	?>
	
		  	
			<?php $this->widget('CTabView', array('tabs'=>$tabs, 'viewData'=>$viewData));?>