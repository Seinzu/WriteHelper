<?php
$this->breadcrumbs=array(
	'Tag Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List TagType', 'url'=>array('index')),
	array('label'=>'Create TagType', 'url'=>array('create')),
	array('label'=>'Update TagType', 'url'=>array('update', 'id'=>$model->title)),
	array('label'=>'Delete TagType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->title),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TagType', 'url'=>array('admin')),
);
?>

<h1>View TagType #<?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'description',
	),
)); ?>
