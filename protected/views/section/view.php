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
		  	$tabs[$model->title . ' Overview'] = array('title'=>'Overview', 'ajax'=>CHtml::normalizeUrl(array('ajax/renderSectionDisplay', "sectionid"=>$model->id)), 'data'=>array());
	 	  	$i = 1;
		  	if (!empty($textData)){
		  		foreach ($textData as $text){
		  			$tabs["Text " . $i] = array('title'=>'Edit text ' . $i, 'ajax'=>CHtml::normalizeUrl(array('ajax/renderTextForm', 'sectionid'=>$model->id, 'textid'=>$text->id)), 'data'=>array());
	 	  			$i++;
		  		}
	 	  	}
	 	  	$tabs['Add Text'] = array('title'=>'Add a new text', 'ajax'=>CHtml::normalizeUrl(array('ajax/renderTextForm', 'sectionid'=>$model->id)), 'data'=>array());
	?>
	
		  	
			<?php 
			$this->widget('zii.widgets.jui.CJuiTabs', array('id'=>'section' . $model->id . 'tab','tabs'=>$tabs));
			?>

			