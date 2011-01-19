<?php
			$sections  = Text::getAvailableSections();
	 	  	$childs = new CActiveDataProvider('SectionTexts', array('criteria'=>array( 'condition'=>"parent='{$model->id}'", 'with'=>array('childText', 'childSection'), 'order'=>"`order` ASC" )));
	 	  	if (method_exists($childs, "getData")){
		  		$childsData = $childs->getData();
	 	  	}
	 	  	else {
	 	  		$childsData = false;
	 	  	}
		  	$panels = array();
		  	$panels[$model->title . ' Overview'] = $this->renderPartial('//section/_preview', array('data'=>Section::model()->findByPk($model->id)), true);
	 	  	$i = 1;
		  	if (!empty($childsData)){
		  		foreach ($childsData as $child){
		  			if (isset($child->childText) && $child->childText->id !==null){
		  				$panels["Text " . $i] = $this->renderPartial('//text/_inline', array('data'=>Text::model()->findByPk($child->childText->id), 'section'=>$model->id), true);
		  			}
		  			else if (isset($child->childSection) && $child->childSection->id !==null){
		  				$panels[$child->childSection->title] = $this->renderPartial('//section/_preview', array('data'=>Section::model()->findByPk($child->childSection->id)), true);
		  			}
		  			$i++;
		  		}
	 	  	}
	 	  	$options = array('autoHeight'=>false,'collapsible'=>true);
	 	  	$panels['Add Text'] = $this->renderPartial('//text/_form', array('model'=>new Text), true);
			$this->widget('zii.widgets.jui.CJuiAccordion', array('id'=>$model->id . '-panels',
															    'panels'=>$panels, 
																'options'=>$options,
																)
						);
			?>
			<script type='text/javascript'>
				jQuery('#<?php echo $model->id;?>-panels').accordion(<?php echo CJavaScript::encode($options);?>);
			</script>			