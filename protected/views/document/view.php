<h1>View Document <?php echo $model->title; ?></h1>

<script type='text/javascript'>
	function renderSection(id){
		$('#document-content-area').html = jQuery.ajax({url: '<?php echo CHtml::normalizeUrl(array('ajax/renderSectionView'));?>?sectionid='+id, 
														success: function(data, status, request){
	        																						jQuery('#document-content-area').html(data);
	        																					}
														});
	}
</script>
<div id='document-content-area'>
	<?php $this->renderPartial('//document/_display', array('data'=>Document::model()->findByPk($model->id), 'sections'=>$sections));?>
</div>
<?php 
$items = array();
$sections = $sections->getData();
foreach ($sections as $section){
	if (isset($section->documentSection)){
		$items[$section->documentSection->id] = "<a href='#' onclick=\"renderSection('{$section->documentSection->id}');return false;\">" . $section->documentSection->title . "</a>";
	}
}

$this->widget('CJScrollPane', array(
    
    // additional javascript options for the slider plugin
    'items'=>$items
));


?>