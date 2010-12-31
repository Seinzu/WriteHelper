<?php
$this->breadcrumbs=array(
	'Document'=>array('/document'),
	'View',
);?>

<h1>View Document <?php echo $model->title; ?></h1>

<?php 
	$viewData = array('sections'=>$sections);
	$tabs = array();
	$tabs['wholedocument'] = array('title'=>'Whole Document',
									'view'=>'_display',
									'data'=>array('sections'=>$sections, 'model'=>$model));
	$i = 1;
	$sectionData = $sections->getData();
	foreach ($sectionData as $section){
		if (!is_string($section)){
			$tabs['section' . $i] = array('title'=>$section->title,
										'view'=>'//section/_view',
										'data'=>array('data'=>$section));
			$i++;
		}
	}

?>


<?php $this->widget('CTabView', array('tabs'=>$tabs, 'viewData'=>$viewData));?>

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
	
</script>