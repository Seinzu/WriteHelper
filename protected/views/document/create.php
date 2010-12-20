<?php
$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
);
?>

<h1>Create Document</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>