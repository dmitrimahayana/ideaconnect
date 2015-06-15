<?php

/**
 * This is the model class for table "ccn_jobseeker_bio".
 *
 * The followings are the available columns in table 'ccn_jobseeker_bio':
 * @property string $id
 * @property string $complete_name
 * @property string $address
 * @property integer $city_id
 * @property integer $province_id
 * @property integer $post_code
 * @property string $house_phone
 * @property string $mobile_phone
 * @property string $mobile_phone2
 * @property string $birth_place
 * @property string $birth_date
 * @property string $sex
 * @property string $religion
 * @property string $homepage
 * @property string $origin_status
 * @property string $origin_address
 * @property integer $origin_city_id
 * @property integer $origin_province_id
 * @property string $hobby
 * @property string $photo
 * @property string $status
 * @property integer $child
 * @property integer $is_data_changed
 * @property string $swt_users_id
 *
 * The followings are the available model relations:
 * @property SwtUsers $swtUsers
 * @property CcnProvince $province
 * @property CcnCity $city
 * @property CcnCity $originCity
 * @property CcnProvince $originProvince
 */
class CcnJobseekerBio extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnJobseekerBio the static model class
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
		return 'ccn_jobseeker_bio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('complete_name, address, city_id, province_id, post_code, mobile_phone, birth_place, birth_date, sex, religion, origin_address, origin_city_id, origin_province_id, hobby, is_data_changed, cv_status , swt_users_id', 'required'),
			array('city_id, province_id, post_code, origin_status, origin_city_id, origin_province_id, child, is_data_changed, cv_status', 'numerical', 'integerOnly'=>true,
				'message' => '{attribute} harus berupa angka'),
			array('id', 'length', 'max'=>10),
			array('complete_name, homepage', 'length', 'max'=>50),
			array('house_phone, mobile_phone, mobile_phone2', 'length', 'max'=>20),
			array('house_phone, mobile_phone, mobile_phone2', 'numerical', 'integerOnly'=>true,
				'message' => '{attribute} harus berupa angka'),
			array('birth_place', 'length', 'max'=>30),
			array('sex', 'length', 'max'=>6),
			array('religion', 'length', 'max'=>8),
			array('hobby', 'length', 'max'=>75),
			array('photo', 'length', 'max'=>255),
			array('status', 'length', 'max'=>7),
			array('swt_users_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, complete_name, address, city_id, province_id, post_code, house_phone, mobile_phone, mobile_phone2, birth_place, birth_date, sex, religion, homepage, origin_address, origin_city_id, origin_province_id, hobby, photo, status, child, is_data_changed, swt_users_id', 'safe', 'on'=>'search'),
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
			'users' => array(self::BELONGS_TO, 'Users', 'swt_users_id'),
			'province' => array(self::BELONGS_TO, 'CcnProvince', 'province_id'),
			'city' => array(self::BELONGS_TO, 'CcnCity', 'city_id'),
			'origin_city' => array(self::BELONGS_TO, 'CcnCity', 'origin_city_id'),
			'origin_province' => array(self::BELONGS_TO, 'CcnProvince', 'origin_province_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'complete_name' => Yii::t('label','Nama Lengkap'),
			'address' => Yii::t('label','Alamat'),
			'city_id' => Yii::t('label','Kota/Kabupaten'),
			'city.name' => Yii::t('label','Kota/Kabupaten'), //penamaan relasi city
			'province_id' => Yii::t('label','Propinsi'),
			'province.name' => Yii::t('label','Propinsi'), //penamaan relasi province
			'post_code' => Yii::t('label','Kode Pos'),
			'house_phone' => Yii::t('label','Telepon'),
			'mobile_phone' => Yii::t('label','Handphone'),
			'mobile_phone2' => Yii::t('label','Handphone2'),
			'birth_place' => Yii::t('label','Tempat Lahir'),
			'birth_date' => Yii::t('label','Tanggal Lahir'),
			'sex' => Yii::t('label','Jenis Kelamin'),
			'religion' => Yii::t('label','Agama'),
			'homepage' => Yii::t('label','Homepage'),
			'origin_status' => Yii::t('label','Alamat Asal Status'),
			'origin_address' => Yii::t('label','Alamat Asal'),
			'origin_city_id' => Yii::t('label','Kota Asal'),
			'origin_city.name' => Yii::t('label','Kota Asal'), //penamaan relasi origin_city
			'origin_province_id' => Yii::t('label','Propinsi Asal'),
			'origin_province.name' => Yii::t('label','Propinsi Asal'), //penamaan relasi origin_province
			'hobby' => Yii::t('label','Hobi'),
			'photo' => Yii::t('label','Photo'),
			'status' => Yii::t('label','Status'),
			'child' => Yii::t('label','Anak'),
			'is_data_changed' => Yii::t('label','Is Data Changed'),
			'swt_users_id' => Yii::t('label','Swt Users'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('complete_name',$this->complete_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('post_code',$this->post_code);
		$criteria->compare('house_phone',$this->house_phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('mobile_phone2',$this->mobile_phone2,true);
		$criteria->compare('birth_place',$this->birth_place,true);
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('religion',$this->religion,true);
		$criteria->compare('homepage',$this->homepage,true);
		$criteria->compare('origin_status',$this->origin_status,true);
		$criteria->compare('origin_address',$this->origin_address,true);
		$criteria->compare('origin_city_id',$this->origin_city_id);
		$criteria->compare('origin_province_id',$this->origin_province_id);
		$criteria->compare('hobby',$this->hobby,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('child',$this->child);
		$criteria->compare('is_data_changed',$this->is_data_changed);
		$criteria->compare('cv_status',$this->cv_status,true);
		$criteria->compare('swt_users_id',$this->swt_users_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		}else {
			$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'complete_name';
			$this->defaultColumns[] = 'address';
			$this->defaultColumns[] = 'city_id';
			$this->defaultColumns[] = 'province_id';
			$this->defaultColumns[] = 'post_code';
			$this->defaultColumns[] = 'house_phone';
			$this->defaultColumns[] = 'mobile_phone';
			$this->defaultColumns[] = 'mobile_phone2';
			$this->defaultColumns[] = 'birth_place';
			$this->defaultColumns[] = 'birth_date';
			$this->defaultColumns[] = 'sex';
			$this->defaultColumns[] = 'religion';
			$this->defaultColumns[] = 'homepage';
			$this->defaultColumns[] = 'origin_status';
			$this->defaultColumns[] = 'origin_address';
			$this->defaultColumns[] = 'origin_city_id';
			$this->defaultColumns[] = 'origin_province_id';
			$this->defaultColumns[] = 'hobby';
			$this->defaultColumns[] = 'photo';
			$this->defaultColumns[] = 'status';
			$this->defaultColumns[] = 'child';
			$this->defaultColumns[] = 'is_data_changed';
			$this->defaultColumns[] = 'swt_users_id';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'complete_name';
			$this->defaultColumns[] = 'address';
			$this->defaultColumns[] = 'city_id';
			$this->defaultColumns[] = 'province_id';
			$this->defaultColumns[] = 'post_code';
			$this->defaultColumns[] = 'house_phone';
			$this->defaultColumns[] = 'mobile_phone';
			$this->defaultColumns[] = 'mobile_phone2';
			$this->defaultColumns[] = 'birth_place';
			$this->defaultColumns[] = 'birth_date';
			$this->defaultColumns[] = 'sex';
			$this->defaultColumns[] = 'religion';
			$this->defaultColumns[] = 'homepage';
			$this->defaultColumns[] = 'origin_status';
			$this->defaultColumns[] = 'origin_address';
			$this->defaultColumns[] = 'origin_city_id';
			$this->defaultColumns[] = 'origin_province_id';
			$this->defaultColumns[] = 'hobby';
			$this->defaultColumns[] = 'photo';
			$this->defaultColumns[] = 'status';
			$this->defaultColumns[] = 'child';
			$this->defaultColumns[] = 'is_data_changed';
			$this->defaultColumns[] = 'swt_users_id';
		}
		parent::afterConstruct();
	}

	protected function beforeValidate()
	{
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				if(Yii::app()->user->id == '4'  || Yii::app()->user->id == '5'){
					$this->swt_users_id = Yii::app()->user->id_user;
				}else{
					$this->swt_users_id = $_GET['id'];
				}
				$this->is_data_changed = 0;
			}
			$this->birth_date = date('Y-m-d', strtotime($this->birth_date));
		}
		return true;
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				
			}else {
				$this->is_data_changed = 1;
			}
			
		}
		return true;
	}
	
	/**
	 * after save
	 */
	protected function afterSave() {
		parent::afterSave();
                $model = CcnUsers::model()->findByPk($this->swt_users_id);
		if($this->isNewRecord) {					
			$model->status_user = 4;
			$model->save(false, array('status_user'));
		}else{
                    if($model->status_user == 3) {
                        $model->status_user = 4;
			$model->save(false, array('status_user'));
                    }                    
                }
	}

}