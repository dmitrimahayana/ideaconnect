<?php

/**
 * This is the model class for table "ccn_country".
 *
 * The followings are the available columns in table 'ccn_country':
 * @property string $code
 * @property string $name
 * @property string $alias
 *
 * The followings are the available model relations:
 * @property CcnEmployerData[] $ccnEmployerDatas
 * @property CcnEmployerData[] $ccnEmployerDatas1
 * @property CcnJobseekerEdu[] $ccnJobseekerEdus
 */
class CcnCountry extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnCountry the static model class
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
		return 'ccn_zone_country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' name, alias', 'required'),
			array('code', 'length', 'max'=>2),
			array('name', 'length', 'max'=>100),
			array('alias', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('code, name, alias', 'safe', 'on'=>'search'),
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
			'ccnEmployerDatas' => array(self::HAS_MANY, 'CcnEmployerData', 'cp_country_code'),
			'ccnEmployerDatas1' => array(self::HAS_MANY, 'CcnEmployerData', 'country_code'),
			'ccnJobseekerEdus' => array(self::HAS_MANY, 'CcnJobseekerEdu', 'country_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'code' => Yii::t('label','Code'),
			'name' => Yii::t('label','Name'),
			'alias' => Yii::t('label','Alias'),
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

		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);

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
			$this->defaultColumns[] = 'code';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'alias';
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
			$this->defaultColumns[] = 'code';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'alias';
		}
		parent::afterConstruct();
	}


}