<?php

/**
 * This is the model class for table "swt_contact_details".
 *
 * The followings are the available columns in table 'swt_contact_details':
 * @property integer $id
 * @property string $name
 * @property string $alias_url
 * @property string $address
 * @property string $city
 * @property string $propincy
 * @property string $country
 * @property string $post_code
 * @property string $telephone
 * @property string $fax
 * @property string $misc
 * @property string $image
 * @property string $image_pos
 * @property string $email_to
 * @property integer $published
 * @property integer $ordering
 * @property string $params
 * @property string $mobile
 */
class ContactDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContactDetails the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_contact_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('params', 'required'),
			array('published, ordering', 'numerical', 'integerOnly'=>true),
			array('name, alias_url, telephone, fax, image, email_to, mobile', 'length', 'max'=>255),
			array('city, propincy, country, post_code, messenger_id, facebook_address, twitter_address', 'length', 'max'=>100),
			array('image_pos', 'length', 'max'=>20),
			array('address, misc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, alias_url, address, city, propincy, country, post_code, telephone, fax, misc, image, image_pos, email_to, published, ordering, params, mobile', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('label', 'ID'),
			'name' => Yii::t('label', 'Nama Kontak'),
			'alias_url' => Yii::t('label', 'Url Alias'),
			'address' => Yii::t('label', 'Alamat'),
			'city' => Yii::t('label', 'Kota'),
			'propincy' => Yii::t('label', 'Provinsi'),
			'country' => Yii::t('label', 'Negara'),
			'post_code' => Yii::t('label', 'Kode pos'),
			'telephone' => Yii::t('label', ' Nomor Telepon'),
			'fax' => Yii::t('label', 'Nomor Fax'),
			'misc' => Yii::t('label', 'Tambahan'),
			'image' => Yii::t('label', 'Gambar'),
			'image_pos' => Yii::t('label', 'Posisi Gambar'),
			'email_to' => Yii::t('label', 'Email'),
			'published' => Yii::t('label', 'Terbitkan'),
			'ordering' => Yii::t('label', 'Urutan'),
			'params' => Yii::t('label', 'Parameter'),
			'mobile' => Yii::t('label', 'Nomor Handphone'),
			'messenger_id' => Yii::t('label', 'Yahoo Messenger'),
			'facebook_address' => Yii::t('label', 'Alamat Facebook'),
			'twitter_address' => Yii::t('label', 'Alamat Twitter'),
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias_url',$this->alias_url,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('propincy',$this->propincy,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('post_code',$this->post_code,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('misc',$this->misc,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('image_pos',$this->image_pos,true);
		$criteria->compare('email_to',$this->email_to,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('mobile',$this->mobile,true);
//		$criteria->order = ''
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			/* 'pagination'=>array(
				'pageSize'=>20,
			), */
		));
	}
}