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
 * @property integer $is_online
 * @property string $photo
 * @property string $mobile_no
 * @property string $params
 *
 * The followings are the available model relations:
 * @property SwtContent[] $swtContents
 * @property SwtContent[] $swtContents1
 * @property SwtUsersGroup $usersGroup
 */
class Users extends CActiveRecord
{
	public $currentPassword;
	public $retypePassword;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_group_id, name, username, email', 'required'),
			array('users_group_id, actived, status_user, block, is_online', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('username', 'length', 'max'=>150),			
			array('username', 'unique'),
			array('password, email, activation', 'length', 'max'=>100),
			array('email', 'email'),
			array('email', 'unique'),
			array('photo', 'length', 'max'=>80),
			array('mobile_no', 'length', 'max'=>15),	
			array('currentPassword, retypePassword', 'length', 'max'=>45, 'min' => 7),
			array('currentPassword, retypePassword', 'required', 'on'=>'adminadd'),
			array('register_date, last_visit_date, activation_date', 'safe'),
			array('retypePassword', 'compare', 'compareAttribute' => 'currentPassword', 
				'message' => 'Retype Password is incorrect.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, users_group_id, actived, name, username, password, email, block, register_date, last_visit_date, activation, is_online, photo, mobile_no, params', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swt_contents' => array(self::HAS_MANY, 'Content', 'created_by'),
			'swt_contents1' => array(self::HAS_MANY, 'Content', 'modified_by'),
			'users_group' => array(self::BELONGS_TO, 'UsersGroup', 'users_group_id'),
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
			'name' => Yii::t('label', 'Full Name'),
			'username' => Yii::t('label', 'Username'),
			'password' => Yii::t('label', 'Password'),
			'email' => Yii::t('label', 'Email'),
			'block' => Yii::t('label', 'Block'),
			'register_date' => Yii::t('label', 'Register Date'),
			'last_visit_date' => Yii::t('label', 'Lastvisit Date'),
			'activation' => Yii::t('label', 'Activation'),
			'is_online' => Yii::t('label', 'Is Online'),
			'photo' => Yii::t('label', 'Photo'),
			'mobile_no' => Yii::t('label', 'Mobile No'),
			'params' => Yii::t('label', 'Params'),
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
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->register_date	= date('Y-m-d H:i:s');	
				$this->password= $this->hashPassword($this->retypePassword);
			}else {
				if(!empty($this->retypePassword))
					$this->password= $this->hashPassword($this->retypePassword);				
			}
		}
		return true;
	}
	
	
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
		if(Yii::app()->user->id == 1)
			$criteria->compare('users_group_id', $this->users_group_id);
		else
			$criteria->condition = 'users_group_id <> 1';
		$criteria->compare('actived',$this->actived);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('block',$this->block);
		$criteria->compare('register_date',$this->register_date,true);
		$criteria->compare('last_visit_date',$this->last_visit_date,true);
		$criteria->compare('activation',$this->activation,true);
		$criteria->compare('is_online',$this->is_online);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('mobile_no',$this->mobile_no,true);
		$criteria->compare('params',$this->params,true);
		$criteria->order = 'register_date DESC';
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			/* 'pagination'=>array(
				'pageSize'=>20,
			), */
		));
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

    /**
     * Get column for CGrid View
     */
//    public function getGridColumn($columns=null) {
//        if($columns !== null) {
//            foreach($columns as $val) {
//
//                if(trim($val) == 'enabled') {
//                    $this->defaultColumns[] = array(
//                        'name'  => 'enabled',
//                        'value' => '$data->enabled == 1? "Ya": "Tidak"',
//                    );
//                }
//
//                $this->defaultColumns[] = $val;
//            }
//        }else {
//            $this->defaultColumns[] = 'id';
//            $this->defaultColumns[] = 'users_group_id';
//            $this->defaultColumns[] = 'actived';
//            $this->defaultColumns[] = 'name';
//            $this->defaultColumns[] = 'username';
//            $this->defaultColumns[] = 'password';
//            $this->defaultColumns[] = 'email';
//            $this->defaultColumns[] = 'block';
//            $this->defaultColumns[] = 'register_date';
//            $this->defaultColumns[] = 'last_visit_date';
//            $this->defaultColumns[] = 'activation';
//            $this->defaultColumns[] = 'activation_date';
//            $this->defaultColumns[] = 'is_online';
//            $this->defaultColumns[] = 'photo';
//            $this->defaultColumns[] = 'mobile_no';
//            $this->defaultColumns[] = 'address';
//            $this->defaultColumns[] = 'regency_id';
//            $this->defaultColumns[] = 'province_id';
//            $this->defaultColumns[] = 'postcode';
//            $this->defaultColumns[] = 'house_phone';
//            $this->defaultColumns[] = 'birth_place_id';
//            $this->defaultColumns[] = 'birth_date';
//            $this->defaultColumns[] = 'is_male';
//            $this->defaultColumns[] = 'religion_id';
//            $this->defaultColumns[] = 'last_education_name';
//            $this->defaultColumns[] = 'university_id';
//            $this->defaultColumns[] = 'faculty_id';
//        }
//
//        return $this->defaultColumns;
//    }

    /**
     * Set default columns to display
     */

//    protected function afterConstruct() {
//        if(count($this->defaultColumns) == 0) {
//            $this->defaultColumns[] = array(
//                'header' => 'No',
//                'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
//            );
            //$this->defaultColumns[] = 'id';
//            $this->defaultColumns[] = 'badge';
            /* $this->defaultColumns[] = array(
                'name' => 'publish',
                'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->id)), $data->publish, 1)',
                'htmlOptions' => array(
                    'class' => 'center',
                ),
                'type' => 'raw',
            ); */
//        }
//        parent::afterConstruct();
//    }

	
}