<?php
$this->breadcrumbs=array(
	'Document'=>array('/document'),
	'View',
);?>
<script type='text/javascript'>

	function textUpdate(data, status, request){
		var data = eval(data);
		alert(data[0]);
	}
	
</script>
<h1>View Document <?php echo $model->title; ?></h1>

<?php 
	$viewData = array('sections'=>$sections);
	$tabs = array();
	$tabs['Whole Document'] = array('title'=>'Whole Document',
									'ajax'=>CHtml::normalizeUrl(array('ajax/renderDocumentPreview', 'documentid'=>$model->id)),
									'data'=>array('sections'=>$sections, 'model'=>$model));
	$i = 1;
	$sectionData = $sections->getData();
	foreach ($sectionData as $section){
		if (!is_string($section)){
			$tabs[$section->title] = array('title'=>$section->title,
										'ajax'=>CHtml::normalizeUrl(array('ajax/renderSectionView', 'sectionid'=>$section->id)),
										'data'=>array(),
										);
			$i++;
		}
	}
	$tabs['Add Section'] = array('title'=>'Add a section',
								'ajax'=>CHtml::normalizeUrl(array('ajax/renderSectionForm', 'documentid'=>$model->id)),
								'data'=>array()
								);
?>


<?php $this->widget('zii.widgets.jui.CJuiTabs', array('tabs'=>$tabs, 'options'=>array('idPrefix'=>"parent")));?>

