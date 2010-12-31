<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$sections,
		'itemView'=> '//section/_preview',
		'id'=>'sectionListWidget',
	));
?>

<div id='req'></div>