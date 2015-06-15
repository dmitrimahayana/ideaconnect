<?php

/**
 * This is the model class for table "swt_users_group".
 *
 * The followings are the available columns in table 'swt_users_group':
 * @property integer $id
 * @property string $group_login
 * @property string $group_name
 * @property string $name
 * @property string $params
 *
 * The followings are the available model relations:
 * @property SwtUsers[] $swtUsers
 */
class CcnGroupAdmin extends CActiveRecord
 {
	public $defaultColumns = array();
	public $arrMenu = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnGroupAdmin the static model class
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
			array('group_name, name, arrMenu', 'required'),
			array('group_login', 'length', 'max'=>20),
			array('group_name', 'length', 'max'=>30),
			array('name', 'length', 'max'=>50),
			array('params, arrMenu', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_login, group_name, name, params', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
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
			'group_name' => Yii::t('label', 'Nama Grup Unik'),
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

		//$criteria->compare('id',$this->id);
		//$criteria->compare('group_login',$this->group_login,true);
		//$criteria->compare('group_name',$this->group_name,true);
		$criteria->addNotInCondition('id',array(1,4,5,6));
		$criteria->compare('name',$this->name,true);
		$criteria->compare('params',$this->params,true);
		$criteria->order ='id DESC';

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
			$this->defaultColumns[] = 'group_login';
			$this->defaultColumns[] = 'group_name';
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
			$this->defaultColumns[] = 'name';
		}
		parent::afterConstruct();
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				$this->group_login = 'back_office';				
				$this->group_name = substr('role_'.str_replace(' ', '_', strtolower($this->name)), 0, 64);
				$this->params = '-';
			}	
		}
		return true;
	}
	
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
	protected function afterSave() {
		parent::afterSave();		
		
		//set array item task
		$menus = Menu::model()->findAll(array(	
			'select' => 'id, srbac_items_task_name',
			'condition' => 'group_pages = :g and published = 1',
			'params' => array(':g'=>'back_office')
		));		
		foreach($menus as $val) {
			$arrayMenuTask[$val->id] = $val->srbac_items_task_name;
		}
		
		if($this->isNewRecord) { //new record
			//save auth item srbac
			$assignments = new AuthItem;
			$assignments->name = $this->group_name;
			$assignments->type = 2;
			$assignments->description = $this->name;
			$assignments->bizrule = '';
			$assignments->data = 's:0:"";';
			$assignments->save();		

			//save assigment srbac
			$assignments = new Assignments;
			$assignments->itemname = $this->group_name;
			$assignments->userid = $this->id;
			$assignments->bizrule = '';
			$assignments->data = 's:0:"";';
			$assignments->save();	
			
			//save to menu auth
			foreach($this->arrMenu as $val) {
				$model = new MenuAuth;
				$model->swt_menu_id = $val;
				$model->swt_users_group_id = $this->id;
				$model->has_task = $arrayMenuTask[$val] == '0' ? 0 : 1;
				if(!$model->save()) {
					print_r($model->getErrors());
				}					
			}
			
			//save to srbac
			if(count($this->arrMenu) > 0) {
				foreach($this->arrMenu as $val) {
					if(ItemChildren::model()->isRoleNotExist($this->group_name, $arrayMenuTask[$val])) {
						$model = new ItemChildren;
						$model->parent = $this->group_name;
						$model->child = $arrayMenuTask[$val];
						if(!$model->save()) {
							print_r($model->getErrors());
						}
					}
				}
				
			}
			
		}else { //update record			
			
			$model = MenuAuth::model()->findAll(array(					
				'select' => 'id, swt_menu_id, swt_users_group_id',
				'condition' => 'swt_users_group_id = :id',
				'params' => array(':id' => $this->id),
			));
			if($model != null) {
				//delete if not in array
				$arrIdToBeDel = array();
				$arrIdMenuNotInsert = array();
				foreach($model as $val) {
					if(!in_array( $val->swt_menu_id, $this->arrMenu)) {
						$arrIdToBeDel[] = $val->id;
						$arrMenuIdToBeDel[] = $val->swt_menu_id;
						
					}
					if(in_array($val->swt_menu_id, $this->arrMenu)) {
						$arrIdMenuNotInsert[] = $val->swt_menu_id;
					}
				}
				
				if(count($arrIdToBeDel) > 0) {
					$listIdToBeDel = implode(',', $arrIdToBeDel);					
					MenuAuth::model()->deleteAll(" id IN ($listIdToBeDel) ");
			
					if(count($this->arrMenu) > 0) {
						$arrTask = Menu::model()->getArrTask($arrMenuIdToBeDel);
						$listTaskToBeDel = implode(',', $arrTask);
						ItemChildren::model()->deleteAll("parent = '{$this->group_name}' AND child IN ($listTaskToBeDel) ");
					}
				}
				
				//insert new input to menu auth
				$newArr = array_values(array_diff($this->arrMenu, $arrIdMenuNotInsert));				
				foreach($newArr as $val) {
					$model = new MenuAuth;
					$model->swt_menu_id = $val;
					$model->swt_users_group_id = $this->id;
					$model->has_task = $arrayMenuTask[$val] == '0' ? 0 : 1;
					if(!$model->save()) {
						print_r($model->getErrors());
					}
				}
				
				//save to srbac
				$newMenuAuths = MenuAuth::model()->findAllByAttributes(array('swt_users_group_id'=>$this->id, 'has_task'=>1), array('select'=>'swt_menu_id'));
				foreach($newMenuAuths as $val) {
					$arrNewTask[] = $arrayMenuTask[$val->swt_menu_id];
				}
				/* $srbacTasks = ItemChildren::model()->findAllByAttributes(array('parent'=>$this->group_name), array('select'=>'child'));
				foreach($srbacTasks as $val) {
					$arrCurrTask[] = $arrayMenuTask[$val->swt_menu_id];
				} */
				
				if(count($arrNewTask) > 0) {
					foreach($arrNewTask as $val) {
						if(ItemChildren::model()->isRoleNotExist($this->group_name, $val)) {
							$model = new ItemChildren;							
							$model->parent = $this->group_name;
							$model->child = $val;	
							if(!$model->save()) {
								print_r($model->getErrors());
							}
						}
					}
				}
				
			}else { //update record (null condition)
				foreach($this->arrMenu as $val) {
					$model = new MenuAuth;
					$model->swt_menu_id = $val;
					$model->swt_users_group_id = $this->id;
					$model->has_task = $arrayMenuTask[$val] == '0' ? 0 : 1;
					if(!$model->save()) {
						print_r($model->getErrors());
					}
				}
				
				//save to srbac
				if(count($this->arrMenu) > 0) {
					foreach($this->arrMenu as $val) {
						if(ItemChildren::model()->isRoleNotExist($this->group_name, $arrayMenuTask[$val])) {
							$model = new ItemChildren;
							$model->parent = $this->group_name;
							$model->child = $arrayMenuTask[$val];
							if(!$model->save()) {
								print_r($model->getErrors());
							}
						}
					}
				}
			}				
		}	
		
	}
	
	
	/**
	 * After delete
	 */
	protected function afterDelete() {
		parent::afterDelete();	
		AuthItem::model()->deleteAllByAttributes(array('name'=>$this->group_name));
		Assignments::model()->deleteAll("itemname='".$this->group_name."'");
		ItemChildren::model()->deleteAll( "parent='".$this->group_name."'");
	}
	


}