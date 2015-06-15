<?php

/**
 * This is the model class for table "ic_institution_some".
 *
 * The followings are the available columns in table 'ic_institution_some':
 * @property string $id
 * @property string $name
 * @property string $address
 * @property integer $province_id
 * @property integer $regency_id
 * @property string $institution_phone_number
 * @property string $job_position
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property IcFundingUser[] $icFundingUsers
 * @property IcZoneProvince $province
 * @property IcZoneRegency $regency
 * @property SwtUsers $user
 * @property IcProject[] $icProjects
 */
class InstitutionSome extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InstitutionSome the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_institution_some';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address, institution_phone_number, job_position, user_id', 'required'),
			array('province_id, regency_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('address', 'length', 'max'=>255),
			array('institution_phone_number', 'length', 'max'=>15),
			array('job_position', 'length', 'max'=>80),
			array('user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, address, province_id, regency_id, institution_phone_number, job_position, user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ic_funding_users' => array(self::HAS_MANY, 'FundingUser', 'as_institution_id'),
			'province' => array(self::BELONGS_TO, 'ZoneProvince', 'province_id'),
			'regency' => array(self::BELONGS_TO, 'ZoneRegency', 'regency_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'ic_projects' => array(self::HAS_MANY, 'Project', 'as_institution_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'name' => Yii::t('label', 'Name'),
			'address' => Yii::t('label', 'Address'),
			'province_id' => Yii::t('label', 'Province'),
			'regency_id' => Yii::t('label', 'Regency'),
			'institution_phone_number' => Yii::t('label', 'Institution Phone Number'),
			'job_position' => Yii::t('label', 'Job Position'),
			'user_id' => Yii::t('label', 'User'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('regency_id',$this->regency_id);
		$criteria->compare('institution_phone_number',$this->institution_phone_number,true);
		$criteria->compare('job_position',$this->job_position,true);
		$criteria->compare('user_id',$this->user_id,true);

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
			$this->defaultColumns[] = 'address';
			$this->defaultColumns[] = 'province_id';
			$this->defaultColumns[] = 'regency_id';
			$this->defaultColumns[] = 'institution_phone_number';
			$this->defaultColumns[] = 'job_position';
			$this->defaultColumns[] = 'user_id';
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
//			$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'address';
//			$this->defaultColumns[] = 'province_id';
            $this->defaultColumns[] = array(
                'name' => 'province_id',
                'value' => '$data->province->name'
            );
//			$this->defaultColumns[] = 'regency_id';
            $this->defaultColumns[] = array(
                'name' => 'regency_id',
                'value' => '$data->regency->name'
            );
			$this->defaultColumns[] = 'institution_phone_number';
			$this->defaultColumns[] = 'job_position';
//			$this->defaultColumns[] = 'user_id';
            $this->defaultColumns[] = array(
                'name' => 'user_id',
                'value' => '$data->user->name'
            );
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

    public function getIdUserJson($term){
        $criteria=new CDbCriteria();
        //$criteria->select="id_materi";
//        $criteria->compare('id_materi', $term,TRUE);
        $criteria->condition='username like "%'.$term.'%" or name like "%'.$term.'%"';
        $dataprovider=new CActiveDataProvider(
            get_class(Users::model()),array(
                'criteria'=>$criteria,
//                'pagination'=>false
            )
        );
        $topic=$dataprovider->getData();

        $returnArray=array();
        foreach ($topic as $key):
            $returnArray[]=array('label'=>$key->name, /*'id'=>$key->id_materi,*/ 'value'=>$key->id);
        endforeach;

        return CJSON::encode($returnArray);
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