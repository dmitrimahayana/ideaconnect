<?php

/**
 * This is the model class for table "swt_menu".
 *
 * The followings are the available columns in table 'swt_menu':
 * @property integer $id
 * @property integer $menu_types_id
 * @property integer $com_modules_id
 * @property string $menu_type
 * @property string $name
 * @property string $url
 * @property string $alias_url
 * @property string $dest_type
 * @property integer $published
 * @property string $parent
 * @property integer $ordering
 * @property integer $access
 * @property string $params
 *
 * The followings are the available model relations:
 * @property SwtComModules $comModules
 * @property SwtMenuTypes $menuTypes
 * @property SwtMenuLang[] $swtMenuLangs
 * @property SwtTemplatesMenu[] $swtTemplatesMenus
 */
class Menu extends CActiveRecord
{
	public $defaultColumns = array();
	public $roleUser = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, alias_url, module, controller, action, menu_types_id, dest_type, menu_type, srbac_items_task_name, roleUser', 'required'),
			array('menu_types_id, com_modules_id, published, ordering, access, dest_id, in_use', 'numerical', 'integerOnly'=>true),
			array('menu_type, module, controller, action', 'length', 'max'=>70),
			array('name, attr_url', 'length', 'max'=>100),
			array('alias_url', 'length', 'max'=>255),
			array('srbac_items_task_name', 'length', 'max'=>80),
			array('dest_type, icon, group_pages, template, layout', 'length', 'max'=>50),
			array('parent', 'length', 'max'=>11),
			array('url, params, roleUser', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu_types_id, com_modules_id, menu_type, name, url, alias_url, dest_type, published, parent, ordering, access, params', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'com_modules' => array(self::BELONGS_TO, 'ComModules', 'com_modules_id'),
			'menu_types' => array(self::BELONGS_TO, 'MenuTypes', 'menu_types_id'),
			'parent_name' => array(self::BELONGS_TO, 'Menu', 'parent'),
			'swt_menu_langs' => array(self::HAS_MANY, 'MenuLang', 'menu_id'),
			'swt_templates_menus' => array(self::HAS_MANY, 'TemplatesMenu', 'menu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'menu_types_id' => Yii::t('label', 'Menu Types'),
			'com_modules_id' => Yii::t('label', 'Com Modules'),
			'menu_type' => Yii::t('label', 'menu_type'),
			'name' => Yii::t('label', 'Link Name'),
			'url' => Yii::t('label', 'Url'),
			'alias_url' => Yii::t('label', 'Alias Url'),
			'dest_type' => Yii::t('label', 'Destination Type'),
			'published' => Yii::t('label', 'Published'),
			'parent' => Yii::t('label', 'Parent'),
			'ordering' => Yii::t('label', 'Order'),
			'access' => Yii::t('label', 'Access'),
			'params' => Yii::t('label', 'Params'),
			'dest_id' => Yii::t('label', 'Destination ID'),
			'srbac_items_task_name' => Yii::t('label', 'SRBAC Item task'),
			'roleUser' => Yii::t('label', 'SRBAC Role User'),
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

		$criteria->compare('menu_types_id',$this->menu_types_id);
		$criteria->compare('com_modules_id',$this->com_modules_id);
		$criteria->compare('menu_type',$this->menu_type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('alias_url',$this->alias_url,true);
		$criteria->compare('dest_type',$this->dest_type,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('parent',$this->parent,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('access',$this->access);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('in_use',$this->in_use);
		$criteria->order = 'parent';
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			/* 'pagination'=>array(
				'pageSize'=>20,
			), */
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
			$this->defaultColumns[] = 'group_pages';
			$this->defaultColumns[] = 'published';
			$this->defaultColumns[] = 'menu_types_id';
			$this->defaultColumns[] = 'menu_type';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'in_use';
			$this->defaultColumns[] = 'module';
			$this->defaultColumns[] = 'controller';
			$this->defaultColumns[] = 'action';
			$this->defaultColumns[] = 'attr_url';
			$this->defaultColumns[] = 'url';
			$this->defaultColumns[] = 'alias_url';
			$this->defaultColumns[] = 'template';
			$this->defaultColumns[] = 'layout';
			$this->defaultColumns[] = 'com_modules_id';
			$this->defaultColumns[] = 'dest_type';
			$this->defaultColumns[] = 'dest_id';
			$this->defaultColumns[] = 'icon';
			$this->defaultColumns[] = 'parent';
			$this->defaultColumns[] = 'ordering';
			$this->defaultColumns[] = 'access';
			$this->defaultColumns[] = 'params';
			$this->defaultColumns[] = 'level';
			$this->defaultColumns[] = 'lft';
			$this->defaultColumns[] = 'rgt';
			$this->defaultColumns[] = 'home';
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
			$this->defaultColumns[] = array(
				'header'=> 'Parent Name',
				'value' => '$data->parent_name->name'
			);
			$this->defaultColumns[] = 'module';
			$this->defaultColumns[] = 'url';
			$this->defaultColumns[] = 'ordering';
			$this->defaultColumns[] = array(
				'name' => 'in_use',
				'value' => 'Utility::getPublishedToImg($data->in_use)',
				'htmlOptions' => array('class'=>'center'),
				'type' => 'raw'
			);
			$this->defaultColumns[] = array(
				'name' => 'published',
				'value' => 'Utility::getPublishedToImg($data->published)',
				'htmlOptions' => array('class'=>'center'),
				'type' => 'raw'
			);
		}
		parent::afterConstruct();
	}

	/* *
	 * Create menu link
	 * params url, module, controller, action, attr_url
	 */
	public function createLink($url, $module, $controller, $action, $attrUrl, $aliasUrl) {
		if($url == null)
			$link = 'javascript:void(0);';
		elseif($url != 'javascript:void(0);') {
			$linkAction = $module != '-'? $module.'/'.$controller.'/'.$action : $controller.'/'.$action;
			$attr = array();
			if($attrUrl != '-') {
				$arrAttr = explode('&', $attrUrl);
				if(count($arrAttr) > 0) {
					foreach($arrAttr as $val) {
						$part = explode('=', $val);
						$attr[$part[0]] = $part[1];
					}
				}
			}
			
			$conAct = $controller.'/'.$action;
			if(($conAct  != 'site/index' && $conAct != '/') || ($module != '-' && $conAct  == 'site/index' && $conAct != '/'))
				$attr['t'] = $aliasUrl;
		//	if(strpos(Yii::app()->theme->name, 'sweeto') !== false) //seo url is not set in admin template
			//	$attr['t'] = ' ';
			$link = Yii::app()->createUrl($linkAction, $attr);
		}else
			$link = 'javascript:void(0);';
			
		return $link;
	
	}

	protected function beforeValidate()
	{
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				$count = self::model()->findAll(array(
					'condition' => 'parent = :id AND group_pages = :group',
					'params' => array(
						':id' => $this->parent,
						':group' => $this->group_pages
					)
				));
				$this->ordering = count($count) + 1;
			}
			if($this->dest_type == 'no_link') {
				$this->url = 'javascript:void(0);';
				$this->srbac_items_task_name = 0;
				$this->module = '-';
				$this->controller = '-';				
				$this->action = '-';
				$this->attr_url = '-';
			}
		}
		return true;
	}

	protected function afterDelete()
	{
		parent::afterDelete();
		$order = self::model()->findAll(array(
			'condition' => 'parent = :id AND group_pages = :group',
			'params' => array(
				':id' => $this->parent,
				':group' => $this->group_pages
			)
		));

		foreach($order as $val) {
			if ($val->ordering > $this->ordering) {
				$update = self::model()->findByPk($val->id);
				$update->ordering = $update->ordering - 1;
				$update->update();
			}
		}
	}
	
	protected function afterSave()	{
		parent::afterSave();
		
		//saving user group menu 
		if(is_array($this->roleUser)) {
			if($this->srbac_items_task_name !== 0) {
				$userGroup = UsersGroup::model()->findAll(array('condition'=>'id NOT IN (4,5,6) '));
				foreach($userGroup as $val) {
					$arrayRoles[$val->id] = $val->group_name;
				}
			}
		
				
			if($this->isNewRecord) { //new record
				//file_put_contents('assets/new_cek_task.txt', $this->srbac_items_task_name);
				//save to menu auth
				foreach($this->roleUser as $val) {
					$model = new MenuAuth;
					$model->swt_menu_id = $this->id;
					$model->swt_users_group_id = $val;
					$model->has_task = $this->srbac_items_task_name == '0' ? 0 : 1;
					if(!$model->save()) {
						print_r($model->getErrors());
					}					
				}
				
				//save to srbac
				if($this->srbac_items_task_name !== 0) {
					foreach($this->roleUser as $val) {
						if(ItemChildren::model()->isRoleNotExist($val, $this->srbac_items_task_name)) {
							$model = new ItemChildren;
							$model->parent = $arrayRoles[$val];
							$model->child = $this->srbac_items_task_name;
							if(!$model->save()) {
								print_r($model->getErrors());
							}
						}
					}
				}
				
			}else { ////update record
				
				$model = MenuAuth::model()->findAll(array(					
					'select' => 'id, swt_users_group_id',
					'condition' => 'swt_menu_id = :id',
					'params' => array(':id' => $this->id),
				));
				if($model != null) {
					//delete if not in array
					$arrIdToBeDel = array();
					$arrIdMajorNotInsert = array();
					foreach($model as $val) {
						if(!in_array( $val->swt_users_group_id, $this->roleUser)) {
							$arrIdToBeDel[] = $val->id;
							$arrGroupIdToBeDel[] = $val->swt_users_group_id;
							
						}
						if(in_array( $val->swt_users_group_id, $this->roleUser)) {
							$arrIdMajorNotInsert[] = $val->swt_users_group_id;
						}
					}
					
					if(count($arrIdToBeDel) > 0) {
						$listIdToBeDel = implode(',', $arrIdToBeDel);
						MenuAuth::model()->deleteAll(" id IN ($listIdToBeDel) ");
				
						if($this->srbac_items_task_name !== 0) {
							$arrRoles = UsersGroup::model()->getArrRoles($arrGroupIdToBeDel);
							$listRoleToBeDel = implode(',', $arrRoles);							
							//file_put_contents('assets/delete_task.txt', $listRoleToBeDel);
							ItemChildren::model()->deleteAll("parent IN ($listRoleToBeDel) AND child = '{$this->srbac_items_task_name}' ");
						}
					}
					
					//insert new input to menu auth
					$newArr = array_values(array_diff($this->roleUser, $arrIdMajorNotInsert));						
					foreach($newArr as $val) {
						$model = new MenuAuth;
						$model->swt_menu_id = $this->id;
						$model->swt_users_group_id = $val;
						$model->has_task = $this->srbac_items_task_name == '0' ? 0 : 1;
						if(!$model->save()) {
							print_r($model->getErrors());
						}
					}
					
					//save to srbac
					if($this->srbac_items_task_name !== 0) {
						
						foreach($newArr as $val) {
							if(ItemChildren::model()->isRoleNotExist($val, $this->srbac_items_task_name)) {
								//file_put_contents('assets/cek_task_'.$val.'.txt', $val);
								$model = new ItemChildren;
								$model->parent = $arrayRoles[$val];//role tobe
								$model->child = $this->srbac_items_task_name;
								if(!$model->save()) {
									print_r($model->getErrors());
								}
							}
						}
					}
					
				}else { //update record (null condition)
					foreach($this->roleUser as $val) {
						$model = new MenuAuth;
						$model->swt_menu_id = $this->id;
						$model->swt_users_group_id = $val;
						$model->has_task = $this->srbac_items_task_name == '0' ? 0 : 1;
						if(!$model->save()) {
							print_r($model->getErrors());
						}
					}
					
					//save to srbac
					if($this->srbac_items_task_name !== 0) {
						foreach($this->roleUser as $val) {
							if(ItemChildren::model()->isRoleNotExist($val, $this->srbac_items_task_name)) {
								$model = new ItemChildren;
								$model->parent = $arrayRoles[$val];
								$model->child = $this->srbac_items_task_name;
								if(!$model->save()) {
									print_r($model->getErrors());
								}
							}
						}
					}
				}				
			}			
		}	
		
	}
	
	
	/**
	 * Get array task
	 *	@param arr menu id
	 * @return array task
	 */
	public function getArrTask($arrMenuId) {
		$result = array();
		$listMenuId = implode(',', $arrMenuId);
		$model = self::model()->findAll(array(
			'select'=>'srbac_items_task_name',
			'condition'=>"id IN ($listMenuId)",			
		));
		if($model != null) {			
			foreach($model as $val) {
				if($val->srbac_items_task_name != '0')
					$result[] = "'{$val->srbac_items_task_name}'";		
			}
		}
		return $result;
	 }	
		
}