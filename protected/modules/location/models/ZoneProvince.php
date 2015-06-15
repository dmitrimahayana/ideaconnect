<?php

/**
 * This is the model class for table "ic_zone_province".
 *
 * The followings are the available columns in table 'ic_zone_province':
 * @property integer $id
 * @property string $name
 * @property string $country_code
 *
 * The followings are the available model relations:
 * @property IcInstitutionSome[] $icInstitutionSomes
 * @property IcZoneCountry $countryCode
 * @property IcZoneRegency[] $icZoneRegencies
 * @property SwtUsers[] $swtUsers
 * @property SwtUsers[] $swtUsers1
 */
class ZoneProvince extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ZoneProvince the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_zone_province';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>45),
			array('country_code', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, country_code', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'institution_somes' => array(self::HAS_MANY, 'InstitutionSome', 'province_id'),
			'country_codes' => array(self::BELONGS_TO, 'ZoneCountry', 'country_code'),
			'zone_regencies' => array(self::HAS_MANY, 'ZoneRegency', 'province_id'),
			'swt_users' => array(self::HAS_MANY, 'Users', 'last_education_province_id'),
			'swt_users1' => array(self::HAS_MANY, 'Users', 'province_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'name' => Yii::t('label', 'Name'),
			'country_code' => Yii::t('label', 'Country Code'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('country_code',$this->country_code,true);

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
			$this->defaultColumns[] = 'country_code';
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
//			$this->defaultColumns[] = 'country_code';
            $this->defaultColumns[] = array(
                'name' => 'country_code',
                'value' => '$data->country_codes->name'
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

    public static function getCategory() {
        $model = self::model()->findAll();
        $items = array();
        if($model != null) {
            foreach($model as $key => $val) {
                $items[$val->id] = $val->name;
            }
            return $items;
        } else {
            return false;
        }
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