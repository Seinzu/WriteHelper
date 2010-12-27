<div class="view">
	<?php echo CHtml::link(CHtml::encode($data->title), array('/section/view', 'id'=>$data->id)); ?>
	<br />
	<?php if (get_class($this) == 'SectionController') {
			// do specific things we want to do when we are in a section
		?>
	
	<?php }
	 	  else if (get_class($this) == 'DocumentController') {
		  	$texts = new CActiveDataProvider('Text', array('criteria'=>array('condition'=>'section=' . $data->id)));
	 	  	if ($texts->getData()){
	 	  		$this->widget('zii.widgets.CListView', array(
	 	  													'dataProvider'=>$texts,
															'itemView'=> '../text/_view',
															'id'=>'textListWidget'.$data->id,
															));
	 	  	}
	 	  	
	?>
	
		  	<p><?php echo CHtml::link('Add a text','#', array('onclick'=>'$("#textForm'.$data->id.'").show();return false;'));?></p>
		  	<div class='hidden' id='textForm<?php echo $data->id;?>'>
				<p><?php echo CHtml::link('close','#', array('onclick'=>'$("#textForm'.$data->id.'").hide();return false;'));?></p>
				<?php echo $this->renderPartial('//text/_form', array('model'=>new Text, 'forcedSection'=>$data->id,'return'=>'textStatus', 'ajax'=>true, 'sections'=>false)); ?>
			</div>
	<?php } ?>


</div>