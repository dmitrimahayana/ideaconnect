<?php

/**
 * This is the model class for table "swt_users_group".
 *
 * The followings are the available columns in table 'swt_users_group':
 * @property integer $id
 * @property string $name
 * @property string $params
 *
 * The followings are the available model relations:
 * @property SwtUsers[] $swtUsers
 */
class UsersGroup extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return UsersGroup the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_users_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('group_login, group_name, name', 'required'),
			array('name', 'length', 'max'=>50),
			array('name, group_name', 'unique'),
			array('params', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, params', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swt_users' => array(self::HAS_MANY, 'SwtUsers', 'users_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'group_login' => Yii::t('label', 'Grup Halaman Login'),
			'group_name' => Yii::t('label', 'Nama Hak Akses (Role)'),
			'name' => Yii::t('label', 'Nama Grup'),
			'params' => Yii::t('label', 'Params'),
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
		if(Yii::app()->user->id != 1)
		$criteria->condition = 'id <> 1';
		$criteria->compare('name',$this->name,true);
		$criteria->compare('params',$this->params,true);
		//$criteria->order = ''
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			/* 
			'pagination'=>array(
				'pageSize'=>20,
			),
			*/
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
	 * Get params	 setting
	 *	@param int categories_id, str $startType, str $endType
	 * @return array params
	 */
	 public function getParams($id, $startType, $endType)  {
		$result = array();
		$model = self::model()->findByPk($id, array('select'=>'params'));
		if($model != null) {			
			$arrParams = explode('-----', $model->params);			
			$replaces = str_replace(array($startType, $endType), array('', ''), $arrParams[0]);
			$listParams = explode(',', $replaces);
			foreach($listParams as $val) {
				$part = explode('=', $val);
				$result[trim($part[0])] = trim($part[1]);		
			}
		}
		return $result;
	 }
	
	/**
	 * Get array role
	 *	@param arr group id
	 * @return array role
	 */
	 public function getArrRoles($arrGroupId) {
		$result = array();
		$listGroupId = implode(',', $arrGroupId);
		$model = self::model()->findAll(array(
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