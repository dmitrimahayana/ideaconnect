<?php

/**
 * This is the model class for table "swt_menu_auth".
 *
 * The followings are the available columns in table 'swt_menu_auth':
 * @property integer $id
 * @property integer $swt_menu_id
 * @property integer $swt_users_group_id
 *
 * The followings are the available model relations:
 * @property SwtMenu $swtMenu
 * @property SwtUsersGroup $swtUsersGroup
 */
class MenuAuth extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MenuAuth the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'swt_menu_auth';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('swt_menu_id, swt_users_group_id', 'required'),
			array('swt_menu_id, swt_users_group_id, has_task', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, swt_menu_id, swt_users_group_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swt_menu' => array(self::BELONGS_TO, 'SwtMenu', 'swt_menu_id'),
			'swt_users_group' => array(self::BELONGS_TO, 'SwtUsersGroup', 'swt_users_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'swt_menu_id' => Yii::t('label', 'Swt Menu'),
			'swt_users_group_id' => Yii::t('label', 'Swt Users Group'),
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
		$criteria->compare('swt_menu_id',$this->swt_menu_id);
		$criteria->compare('swt_users_group_id',$this->swt_users_group_id);

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
			$this->defaultColumns[] = 'swt_menu_id';
			$this->defaultColumns[] = 'swt_users_group_id';
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
			$this->defaultColumns[] = 'swt_menu_id';
			$this->defaultColumns[] = 'swt_users_group_id';
		}
		parent::afterConstruct();
	}

	/**
	 * before validate attributes
	 */
	/* 
	protected function beforeValidate() {
		if(parent::beforeValidate()) {		
			if($this->isNewRecord) {
				$this->verifyPassword = $data;
			
			}else {
				
			}			
		}
		return true;
	}
	 */
	
	/**
	 * before save attributes
	 */
	/* 
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->start_date 	= date('Y-m-d', strtotime($this->start_date));			
			}else {
				
			}
		}
		return true;
	}
	 */
	
	/**
	 * After save attributes
	 */
	/* 
	protected function afterSave() {
		parent::afterSave();
		// Create action		
	}
	 */
	


}