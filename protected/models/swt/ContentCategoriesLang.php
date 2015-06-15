<?php

/**
 * This is the model class for table "swt_content_categories_lang".
 *
 * The followings are the available columns in table 'swt_content_categories_lang':
 * @property string $l_id
 * @property integer $content_categories_id
 * @property string $lang_id
 * @property string $l_title
 * @property string $l_alias_url
 * @property string $l_description
 *
 * The followings are the available model relations:
 * @property SwtContentCategories $contentCategories
 * @property SwtLanguages $lang
 */
class ContentCategoriesLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContentCategoriesLang the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_content_categories_lang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_categories_id, lang_id, l_title, l_alias_url, l_description', 'required'),
			array('content_categories_id', 'numerical', 'integerOnly'=>true),
			array('lang_id', 'length', 'max'=>6),
			array('l_title', 'length', 'max'=>80),
			array('l_alias_url', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('l_id, content_categories_id, lang_id, l_title, l_alias_url, l_description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'content_categories' => array(self::BELONGS_TO, 'SwtContentCategories', 'content_categories_id'),
			'lang' => array(self::BELONGS_TO, 'SwtLanguages', 'lang_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'l_id' => Yii::t('label', 'L'),
			'content_categories_id' => Yii::t('label', 'Content Categories'),
			'lang_id' => Yii::t('label', 'Lang'),
			'l_title' => Yii::t('label', 'L Title'),
			'l_alias_url' => Yii::t('label', 'L Alias Url'),
			'l_description' => Yii::t('label', 'L Description'),
		);
	}
	
	/**
	 * before validate attributes
	 */
	/* protected function beforeValidate() {
		if(parent::beforeValidate()) {		
			if($this->isNewRecord) {
				$this->verifyPassword = $data;
			
			}else {
				
			}			
		}
		return true;
	} */
	
	/**
	 * before save attributes
	 */
	/* protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->start_date 	= date('Y-m-d', strtotime($this->start_date));			
			}else {
				
			}
		}
		return true;
	} */
	
	
	/**
	 * After save attributes
	 */
	/* protected function afterSave() {
		parent::afterSave();
		// Create action		
	} */

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('content_categories_id',$this->content_categories_id);
		$criteria->compare('lang_id',$this->lang_id,true);
		$criteria->compare('l_title',$this->l_title,true);
		$criteria->compare('l_alias_url',$this->l_alias_url,true);
		$criteria->compare('l_description',$this->l_description,true);
//		$criteria->order = ''
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			/* 'pagination'=>array(
				'pageSize'=>20,
			), */
		));
	}
}