<?php
$contents = new CActiveDataProvider('SectionTexts', array('criteria'=>array('select'=>'SectionTexts.id, childText.text as text', 'condition'=>"parent='{$data->id}'", 'with'=>array('childText', 'childSection'), 'order'=>"`order` ASC" )));
$contentData = $contents->getData();

if (!empty($contentData)){
	$output = '';
	foreach ($contentData as $child){
		if (isset($child->childText) && $child->childText->id !==null){
			$output .= $this->renderPartial('//text/_preview', array('data'=>$child->childText), true);
		}
		else if (isset($child->childSection) && $child->childSection->id !=null){
			$output .= $this->renderPartial('//section/_preview', array('data'=>$child->childSection), true);
		}
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