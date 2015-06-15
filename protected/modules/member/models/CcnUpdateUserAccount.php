<?php

/**
 * This is the model class for table "swt_users".
 *
 * The followings are the available columns in table 'swt_users':
 * @property string $id
 * @property integer $users_group_id
 * @property integer $actived
 * @property integer $status_user
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $block
 * @property string $register_date
 * @property string $last_visit_date
 * @property string $activation
 * @property string $activation_date
 * @property integer $is_online
 * @property string $photo
 * @property string $mobile_no
 * @property string $params
 *
 * The followings are the available model relations:
 * @property CcnEmployerData[] $ccnEmployerDatas
 * @property CcnEmployerGroupList[] $ccnEmployerGroupLists
 * @property CcnEmployerPackage[] $ccnEmployerPackages
 * @property CcnEmployerSubscribe[] $ccnEmployerSubscribes
 * @property CcnJobseekerAward[] $ccnJobseekerAwards
 * @property CcnJobseekerBio[] $ccnJobseekerBios
 * @property CcnJobseekerEdu[] $ccnJobseekerEdus
 * @property CcnJobseekerExp[] $ccnJobseekerExps
 * @property CcnJobseekerLang[] $ccnJobseekerLangs
 * @property CcnJobseekerOrg[] $ccnJobseekerOrgs
 * @property CcnJobseekerPositive[] $ccnJobseekerPositives
 * @property CcnJobseekerReference[] $ccnJobseekerReferences
 * @property CcnJobseekerSkill[] $ccnJobseekerSkills
 * @property CcnJobseekerSubscribe[] $ccnJobseekerSubscribes
 * @property CcnJobseekerToefl[] $ccnJobseekerToefls
 * @property CcnJobseekerTraining[] $ccnJobseekerTrainings
 * @property CcnJobseekerUpdate[] $ccnJobseekerUpdates
 * @property CcnLogAdminSummary[] $ccnLogAdminSummaries
 * @property CcnTestCall[] $ccnTestCalls
 * @property CcnTracerIn[] $ccnTracerIns
 * @property SwtContent[] $swtContents
 * @property SwtContent[] $swtContents1
 * @property SwtUsersGroup $usersGroup
 */
class CcnUpdateUserAccount extends CActiveRecord
 {
	public $defaultColumns = array();
	public $oldPassword;
	public $retypePassword;
	public $newPassword;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnUpdateUserAccount the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'swt_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_group_id, actived, register_date, last_visit_date', 'required'),
			array('users_group_id, actived, status_user, block, is_online', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('oldPassword, newPassword, retypePassword', 'required', 'on'=>'editAcount'),
			array('oldPassword', 'checkOldPassword', 'on'=>'editAcount'),
			array('username', 'length', 'max'=>150),
			array('password, email, newPassword', 'length', 'max'=>100),
			array('oldPassword, retypePassword, newPassword', 'alphaNumeric'),
			array('oldPassword, retypePassword, newPassword', 'length', 'min'=>6),
			array('activation', 'length', 'max'=>32),
			array('photo', 'length', 'max'=>80),
			array('mobile_no', 'length', 'max'=>15),
			array('activation_date', 'safe'),
			array('retypePassword', 'compare', 'compareAttribute' => 'newPassword', 
				'message' => 'Ulangi password tidak sesuai dengan password baru.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, users_group_id, actived, status_user, name, username, password, email, block, register_date, last_visit_date, activation, activation_date, is_online, photo, mobile_no, params', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ccn_employer_datas' => array(self::HAS_MANY, 'CcnEmployerData', 'swt_users_id'),
			'ccn_employer_group_lists' => array(self::HAS_MANY, 'CcnEmployerGroupList', 'swt_users_id'),
			'ccn_employer_packages' => array(self::HAS_MANY, 'CcnEmployerPackage', 'swt_users_id'),
			'ccn_employer_subscribes' => array(self::HAS_MANY, 'CcnEmployerSubscribe', 'swt_users_id'),
			'ccn_jobseeker_awards' => array(self::HAS_MANY, 'CcnJobseekerAward', 'swt_users_id'),
			'ccn_jobseeker_bios' => array(self::HAS_MANY, 'CcnJobseekerBio', 'swt_users_id'),
			'ccn_jobseeker_edus' => array(self::HAS_MANY, 'CcnJobseekerEdu', 'swt_users_id'),
			'ccn_jobseeker_exps' => array(self::HAS_MANY, 'CcnJobseekerExp', 'swt_users_id'),
			'ccn_jobseeker_langs' => array(self::HAS_MANY, 'CcnJobseekerLang', 'swt_users_id'),
			'ccn_jobseeker_orgs' => array(self::HAS_MANY, 'CcnJobseekerOrg', 'swt_users_id'),
			'ccn_jobseeker_positives' => array(self::HAS_MANY, 'CcnJobseekerPositive', 'swt_users_id'),
			'ccn_jobseeker_references' => array(self::HAS_MANY, 'CcnJobseekerReference', 'swt_users_id'),
			'ccn_jobseeker_skills' => array(self::HAS_MANY, 'CcnJobseekerSkill', 'swt_users_id'),
			'ccn_jobseeker_subscribes' => array(self::HAS_MANY, 'CcnJobseekerSubscribe', 'swt_users_id'),
			'ccn_jobseeker_toefls' => array(self::HAS_MANY, 'CcnJobseekerToefl', 'swt_users_id'),
			'ccn_jobseeker_trainings' => array(self::HAS_MANY, 'CcnJobseekerTraining', 'swt_users_id'),
			'ccn_jobseeker_updates' => array(self::HAS_MANY, 'CcnJobseekerUpdate', 'swt_users_id'),
			'ccn_log_admin_summaries' => array(self::HAS_MANY, 'CcnLogAdminSummary', 'swt_users_id'),
			'ccn_test_calls' => array(self::HAS_MANY, 'CcnTestCall', 'swt_users_id'),
			'ccn_tracer_ins' => array(self::HAS_MANY, 'CcnTracerIn', 'swt_users_id'),
			'swt_contents' => array(self::HAS_MANY, 'SwtContent', 'created_by'),
			'swt_contents1' => array(self::HAS_MANY, 'SwtContent', 'modified_by'),
			'users_group' => array(self::BELONGS_TO, 'SwtUsersGroup', 'users_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'users_group_id' => Yii::t('label', 'Grup User'),
			'actived' => Yii::t('label', 'Aktif'),
			'status_user' => Yii::t('label', 'Status User'),
			'name' => Yii::t('label', 'Nama'),
			'username' => Yii::t('label', 'Username'),
			'password' => Yii::t('label', 'Password'),
			'retypePassword' => Yii::t('label', 'Ulangi Password'),
			'newPassword' => Yii::t('label', 'Password baru'),
			'email' => Yii::t('label', 'Email'),
			'block' => Yii::t('label', 'Blok'),
			'register_date' => Yii::t('label', 'Tanggal Registrasi'),
			'last_visit_date' => Yii::t('label', 'Kunjungan Terakhir'),
			'activation' => Yii::t('label', 'Kode Aktivasi'),
			'activation_date' => Yii::t('label', 'Tanggal Aktivasi'),
			'is_online' => Yii::t('label', 'Online'),
			'photo' => Yii::t('label', 'Foto'),
			'mobile_no' => Yii::t('label', 'No. HP'),
			'params' => Yii::t('label', 'Params'),
			'oldPassword' => Yii::t('label', 'Katasandi lama'),
			'retypePassword' => Yii::t('label', 'Ulangi katasandi'),
			'newPassword' => Yii::t('label', 'Katasandi baru'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('users_group_id',$this->users_group_id);
		$criteria->compare('actived',$this->actived);
		$criteria->compare('status_user',$this->status_user);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('block',$this->block);
		$criteria->compare('register_date',$this->register_date,true);
		$criteria->compare('last_visit_date',$this->last_visit_date,true);
		$criteria->compare('activation',$this->activation,true);
		$criteria->compare('activation_date',$this->activation_date,true);
		$criteria->compare('is_online',$this->is_online);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('mobile_no',$this->mobile_no,true);
		$criteria->compare('params',$this->params,true);

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
			$this->defaultColumns[] = 'users_group_id';
			$this->defaultColumns[] = 'actived';
			$this->defaultColumns[] = 'status_user';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'username';
			$this->defaultColumns[] = 'password';
			$this->defaultColumns[] = 'email';
			$this->defaultColumns[] = 'block';
			$this->defaultColumns[] = 'register_date';
			$this->defaultColumns[] = 'last_visit_date';
			$this->defaultColumns[] = 'activation';
			$this->defaultColumns[] = 'activation_date';
			$this->defaultColumns[] = 'is_online';
			$this->defaultColumns[] = 'photo';
			$this->defaultColumns[] = 'mobile_no';
			$this->defaultColumns[] = 'params';
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
			$this->defaultColumns[] = 'users_group_id';
			$this->defaultColumns[] = 'actived';
			$this->defaultColumns[] = 'status_user';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'username';
			$this->defaultColumns[] = 'password';
			$this->defaultColumns[] = 'email';
			$this->defaultColumns[] = 'block';
			$this->defaultColumns[] = 'register_date';
			$this->defaultColumns[] = 'last_visit_date';
			$this->defaultColumns[] = 'activation';
			$this->defaultColumns[] = 'activation_date';
			$this->defaultColumns[] = 'is_online';
			$this->defaultColumns[] = 'photo';
			$this->defaultColumns[] = 'mobile_no';
			$this->defaultColumns[] = 'params';
		}
		parent::afterConstruct();
	}
	
	/**
	 * check old Password call from rule
	 */
	public function checkOldPassword($attribute) {
		if(!empty($this->oldPassword)) {
			$id = Yii::app()->user->id_user;
			$model=CcnUpdateUserAccount::model()->findByPk($id);
			if($model->password !== $this->hashPassword($this->oldPassword)){
				$this->addError($attribute, Yii::t('error','Password anda salah'));
			}
		}
	} 
	
	/**
	 * check whether password is using alpha and numeric combination
	 */
	public function alphaNumeric($attribute){
		$pattern = '/^.*(?=.*[a-zA-Z])[a-zA-Z0-9]+$/';
		if ($this->$attribute) {
			if(!preg_match($pattern, $this->$attribute))
				$this->addError($attribute, Yii::t('', 'Kombinasi password yang diperbolehkan berupa karakter huruf dan angka'));
		}
	}
	
	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		$salt = self::getSalt();
		return md5($salt.$password);
	}
	
	/**
	 * Get salt
	 */
	public function getSalt() {
		return Yii::app()->dbparams->auth_salt;
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
	


}