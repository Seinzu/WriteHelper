<?php
$this->breadcrumbs=array(
	'Tag Types'=>array('index'),
	$model->title=>array('view','id'=>$model->title),
	'Update',
);

$this->menu=array(
	array('label'=>'List TagType', 'url'=>array('index')),
	array('label'=>'Create TagType', 'url'=>array('create')),
	array('label'=>'View TagType', 'url'=>array('view', 'id'=>$model->title)),
	array('label'=>'Manage TagType', 'url'=>array('admin')),
);
?>

<h1>Update TagType <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>