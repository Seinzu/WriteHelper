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
			array('text, section', 'required'),
			array('section', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, text, section', 'safe', 'on'=>'search'),
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
					'section'=>array(self::BELONGS_TO, 'Section', 'section'),
					'sectiontexts'=>array(self::HAS_MANY, 'SectionTexts', 'text')
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
			'section' => 'Section',
		);
	}
	
	/** 
	 * Extends afterSave hook, currently used to insert the current section into the next slot on
	 * the document sections order list.
	 */
	public function afterSave(){
		parent::afterSave();
		$textRecordCount = SectionTexts::model()->count('text = :text', array("text"=>$this->id));
		if ($textRecordCount == 0 && $this->section > 0){
				
			$st = new SectionTexts;
			$nextorder = $st->findHighestGap($this->section);
			if ($nextorder === null)
				$nextorder = 1;
			
			$st->attributes = array('id'=>null, 'section'=>(int)$this->section, 'text'=>(int)$this->id, 'order'=>(int)$nextorder);
			return $st->save();
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('section',$this->section);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}