	<h2>Sections</h2>

<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$sections,
		'itemView'=> '../section/_view',
		'id'=>'sectionListWidget',
	));
?>

<p><?php echo CHtml::link('Add a section','#', array('onclick'=>'$("#sectionForm").show();return false;'));?></p>
<div class='hidden' id='sectionForm'>
	<p><?php echo CHtml::link('close','#', array('onclick'=>'$("#sectionForm").hide();return false;'));?></p>
	<?php echo $this->renderPartial('//section/_form', array('model'=>new Section, 'forcedDocument'=>$model->id,'return'=>'sectionStatus', 'ajax'=>true, 'documents'=>false)); ?>
</div>
<div id='req'></div>