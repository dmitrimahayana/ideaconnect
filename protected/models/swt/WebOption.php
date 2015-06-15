<?php

/**
 * This is the model class for table "swt_web_option".
 *
 * The followings are the available columns in table 'swt_web_option':
 * @property integer $id_option
 * @property string $web_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property string $email_admin
 * @property string $format_date
 * @property string $emp_address
 * @property string $facebook_address
 * @property string $twitter_address
 * @property integer $max_news_per_page
 * @property integer $max_menu_per_page
 * @property string $status_web
 * @property string $teks_under_construction
 */
class WebOption extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return WebOption the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_web_option';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_option, web_title, meta_keyword, meta_description, email_admin, format_date, max_news_per_page, max_menu_per_page, teks_under_construction, pay_amount', 'required'),
			array('id_option, max_news_per_page, max_menu_per_page , pay_amount', 'numerical', 'integerOnly'=>true),
			array('web_title', 'length', 'max'=>128),
			array('meta_keyword, meta_description', 'length', 'max'=>155),
			array('email_admin', 'email'),
			array('format_date', 'length', 'max'=>50),
			array('pay_amount', 'length', 'max'=>7),
			array('teks_under_construction', 'length', 'max'=>255),
			array('status_web', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_option, web_title, meta_keyword, meta_description, email_admin, format_date, max_news_per_page, max_menu_per_page,  status_web, teks_under_construction', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id_option' => Yii::t('label', 'Id Option'),
			'web_title' => Yii::t('label', 'Nama Website'),
			'meta_keyword' => Yii::t('label', 'Meta Keyword'),
			'meta_description' => Yii::t('label', 'Meta Description'),
			'email_admin' => Yii::t('label', 'Email Penerima Konfirmasi'),
			'format_date' => Yii::t('label', 'Format Tanggal'),			
			'max_news_per_page' => Yii::t('label', 'Maks Berita Per Halaman'),
			'max_menu_per_page' => Yii::t('label', 'Maks Menu Per Halaman'),
			'status_web' => Yii::t('label', 'Status Web'),
			'teks_under_construction' => Yii::t('label', 'Teks Dalam Pengerjaan'),
			'pay_amount' => Yii::t('label', 'Jumlah Pembayaran'),
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

		$criteria->compare('web_title',$this->web_title,true);
		$criteria->compare('meta_keyword',$this->meta_keyword,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('email_admin',$this->email_admin,true);
		$criteria->compare('format_date',$this->format_date,true);
		$criteria->compare('emp_address',$this->emp_address,true);
		$criteria->compare('facebook_address',$this->facebook_address,true);
		$criteria->compare('twitter_address',$this->twitter_address,true);
		$criteria->compare('max_news_per_page',$this->max_news_per_page);
		$criteria->compare('max_menu_per_page',$this->max_menu_per_page);
		$criteria->compare('status_web',$this->status_web,true);
		$criteria->compare('teks_under_construction',$this->teks_under_construction,true);
//		$criteria->order = ''
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			/* 'pagination'=>array(
				'pageSize'=>20,
			), */
		));
	}
}