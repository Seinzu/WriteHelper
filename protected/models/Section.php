<?php

/**
 * This is the model class for table "section".
 *
 * The followings are the available columns in table 'section':
 * @property integer $id
 * @property integer $document
 */
class Section extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Section the static model class
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
		return 'section';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('document', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, document', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('document'=>array(self::BELONGS_TO, 'Document', 'document'),
					'documentsections'=>array(self::HAS_MANY, 'DocumentSections', 'section'),
					'sectiontexts'=>array(self::HAS_MANY, 'SectionTexts', 'parent'),
					'sectionparents'=>array(self::HAS_MANY, 'SectionTexts', 'child'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'document' => 'Document',
		);
	}

	public function beforeSave(){
		$this->id = new CDbExpression('UUID()');
		return parent::beforeSave();
	}
	
	/** 
	 * Extends afterSave hook, currently used to insert the current section into the next slot on
	 * the document sections order list.
	 */
	public function afterSave(){
		parent::afterSave();
		$sectionRecordCount = DocumentSections::model()->count('section = :section', array("section"=>$this->id));
		if ($sectionRecordCount == 0 && $this->document > 0){
				
			$ds = new DocumentSections;
			$nextorder = $ds->findHighestGap($this->document);
			if ($nextorder === null)
				$nextorder = 1;
			else 
				$nextorder++;
			$ds->attributes = array('id'=>null, 'document'=>(int)$this->document, 'section'=>(int)$this->id, 'order'=>(int)$nextorder);
			return $ds->save();
		}
		
		return true;
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
		$criteria->compare('document',$this->document);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}