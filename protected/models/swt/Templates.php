<?php

/**
 * This is the model class for table "swt_templates".
 *
 * The followings are the available columns in table 'swt_templates':
 * @property integer $id
 * @property string $template
 * @property string $default_theme
 * @property string $path_folder
 * @property string $thumbnail
 *
 * The followings are the available model relations:
 * @property SwtTemplatesMenu[] $swtTemplatesMenus
 */
class Templates extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return Templates the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_templates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('path_folder', 'required'),
			array('template, layout, path_folder, group_page', 'length', 'max'=>100),
			array('default_theme', 'length', 'max'=>1),
			array('thumbnail', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, template, default_theme, path_folder, thumbnail', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swt_templates_menus' => array(self::HAS_MANY, 'SwtTemplatesMenu', 'templates_id'),
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
			$criteria->AddCondition('id != 1');
		$criteria->compare('template',$this->template,true);
		$criteria->compare('default_theme',$this->default_theme,true);
		$criteria->compare('path_folder',$this->path_folder,true);
		$criteria->compare('thumbnail',$this->thumbnail,true);
		//$criteria->order = ''
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
			$this->defaultColumns[] = 'group_page';
			$this->defaultColumns[] = 'default_theme';
			$this->defaultColumns[] = 'template';
			$this->defaultColumns[] = 'layout';
			$this->defaultColumns[] = 'path_folder';
			$this->defaultColumns[] = 'thumbnail';
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
			$this->defaultColumns[] = 'group_page';
			$this->defaultColumns[] = 'template';
			$this->defaultColumns[] =  array(
				'header' => 'Default',
				'name' => 'default_theme',
				'value' => '$data->default_theme == 1? "Ya": "Tidak"',
				'htmlOptions' => array(
					'class' => 'center',
				),
			);
			//$this->defaultColumns[] = 'path_folder';
			//$this->defaultColumns[] = 'thumbnail';
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
	protected function beforeSave() {
		if(parent::beforeSave()) {
			$this->updateAll(array('default_theme' => '0'),
				array(
					'condition' => 'group_page= :group_page',
					'params'    => array(':group_page' => $this->group_page)
				)
			);
		}
		return true;
	}
	
	
	/**
	 * After save attributes
	 */
	/* protected function afterSave() {
		parent::afterSave();
		// Create action		
	} */


	/**
	 * Get group page from enum values
	 *
	 * @return array
	 */
	public function getGroupPage() {
		$sql    = 'SHOW COLUMNS FROM swt_templates WHERE FIELD = "group_page"';
		$model  = Yii::app()->db->createCommand($sql)->queryAll();
		$group  = preg_replace("/enum\(|\)|'/i", '', $model[0]['Type']);
		$group  = explode(',', $group);
		$result = array();
		foreach($group as $val) {
			$result[$val] = $val;
		}

		return $result;
	}
}
