<?php


class TagWidget extends CWidget {
	
	public $item;
	
	public $itemType;
	
	public function run(){
		if (!empty($this->item) || !empty($this->itemType)){
			$criteriaApplied = new CDbCriteria();
			$criteriaApplied->compare('item', $this->item); 
			$criteriaApplied->compare('itemType', $this->itemType);
			//$criteriaApplied->with = array('TagType', 'TagInstance');
			$criteriaApplied->together = true;
			$appliedTags = Tag::model()->with('TagType', 'TagInstance')->findAll($criteriaApplied);	
			
			$applicableTags = Tag::model()->findAll();
			$this->render('tagForm', array('appliedTags'=>$appliedTags, 'applicableTags'=>$applicableTags));
		}
	}
	
}