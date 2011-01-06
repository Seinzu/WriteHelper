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
		  				$tabs["Text " . $i] = array('id'=>$child->childText->id, 'ajax'=>CHtml::normalizeUrl(array('ajax/renderTextForm', 'sectionid'=>$model->id, 'textid'=>$child->childText->id)), 'data'=>array());
		  			}
		  			else if (isset($child->childSection) && $child->childSection->id !==null){
		  				$tabs[$child->childSection->title] = array('id'=>$child->childSection->id, 'ajax'=>CHtml::normalizeUrl(array('ajax/renderSectionView', 'sectionid'=>$child->childSection->id)), 'data'=>array());
		  			}
		  			$i++;
		  		}
	 	  	}
	 	  	$tabs['Add Text'] = array('title'=>'Add a new text', 'ajax'=>CHtml::normalizeUrl(array('ajax/renderTextForm', 'sectionid'=>$model->id)), 'data'=>array());
	?>
	
		  	
			<?php 
			$this->widget('zii.widgets.jui.CJuiTabs', array('id'=>'SectionTab_' . $model->id,'tabs'=>$tabs));
			?>
<script type='text/javascript'>		   														
	jQuery(function($) {
		jQuery('#SectionTab_<?php echo $model->id;?>').tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
		jQuery('#SectionTab_<?php echo $model->id;?> li').removeClass('ui-corner-top').addClass('ui-corner-left');
		jQuery('#SectionTab_<?php echo $model->id;?>').tabs().find('.ui-tabs-nav').sortable({  axis: "x", 
																								update: function(event, ui) { 
																												var sortArray = $(this).sortable("toArray");
																												var section = '<?php echo $model->id;?>';
																												$.ajax({
																														type: "POST",
																														url: "<?php echo Yii::app()->createUrl('ajax/reorderSectionItem');?>",
																														data: {section: section, sortArray: sortArray},
																														success: function (msg){
																																				jQuery('#ajax-message').text(msg);
																																				}
																														});
																												}
																							});
	});
</script>
			