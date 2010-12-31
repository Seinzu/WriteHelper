<?php
			if (!empty($textData)){
	 	  		$this->widget('zii.widgets.CListView', array(
	 	  													'dataProvider'=>$texts,
															'itemView'=> '//text/_preview',
															'id'=>'textListWidget'.$data->id,
															));
	 	  	}
	 	  	?>