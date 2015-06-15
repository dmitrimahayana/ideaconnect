<?php

/**
 * This is the model class for table "ccn_employer_data".
 *
 * The followings are the available columns in table 'ccn_employer_data':
 * @property string $id
 * @property string $name
 * @property string $company_desc
 * @property string $address
 * @property integer $city_id
 * @property integer $province_id
 * @property string $country_code
 * @property string $phone_no1
 * @property string $phone_no2
 * @property string $postal_code
 * @property string $city
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property string $ccn_employer_industry_id
 * @property string $contact_person
 * @property string $cp_phone
 * @property string $cp_mobile
 * @property string $cp_email
 * @property string $cp_address
 * @property integer $cp_city_id
 * @property integer $cp_province_id
 * @property string $cp_country_code
 * @property string $cp_postal_code
 * @property string $company_logo
 * @property string $swt_users_id
 * @property string $group
 *
 * The followings are the available model relations:
 * @property CcnCity $cpCity
 * @property CcnCity $city0
 * @property CcnCountry $cpCountryCode
 * @property CcnCountry $countryCode
 * @property CcnEmployerIndustry $ccnEmployerIndustry
 * @property CcnProvince $cpProvince
 * @property CcnProvince $province
 * @property SwtUsers $swtUsers
 */
class CcnEmployerData extends CActiveRecord
{
	public $defaultColumns = array();
	public $company_logo_file;
	public $industry_search;
	public $city_search;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmployerData the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ccn_employer_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, company_desc, ccn_employer_industry_id, address, city_id, province_id, country_code, phone_no1', 'required', 'on'=>'step1'),
			array('contact_person, cp_mobile, cp_email, swt_users_id', 'required', 'on'=>'step2'),
			array('phone_no1, phone_no2, postal_code, city_id, province_id, cp_phone, cp_mobile, cp_city_id, cp_province_id, cp_postal_code', 'numerical', 'integerOnly'=>true,
				'message' => '{attribute} harus berupa angka'),
			array('name', 'length', 'max'=>70),
			array('address, cp_address', 'length', 'max'=>255),
			array('country_code, cp_country_code', 'length', 'max'=>2),
			array('phone_no1, phone_no2, fax, cp_phone, cp_mobile', 'length', 'max'=>20),
			array('ccn_employer_industry_id', 'length', 'max'=>10),
			array('contact_person, group', 'length', 'max'=>45),
			array('email, website', 'length', 'max'=>50),
			array('website', 'url'),
			array('email, cp_email', 'email'),
			array('email', 'unique'),
			array('cp_email', 'length', 'max'=>40),
			array('postal_code, cp_postal_code', 'length', 'max'=>5),
			array('company_logo', 'length', 'max'=>100),
			array('company_logo_file', 'file', 'types' => 'jpg, jpeg, png, gif', 'on'=>'step1', 'allowEmpty'=>true),
			array('swt_users_id', 'length', 'max'=>11),
			array('company_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, company_desc, address, city_id, province_id, country_code, phone_no1, phone_no2, postal_code, fax, email, website, ccn_employer_industry_id, contact_person, cp_phone, cp_mobile, cp_email, cp_address, cp_city_id, cp_province_id, cp_country_code, cp_postal_code, company_logo, swt_users_id, group, industry_search, city_search', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'cpCity' => array(self::BELONGS_TO, 'CcnCity', 'cp_city_id'),
			'city' => array(self::BELONGS_TO, 'CcnCity', 'city_id'),
			'cpCountryCode' => array(self::BELONGS_TO, 'CcnCountry', 'cp_country_code'),
			'country' => array(self::BELONGS_TO, 'CcnCountry', 'country_code'),
			'employer_industry' => array(self::BELONGS_TO, 'CcnEmployerIndustry', 'ccn_employer_industry_id'),
			'cpProvince' => array(self::BELONGS_TO, 'CcnProvince', 'cp_province_id'),
			'province' => array(self::BELONGS_TO, 'CcnProvince', 'province_id'),
			'users' => array(self::BELONGS_TO, 'CcnUsers', 'swt_users_id'),
			'employer_group'	=> array(self::BELONGS_TO, 'CcnEmployerGroup', 'group')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label','ID'),
			'name' => Yii::t('label','Nama Perusahaan'),
			'company_desc' => Yii::t('label','Deskripsi Perusahaan'),
			'address' => Yii::t('label','Alamat'),
			'city_id' => Yii::t('label','Kota'),
			'province_id' => Yii::t('label','Provinsi'),
			'country_code' => Yii::t('label','Negara'),
			'phone_no1' => Yii::t('label','Telepon 1'),
			'phone_no2' => Yii::t('label','Telepon 2'),
			'postal_code' => Yii::t('label','Kode Pos'),
			'fax' => Yii::t('label','Faks.'),
			'email' => Yii::t('label','Email'),
			'website' => Yii::t('label','Website'),
			'ccn_employer_industry_id' => Yii::t('label','Jenis Industri'),
			'contact_person' => Yii::t('label','Nama Kontak'),
			'cp_phone' => Yii::t('label','Nomer Telepon'),
			'cp_mobile' => Yii::t('label','Nomer Handphone'),
			'cp_email' => Yii::t('label','Email'),
			'cp_address' => Yii::t('label','Alamat'),
			'cp_city_id' => Yii::t('label','Kota'),
			'cp_province_id' => Yii::t('label','Provinsi'),
			'cp_country_code' => Yii::t('label','Negara'),
			'cp_postal_code' => Yii::t('label','Kode Pos'),
			'company_logo' => Yii::t('label','Logo Perusahaan'),
			'company_logo_file'	=> Yii::t('label','Logo Perusahaan'),
			'swt_users_id' => Yii::t('label','Nama Pengguna'),
			'group' => Yii::t('label','Grup Perusahaan'),
			'industry_search'	=> Yii::t('label','Jenis Industry'),
			'city_search'	=> Yii::t('label','Kota')
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('company_desc',$this->company_desc,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('phone_no1',$this->phone_no1,true);
		$criteria->compare('phone_no2',$this->phone_no2,true);
		$criteria->compare('postal_code',$this->postal_code,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('ccn_employer_industry_id',$this->ccn_employer_industry_id,true);
		$criteria->compare('contact_person',$this->contact_person,true);
		$criteria->compare('cp_phone',$this->cp_phone,true);
		$criteria->compare('cp_mobile',$this->cp_mobile,true);
		$criteria->compare('cp_email',$this->cp_email,true);
		$criteria->compare('cp_address',$this->cp_address,true);
		$criteria->compare('cp_city_id',$this->cp_city_id);
		$criteria->compare('cp_province_id',$this->cp_province_id);
		$criteria->compare('cp_country_code',$this->cp_country_code,true);
		$criteria->compare('cp_postal_code',$this->cp_postal_code,true);
		$criteria->compare('company_logo',$this->company_logo,true);
		$criteria->compare('swt_users_id',$this->swt_users_id,true);
		$criteria->compare('group',$this->group,true);

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
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'company_desc';
			$this->defaultColumns[] = 'address';
			$this->defaultColumns[] = 'city_id';
			$this->defaultColumns[] = 'province_id';
			$this->defaultColumns[] = 'country_code';
			$this->defaultColumns[] = 'phone_no1';
			$this->defaultColumns[] = 'phone_no2';
			$this->defaultColumns[] = 'postal_code';
			$this->defaultColumns[] = 'fax';
			$this->defaultColumns[] = 'email';
			$this->defaultColumns[] = 'website';
			$this->defaultColumns[] = 'ccn_employer_industry_id';
			$this->defaultColumns[] = 'contact_person';
			$this->defaultColumns[] = 'cp_phone';
			$this->defaultColumns[] = 'cp_mobile';
			$this->defaultColumns[] = 'cp_email';
			$this->defaultColumns[] = 'cp_address';
			$this->defaultColumns[] = 'cp_city_id';
			$this->defaultColumns[] = 'cp_province_id';
			$this->defaultColumns[] = 'cp_country_code';
			$this->defaultColumns[] = 'cp_postal_code';
			$this->defaultColumns[] = 'company_logo';
			$this->defaultColumns[] = 'swt_users_id';
			$this->defaultColumns[] = 'group';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		$image = Yii::app()->getBaseUrl(true)."/media/logo/".$data->company_logo;
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = array(
				'header'	=> 'Logo Perusahaan',
				'value'		=> 'Yii::app()->getBaseUrl(true)."/media/logo/".$data->company_logo',
				'type'		=> 'image',
				'htmlOptions' => array('class' => 'center')
			);
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = array(
				'header'	=> 'Kota',
				'value'		=> '$data->city0->name',
				'name'		=> 'city_id'
			);
			$this->defaultColumns[] = array(
				'header'	=> 'Negara',
				'value'		=> '$data->cpCountryCode->name',
				'name'		=> 'country_code'
			);
			$this->defaultColumns[] = array(
				'header'	=> 'Industri',
				'value'		=> '$data->ccnEmployerIndustry->name'
			);'ccn_employer_industry_id';
		}
		parent::afterConstruct();
	}
	
	/**
	 * Get id pk
	 *	@param int user_id
	 *	@return int id
	 */
	 public function getEmployerId($userId) {
		$model = self::model()->findByAttributes(array('swt_users_id'=>$userId), 
						array('select'=>'id'));
		return ($model != null ? $model->id : null);
	 }

	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
			//	$this->swt_users_id = Yii::app()->user->id_user;
			}
		}
		return true;
	}

	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->cp_city_id = $this->city_id;
				$this->cp_province_id = $this->province_id;
				$this->cp_country_code = $this->country_code;
			}else{
				//upload employer logo
				if($_GET['step'] == 2){
					//file_put_contents('ckakaka.txt','hihihi');
					$image = CUploadedFile::getInstance($this, 'company_logo_file');
					if($image != null){
						//file_put_contents('hahaha.txt','hihihi');
						Yii::import('ext.phpThumb.PhpThumbFactory');
						$imagePathSmall = YiiBase::getPathOfAlias('webroot.images.member_upload.employer.small');
						$imagePathMedium = YiiBase::getPathOfAlias('webroot.images.member_upload.employer.medium');
						$imagePathLarge = YiiBase::getPathOfAlias('webroot.images.member_upload.employer.large');
						
						$fileName = time().$image->getName();
						
						$saveBanner = $image->saveAs($imagePathSmall.'/'.$fileName);
						
						@chmod($imagePathSmall.'/'.$fileName, 0777);
						/* @chmod($imagePathMedium.'/'.$fileName, 0777);
						@chmod($imagePathLarge.'/'.$fileName, 0777); */
						
						$options = array('jpegQuality' => 90);
						$thumb = PhpThumbFactory::create($imagePathSmall.'/'.$fileName, $options);
						/* $thumbMedium = PhpThumbFactory::create($imagePathMedium.'/'.$fileName, $options);
						$thumbSmall = PhpThumbFactory::create($imagePathSmall.'/'.$fileName, $options); */
						
						//delete origina image
						@unlink($imagePathSmall.'/'.$fileName);
						
						$thumb->adaptiveResize(120, 120);
						$thumb->save($imagePathLarge.'/large_'.$fileName);
						
						$thumb->adaptiveResize(100, 100);
						$thumb->save($imagePathMedium.'/medium_'.$fileName);
						
						$thumb->adaptiveResize(80, 80);
						$thumb->save($imagePathSmall.'/small_'.$fileName);
						
						$this->company_logo = $fileName;
						/* if(!$this->isNewRecord){
							@unlink($imagePath.'/'.$this->oldBanner);
						} */
					}
				}
				
			}
		}
		return true;
	}
	
	public static function publicationRemain($id) {
		$packageModel	= CcnEmployerPackage::model()->find('swt_users_id = '.$id);
		$packageName	= $packageModel->vacancy_package->name;
		$postAmount		= $packageModel->vacancy_package->post_amount;
		$monthDuration	= $packageModel->vacancy_package->month_duration;
		
		if ($packageModel == null)
			return 'Belum memiliki paket publikasi, silakan hubungi administrator';
		else {
			$packageStart	= $packageModel->created;
			$expirationType	= $packageModel->vacancy_package->expiration_type;
			if ($expirationType == 'post') {
			
				/* $countUsed		= "SELECT COUNT(swt_users_id)
									FROM ccn_employer_vacancy
									WHERE swt_users_id = ".$id." AND update_date >= '".$packageStart."'";
				$countPost		= Yii::app()->db->createCommand($countUsed)->queryScalar(); */
				
				$postRemain		= $packageModel->post_left;//$postAmount - $countPost <= 0 ? 0 : $postAmount - $countPost;
				$message		= $postRemain == 10000 ? 'Unlimited' : $postRemain.' pos dari maksimal '.$postAmount.' pos';
				
				$publicationData = array(
					'package'	=> $packageName,
					'message'	=> $message,
					'type'		=> $expirationType,
					'amount'	=> $postAmount,
					'remain'	=> $postRemain
				);
				return $publicationData;
			} else {
				$dayDuration	= 30 * $monthDuration;
				$timeRemain		= $dayDuration - Utility::dateInterval($packageStart, date('Y-m-d H:i:s'));
				$dayRemain		= $packageModel->day_left;//$timeRemain < 0 ? 0 : $timeRemain;
				
				
				$message		= $dayRemain == 10000 ? 'Unlimited' : $dayRemain.' hari dari maksimal '.$dayDuration.' hari';
				
				$publicationData = array(
					'package'	=> $packageName,
					'message'	=> $message,
					'type'		=> $expirationType,
					'amount'	=> $dayDuration,
					'remain'	=> $dayRemain
				);
				return $publicationData;
			}
		}
	}

}