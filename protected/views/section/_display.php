<?php
			$texts = new CActiveDataProvider('Text', array('criteria'=>array('condition'=>'section=' . $data->id)));
			$textData = $texts->getData();
			if (!empty($textData)){
	 	  		$this->widget('zii.widgets.CListView', array(
	 	  													'dataProvider'=>$texts,
															'itemView'=> '//text/_preview',
															'id'=>'textListWidget'.$data->id,
	 	  													'summaryText'=>'',
	 	  													'enablePagination'=>false,
															));
	 	  	}
	 	  	?>