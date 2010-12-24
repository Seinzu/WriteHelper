<?php
$this->breadcrumbs=array(
	'Tag Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TagType', 'url'=>array('index')),
	array('label'=>'Manage TagType', 'url'=>array('admin')),
);
?>

<h1>Create TagType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>