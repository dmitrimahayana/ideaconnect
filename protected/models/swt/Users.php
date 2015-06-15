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
 * @property string $params
 * @property string $initiator_rating
 * @property string $address
 * @property string $rating
 * @property integer $regency_id
 * @property integer $province_id
 * @property string $country_id
 * @property integer $postcode
 * @property string $house_phone
 * @property string $mobile_no
 * @property integer $birth_place_id
 * @property string $birth_place_none
 * @property string $birth_date
 * @property integer $is_male
 * @property integer $religion_id
 * @property string $last_education_name
 * @property string $university_id
 * @property string $university_name
 * @property integer $faculty_id
 * @property string $faculty_name
 * @property integer $major_id
 * @property string $major_name
 * @property integer $last_education_degree_id
 * @property integer $last_education_city_id
 * @property integer $last_education_province_id
 * @property integer $project_sponsored_progress
 * @property integer $project_sponsored_success
 * @property integer $project_sponsored_failed
 * @property integer $project_initiated_progress
 * @property integer $project_initiated_success
 * @property integer $project_initiated_failed
 * @property integer $ugm_engineering_status_id
 *
 * The followings are the available model relations:
 * @property IcBadgeSome[] $icBadgeSomes
 * @property IcFtGraduate[] $icFtGraduates
 * @property IcFtStaff[] $icFtStaffs
 * @property IcFtStudent[] $icFtStudents
 * @property IcFundingUser[] $icFundingUsers
 * @property IcFundingUser[] $icFundingUsers1
 * @property IcInstitutionSome[] $icInstitutionSomes
 * @property IcMessege[] $icMesseges
 * @property IcMessege[] $icMesseges1
 * @property IcProject[] $icProjects
 * @property IcProject[] $icProjects1
 * @property IcProject[] $icProjects2
 * @property IcProjectRequisite[] $icProjectRequisites
 * @property IcRewardChoosen[] $icRewardChoosens
 * @property IcSavedContact[] $icSavedContacts
 * @property IcSavedContact[] $icSavedContacts1
 * @property IcVolunteerUser[] $icVolunteerUsers
 * @property SwtContent[] $swtContents
 * @property SwtContent[] $swtContents1
 * @property IcZoneRegency $birthPlace
 * @property IcZoneCountry $country
 * @property IcZoneRegency $lastEducationCity
 * @property IcEduDegree $lastEducationDegree
 * @property IcZoneProvince $lastEducationProvince
 * @property IcEduMajor $major
 * @property IcZoneProvince $province
 * @property IcZoneRegency $regency
 * @property IcReligion $religion
 * @property SwtUsersGroup $usersGroup
 * @property IcUgmEngineeringStatus $ugmEngineeringStatus
 * @property IcEduUniversity $university
 */
class Users extends CActiveRecord
 {
	public $defaultColumns = array();
    public $id;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
			array('users_group_id, username, password, register_date, last_visit_date, params', 'required'),
			array('users_group_id, actived, block, is_online, regency_id, province_id, postcode, birth_place_id, is_male, religion_id, faculty_id, major_id, last_education_degree_id, last_education_city_id, last_education_province_id, project_sponsored_progress, project_sponsored_success, project_sponsored_failed, project_initiated_progress, project_initiated_success, project_initiated_failed, ugm_engineering_status_id', 'numerical', 'integerOnly'=>true),
			array('name, last_education_name', 'length', 'max'=>255),
			array('username', 'length', 'max'=>150),
			array('password, email, activation', 'length', 'max'=>100),
			array('photo, university_name, major_name', 'length', 'max'=>80),
			array('initiator_rating', 'length', 'max'=>5),
			array('rating', 'length', 'max'=>6),
			array('country_id', 'length', 'max'=>2),
			array('house_phone, mobile_no', 'length', 'max'=>15),
			array('birth_place_none, faculty_name', 'length', 'max'=>50),
			array('university_id', 'length', 'max'=>10),
			array('activation_date, address, birth_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, users_group_id, actived, name, username, password, email, block, register_date, last_visit_date, activation, activation_date, is_online, photo, params, initiator_rating, address, rating, regency_id, province_id, country_id, postcode, house_phone, mobile_no, birth_place_id, birth_place_none, birth_date, is_male, religion_id, last_education_name, university_id, university_name, faculty_id, faculty_name, major_id, major_name, last_education_degree_id, last_education_city_id, last_education_province_id, project_sponsored_progress, project_sponsored_success, project_sponsored_failed, project_initiated_progress, project_initiated_success, project_initiated_failed, ugm_engineering_status_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'badge_somes' => array(self::HAS_MANY, 'BadgeSome', 'user_id'),
			'ft_graduates' => array(self::HAS_MANY, 'FtGraduate', 'member_id'),
			'ft_staffs' => array(self::HAS_MANY, 'FtStaff', 'member_id'),
			'ft_students' => array(self::HAS_MANY, 'FtStudent', 'member_id'),
			'funding_users' => array(self::HAS_MANY, 'FundingUser', 'sponsor_id'),
			'funding_users1' => array(self::HAS_MANY, 'FundingUser', 'varificator_id'),
			'institution_somes' => array(self::HAS_MANY, 'InstitutionSome', 'user_id'),
			'messeges' => array(self::HAS_MANY, 'Messege', 'from_user_id'),
			'messeges1' => array(self::HAS_MANY, 'Messege', 'to_user_id'),
			'projects' => array(self::HAS_MANY, 'Project', 'inisiator_id'),
			'projects1' => array(self::HAS_MANY, 'Project', 'verificator_id'),
			'projects2' => array(self::HAS_MANY, 'Project', 'editor_id'),
			'project_requisites' => array(self::HAS_MANY, 'ProjectRequisite', 'approver_id'),
			'reward_choosens' => array(self::HAS_MANY, 'RewardChoosen', 'user_id'),
			'saved_contacts' => array(self::HAS_MANY, 'SavedContact', 'owner_id'),
			'saved_contacts1' => array(self::HAS_MANY, 'SavedContact', 'saved_contact_id'),
			'volunteer_users' => array(self::HAS_MANY, 'VolunteerUser', 'volunteer_id'),
			'contents' => array(self::HAS_MANY, 'Content', 'created_by'),
			'contents1' => array(self::HAS_MANY, 'Content', 'modified_by'),
			'birth_place' => array(self::BELONGS_TO, 'ZoneRegency', 'birth_place_id'),
			'country' => array(self::BELONGS_TO, 'ZoneCountry', 'country_id'),
			'last_education_city' => array(self::BELONGS_TO, 'ZoneRegency', 'last_education_city_id'),
			'last_education_degree' => array(self::BELONGS_TO, 'EduDegree', 'last_education_degree_id'),
			'last_education_province' => array(self::BELONGS_TO, 'ZoneProvince', 'last_education_province_id'),
			'major' => array(self::BELONGS_TO, 'EduMajor', 'major_id'),
			'province' => array(self::BELONGS_TO, 'ZoneProvince', 'province_id'),
			'regency' => array(self::BELONGS_TO, 'ZoneRegency', 'regency_id'),
			'religion' => array(self::BELONGS_TO, 'Religion', 'religion_id'),
			'users_group' => array(self::BELONGS_TO, 'UsersGroup', 'users_group_id'),
			'ugm_engineering_status' => array(self::BELONGS_TO, 'UgmEngineeringStatus', 'ugm_engineering_status_id'),
			'university' => array(self::BELONGS_TO, 'EduUniversity', 'university_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'users_group_id' => Yii::t('label', 'Users Group'),
			'actived' => Yii::t('label', 'Actived'),
			'name' => Yii::t('label', 'Name'),
			'username' => Yii::t('label', 'Username'),
			'password' => Yii::t('label', 'Password'),
			'email' => Yii::t('label', 'Email'),
			'block' => Yii::t('label', 'Block'),
			'register_date' => Yii::t('label', 'Register Date'),
			'last_visit_date' => Yii::t('label', 'Last Visit Date'),
			'activation' => Yii::t('label', 'Activation'),
			'activation_date' => Yii::t('label', 'Activation Date'),
			'is_online' => Yii::t('label', 'Is Online'),
			'photo' => Yii::t('label', 'Photo'),
			'params' => Yii::t('label', 'Params'),
			'initiator_rating' => Yii::t('label', 'Initiator Rating'),
			'address' => Yii::t('label', 'Address'),
			'rating' => Yii::t('label', 'Rating'),
			'regency_id' => Yii::t('label', 'Regency'),
			'province_id' => Yii::t('label', 'Province'),
			'country_id' => Yii::t('label', 'Country'),
			'postcode' => Yii::t('label', 'Postcode'),
			'house_phone' => Yii::t('label', 'House Phone'),
			'mobile_no' => Yii::t('label', 'Mobile No'),
			'birth_place_id' => Yii::t('label', 'Birth Place'),
			'birth_place_none' => Yii::t('label', 'Birth Place None'),
			'birth_date' => Yii::t('label', 'Birth Date'),
			'is_male' => Yii::t('label', 'Is Male'),
			'religion_id' => Yii::t('label', 'Religion'),
			'last_education_name' => Yii::t('label', 'Last Education Name'),
			'university_id' => Yii::t('label', 'University'),
			'university_name' => Yii::t('label', 'University Name'),
			'faculty_id' => Yii::t('label', 'Faculty'),
			'faculty_name' => Yii::t('label', 'Faculty Name'),
			'major_id' => Yii::t('label', 'Major'),
			'major_name' => Yii::t('label', 'Major Name'),
			'last_education_degree_id' => Yii::t('label', 'Last Education Degree'),
			'last_education_city_id' => Yii::t('label', 'Last Education City'),
			'last_education_province_id' => Yii::t('label', 'Last Education Province'),
			'project_sponsored_progress' => Yii::t('label', 'Project Sponsored Progress'),
			'project_sponsored_success' => Yii::t('label', 'Project Sponsored Success'),
			'project_sponsored_failed' => Yii::t('label', 'Project Sponsored Failed'),
			'project_initiated_progress' => Yii::t('label', 'Project Initiated Progress'),
			'project_initiated_success' => Yii::t('label', 'Project Initiated Success'),
			'project_initiated_failed' => Yii::t('label', 'Project Initiated Failed'),
			'ugm_engineering_status_id' => Yii::t('label', 'Ugm Engineering Status'),
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
		$criteria->compare('params',$this->params,true);
		$criteria->compare('initiator_rating',$this->initiator_rating,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('regency_id',$this->regency_id);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('postcode',$this->postcode);
		$criteria->compare('house_phone',$this->house_phone,true);
		$criteria->compare('mobile_no',$this->mobile_no,true);
		$criteria->compare('birth_place_id',$this->birth_place_id);
		$criteria->compare('birth_place_none',$this->birth_place_none,true);
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('is_male',$this->is_male);
		$criteria->compare('religion_id',$this->religion_id);
		$criteria->compare('last_education_name',$this->last_education_name,true);
		$criteria->compare('university_id',$this->university_id,true);
		$criteria->compare('university_name',$this->university_name,true);
		$criteria->compare('faculty_id',$this->faculty_id);
		$criteria->compare('faculty_name',$this->faculty_name,true);
		$criteria->compare('major_id',$this->major_id);
		$criteria->compare('major_name',$this->major_name,true);
		$criteria->compare('last_education_degree_id',$this->last_education_degree_id);
		$criteria->compare('last_education_city_id',$this->last_education_city_id);
		$criteria->compare('last_education_province_id',$this->last_education_province_id);
		$criteria->compare('project_sponsored_progress',$this->project_sponsored_progress);
		$criteria->compare('project_sponsored_success',$this->project_sponsored_success);
		$criteria->compare('project_sponsored_failed',$this->project_sponsored_failed);
		$criteria->compare('project_initiated_progress',$this->project_initiated_progress);
		$criteria->compare('project_initiated_success',$this->project_initiated_success);
		$criteria->compare('project_initiated_failed',$this->project_initiated_failed);
		$criteria->compare('ugm_engineering_status_id',$this->ugm_engineering_status_id);

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
			$this->defaultColumns[] = 'password';
			$this->defaultColumns[] = 'email';
			$this->defaultColumns[] = 'block';
			$this->defaultColumns[] = 'register_date';
			$this->defaultColumns[] = 'last_visit_date';
			$this->defaultColumns[] = 'activation';
			$this->defaultColumns[] = 'activation_date';
			$this->defaultColumns[] = 'is_online';
			$this->defaultColumns[] = 'photo';
			$this->defaultColumns[] = 'params';
			$this->defaultColumns[] = 'initiator_rating';
			$this->defaultColumns[] = 'address';
			$this->defaultColumns[] = 'rating';
			$this->defaultColumns[] = 'regency_id';
			$this->defaultColumns[] = 'province_id';
			$this->defaultColumns[] = 'country_id';
			$this->defaultColumns[] = 'postcode';
			$this->defaultColumns[] = 'house_phone';
			$this->defaultColumns[] = 'mobile_no';
			$this->defaultColumns[] = 'birth_place_id';
			$this->defaultColumns[] = 'birth_place_none';
			$this->defaultColumns[] = 'birth_date';
			$this->defaultColumns[] = 'is_male';
			$this->defaultColumns[] = 'religion_id';
			$this->defaultColumns[] = 'last_education_name';
			$this->defaultColumns[] = 'university_id';
			$this->defaultColumns[] = 'university_name';
			$this->defaultColumns[] = 'faculty_id';
			$this->defaultColumns[] = 'faculty_name';
			$this->defaultColumns[] = 'major_id';
			$this->defaultColumns[] = 'major_name';
			$this->defaultColumns[] = 'last_education_degree_id';
			$this->defaultColumns[] = 'last_education_city_id';
			$this->defaultColumns[] = 'last_education_province_id';
			$this->defaultColumns[] = 'project_sponsored_progress';
			$this->defaultColumns[] = 'project_sponsored_success';
			$this->defaultColumns[] = 'project_sponsored_failed';
			$this->defaultColumns[] = 'project_initiated_progress';
			$this->defaultColumns[] = 'project_initiated_success';
			$this->defaultColumns[] = 'project_initiated_failed';
			$this->defaultColumns[] = 'ugm_engineering_status_id';
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
            $this->defaultColumns[] = array(
                'class' => 'CCheckBoxColumn',
                'name' => 'id',
                'selectableRows' => 2,
                'checkBoxHtmlOptions' => array('name' => 'id[]')
            );
			//$this->defaultColumns[] = 'id';
//			$this->defaultColumns[] = 'users_group_id';
            $this->defaultColumns[] = array(
                'name' => 'users_group_id',
                'value' => '$data->users_group->name',
            );
			//$this->defaultColumns[] = 'actived';
			$this->defaultColumns[] = 'name';
			//$this->defaultColumns[] = 'username';
//			$this->defaultColumns[] = 'password';
			$this->defaultColumns[] = 'email';
			//$this->defaultColumns[] = 'block';
			//$this->defaultColumns[] = 'register_date';
			//$this->defaultColumns[] = 'last_visit_date';
			//$this->defaultColumns[] = 'activation';
			//$this->defaultColumns[] = 'activation_date';
			//$this->defaultColumns[] = 'is_online';
//			$this->defaultColumns[] = 'photo';
			//$this->defaultColumns[] = 'params';
			//$this->defaultColumns[] = 'initiator_rating';
			$this->defaultColumns[] = 'address';
			//$this->defaultColumns[] = 'rating';
//			$this->defaultColumns[] = 'regency_id';
            $this->defaultColumns[] = array(
                'name' => 'regency_id',
                'value' => '$data->regency->name',
            );
//			$this->defaultColumns[] = 'province_id';
            $this->defaultColumns[] = array(
            'name' => 'province_id',
                'value' => '$data->province->name',
            );
//			$this->defaultColumns[] = 'country_id';
//            $this->defaultColumns[] = array(
//                'name' => 'country_id',
//                'value' => '$data->country->name',
//            );
//			$this->defaultColumns[] = 'postcode';
//			$this->defaultColumns[] = 'house_phone';
			$this->defaultColumns[] = 'mobile_no';
            $this->defaultColumns[] = //'is_actived';
                array(
                    "name"=>'activation',
                    "type"=>'raw',
                    "value"=>  'Utility::getPublishedToImg($data->activation)',
                );
//			$this->defaultColumns[] = 'birth_place_id';
			//$this->defaultColumns[] = 'birth_place_none';
//			$this->defaultColumns[] = 'birth_date';
//			$this->defaultColumns[] = 'is_male';
//			$this->defaultColumns[] = 'religion_id';
//			$this->defaultColumns[] = 'last_education_name';
//			$this->defaultColumns[] = 'university_id';
//			$this->defaultColumns[] = 'university_name';
//			$this->defaultColumns[] = 'faculty_id';
//			$this->defaultColumns[] = 'faculty_name';
//			$this->defaultColumns[] = 'major_id';
//			$this->defaultColumns[] = 'major_name';
//			$this->defaultColumns[] = 'last_education_degree_id';
//			$this->defaultColumns[] = 'last_education_city_id';
//			$this->defaultColumns[] = 'last_education_province_id';
			//$this->defaultColumns[] = 'project_sponsored_progress';
			//$this->defaultColumns[] = 'project_sponsored_success';
			//$this->defaultColumns[] = 'project_sponsored_failed';
			//$this->defaultColumns[] = 'project_initiated_progress';
			//$this->defaultColumns[] = 'project_initiated_success';
			//$this->defaultColumns[] = 'project_initiated_failed';
//			$this->defaultColumns[] = 'ugm_engineering_status_id';
			/* $this->defaultColumns[] = array(
				'name' => 'publish',
				'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->id)), $data->publish, 1)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			); */

		}
		parent::afterConstruct();
	}

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
     * Hash password after validate and no error.
     */
    /* 	protected function afterValidate() {
            parent::afterValidate();
            if(count($this->errors) == 0) {
                $this->password = $this->retypePassword = self::hashPassword($this->password);
            }
        } */

    /**
     * Get user group
     *
     * return CHtml::listData
     */
    public function getUsersGroup() {
        $model = UsersGroup::model()->findAll(array('order' => 'name ASC'));
        return CHtml::listData($model, 'id', 'name');
    }

    public function getUGMEngineeringStats($id){
        $model = UgmEngineeringStatus::model()->findByPk($id);
        return $model->status;
    }

    public static function getStatus($affirmative, $negative) {
        $items = array();
        $items[0] = $negative;
        $items[1] =$affirmative;
        return $items;
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