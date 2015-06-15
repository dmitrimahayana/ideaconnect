<?php

/**
 * This is the model class for table "swt_users".
 *
 * The followings are the available columns in table 'swt_users':
 * @property string $id
 * @property integer $users_group_id
 * @property integer $actived
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
 * @property CcnAlumni[] $ccnAlumnis
 * @property CcnConfirm[] $ccnConfirms
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
 * @property status_user etc: 0 after register, 1= active email, 2 = payment, 3 = approval admin, 4 = fill biodata cv, 5= fill education cv
 */
class CcnUsers extends CActiveRecord
{
	public $defaultColumns = array();
	public $old_password;
	public $new_password;
	public $retype_new_password;
	public $retypePassword;
	public $member_type;
	public $nim;
	public $first_name;
	public $oldPhoto;
	public $statistic_member_signal = false;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PcrUsers the static model class
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
		return 'swt_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_group_id, actived, register_date', 'required', 'on' => 'addEmployer, addJobseeker, addJobseekerAlumni, addAdmin'),
			array('email', 'required', 'on' => 'addEmployer, forgot, addJobseeker, addJobseekerAlumni, addAdmin'),
			array('name', 'required', 'on'=>'addAdmin'),
			array('username, mobile_no', 'required', 'on'=>'addAdmin'),
			array('mobile_no', 'required', 'on'=>'addJobseeker'),
			array('nim, first_name, mobile_no', 'required', 'on'=>'addJobseekerAlumni'),
			array('users_group_id, actived, status_user, block, is_online, mobile_no, member_type', 'numerical', 'integerOnly'=>true,
				'message' => '{attribute} harus berupa angka'),
			array('name', 'length', 'max'=>255),
			array('username', 'length', 'max'=>150),
			array('password, email, activation', 'length', 'max'=>100),
			array('email', 'unique', 'on' => 'addEmployer, addJobseeker, addJobseekerAlumni'),
			array('email', 'email'),
			array('nim', 'checkNimAlumni', 'on'=>'addJobseekerAlumni'),
			array('first_name', 'checkNameAlumni', 'on'=>'addJobseekerAlumni'),
			//array('email', 'checkDomainEmail'),
			//array('name, email, username, mobile_no', 'required', 'on'=>'editAccount'),
			array('old_password, new_password, retype_new_password', 'required', 'on'=>'editPassword'),
			array('old_password', 'isValidOldPassword', 'on'=>'editPassword'),
			array('password, retypePassword', 'required', 'on'=>'addEmployer, addJobseeker, addJobseekerAlumni, addAdmin'),
			array('old_password, new_password, retype_new_password, password, retypePassword', 'alphaNumeric'),
			array('old_password, new_password, retype_new_password, password, retypePassword', 'length', 'min'=>6),
			//array('retypePassword', 'compare', 'compareAttribute' => 'password', 
			//	'message' => 'Ulangi password tidak sesuai dengan password baru.'),
			array('photo', 'length', 'max'=>80),
			array('mobile_no', 'length', 'max'=>15),
			array('activation_date, nim, first_name', 'safe'),
			array('statistic_member_signal','boolean'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, users_group_id, actived, name, username, password, email, block, register_date, last_visit_date, activation, activation_date, is_online, photo, mobile_no, params', 'safe', 'on'=>'search'),
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
			'alumni' => array(self::HAS_MANY, 'CcnAlumni', 'swt_users_id'),
			'alumni1'	=> array(self::HAS_ONE, 'CcnAlumni', 'swt_users_id'),
			'ccnConfirms' => array(self::HAS_MANY, 'CcnConfirm', 'swt_users_id'),
			'ccnConfirms1' => array(self::HAS_ONE, 'CcnConfirm', 'swt_users_id'),
			'employer_data' => array(self::HAS_MANY, 'CcnEmployerData', 'swt_users_id'),
			'employer_data1' => array(self::HAS_ONE, 'CcnEmployerData', 'swt_users_id'),
			'ccnEmployerGroupLists' => array(self::HAS_MANY, 'CcnEmployerGroupList', 'swt_users_id'),
			'employer_packages' => array(self::HAS_ONE, 'CcnEmployerPackage', 'swt_users_id'),
			'ccnEmployerSubscribes' => array(self::HAS_MANY, 'CcnEmployerSubscribe', 'swt_users_id'),
			'jobseeker_award' => array(self::HAS_MANY, 'CcnJobseekerAward', 'swt_users_id'),
			'jobseeker_bio' => array(self::HAS_MANY, 'CcnJobseekerBio', 'swt_users_id'),
			'jobseeker_bio1' => array(self::HAS_ONE, 'CcnJobseekerBio', 'swt_users_id'),
			'jobseeker_edu' => array(self::HAS_MANY, 'CcnJobseekerEdu', 'swt_users_id'),
			'jobseeker_edu1' => array(self::HAS_ONE, 'CcnJobseekerEdu', 'swt_users_id'),
			'jobseeker_exp' => array(self::HAS_MANY, 'CcnJobseekerExp', 'swt_users_id'),
			'jobseeker_exp1' => array(self::HAS_ONE, 'CcnJobseekerExp', 'swt_users_id'),
			'jobseeker_lang' => array(self::HAS_MANY, 'CcnJobseekerLang', 'swt_users_id'),
			'jobseeker_org' => array(self::HAS_MANY, 'CcnJobseekerOrg', 'swt_users_id'),
			'jobseeker_org1' => array(self::HAS_ONE, 'CcnJobseekerOrg', 'swt_users_id'),
			'jobseeker_positive' => array(self::HAS_MANY, 'CcnJobseekerPositive', 'swt_users_id'),
			'jobseeker_reference' => array(self::HAS_MANY, 'CcnJobseekerReference', 'swt_users_id'),
			'jobseeker_skill' => array(self::HAS_MANY, 'CcnJobseekerSkill', 'swt_users_id'),
			'jobseeker_skill1' => array(self::HAS_ONE, 'CcnJobseekerSkill', 'swt_users_id'),
			'jobseeker_subscribe' => array(self::HAS_MANY, 'CcnJobseekerSubscribe', 'swt_users_id'),
			'jobseeker_toefl' => array(self::HAS_MANY, 'CcnJobseekerToefl', 'swt_users_id'),
			'jobseeker_toefl1' => array(self::HAS_ONE, 'CcnJobseekerToefl', 'swt_users_id'),
			'jobseeker_training' => array(self::HAS_MANY, 'CcnJobseekerTraining', 'swt_users_id'),
			'jobseeker_update' => array(self::HAS_MANY, 'CcnJobseekerUpdate', 'swt_users_id'),
			'ccnLogAdminSummaries' => array(self::HAS_MANY, 'CcnLogAdminSummary', 'swt_users_id'),
			'test_calls' => array(self::HAS_MANY, 'CcnTestCall', 'swt_users_id'),
			'ccnTracerIns' => array(self::HAS_MANY, 'CcnTracerIn', 'swt_users_id'),
			'swtContents' => array(self::HAS_MANY, 'SwtContent', 'created_by'),
			'swtContents1' => array(self::HAS_MANY, 'SwtContent', 'modified_by'),
			'users_group' => array(self::BELONGS_TO, 'UsersGroup', 'users_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'users_group_id' => Yii::t('label','Tipe Member'),
			'actived' => Yii::t('label','Aktif'),
			'name' => Yii::t('label','Nama'),
			'username' => Yii::t('label','Username'),
			'password' => Yii::t('label','Password'),
			'old_password'	=> Yii::t('label', 'Password Lama'),
			'new_password'	=> Yii::t('label', 'Password Baru'),
			'retype_new_password'	=> Yii::t('label', 'Ulangi Password Baru'),
			'retypePassword' => Yii::t('label','Ulangi Password'),
			'member_type' => Yii::t('label', 'Tipe Keanggotaan'),
			'nim' => Yii::t('label','NIM'),
			'first_name' => Yii::t('label', 'Nama Depan'),
			'email' => Yii::t('label','Email'),
			'block' => Yii::t('label','Diblok'),
			'register_date' => Yii::t('label','Tanggal Gabung'),
			'last_visit_date' => Yii::t('label','Last Visit Date'),
			'activation' => Yii::t('label','Activation'),
			'activation_date' => Yii::t('label','Tanggal Gabung'),
			'is_online' => Yii::t('label','Is Online'),
			'photo' => Yii::t('label','Photo'),
			'mobile_no' => Yii::t('label','Nomer HP'),
			'params' => Yii::t('label','Params'),
			'status_user' => Yii::t('label','Status'),
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
		$criteria->compare('users_group_id',$this->users_group_id);
		$criteria->compare('actived',$this->actived);
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
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'username';
			//$this->defaultColumns[] = 'password';
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
			if($_GET['gid'] == 6) {
				$this->defaultColumns[] = 'employer_data1.name';
			}
			$this->defaultColumns[] = 'email';
			if($_GET['gid'] == 5) {
				$this->defaultColumns[] = 'mobile_no';
			}
			$this->defaultColumns[] = array(
				'header'	=> 'Tanggal Gabung',
				'value'		=> 'date("d-m-Y", strtotime(substr($data->register_date, 0, 10)))',
				'htmlOptions' => array('class' => 'center')
			); 
			$this->defaultColumns[] = array(
				'value'		=> '$data->actived == 1 ? Utility::getPublishedToImg($data->actived) : CHtml::link(Utility::getPublishedToImg($data->actived), AdminController::activateUrl($_GET[id], $data->primaryKey))',
				'type'		=> 'raw',
				'htmlOptions' => array(
					'class' => 'center',
				),
			);
			$this->defaultColumns[] = array(
				'value'		=> 'CHtml::link(
					Utility::getPublishedToImg($data->block), $data->block == 1 ? AdminController::cancelApprovalUrl($_GET[id], $data->primaryKey) : 
					AdminController::ApproveUrl($_GET[id], $data->primaryKey),
					array(
						\'class\' => \'approve\',
						\'onclick\' =>
							$data->block == 1 ? \'if(!confirm("Yakin ingin mengeblok member ini?")){return false;}\' :
							\'if(!confirm("Yakin ingin meng-approve member ini?")){return false;}\'
					)
				)',
				'type'		=> 'raw',
				'htmlOptions' => array(
					'class' => 'center',
				),
			);
			
			//$this->defaultColumns[] = array();
		}
		parent::afterConstruct();
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			$current = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
			if($this->isNewRecord) {
				if($current == 'site/forgot'){
					$user = self::model()->findByAttributes(array('email'=>$this->email));
					if($user == null){
						$this->addError('email',Yii::t('', 'Maaf email Anda tidak ditemukan dalam database kami. Cek sekali lagi penulisannya.'));
					}
				}
				$this->register_date = date('Y-m-d H:i:s');
				if(Yii::app()->controller->id != 'adminbackoffice')
					$this->actived = 0;
				/*
				if($_GET['gid']== 0){
					$this->users_group_id = $this->users_group_id ;
				} else{
					if ($_GET['gid'] == 5) {
						if ($this->member_type = 4)
							$this->users_group_id = 4;
						else
							$this->users_group_id = 5;
					} else
						$this->users_group_id = 6;
				} */
				
			} else {
				if ($this->scenario == 'editAccount') { //(($current == 'adminbackoffice/admineditedit') && ($_GET['type'] == 'account')) {
					echo 'edit akun';
					echo $_GET['type'];
					//exit;
					$this->retypePassword	= $this->password;
					$this->old_password		= $this->password;
				} else if ($this->scenario == 'editPassword') { //(($current == 'adminbackoffice/admineditedit') && ($_GET['type'] == 'password')) {
					echo 'edit pass';
					exit;
					/* if($this->password == ''){
						$this->addError('password',Yii::t('', 'Password tidak boleh kosong.'));
					}
					if($this->retypePassword == ''){
						 $this->addError('retypePassword',Yii::t('', 'Ketik ulang password tidak boleh kosong.'));
					} */
				}
			}
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if ($this->scenario != 'editAccount') {
				/* if ($this->scenario == 'editPassword')
					$this->password = $this->hashPassword($this->password);
				else {
					 */$this->password = $this->hashPassword($this->password);
			
					//upload image admin
					$image = CUploadedFile::getInstance($this, 'photo');
					if($image != Null){
						Yii::import('ext.phpThumb.PhpThumbFactory');
						$imagePath = YiiBase::getPathOfAlias('webroot.images.member_upload.admin');
						$fileName = time().'_orig_'.$image->getName();
						$savePhoto = $image->saveAs($imagePath.'/'.$fileName);
						@chmod($imagePath.'/'.$fileName, 0777);
						$options = array('jpegQuality' => 90);
						$thumb = PhpThumbFactory::create($imagePath.'/'.$fileName, $options);
						$thumb->adaptiveResize(100, 100);
						$thumb->save($imagePath.'/'.$fileName);
						$this->photo = $fileName;
						if(!$this->isNewRecord){
							@unlink($imagePath.'/'.$this->oldPhoto);
						}
					}else{
						$this->photo = $this->oldPhoto;
					}
				//}
			}			
		}
		return true;
	}
	
	/**
	 * After save attributes
	 */
	protected function afterSave() {
		parent::afterSave();
		if($this->statistic_member_signal){
			$model = CcnStatisticMember::model()->find(array(
					'condition' =>' type_id = :gid and status_user = :st_user and  months = :m and years = :y',
					'params' => array(
							':gid'=>$this->users_group_id,
							':st_user'=>$this->status_user,
							':m'=> date("m"),
							':y'=> date("Y")
						), 
				));
			//if($this->isNewRecord) {
				
				if($model != null){
					$model->total = $model->total+1;
					$model->update();
				}else{
					$model = new CcnStatisticMember;
					$model->type_id = $this->users_group_id;
					$model->status_user = $this->status_user;
					$model->months = date("m");
					$model->years = date("Y");
					$model->total = 1;
					$model->save();
				}
		//}
		}
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password) === $this->password;
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
	 * Check, whether old password is really the old password
	 */
	public function isValidOldPassword($attribute) {
		//if ($this->scenario == 'editPassword') {
			$hash	= self::hashPassword($this->$attribute);
			//$old	= self::model()->findByPk($this->id);
			if ($this->password != $hash)
				$this->addError($attribute, Yii::t('',$hash.' Password lama yang dimasukkan salah '.$this->password));
		//}
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
	 * @check domain email
	 */	
	public function checkDomainEmail($attribute,$params) {
		if(!empty($this->email)) {
			list($user, $domain) = split('@', $this->email);
			if(checkdnsrr($domain,  'MX') == false)
				$this->addError($attribute, 'Domain email Anda tidak terdaftar');
		}
	}
	
	public function checkNimAlumni($attribute,$params) {
		if(!empty($this->nim)) {
			$nim = CcnAlumni::model()->find(array(
					'condition' => 'nim = :nim',
					'params' => array(':nim' => $this->nim)
				));
			if (count($nim) == 0) {
				$this->addError('nim', Yii::t('','Maaf, NIM anda tidak ditemukan dalam database alumni PCR.'));
			}
		}
	}
	
	public function checkNameAlumni($attribute,$params) {
		if(!empty($this->first_name)) {
			$name = CcnAlumni::model()->find(array(
					'condition' => 'name LIKE LOWER(:first_name)',
					'params' => array(':first_name' => '%'.strtolower($this->first_name).'%')
				));
			if (count($name) == 0) {
				$this->addError('first_name', Yii::t('','Maaf, nama anda tidak ditemukan dalam database alumni PCR.'));
			} else {
				if ($name->swt_users_id != 0) {
					$this->addError('first_name', Yii::t('', 'Maaf data Anda terdaftar dalam database alumni PCR dan 
					Anda sudah pernah melakukan registrasi sebelumnya.'));
				}
			}
		}
	}
	
	/**
	 * @check data alumin if register as alumni pcr
	 */	
	public function checkDataAlumni($attribute,$params) {
		if(!empty($this->nim) && !empty($this->first_name)) {
			$alumni = CcnAlumni::model()->find(array(
						'condition' => 'nim = :nim AND name LIKE LOWER(:first_name)',
						'params' => array(
							':nim' => $this->nim,
							':first_name' => '%'.strtolower($this->first_name).'%'
						)
					));
			
			// if data is not exist (result = 0), add an error notification
			if (count($alumni) == 0) {
				$this->addError('nim', Yii::t('','Maaf, NIM anda tidak ditemukan dalam database alumni PCR.'));
				$this->addError('first_name', Yii::t('', 'Maaf nama Anda tidak ditemukan dalam database alumni PCR.'));
			} else {
				// If data exist, validate again..
				// If column swt_users_id on ccn_alumni was filled with != 0, it means that alumni was registered
				// before as a member jobseeker.. So, he/she can't register again and system shows an error notification
				if ($alumni->swt_users_id != 0) {
					$this->addError('first_name', Yii::t('', 'Maaf data Anda terdaftar dalam database alumni PCR dan 
					Anda sudah pernah melakukan registrasi sebelumnya.'));
				}
			}
		}
	}
	
	/**
	 * check whether password is using alpha and numeric combination
	 */
	public function isBiodataComplete($id){
		$count = CcnJobseekerBio::model()->countByAttributes(array('swt_users_id' => $id));
		
		if($count > 0)
			return true;
		else
			return false;
		
	} 
	
	/**
	 * Generate new random password
	 */
	public function generateRandomString($length = 8) {    
		$data = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		return $data;
	}

	
	/**
	 * Get status user
	 */
	public static function getStatusUser($status, $userGroup) {
		if(in_array($userGroup, array(4,5))) {
			$arrStatus = array(
				0 => Yii::t('label', 'Registrasi'),
				1 => Yii::t('label', 'Aktifasi'),
				2 => Yii::t('label', 'Konfirmasi Pembayaran'),
				3 => Yii::t('label', 'Approved'),
				4 => Yii::t('label', 'Domisili'),
				5 => Yii::t('label', 'Aktif (Data komplete)'),
				6 => Yii::t('label', 'Rejected'),
				7 => Yii::t('label', 'Blocked'),			
			);
		}elseif(in_array($userGroup, array(6))) {
			$arrStatus = array(
				0 => Yii::t('label', 'Registrasi'),
				1 => Yii::t('label', 'Aktifasi'),			
				3 => Yii::t('label', 'Approved'),
				4 => Yii::t('label', 'Data Perusahaan'),
				6 => Yii::t('label', 'Rejected'),
				7 => Yii::t('label', 'Blocked'),			
			);	
		
		}
		return $arrStatus[$status];
	
	}
}