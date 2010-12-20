<?php
$this->breadcrumbs=array(
	'Document',
);
if (!empty($documents)){
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$documents,
		'itemView'=>'_view',
	)); 
}
else {

?>
	<p>You haven't created any documents yet.</p>
<?php

}
?>

<p><?php echo CHtml::link('Create a new document',CHtml::normalizeUrl('document/create')); ?></p>

