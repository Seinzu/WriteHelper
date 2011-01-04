

<?php

$texts = new CActiveDataProvider('Text', array('criteria'=>array('condition'=>'section=' . $data->id)));;
$textData = $texts->getData();
if (!empty($textData)){
	$output = '';
	foreach ($textData as $text){
		$output .= $this->renderPartial('//text/_preview', array('data'=>$text), true) . '<br /><br />';
	}
	$Markdown = new CMarkdown;
	$word_count = str_word_count($output);
	?>
	<h2><?php echo $data->title;?><span class='statistic'>(Word Count: <?php echo $word_count;?> words )</span></h2>
	<?php 
	echo $Markdown->transform($output);
}


//