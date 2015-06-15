<?php

/**
 * This is the model class for table "ic_volunteer_user".
 *
 * The followings are the available columns in table 'ic_volunteer_user':
 * @property string $id
 * @property string $volunteer_requirement_id
 * @property string $volunteer_id
 * @property string $volunteer_name
 * @property string $contact_number
 * @property string $email
 * @property string $address
 * @property string $regency
 * @property string $province
 * @property integer $is_male
 * @property integer $had_been_canceled
 *
 * The followings are the available model relations:
 * @property SwtUsers $volunteer
 * @property IcVolunteerRequirement $volunteerRequirement
 */
class VolunteerUser extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VolunteerUser the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_volunteer_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('volunteer_requirement_id', 'required'),
			array('is_male, had_been_canceled', 'numerical', 'integerOnly'=>true),
			array('volunteer_requirement_id, volunteer_id', 'length', 'max'=>10),
			array('volunteer_name', 'length', 'max'=>80),
			array('contact_number', 'length', 'max'=>15),
			array('email', 'length', 'max'=>50),
			array('address', 'length', 'max'=>255),
			array('regency, province', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, volunteer_requirement_id, volunteer_id, volunteer_name, contact_number, email, address, regency, province, is_male, had_been_canceled', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'volunteer' => array(self::BELONGS_TO, 'Users', 'volunteer_id'),
			'volunteer_requirement' => array(self::BELONGS_TO, 'VolunteerRequirement', 'volunteer_requirement_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'volunteer_requirement_id' => Yii::t('label', 'Volunteer Requirement'),
			'volunteer_id' => Yii::t('label', 'Volunteer'),
			'volunteer_name' => Yii::t('label', 'Volunteer Name'),
			'contact_number' => Yii::t('label', 'Contact Number'),
			'email' => Yii::t('label', 'Email'),
			'address' => Yii::t('label', 'Address'),
			'regency' => Yii::t('label', 'Regency'),
			'province' => Yii::t('label', 'Province'),
			'is_male' => Yii::t('label', 'Is Male'),
			'had_been_canceled' => Yii::t('label', 'Had Been Canceled'),
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
		$criteria->compare('volunteer_requirement_id',$this->volunteer_requirement_id,true);
		$criteria->compare('volunteer_id',$this->volunteer_id,true);
		$criteria->compare('volunteer_name',$this->volunteer_name,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('regency',$this->regency,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('is_male',$this->is_male);
		$criteria->compare('had_been_canceled',$this->had_been_canceled);

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
			$this->defaultColumns[] = 'volunteer_requirement_id';
			$this->defaultColumns[] = 'volunteer_id';
			$this->defaultColumns[] = 'volunteer_name';
			$this->defaultColumns[] = 'contact_number';
			$this->defaultColumns[] = 'email';
			$this->defaultColumns[] = 'address';
			$this->defaultColumns[] = 'regency';
			$this->defaultColumns[] = 'province';
			$this->defaultColumns[] = 'is_male';
			$this->defaultColumns[] = 'had_been_canceled';
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
			$this->defaultColumns[] = 'volunteer_requirement_id';
			$this->defaultColumns[] = 'volunteer_id';
			$this->defaultColumns[] = 'volunteer_name';
			$this->defaultColumns[] = 'contact_number';
			$this->defaultColumns[] = 'email';
			$this->defaultColumns[] = 'address';
			$this->defaultColumns[] = 'regency';
			$this->defaultColumns[] = 'province';
			$this->defaultColumns[] = 'is_male';
			$this->defaultColumns[] = 'had_been_canceled';
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

    public function getSomeVolunteerUser($id){
        $criteria=new CDbCriteria;

        $criteria->compare('volunteer_requirement_id',$id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function getSomeVolunteerUserByPk($id){
        /*$criteria=new CDbCriteria;

        $criteria->compare('id',$id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));*/

        return VolunteerUser::model()->findAll(array('condition'=>'id='.$id));
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