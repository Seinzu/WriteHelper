<?php

/**
 * This is the model class for table "text".
 *
 * The followings are the available columns in table 'text':
 * @property integer $id
 * @property string $text
 * @property integer $section
 */
class Text extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Text the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'text';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text', 'required'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, text', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
					'childText'=>array(self::HAS_MANY, 'SectionTexts', 'child')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'text' => 'Text',
		);
	}
	
	public function beforeSave(){
		
		if (isset($_POST['nonce'])){
			$nonce = Nonce::model()->find('nonce=:nonce', array('nonce'=>$_POST['nonce']));
			if (isset($nonce->active) && $nonce->active)
				$nonce->delete();
			else 
				return false;
		}
		else {
			return false;
		}
		
		if (empty($this->id)){
			$cmd = Yii::app()->db->createCommand("SELECT UUID( ) AS idval");
			$results = $cmd->query();
			$result = $results->read();
			$this->id = $result['idval'];
		}
		
		
		
		$this->modified = new CDbExpression('NOW()');
		
		return parent::beforeSave();
	}
	
	/** 
	 * Extends afterSave hook, currently used to insert the current section into the next slot on
	 * the document sections order list.
	 */
	public function afterSave(){
		parent::afterSave();
		// insert a record into the revisions table
		$revision = new Revisions;
		$revision->attributes = array("textid"=>$this->id, 'contents'=>$this->text);
		$revision->save();
		$section = $_POST['section'];
		// Put this record into the current section
		$textRecordCount = SectionTexts::model()->count("child = :text", array("text"=>$this->id));
		if ($textRecordCount == 0 && $section > 0){
				
			$st = new SectionTexts;
			$nextorder = $st->findHighestGap($section);
			if ($nextorder === null)
				$nextorder = 1;
			
			$st->attributes = array('id'=>null, 'parent'=>$section, 'child'=>$this->id, 'order'=>(int)$nextorder);
			return $st->save();
		}
		return true;
	}
	
	public static function getAvailableSections(){
		//$author = Yii::app()->user->getId();
		//$sections = new CActiveDataProvider('Section', array('criteria'=>array('condition'=>'author='.$author, 'with'=>array('documentSection', 'documentSection.documentParent'))));
		//$data = $sections->getData();
		//$sections = array(0=>'No Section');
		//foreach ($data as $section){
		//	$sections[$section->id] = $section->title;
		//}
		return array();
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}