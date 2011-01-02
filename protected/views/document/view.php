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

<script type='text/javascript'>
	$('.hidden').hide();

	function sectionStatus(data, status, request){
		$('#sectionForm').hide();
		if (data != false){
			var options = new Array();
			options["afterAjaxUpdate"] = 'hideAll';
			$.fn.yiiListView.update('sectionListWidget', options);
			
			$('.hidden').hide();
		}
	}

	function hideAll(){
		$('.hidden').hide();
	}
		
	function textStatus(data, status, request){
		var data = eval(data);
		if (data[1] == true){
			var options = new Array();
			$('#textForm' + data[0]).hide();
			$.fn.yiiListView.update('textListWidget' + data[0], options);
		}
	}

	function getCurrentTab(tabid){
		var currentTab = $("div#"+tabid+" > ul.tabs > li > a.active");
		var href = currentTab.attr('href');
	}
	
</script>