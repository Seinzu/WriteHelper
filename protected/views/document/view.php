<?php
$this->breadcrumbs=array(
	'Document'=>array('/document'),
	'View',
);?>

<h1>View Document <?php echo $model->title; ?></h1>

<h2>Sections</h2>

<?php if (!empty($sections)){
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$sections,
		'itemView'=> '_view',
	)); 
}?>

<p><?php echo CHtml::link('Add a section',array('/section/create/', 'document'=>$model->id));?></p>
