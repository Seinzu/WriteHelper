<div id='result'></div>

<div class='targets'>
<?php 
$items = array();
foreach ($sectiontexts as $text){
	$items[$text->text] = 'text ' . $text->text;
}

$this->widget('zii.widgets.jui.CJuiSortable', array(
       'items'=>$items,
       // additional javascript options for the accordion plugin
       'options'=>array(
           'delay'=>'300',
		   'update'=>'js:function (event, ui){
		   					var sortArray = $(this).sortable("toArray");
		   					var section = '. $model->id .';
		   					console.debug(sortArray);
		   					$.ajax({
		   							type: "POST",
		   							url: "'. Yii::app()->createUrl("ajax/reorderSectionItem") .'",
		   							data: {section: section, sortArray: sortArray},
		   							success: function (msg){
		   										$("#result").html(msg);
		   								},
		   							});
		   
		   			   }',
		),
		
));

?>
</div>

</div>