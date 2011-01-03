<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$sections,
		'itemView'=> '//section/_preview',
		'id'=>'sectionListWidget',
		'enablePagination'=>false,
		'summaryText'=>'',
	));
?>

<div id='req'></div>
