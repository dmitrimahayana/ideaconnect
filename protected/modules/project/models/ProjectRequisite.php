<?php

/**
 * This is the model class for table "ic_project_requisite".
 *
 * The followings are the available columns in table 'ic_project_requisite':
 * @property string $id
 * @property string $project_id
 * @property integer $counter_time
 * @property string $total_value
 * @property string $funded
 * @property integer $is_funded
 * @property integer $funding_time
 * @property string $funding_started_time
 * @property string $funding_closed_time
 * @property string $argument
 * @property integer $is_proposed
 * @property integer $is_approved
 * @property string $approved_time
 * @property string $approver_id
 *
 * The followings are the available model relations:
 * @property IcFunding[] $icFundings
 * @property IcFundingUser[] $icFundingUsers
 * @property IcMaterial[] $icMaterials
 * @property SwtUsers $approver
 * @property IcProject $project
 * @property IcVolunteerRequirement[] $icVolunteerRequirements
 */
class ProjectRequisite extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjectRequisite the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_project_requisite';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, argument', 'required'),
			array('counter_time, is_funded, funding_time, is_proposed, is_approved', 'numerical', 'integerOnly'=>true),
			array('project_id, approver_id', 'length', 'max'=>10),
			array('total_value, funded', 'length', 'max'=>14),
			array('funding_started_time, funding_closed_time, approved_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, project_id, counter_time, total_value, funded, is_funded, funding_time, funding_started_time, funding_closed_time, argument, is_proposed, is_approved, approved_time, approver_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'fundings' => array(self::HAS_MANY, 'Funding', 'requisite_id'),
			'funding_users' => array(self::HAS_MANY, 'FundingUser', 'requisite_id'),
			'materials' => array(self::HAS_MANY, 'Material', 'requisite_id'),
			'approver' => array(self::BELONGS_TO, 'Users', 'approver_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'volunteer_requirements' => array(self::HAS_MANY, 'VolunteerRequirement', 'requisite_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'project_id' => Yii::t('label', 'Project'),
			'counter_time' => Yii::t('label', 'Counter Time'),
			'total_value' => Yii::t('label', 'Total Dana'),
			'funded' => Yii::t('label', 'Funded'),
			'is_funded' => Yii::t('label', 'Is Funded'),
			'funding_time' => Yii::t('label', 'Waktu Penggalangan Dana (Bulan)'),
			'funding_started_time' => Yii::t('label', 'Penggalangan Dana dimulai'),
			'funding_closed_time' => Yii::t('label', 'Penggalangan Dana ditutup'),
			'argument' => Yii::t('label', 'Argument'),
			'is_proposed' => Yii::t('label', 'Diusulkan'),
			'is_approved' => Yii::t('label', 'Diterima'),
			'approved_time' => Yii::t('label', 'Waktu Diterima'),
			'approver_id' => Yii::t('label', 'Penerima'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('counter_time',$this->counter_time);
		$criteria->compare('total_value',$this->total_value,true);
		$criteria->compare('funded',$this->funded,true);
		$criteria->compare('is_funded',$this->is_funded);
		$criteria->compare('funding_time',$this->funding_time);
		$criteria->compare('funding_started_time',$this->funding_started_time,true);
		$criteria->compare('funding_closed_time',$this->funding_closed_time,true);
		$criteria->compare('argument',$this->argument,true);
		$criteria->compare('is_proposed',$this->is_proposed);
		$criteria->compare('is_approved',$this->is_approved);
		$criteria->compare('approved_time',$this->approved_time,true);
		$criteria->compare('approver_id',$this->approver_id,true);

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
			$this->defaultColumns[] = 'project_id';
			$this->defaultColumns[] = 'counter_time';
			$this->defaultColumns[] = 'total_value';
			$this->defaultColumns[] = 'funded';
			$this->defaultColumns[] = 'is_funded';
			$this->defaultColumns[] = 'funding_time';
			$this->defaultColumns[] = 'funding_started_time';
			$this->defaultColumns[] = 'funding_closed_time';
			$this->defaultColumns[] = 'argument';
			$this->defaultColumns[] = 'is_proposed';
			$this->defaultColumns[] = 'is_approved';
			$this->defaultColumns[] = 'approved_time';
			$this->defaultColumns[] = 'approver_id';
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
			$this->defaultColumns[] = 'project_id';
			$this->defaultColumns[] = 'counter_time';
			$this->defaultColumns[] = 'total_value';
			$this->defaultColumns[] = 'funded';
			$this->defaultColumns[] = 'is_funded';
			$this->defaultColumns[] = 'funding_time';
			$this->defaultColumns[] = 'funding_started_time';
			$this->defaultColumns[] = 'funding_closed_time';
			$this->defaultColumns[] = 'argument';
			$this->defaultColumns[] = 'is_proposed';
			$this->defaultColumns[] = 'is_approved';
			$this->defaultColumns[] = 'approved_time';
			$this->defaultColumns[] = 'approver_id';
			/* $this->defaultColumns[] = array(
				'name' => 'publish',
				'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->id)), $data->publish, 1)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			); */

		}
		parent::afterConstruct();
	}

    public function getDetailSomeRequisite($idProject){
        $criteria=new CDbCriteria;

        $criteria->compare('project_id',$idProject);
        $criteria->compare('is_proposed',1);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function cekMaterial($id){
        $criteria=new CDbCriteria;

        $criteria->compare('requisite_id',$id);

        $model=Material::model()->findAll($criteria);
        //return $model;
        //return $count=count ( $model );
        return (!empty($model))?true: false;
    }

    public function cekFunding($id){
        $criteria=new CDbCriteria;

        $criteria->compare('requisite_id',$id);

        $model=Funding::model()->findAll($criteria);
        return (!empty($model))?true: false;
    }

    public function cekVolunteer($id){
        $criteria=new CDbCriteria;

        $criteria->compare('requisite_id',$id);

        $model=VolunteerRequirement::model()->findAll($criteria);
        return (!empty($model))?true: false;
    }

    public function getSomeMaterial($id){
        $criteria=new CDbCriteria;

        $criteria->compare('requisite_id',$id);

        return new CActiveDataProvider('material', array(
            'criteria'=>$criteria,
        ));
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