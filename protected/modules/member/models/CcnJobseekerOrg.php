<?php

/**
 * This is the model class for table "ccn_jobseeker_org".
 *
 * The followings are the available columns in table 'ccn_jobseeker_org':
 * @property string $id
 * @property string $org_name
 * @property string $start_date
 * @property string $finish_date
 * @property string $position
 * @property string $description
 * @property integer $active
 * @property string $swt_users_id
 *
 * The followings are the available model relations:
 * @property SwtUsers $swtUsers
 */
class CcnJobseekerOrg extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnJobseekerOrg the static model class
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
		return 'ccn_jobseeker_org';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('org_name, start_date, finish_date, position, description, active, swt_users_id', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('org_name', 'length', 'max'=>70),
			array('position, description', 'length', 'max'=>50),
			array('swt_users_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, org_name, start_date, finish_date, position, description, active, swt_users_id', 'safe', 'on'=>'search'),
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
			'users' => array(self::BELONGS_TO, 'CcnUsers', 'swt_users_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'org_name' => Yii::t('label','Nama Organisasi'),
			'start_date' => Yii::t('label','Tanggal Mulai'),
			'finish_date' => Yii::t('label','Tanggal Berakhir'),
			'position' => Yii::t('label','Jabatan'),
			'description' => Yii::t('label','Keterangan'),
			'active' => Yii::t('label','Aktif'),
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
		$criteria->compare('org_name',$this->org_name,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('finish_date',$this->finish_date,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('active',$this->active);
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
			$this->defaultColumns[] = 'org_name';
			$this->defaultColumns[] = 'start_date';
			$this->defaultColumns[] = 'finish_date';
			$this->defaultColumns[] = 'position';
			$this->defaultColumns[] = 'description';
			$this->defaultColumns[] = 'active';
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
			$this->defaultColumns[] = 'org_name';
			$this->defaultColumns[] = 'start_date';
			$this->defaultColumns[] = 'finish_date';
			$this->defaultColumns[] = 'position';
			$this->defaultColumns[] = 'description';
			$this->defaultColumns[] = 'active';
			$this->defaultColumns[] = 'swt_users_id';
		}
		parent::afterConstruct();
	}

	protected function beforeValidate()
	{
		if(parent::beforeValidate()) {
			$this->start_date= date('Y-m-d',strtotime($this->start_date));
			$this->finish_date= date('Y-m-d',strtotime($this->finish_date));
			if($this->active == 1) {
				$this->finish_date = '0000-00-00';
			}
			if ($this->start_date > date('Y-m-d')) {
				$this->addError('start_date', 'Tahun masuk lebih besar dari tahun sekarang');
			}
                        if($this->active == 0 && ($this->finish_date < $this->start_date)) {
				$this->addError('start_date', 'Tahun masuk lebih besar dari tahun keluar');
			}elseif ($this->active == 0 && ($this->finish_date > date('Y-m-d'))) {
				$this->addError('finish_date', 'Tahun keluar lebih besar dari tahun sekarang');
			}	

			if($this->isNewRecord) {
				$this->swt_users_id = Yii::app()->user->id_user;
			}
		}
		return true;
	}

}