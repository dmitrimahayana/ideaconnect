<?php

/**
 * This is the model class for table "ic_volunteer_requirement".
 *
 * The followings are the available columns in table 'ic_volunteer_requirement':
 * @property string $id
 * @property string $requirement
 * @property integer $number_of_volunteer
 * @property integer $number_of_registered
 * @property string $requisite_id
 *
 * The followings are the available model relations:
 * @property IcProjectRequisite $requisite
 * @property IcVolunteerUser[] $icVolunteerUsers
 */
class VolunteerRequirement extends CActiveRecord
 {
	public $defaultColumns = array();
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VolunteerRequirement the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_volunteer_requirement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requirement, number_of_volunteer, requisite_id', 'required'),
			array('number_of_volunteer, number_of_registered', 'numerical', 'integerOnly'=>true),
			array('requirement', 'length', 'max'=>80),
			array('requisite_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, requirement, number_of_volunteer, number_of_registered, requisite_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'requisite' => array(self::BELONGS_TO, 'ProjectRequisite', 'requisite_id'),
			'volunteer_users' => array(self::HAS_MANY, 'VolunteerUser', 'volunteer_requirement_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'requirement' => Yii::t('label', 'Kebutuhan'),
			'number_of_volunteer' => Yii::t('label', 'Jumlah Sukarelawan Dibutuhkan'),
			'number_of_registered' => Yii::t('label', 'Jumlah Sukarelawan Bersedia'),
			'requisite_id' => Yii::t('label', 'Requisite'),
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
		$criteria->compare('requirement',$this->requirement,true);
		$criteria->compare('number_of_volunteer',$this->number_of_volunteer);
		$criteria->compare('number_of_registered',$this->number_of_registered);
		$criteria->compare('requisite_id',$this->requisite_id,true);

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
			$this->defaultColumns[] = 'requirement';
			$this->defaultColumns[] = 'number_of_volunteer';
			$this->defaultColumns[] = 'number_of_registered';
			$this->defaultColumns[] = 'requisite_id';
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
			//$this->defaultColumns[] = 'id';
            $this->defaultColumns[] = 'requirement';
            $this->defaultColumns[] = 'number_of_volunteer';
            $this->defaultColumns[] = 'number_of_registered';
            //$this->defaultColumns[] = 'requisite_id';
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

    public function getSomeVolunteer($id){
        $criteria=new CDbCriteria;

        $criteria->compare('requisite_id',$id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
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