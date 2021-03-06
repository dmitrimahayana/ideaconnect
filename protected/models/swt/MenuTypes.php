<?php

/**
 * This is the model class for table "swt_menu_types".
 *
 * The followings are the available columns in table 'swt_menu_types':
 * @property integer $id
 * @property string $menu_type
 * @property string $title
 * @property string $description
 *
 * The followings are the available model relations:
 * @property SwtMenu[] $swtMenus
 */
class MenuTypes extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return MenuTypes the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_menu_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_type, group_type', 'length', 'max'=>75),
			array('title, description', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu_type, title, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swt_menus' => array(self::HAS_MANY, 'SwtMenu', 'menu_types_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'menu_type' => Yii::t('label', 'menu_type'),
			'title' => Yii::t('label', 'Title'),
			'description' => Yii::t('label', 'Description'),
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

		$criteria->compare('menu_type',$this->menu_type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
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
			$this->defaultColumns[] = 'group_type';
			$this->defaultColumns[] = 'menu_type';
			$this->defaultColumns[] = 'title';
			$this->defaultColumns[] = 'description';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		$current = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = 'group_type';
			$this->defaultColumns[] = 'menu_type';
			$this->defaultColumns[] = 'title';
			$this->defaultColumns[] = 'description';
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