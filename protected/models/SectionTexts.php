<?php

/**
 * This is the model class for table "section_texts".
 *
 * The followings are the available columns in table 'section_texts':
 * @property integer $id
 * @property integer $section
 * @property integer $text
 * @property integer $order
 */
class SectionTexts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SectionTexts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function findHighestGap($section){
		$section = (int) $section;
		$order = $this->getDbConnection()->createCommand('SELECT MAX(`order`) FROM `section_texts` WHERE parent=' . $section)->queryScalar();
		return $order+1;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'section_texts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent, child, order', 'required'),
			array(' order', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent, child, order', 'safe', 'on'=>'search'),
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
					'childText'=>array(self::HAS_MANY, 'Text', 'child'),
					'childSection'=>array(self::HAS_MANY, 'Section', 'child'),
					'parent'=>array(self::BELONGS_TO, 'Section', 'parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent' => 'Section',
			'child' => 'Child',
			'order' => 'Order',
		);
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
		$criteria->compare('parent',$this->parent);
		$criteria->compare('child',$this->child);
		$criteria->compare('order',$this->order);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}