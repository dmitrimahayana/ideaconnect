<?php

/**
 * This is the model class for table "ccn_jobseeker_toefl".
 *
 * The followings are the available columns in table 'ccn_jobseeker_toefl':
 * @property string $id
 * @property integer $toefl_score
 * @property string $ielts_score
 * @property string $toefl_years
 * @property string $ielts_years
 * @property string $swt_users_id
 *
 * The followings are the available model relations:
 * @property SwtUsers $swtUsers
 */
class CcnJobseekerToefl extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnJobseekerToefl the static model class
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
		return 'ccn_jobseeker_toefl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('toefl_score, ielts_score, toefl_years, ielts_years, swt_users_id', 'required'),
			array('toefl_score', 'numerical', 'integerOnly'=>true,
				'message' => '{attribute} harus berupa angka'),
			array('ielts_score', 'length', 'max'=>3),
			array('toefl_years, ielts_years', 'length', 'max'=>4),
			array('swt_users_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, toefl_score, ielts_score, toefl_years, ielts_years, swt_users_id', 'safe', 'on'=>'search'),
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
			'toefl_score' => Yii::t('label','Nilai TOEFL'),
			'ielts_score' => Yii::t('label','Nilai IELTS '),
			'toefl_years' => Yii::t('label','Tahun tes TOEFL'),
			'ielts_years' => Yii::t('label','Tahun tes IELTS'),
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
		$criteria->compare('toefl_score',$this->toefl_score);
		$criteria->compare('ielts_score',$this->ielts_score,true);
		$criteria->compare('toefl_years',$this->toefl_years,true);
		$criteria->compare('ielts_years',$this->ielts_years,true);
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
			$this->defaultColumns[] = 'toefl_score';
			$this->defaultColumns[] = 'ielts_score';
			$this->defaultColumns[] = 'toefl_years';
			$this->defaultColumns[] = 'ielts_years';
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
			$this->defaultColumns[] = 'toefl_score';
			$this->defaultColumns[] = 'ielts_score';
			$this->defaultColumns[] = 'toefl_years';
			$this->defaultColumns[] = 'ielts_years';
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