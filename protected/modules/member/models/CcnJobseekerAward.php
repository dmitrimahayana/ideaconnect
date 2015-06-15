<?php

/**
 * This is the model class for table "ccn_jobseeker_award".
 *
 * The followings are the available columns in table 'ccn_jobseeker_award':
 * @property string $id
 * @property string $award_name
 * @property string $sponsor
 * @property string $year
 * @property string $note
 * @property string $swt_users_id
 *
 * The followings are the available model relations:
 * @property SwtUsers $swtUsers
 */
class CcnJobseekerAward extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnJobseekerAward the static model class
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
		return 'ccn_jobseeker_award';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('award_name, sponsor, year, note, swt_users_id', 'required'),
			array('id, swt_users_id', 'length', 'max'=>11),
			array('award_name, sponsor', 'length', 'max'=>70),
			array('year', 'length', 'max'=>4),
			array('note', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, award_name, sponsor, year, note, swt_users_id', 'safe', 'on'=>'search'),
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
			'award_name' => Yii::t('label','Nama Penghargaan'),
			'sponsor' => Yii::t('label','Pemberi'),
			'year' => Yii::t('label','Tahun'),
			'note' => Yii::t('label','Keterangan'),
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
		$criteria->compare('award_name',$this->award_name,true);
		$criteria->compare('sponsor',$this->sponsor,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('note',$this->note,true);
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
			$this->defaultColumns[] = 'award_name';
			$this->defaultColumns[] = 'sponsor';
			$this->defaultColumns[] = 'year';
			$this->defaultColumns[] = 'note';
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
			$this->defaultColumns[] = 'award_name';
			$this->defaultColumns[] = 'sponsor';
			$this->defaultColumns[] = 'year';
			$this->defaultColumns[] = 'note';
			$this->defaultColumns[] = 'swt_users_id';
		}
		parent::afterConstruct();
	}

	protected function beforeValidate()
	{
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				$this->swt_users_id = Yii::app()->user->id_user;
			}
		}
		return true;
	}

}