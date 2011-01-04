

<?php

$texts = new CActiveDataProvider('Text', array('criteria'=>array('condition'=>'section=' . $data->id)));;
$textData = $texts->getData();
if (!empty($textData)){
	$output = '';
	foreach ($textData as $text){
		$output .= $this->renderPartial('//text/_preview', array('data'=>$text), true);
	}
	$Markdown = new CMarkdown;
	$Markdown->purifyOutput = true;
	$word_count = str_word_count(strip_tags($output));
	?>
	<h2><?php echo $data->title;?><span class='statistic'>(Word Count: <?php echo $word_count;?> words - approx )</span></h2>
	<?php 
	echo $Markdown->transform($output);
}


//