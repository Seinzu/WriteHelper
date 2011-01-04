
<h2><?php echo $data->title;?></h2>
<?php

$texts = new CActiveDataProvider('Text', array('criteria'=>array('condition'=>'section=' . $data->id)));;
$textData = $texts->getData();
if (!empty($textData)){
	$output = '';
	foreach ($textData as $text){
		$output .= $this->renderPartial('//text/_preview', array('data'=>$text), true) . '<br /><br />';
	}
	$Markdown = new CMarkdown;
	
	echo $Markdown->transform($output);
}


//