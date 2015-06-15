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
 * @property CcnJobseekerAward[] $ccnJobseekerAwards
 * @property CcnJobseekerBio[] $ccnJobseekerBios
 * @property CcnJobseekerEdu[] $ccnJobseekerEdus
 * @property CcnJobseekerExp[] $ccnJobseekerExps
 * @property CcnJobseekerLang[] $ccnJobseekerLangs
 * @property CcnJobseekerOrg[] $ccnJobseekerOrgs
 * @property CcnJobseekerPositive[] $ccnJobseekerPositives
 * @property CcnJobseekerReference[] $ccnJobseekerReferences
 * @property CcnJobseekerSkill[] $ccnJobseekerSkills
 * @property CcnJobseekerToefl[] $ccnJobseekerToefls
 * @property CcnJobseekerTraining[] $ccnJobseekerTrainings
 * @property CcnJobseekerUpdate[] $ccnJobseekerUpdates
 * @property CcnLogAdminSummary[] $ccnLogAdminSummaries
 * @property CcnSubscribeContent[] $ccnSubscribeContents
 * @property CcnSubscribeTestCall[] $ccnSubscribeTestCalls
 * @property CcnSubscribeVacancyJobseeker[] $ccnSubscribeVacancyJobseekers
 * @property CcnTestCall[] $ccnTestCalls
 * @property CcnTracerIn[] $ccnTracerIns
 * @property SwtContent[] $swtContents
 * @property SwtContent[] $swtContents1
 * @property SwtUsersGroup $usersGroup
 */
class CcnEditAdminAccount extends CActiveRecord
 {
	public $defaultColumns = array();
	public $old_password;
	public $new_password;
	public $retype_new_password;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnEditAdminAccount the static model class
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
			array('old_password, new_password, retype_new_password', 'required', 'on'=>'editPassword'),
			array('username, email, name', 'required', 'on'=>'editAccount'),
			array('old_password', 'isValidOldPassword', 'on'=>'editPassword'),
			array('old_password, new_password, retype_new_password, password', 'alphaNumeric'),
			array('old_password, new_password, retype_new_password, password', 'length', 'min'=>6),
			array('retype_new_password', 'compare', 'compareAttribute' => 'new_password', 
				'message' => 'Ulangi password tidak sesuai dengan password baru.'),
		 	
			array('mobile_no', 'numerical', 'integerOnly'=>true,
				'message' => '{attribute} harus berupa angka'),
			array('username', 'length', 'max'=>150),
			array('email', 'email'),
			array('email', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('old_password, new_password, retype_new_password, username, email, name, mobile_no', 'safe'),
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
			'ccn_jobseeker_awards' => array(self::HAS_MANY, 'CcnJobseekerAward', 'swt_users_id'),
			'ccn_jobseeker_bios' => array(self::HAS_MANY, 'CcnJobseekerBio', 'swt_users_id'),
			'ccn_jobseeker_edus' => array(self::HAS_MANY, 'CcnJobseekerEdu', 'swt_users_id'),
			'ccn_jobseeker_exps' => array(self::HAS_MANY, 'CcnJobseekerExp', 'swt_users_id'),
			'ccn_jobseeker_langs' => array(self::HAS_MANY, 'CcnJobseekerLang', 'swt_users_id'),
			'ccn_jobseeker_orgs' => array(self::HAS_MANY, 'CcnJobseekerOrg', 'swt_users_id'),
			'ccn_jobseeker_positives' => array(self::HAS_MANY, 'CcnJobseekerPositive', 'swt_users_id'),
			'ccn_jobseeker_references' => array(self::HAS_MANY, 'CcnJobseekerReference', 'swt_users_id'),
			'ccn_jobseeker_skills' => array(self::HAS_MANY, 'CcnJobseekerSkill', 'swt_users_id'),
			'ccn_jobseeker_toefls' => array(self::HAS_MANY, 'CcnJobseekerToefl', 'swt_users_id'),
			'ccn_jobseeker_trainings' => array(self::HAS_MANY, 'CcnJobseekerTraining', 'swt_users_id'),
			'ccn_jobseeker_updates' => array(self::HAS_MANY, 'CcnJobseekerUpdate', 'swt_users_id'),
			'ccn_log_admin_summaries' => array(self::HAS_MANY, 'CcnLogAdminSummary', 'swt_users_id'),
			'ccn_subscribe_contents' => array(self::HAS_MANY, 'CcnSubscribeContent', 'swt_users_id'),
			'ccn_subscribe_test_calls' => array(self::HAS_MANY, 'CcnSubscribeTestCall', 'swt_users_id'),
			'ccn_subscribe_vacancy_jobseekers' => array(self::HAS_MANY, 'CcnSubscribeVacancyJobseeker', 'swt_users_id'),
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
			'name' => Yii::t('label', 'Nama'),
			'username' => Yii::t('label', 'Username'),
			'password' => Yii::t('label', 'Password'),
			'email' => Yii::t('label', 'Email'),
			'old_password' => Yii::t('label', 'Password Lama'),
			'new_password' => Yii::t('label', 'Password Baru'),
			'retype_new_password' => Yii::t('label', 'Ketikkan Password Baru'),
			
		);
	}
	
	/**
	 * Check, whether old password is really the old password
	 */
	public function isValidOldPassword($attribute) {

		$hash	= CcnUsers::model()->hashPassword($this->$attribute);

		if ($this->password != $hash)
			$this->addError($attribute, Yii::t('', 'Password lama yang dimasukkan salah'));

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
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->scenario == 'editPassword')
				$this->password 	= CcnUsers::model()->hashPassword($this->retype_new_password);			
		}
		return true;
	}

}