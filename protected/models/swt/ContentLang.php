<?php

/**
 * This is the model class for table "swt_content_lang".
 *
 * The followings are the available columns in table 'swt_content_lang':
 * @property string $l_id
 * @property string $content_id
 * @property string $lang_id
 * @property string $l_title
 * @property string $l_alias_url
 * @property string $l_intro_text
 * @property string $l_full_text
 * @property string $l_meta_key
 * @property string $l_meta_desc
 *
 * The followings are the available model relations:
 * @property SwtContent $content
 * @property SwtLanguages $lang
 */
class ContentLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContentLang the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_content_lang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_id, lang_id, l_title, l_alias_url, l_intro_text, l_full_text, l_meta_key, l_meta_desc', 'required'),
			array('content_id', 'length', 'max'=>11),
			array('lang_id', 'length', 'max'=>6),
			array('l_title', 'length', 'max'=>100),
			array('l_alias_url', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('l_id, content_id, lang_id, l_title, l_alias_url, l_intro_text, l_full_text, l_meta_key, l_meta_desc', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'content' => array(self::BELONGS_TO, 'SwtContent', 'content_id'),
			'lang' => array(self::BELONGS_TO, 'SwtLanguages', 'lang_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'l_id' => Yii::t('label', 'L'),
			'content_id' => Yii::t('label', 'Content'),
			'lang_id' => Yii::t('label', 'Lang'),
			'l_title' => Yii::t('label', 'L Title'),
			'l_alias_url' => Yii::t('label', 'L Alias Url'),
			'l_intro_text' => Yii::t('label', 'L Introtext'),
			'l_full_text' => Yii::t('label', 'L Fulltext'),
			'l_meta_key' => Yii::t('label', 'L Metakey'),
			'l_meta_desc' => Yii::t('label', 'L Metadesc'),
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

		$criteria->compare('content_id',$this->content_id,true);
		$criteria->compare('lang_id',$this->lang_id,true);
		$criteria->compare('l_title',$this->l_title,true);
		$criteria->compare('l_alias_url',$this->l_alias_url,true);
		$criteria->compare('l_intro_text',$this->l_intro_text,true);
		$criteria->compare('l_full_text',$this->l_full_text,true);
		$criteria->compare('l_meta_key',$this->l_meta_key,true);
		$criteria->compare('l_meta_desc',$this->l_meta_desc,true);
//		$criteria->order = ''
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			/* 'pagination'=>array(
				'pageSize'=>20,
			), */
		));
	}
}