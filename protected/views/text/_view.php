<div class="view">

	<b><?php echo CHtml::link(CHtml::encode($data->getAttributeLabel('text')), array('/text/view/', "id"=>$data->id)); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />
	<?php if (get_class($this) == 'TextController') {
			// do specific things we want to do when we are in a section
		?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('section')); ?>:</b>
	<?php echo CHtml::encode($data->section); ?>
	<br />
	<?php }?>
	


</div>