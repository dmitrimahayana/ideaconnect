<?php

/**
 * This is the model class for table "swt_menu_lang".
 *
 * The followings are the available columns in table 'swt_menu_lang':
 * @property string $l_id
 * @property integer $menu_id
 * @property string $lang_id
 * @property string $l_name
 * @property string $l_alias_url
 *
 * The followings are the available model relations:
 * @property SwtLanguages $lang
 * @property SwtMenu $menu
 */
class MenuLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MenuLang the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_menu_lang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_id, lang_id, l_name, l_alias_url', 'required'),
			array('menu_id', 'numerical', 'integerOnly'=>true),
			array('lang_id', 'length', 'max'=>6),
			array('l_name', 'length', 'max'=>100),
			array('l_alias_url', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('l_id, menu_id, lang_id, l_name, l_alias_url', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'lang' => array(self::BELONGS_TO, 'SwtLanguages', 'lang_id'),
			'menu' => array(self::BELONGS_TO, 'SwtMenu', 'menu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'l_id' => Yii::t('label', 'L'),
			'menu_id' => Yii::t('label', 'Menu'),
			'lang_id' => Yii::t('label', 'Lang'),
			'l_name' => Yii::t('label', 'L Name'),
			'l_alias_url' => Yii::t('label', 'L Alias Url'),
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

		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('lang_id',$this->lang_id,true);
		$criteria->compare('l_name',$this->l_name,true);
		$criteria->compare('l_alias_url',$this->l_alias_url,true);
//		$criteria->order = ''
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			/* 'pagination'=>array(
				'pageSize'=>20,
			), */
		));
	}
}