<div class="view">
	<?php echo CHtml::link(CHtml::encode($data->title), array('/section/view', 'id'=>$data->id)); ?>
	<br />
	<?php if (get_class($this) == 'SectionController') {
			// do specific things we want to do when we are in a section
		?>
	
	<?php }?>


</div>