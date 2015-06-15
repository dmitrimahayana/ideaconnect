<?php

/**
 * This is the model class for table "ic_ft_student".
 *
 * The followings are the available columns in table 'ic_ft_student':
 * @property string $id
 * @property integer $major_id
 * @property integer $degree_id
 * @property integer $role_date
 * @property integer $role_month
 * @property integer $role_year
 * @property string $student_number
 * @property string $member_id
 *
 * The followings are the available model relations:
 * @property IcEduDegree $degree
 * @property IcEduMajor $major
 * @property SwtUsers $member
 */
class FtStudent extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FtStudent the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_ft_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_date, role_month, role_year, student_number, member_id', 'required'),
			array('major_id, degree_id, role_date, role_month, role_year', 'numerical', 'integerOnly'=>true),
			array('student_number', 'length', 'max'=>80),
			array('member_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, major_id, degree_id, role_date, role_month, role_year, student_number, member_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'degree' => array(self::BELONGS_TO, 'IcEduDegree', 'degree_id'),
			'major' => array(self::BELONGS_TO, 'IcEduMajor', 'major_id'),
			'member' => array(self::BELONGS_TO, 'SwtUsers', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'major_id' => Yii::t('label', 'Major'),
			'degree_id' => Yii::t('label', 'Degree'),
			'role_date' => Yii::t('label', 'Role Date'),
			'role_month' => Yii::t('label', 'Role Month'),
			'role_year' => Yii::t('label', 'Role Year'),
			'student_number' => Yii::t('label', 'Student Number'),
			'member_id' => Yii::t('label', 'Member'),
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
		$criteria->compare('major_id',$this->major_id);
		$criteria->compare('degree_id',$this->degree_id);
		$criteria->compare('role_date',$this->role_date);
		$criteria->compare('role_month',$this->role_month);
		$criteria->compare('role_year',$this->role_year);
		$criteria->compare('student_number',$this->student_number,true);
		$criteria->compare('member_id',$this->member_id,true);

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
			$this->defaultColumns[] = 'major_id';
			$this->defaultColumns[] = 'degree_id';
			$this->defaultColumns[] = 'role_date';
			$this->defaultColumns[] = 'role_month';
			$this->defaultColumns[] = 'role_year';
			$this->defaultColumns[] = 'student_number';
			$this->defaultColumns[] = 'member_id';
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
			$this->defaultColumns[] = 'major_id';
			$this->defaultColumns[] = 'degree_id';
			$this->defaultColumns[] = 'role_date';
			$this->defaultColumns[] = 'role_month';
			$this->defaultColumns[] = 'role_year';
			$this->defaultColumns[] = 'student_number';
			$this->defaultColumns[] = 'member_id';
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