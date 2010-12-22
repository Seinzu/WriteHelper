<?php
$documents = AuthorDocuments::getUserDocuments();
foreach ($documents as $document){
	
	echo CHtml::link(CHtml::encode($document->name), array('view', 'id'=>$document->id)); 	
}

?>