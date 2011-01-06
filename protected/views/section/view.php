<?php

?>

<h1>View Section <?php echo $model->title; ?></h1>
<?php
			$sections  = Text::getAvailableSections();
	 	  	$childs = new CActiveDataProvider('SectionTexts', array('criteria'=>array( 'condition'=>"parent='{$model->id}'", 'with'=>array('childText', 'childSection'), 'order'=>"`order` ASC" )));
	 	  	if (method_exists($childs, "getData")){
		  		$childsData = $childs->getData();
	 	  	}
	 	  	else {
	 	  		$childsData = false;
	 	  	}
		  	$tabs = array();
		  	$viewData = array();
		  	$tabs[$model->title . ' Overview'] = array('title'=>'Overview', 'ajax'=>CHtml::normalizeUrl(array('ajax/renderSectionPreview', "sectionid"=>$model->id)), 'data'=>array());
	 	  	$i = 1;
		  	if (!empty($childsData)){
		  		foreach ($childsData as $child){
		  			if (isset($child->childText) && $child->childText->id !==null){
		  				$tabs["Text " . $i] = array('title'=>'Edit text ' . $i, 'ajax'=>CHtml::normalizeUrl(array('ajax/renderTextForm', 'sectionid'=>$model->id, 'textid'=>$child->childText->id)), 'data'=>array());
		  			}
		  			else if (isset($child->childSection) && $child->childSection->id !==null){
		  				$tabs["Section " . $i] = array('title'=>'Edit text ' . $i, 'ajax'=>CHtml::normalizeUrl(array('ajax/renderSectionView', 'sectionid'=>$child->childSection->id)), 'data'=>array());
		  			}
		  			$i++;
		  		}
	 	  	}
	 	  	$tabs['Add Text'] = array('title'=>'Add a new text', 'ajax'=>CHtml::normalizeUrl(array('ajax/renderTextForm', 'sectionid'=>$model->id)), 'data'=>array());
	?>
	
		  	
			<?php 
			$this->widget('zii.widgets.jui.CJuiTabs', array('id'=>'section' . $model->id . 'tab','tabs'=>$tabs));
			?>
<script type='text/javascript'>
	jQuery(function($) {
		jQuery('#section<?php echo $model->id;?>tab').tabs({'idPrefix':'section<?php echo $model->id;?>'});
	});
</script>
			