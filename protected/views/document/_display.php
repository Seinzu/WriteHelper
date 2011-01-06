<?php
	$sectionsData = $sections->getData();
	foreach ($sectionsData as $section){
		if (isset($section->documentSection))
			$this->renderPartial('//section/_preview', array('data'=>$section->documentSection));
	}	

?>

<div id='req'></div>
