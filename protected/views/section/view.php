<?php

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
<script type='text/javascript'>
	jQuery(function($) {
		jQuery('#section<?php echo $model->id;?>tab').tabs({'idPrefix':'section<?php echo $model->id;?>'});
	});
</script>
			