<?php

/**
 * This is the model class for table "ccn_jobseeker_add".
 *
 * The followings are the available columns in table 'ccn_jobseeker_add':
 * @property string $id_add
 * @property integer $abroad
 * @property integer $travel_ok
 * @property integer $vehicle
 * @property integer $sim_a
 * @property integer $sim_c
 * @property integer $passport
 * @property integer $available
 * @property string $available_time
 * @property string $additional_info
 */
class CcnJobseekerAdd extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnJobseekerAdd the static model class
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
		return 'ccn_jobseeker_add';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('abroad, travel_ok, vehicle, sim_a, sim_c, passport, available, available_time, additional_info', 'required'),
			array('abroad, travel_ok, vehicle, sim_a, sim_c, passport, available', 'numerical', 'integerOnly'=>true,
				'message' => '{attribute} harus berupa angka'),
			array('id_add', 'length', 'max'=>11),
			array('available_time', 'length', 'max'=>50),
			array('additional_info', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_add, abroad, travel_ok, vehicle, sim_a, sim_c, passport, available, available_time, additional_info', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_add' => Yii::t('label','Id Add'),
			'abroad' => Yii::t('label','Abroad'),
			'travel_ok' => Yii::t('label','Travel Ok'),
			'vehicle' => Yii::t('label','Vehicle'),
			'sim_a' => Yii::t('label','Sim A'),
			'sim_c' => Yii::t('label','Sim C'),
			'passport' => Yii::t('label','Passport'),
			'available' => Yii::t('label','Available'),
			'available_time' => Yii::t('label','Available Time'),
			'additional_info' => Yii::t('label','Additional Info'),
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

		$criteria->compare('id_add',$this->id_add,true);
		$criteria->compare('abroad',$this->abroad);
		$criteria->compare('travel_ok',$this->travel_ok);
		$criteria->compare('vehicle',$this->vehicle);
		$criteria->compare('sim_a',$this->sim_a);
		$criteria->compare('sim_c',$this->sim_c);
		$criteria->compare('passport',$this->passport);
		$criteria->compare('available',$this->available);
		$criteria->compare('available_time',$this->available_time,true);
		$criteria->compare('additional_info',$this->additional_info,true);

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
			$this->defaultColumns[] = 'id_add';
			$this->defaultColumns[] = 'abroad';
			$this->defaultColumns[] = 'travel_ok';
			$this->defaultColumns[] = 'vehicle';
			$this->defaultColumns[] = 'sim_a';
			$this->defaultColumns[] = 'sim_c';
			$this->defaultColumns[] = 'passport';
			$this->defaultColumns[] = 'available';
			$this->defaultColumns[] = 'available_time';
			$this->defaultColumns[] = 'additional_info';
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
			$this->defaultColumns[] = 'id_add';
			$this->defaultColumns[] = 'abroad';
			$this->defaultColumns[] = 'travel_ok';
			$this->defaultColumns[] = 'vehicle';
			$this->defaultColumns[] = 'sim_a';
			$this->defaultColumns[] = 'sim_c';
			$this->defaultColumns[] = 'passport';
			$this->defaultColumns[] = 'available';
			$this->defaultColumns[] = 'available_time';
			$this->defaultColumns[] = 'additional_info';
		}
		parent::afterConstruct();
	}


}