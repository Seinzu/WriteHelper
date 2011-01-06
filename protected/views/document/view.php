<?php
$this->breadcrumbs=array(
	'Document'=>array('/document'),
	'View',
);?>

<h1>View Document <?php echo $model->title; ?></h1>

<?php 
	$viewData = array('sections'=>$sections);
	$tabs = array();
	$tabs['Whole Document'] = array('title'=>'Whole Document',
									'ajax'=>CHtml::normalizeUrl(array('ajax/renderDocumentPreview', 'documentid'=>$model->id)),
									);
	$i = 1;
	$sectionData = $sections->getData();
	foreach ($sectionData as $section){
		if (isset($section->documentSection)){
			$tabs[$section->documentSection->title] = array('id'=>$section->documentSection->id,
										'ajax'=>CHtml::normalizeUrl(array('ajax/renderSectionView', 'sectionid'=>$section->documentSection->id)),
										
										);
			$i++;
		}
	}
	$tabs['Add Section'] = array('title'=>'Add a section',
								'ajax'=>CHtml::normalizeUrl(array('ajax/renderSectionForm', 'documentid'=>$model->id)),
								
								);
?>


<?php $this->widget('zii.widgets.jui.CJuiTabs', array('id'=>'DocumentTab','tabs'=>$tabs, 'options'=>array('idPrefix'=>"parent")));?>

<p>Status: <span id='ajax-message'>idle</span></p>

<script type='text/javascript'>
	jQuery(function() {
		jQuery( "#DocumentTab" ).tabs().find( ".ui-tabs-nav" ).sortable({ axis: "x", 
			   															  update: function(event, ui) { 
				  																			var sortArray = $(this).sortable("toArray");
				  																			var document = <?php echo $model->id;?>;
				  																			$.ajax({
				  													   							type: "POST",
				  													   							url: "<?php echo Yii::app()->createUrl("ajax/reorderDocumentItem")?>",
				  													   							data: {document: document, sortArray: sortArray},
				  													   							success: function (msg){
				  													   										jQuery('#ajax-message').text(msg);
				  													   								}
				  													   							});
				  																			}
																		});
	});
	
	function textUpdate(data, status, request){
		if (data[1]){
			var message = 'text saved'; 
		}
		else {
			var message = 'couldn\'t save';
		}
		jQuery('#ajax-message').text(message);
	}

	function sectionUpdate(data, status, request){
		jQuery('#ajax-message').text(data[1]);
	}
	
</script>