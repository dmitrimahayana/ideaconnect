<?php

/**
 * This is the model class for table "ccn_city".
 *
 * The followings are the available columns in table 'ccn_city':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property CcnEmployerData[] $ccnEmployerDatas
 * @property CcnEmployerData[] $ccnEmployerDatas1
 * @property CcnJobseekerBio[] $ccnJobseekerBios
 * @property CcnJobseekerBio[] $ccnJobseekerBios1
 * @property CcnJobseekerEdu[] $ccnJobseekerEdus
 */
class CcnCity extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnCity the static model class
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
		return 'ccn_zone_city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name', 'required'),
			array('id', 'numerical', 'integerOnly'=>true,
				'message' => '{attribute} harus berupa angka'),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'ccnEmployerDatas' => array(self::HAS_MANY, 'CcnEmployerData', 'cp_city_id'),
			'ccnEmployerDatas1' => array(self::HAS_MANY, 'CcnEmployerData', 'city_id'),
			'ccnJobseekerBios' => array(self::HAS_MANY, 'CcnJobseekerBio', 'city_id'),
			'ccnJobseekerBios1' => array(self::HAS_MANY, 'CcnJobseekerBio', 'origin_city_id'),
			'ccnJobseekerEdus' => array(self::HAS_MANY, 'CcnJobseekerEdu', 'city_id'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'name' => Yii::t('label','Nama'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);

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
			$this->defaultColumns[] = 'name';
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
			$this->defaultColumns[] = 'name';
		}
		parent::afterConstruct();
	}


}