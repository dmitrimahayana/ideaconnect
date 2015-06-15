<?php

/**
 * This is the model class for table "swt_com_modules".
 *
 * The followings are the available columns in table 'swt_com_modules':
 * @property integer $id
 * @property string $name
 * @property string $public_menu_link
 * @property string $admin_menu_link
 * @property string $parent
 * @property string $module
 * @property integer $ordering
 * @property string $params
 * @property integer $enabled
 *
 * The followings are the available model relations:
 * @property SwtComWidgets[] $swtComWidgets
 * @property SwtMenu[] $swtMenus
 */
class ComModules extends CActiveRecord
{
	public $defaultColumns = array();
	private $_moduleId; // for deleting all widgets row

	/**
	 * Returns the static model of the specified AR class.
	 * @return ComModules the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_com_modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required', 'message' => '{attribute} tidak boleh kosong'),
			array('ordering, enabled', 'numerical', 'integerOnly'=>true),
			array('name, module', 'length', 'max'=>50),
			array('public_menu_link, admin_menu_link', 'length', 'max'=>255),
			array('parent, subscribe_group_user', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, public_menu_link, admin_menu_link, parent, module,
				ordering, params, enabled, subscribe_exist, subscribe_active, subscribe_url_get_form, label', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swt_com_widgets' => array(self::HAS_MANY, 'SwtComWidgets', 'com_modules_id'),
			'swt_menus' => array(self::HAS_MANY, 'SwtMenu', 'com_modules_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id'               => Yii::t('label', 'ID'),
			'name'             => Yii::t('label', 'Nama Modul'),
			'public_menu_link' => Yii::t('label', 'Public Menu Link'),
			'admin_menu_link'  => Yii::t('label', 'Admin Menu Link'),
			'parent'           => Yii::t('label', 'Parent'),
			'module'           => Yii::t('label', 'Modul'),
			'ordering'         => Yii::t('label', 'Ordering'),
			'params'           => Yii::t('label', 'Params'),
			'enabled'          => Yii::t('label', 'Diizinkan'),
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('public_menu_link',$this->public_menu_link,true);
		$criteria->compare('admin_menu_link',$this->admin_menu_link,true);
		$criteria->compare('parent',$this->parent,true);
		$criteria->compare('module',$this->module,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('enabled',$this->enabled);

		if(!isset($_GET['ComModules_sort'])) {
			$criteria->order = 'id DESC';
		}

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
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);

				}else {
					$this->defaultColumns[] = $val;
				}
			}

		}else {
			$this->defaultColumns[] = 'public_menu_link';
			$this->defaultColumns[] = 'admin_menu_link';
			$this->defaultColumns[] = 'parent';
			$this->defaultColumns[] = array(
				'name'  => 'enabled',
				'value' => '$data->enabled == 1? "Ya": "Tidak"',
			);
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

			$this->defaultColumns[] = array(
				'name' => 'name',
				'type' => 'raw',
				'value' => 'CHtml::link($data->name, Yii::app()->createUrl($data->name))',
			);
		}
		parent::afterConstruct();
	}

	/**
	 * Return list of module
	 *
	 * @return CHtml::listData of module
	 */
	public function getListData() {
		$model = ComModules::model()->findAll(array('select' => 'id, name', 'order' => 'name ASC'));
		return CHtml::listData($model, 'id', 'name');
	}

	/**
	 * Register all widget to widget table
	 *
	 * @param string $configName yaml file name
	 */
	public function registerWidget($configName) {
		Yii::import('ext.Spyc');
		$setting = Spyc::YAMLLoad($configName);

		$sql  = 'INSERT INTO swt_com_widgets(com_modules_id, ordering, hook_position, enabled, ';
		$sql .= 'widget_type) VALUES';
		if(isset($setting['widgets'])) {
			$moduleId = $this->getModuleId(trim($setting['folder_name']));
			$i        = 1;
			$total    = count($setting['widgets']);
			foreach($setting['widgets'] as $key => $val) {
				if($i == $total) {
					$sql .= '('.$moduleId.', 0, "'.$val['hook_position'] .'", '. $val['enabled'];
					$sql .= ', "'. $val['widget_type'] .'");';

				}else {
					$sql .= '('.$moduleId.', 0, "'.$val['hook_position'] .'", '. $val['enabled'];
					$sql .= ', "'. $val['widget_type'] .'"),';
				}
				$i++;
			}
			Yii::app()->db->createCommand($sql)->execute();
		}
	}

	/**
	 * Get module id by name
	 *
	 * @param string $name
	 * @return integer module id, otherwise '0'
	 */
	public function getModuleId($name) {
		$model = ComModules::model()->findByAttributes(array('name' => $name), array(
			'select' => 'id',
		));

		if($model !== null)
			return $model->id;
		else
			return '0';
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
	 * Delete all widget in swt_com_widgets
	 */
	protected function afterDelete() {
		parent::afterDelete();
		Yii::app()->db->createCommand('DELETE FROM swt_com_widgets WHERE com_modules_id= :mid')
			->execute(array(':mid' => $this->_moduleId));
	}

	/**
	 * Save some attributes for next event
	 */
	protected function afterFind() {
		parent::afterFind();
		$this->_moduleId = $this->id;
	}

	/**
	 * Delete all table that created from module
	 */
	protected function beforeDelete() {
		if(parent::beforeDelete()) {
			Yii::import('ext.Spyc');

			$setting = null;
			if(file_exists(Yii::getPathOfAlias("modules.{$this->name}")."/{$this->name}.yaml")) {
				$setting = Spyc::YAMLLoad(Yii::getPathOfAlias("modules.{$this->name}")."/{$this->name}.yaml");
			}

			if($setting !== null) {
				$tableName = trim($setting['table_name']);
				Yii::app()->db->createCommand("DROP TABLE IF EXISTS {$tableName}")->execute();
			}
		}
		return true;
	}
	
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
			foreach($arrParams as $key=>$val) {
				if(strpos($val, $startType) !== false)
					$index = $key;
			}
			$replaces = str_replace(array($startType, $endType), array('', ''), $arrParams[$index]);
			$listParams = explode(',', $replaces);
			foreach($listParams as $val) {
				$part = explode('=', $val);
				$result[trim($part[0])] = trim($part[1]);
			}
		}
		return $result;
	 }


}
