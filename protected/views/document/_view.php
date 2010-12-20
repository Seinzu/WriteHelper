<div class="view">

	<?php echo "<pre>";var_dump($data);echo "</pre>";echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
	<br />


</div>