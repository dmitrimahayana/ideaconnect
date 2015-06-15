<?php

/**
 * This is the model class for table "ccn_jobseeker_lang".
 *
 * The followings are the available columns in table 'ccn_jobseeker_lang':
 * @property string $id
 * @property string $lang_name
 * @property integer $ability
 * @property string $created
 * @property string $swt_users_id
 *
 * The followings are the available model relations:
 * @property SwtUsers $swtUsers
 */
class CcnJobseekerLang extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnJobseekerLang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ccn_jobseeker_lang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lang_name, ability, created, swt_users_id', 'required'),
			array('ability', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>10),
			array('lang_name, created', 'length', 'max'=>45),
			array('swt_users_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, lang_name, ability, created, swt_users_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swtUsers' => array(self::BELONGS_TO, 'SwtUsers', 'swt_users_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'lang_name' => Yii::t('label','Bahasa'),
			'ability' => Yii::t('label','Kemampuan'),
			'created' => Yii::t('label','Created'),
			'swt_users_id' => Yii::t('label','Swt Users'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('lang_name',$this->lang_name,true);
		$criteria->compare('ability',$this->ability);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('swt_users_id',$this->swt_users_id,true);

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
			$this->defaultColumns[] = 'lang_name';
			$this->defaultColumns[] = 'ability';
			$this->defaultColumns[] = 'created';
			$this->defaultColumns[] = 'swt_users_id';
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
			$this->defaultColumns[] = 'lang_name';
			$this->defaultColumns[] = 'ability';
			$this->defaultColumns[] = 'created';
			$this->defaultColumns[] = 'swt_users_id';
		}
		parent::afterConstruct();
	}

	protected function beforeValidate()
	{
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				$this->swt_users_id = Yii::app()->user->id_user;
				$this->created = date('Y-m-d H:i:s');
			}
		}
		return true;
	}
	
	/** 
	* get data array language
	 */	
	public static function getArrLanguage() {
		return array(
				1	=> 'Prancis',
				2	=> 'Mandarin',
				3	=> 'Korea',
				4	=> 'Belanda',
			);
	}
	
	/** 
	* get data language
	 */	
	public static function getlanguage($id) {
		$arrLang = self::getArrLanguage();
		return $arrLang[$id];
	}
	
	/** 
	* get data array ability
	 */	
	public static function getArrAbility() {
		return array(
				1	=> 'Cukup',
				2	=> 'Baik',
				3	=> 'Sangat Baik',
			);
	}
	
	/** 
	* get data ability
	 */	
	public static function getAbility($id) {
		$arrAbility = self::getArrAbility();
		return $arrAbility[$id];
	}

}