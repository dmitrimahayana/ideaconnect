<?php

/**
 * This is the model class for table "ccn_employer_subscribe".
 *
 * The followings are the available columns in table 'ccn_employer_subscribe':
 * @property string $id
 * @property string $swt_users_id
 * @property integer $subscribe_vacancy_info
 * @property integer $subscribe_autosend_resume
 *
 * The followings are the available model relations:
 * @property SwtUsers $swtUsers
 */
class CcnEmployerSubscribe extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnEmployerSubscribe the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ccn_employer_subscribe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('swt_users_id, subscribe_vacancy_info, subscribe_autosend_resume', 'required'),
			array('subscribe_vacancy_info, subscribe_autosend_resume', 'numerical', 'integerOnly'=>true),
			array('swt_users_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, swt_users_id, subscribe_vacancy_info, subscribe_autosend_resume', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swt_users' => array(self::BELONGS_TO, 'SwtUsers', 'swt_users_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'swt_users_id' => Yii::t('label', 'Swt Users'),
			'subscribe_vacancy_info' => Yii::t('label', 'Subscribe Vacancy Info'),
			'subscribe_autosend_resume' => Yii::t('label', 'Subscribe Autosend Resume'),
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
		$criteria->compare('swt_users_id',$this->swt_users_id,true);
		$criteria->compare('subscribe_vacancy_info',$this->subscribe_vacancy_info);
		$criteria->compare('subscribe_autosend_resume',$this->subscribe_autosend_resume);

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
			$this->defaultColumns[] = 'swt_users_id';
			$this->defaultColumns[] = 'subscribe_vacancy_info';
			$this->defaultColumns[] = 'subscribe_autosend_resume';
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
			$this->defaultColumns[] = 'swt_users_id';
			$this->defaultColumns[] = 'subscribe_vacancy_info';
			$this->defaultColumns[] = 'subscribe_autosend_resume';
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