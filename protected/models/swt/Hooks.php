<?php

/**
 * This is the model class for table "swt_hooks".
 *
 * The followings are the available columns in table 'swt_hooks':
 * @property integer $id
 * @property string $hook_name
 * @property string $published
 * @property string $desc
 */
class Hooks extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return Hooks the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_hooks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hook_name, published', 'required', 'message' => '{attribute} tidak boleh kosong.'),
			array('hook_name', 'length', 'max'=>100),
			array('published', 'length', 'max'=>1),
			array('desc', 'length', 'max'=>255),
			array('hook_name', 'unique', 'message' => '{attribute} sudah ada.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hook_name, published, desc', 'safe', 'on'=>'search'),
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
			'hook_name' => Yii::t('label', 'Nama Hook'),
			'published' => Yii::t('label', 'Published'),
			'desc' => Yii::t('label', 'Desc'),
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

		$criteria->compare('hook_name',$this->hook_name,true);
		$criteria->compare('published',$this->published,true);
		$criteria->compare('desc',$this->desc,true);
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
			$this->defaultColumns[] = 'hook_name';
			$this->defaultColumns[] = 'published';
			$this->defaultColumns[] = 'desc';
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
			$this->defaultColumns[] = 'hook_name';
			$this->defaultColumns[] = 'published';
			$this->defaultColumns[] = 'desc';
		}
		parent::afterConstruct();
	}

	/**
	 * Return list of hook
	 *
	 * @return CHtml::listData of hook
	 */
	public function getListData() {
		$model = $this->findAll(array('select' => 'hook_name', 'order' => 'hook_name ASC'));
		return CHtml::listData($model, 'hook_name', 'hook_name');
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
