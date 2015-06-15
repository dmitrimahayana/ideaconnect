<?php

/**
 * This is the model class for table "swt_com_extensions".
 *
 * The followings are the available columns in table 'swt_com_extensions':
 * @property integer $id
 * @property string $name
 * @property string $element
 * @property string $folder
 * @property integer $access
 * @property integer $ordering
 * @property integer $published
 * @property string $params
 */
class ComExtensions extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return ComExtensions the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_com_extensions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('params', 'required'),
			array('access, ordering, published', 'numerical', 'integerOnly'=>true),
			array('name, element, folder', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, element, folder, access, ordering, published, params', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'name' => Yii::t('label', 'Name'),
			'element' => Yii::t('label', 'Element'),
			'folder' => Yii::t('label', 'Folder'),
			'access' => Yii::t('label', 'Access'),
			'ordering' => Yii::t('label', 'Ordering'),
			'published' => Yii::t('label', 'Published'),
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('element',$this->element,true);
		$criteria->compare('folder',$this->folder,true);
		$criteria->compare('access',$this->access);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('published',$this->published);
		$criteria->compare('params',$this->params,true);
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
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'element';
			$this->defaultColumns[] = 'folder';
			$this->defaultColumns[] = 'access';
			$this->defaultColumns[] = 'ordering';
			$this->defaultColumns[] = 'published';
			$this->defaultColumns[] = 'params';
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
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'element';
			$this->defaultColumns[] = 'folder';
			$this->defaultColumns[] = 'access';
			//$this->defaultColumns[] = 'ordering';
			$this->defaultColumns[] = 'published';
			//$this->defaultColumns[] = 'params';
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