<?php

/**
 * This is the model class for table "ccn_jobseeker_skill".
 *
 * The followings are the available columns in table 'ccn_jobseeker_skill':
 * @property integer $id
 * @property string $technical_skill
 * @property string $non_technical_skill
 * @property string $computer_skill
 * @property string $other
 * @property string $swt_users_id
 *
 * The followings are the available model relations:
 * @property SwtUsers $swtUsers
 */
class CcnJobseekerSkill extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnJobseekerSkill the static model class
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
		return 'ccn_jobseeker_skill';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('technical_skill, non_technical_skill, computer_skill, other, swt_users_id', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('swt_users_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, technical_skill, non_technical_skill, computer_skill, other, swt_users_id', 'safe', 'on'=>'search'),
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
			'technical_skill' => Yii::t('label','Keterampilan Teknis'),
			'non_technical_skill' => Yii::t('label','Keterampilan Non Teknis'),
			'computer_skill' => Yii::t('label','Keterampilan Komputer'),
			'other' => Yii::t('label','Lainnya'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('technical_skill',$this->technical_skill,true);
		$criteria->compare('non_technical_skill',$this->non_technical_skill,true);
		$criteria->compare('computer_skill',$this->computer_skill,true);
		$criteria->compare('other',$this->other,true);
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
			$this->defaultColumns[] = 'technical_skill';
			$this->defaultColumns[] = 'non_technical_skill';
			$this->defaultColumns[] = 'computer_skill';
			$this->defaultColumns[] = 'other';
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
			$this->defaultColumns[] = 'technical_skill';
			$this->defaultColumns[] = 'non_technical_skill';
			$this->defaultColumns[] = 'computer_skill';
			$this->defaultColumns[] = 'other';
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