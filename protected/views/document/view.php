<?php
$this->breadcrumbs=array(
	'Document'=>array('/document'),
	'View',
);?>

<h1>View Document <?php echo $model->title; ?></h1>

<h2>Sections</h2>

<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$sections,
		'itemView'=> '../section/_view',
		'id'=>'sectionListWidget',
	));
?>

<p><?php echo CHtml::link('Add a section','#', array('onclick'=>'$("#sectionForm").show();return false;'));?></p>
<div class='hidden' id='sectionForm'>
	<p><?php echo CHtml::link('close','#', array('onclick'=>'$("#sectionForm").hide();return false;'));?></p>
	<?php echo $this->renderPartial('//section/_form', array('model'=>new Section, 'forcedDocument'=>$model->id,'return'=>'sectionStatus', 'ajax'=>true, 'documents'=>false)); ?>
</div>
<div id='req'></div>
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