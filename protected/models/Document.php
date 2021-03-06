<?php

/**
 * This is the model class for table "document".
 *
 * The followings are the available columns in table 'document':
 * @property integer $id
 * @property string $title
 * @property integer $author
 */
class Document extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Document the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	

	public function lastModified(){
		$this->getDbConnection()->createCommand('SELECT MAX(`order`) FROM `section_texts` WHERE section=' . $section)->queryScalar();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'document';
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
			array('author', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, author', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('author'=>array(self::BELONGS_TO, 'Author', 'author'),
					 'documentsections'=>array(self::HAS_MANY, 'DocumentSections', 'document'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'author' => 'Author',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('author',$this->author);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getAvailableDocuments(){
		$author = Yii::app()->user->id;
		$documents = new CActiveDataProvider('Document', array('criteria'=>array('condition'=>'author='.$author)));
		return $documents;
	}
	
	public static function getAvailableDocumentsMenu(){
		$docs = Document::getAvailableDocuments();
		$returnDocs = array();
		if ($data = $docs->getData()){
			foreach ($data as $doc){
				$returnDocs[$doc->id] = $doc->title;
			}
		}
		return $returnDocs;
	}
	
	protected function beforeSave(){
		if(parent::beforeSave())
		    {
		        if($this->isNewRecord)
		        {
		            
		            $this->author=Yii::app()->user->id;
		        }
		        
		        return true;
		    }
		    else
		        return false;
	}
}