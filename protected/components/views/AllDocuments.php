<?php
$documents = AuthorDocuments::getUserDocuments();
foreach ($documents as $document){
	echo "<pre>";
	var_dump($document);
	echo "</pre>";
	//echo CHtml::link(CHtml::encode($document->name), array('view', 'id'=>$document->id)); 	
}

?>