<?php

/**
 * This is the model class for table "swt_users_group".
 *
 * The followings are the available columns in table 'swt_users_group':
 * @property integer $id
 * @property string $name
 * @property string $params
 * @property string $group_name
 * @property string $group_login
 *
 * The followings are the available model relations:
 * @property SwtMenuAuth[] $swtMenuAuths
 * @property SwtUsers[] $swtUsers
 */
class UsersGroup extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UsersGroup the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'swt_users_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>50),
			array('group_name', 'length', 'max'=>30),
			array('group_login', 'length', 'max'=>12),
			array('params', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, params, group_name, group_login', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swt_menu_auths' => array(self::HAS_MANY, 'SwtMenuAuth', 'swt_users_group_id'),
			'swt_users' => array(self::HAS_MANY, 'SwtUsers', 'users_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'name' => Yii::t('label', 'Name'),
			'params' => Yii::t('label', 'Params'),
			'group_name' => Yii::t('label', 'Group Name'),
			'group_login' => Yii::t('label', 'Group Login'),
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
		$criteria->compare('params',$this->params,true);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('group_login',$this->group_login,true);

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
			$this->defaultColumns[] = 'params';
			$this->defaultColumns[] = 'group_name';
			$this->defaultColumns[] = 'group_login';
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
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'params';
			$this->defaultColumns[] = 'group_name';
			$this->defaultColumns[] = 'group_login';
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
	
	/**
	 * Get array role
	 *	@param arr group id
	 * @return array role
	 */
	 public function getArrRoles($arrGroupId) {
		$result      = array();
		$listGroupId = implode(',', $arrGroupId);
		$model       = self::model()->findAll(array(
			'select'=>'group_name',
			'condition'=>"id IN ($listGroupId)",			
		));
		if($model != null) {			
			foreach($model as $val) {				
				$result[] = "'{$val->group_name}'";		
			}
		}
		return $result;
	 }
}