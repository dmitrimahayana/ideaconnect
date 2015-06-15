<?php

/**
 * This is the model class for table "ic_funding_user".
 *
 * The followings are the available columns in table 'ic_funding_user':
 * @property string $id
 * @property string $sponsor_id
 * @property string $sponsor_name
 * @property string $requisite_id
 * @property string $as_institution_id
 * @property string $as_institution_name
 * @property string $account_from_number
 * @property integer $bank_from_id
 * @property string $bank_from_name
 * @property integer $account_to_id
 * @property string $account_to_number
 * @property string $value
 * @property string $unit
 * @property integer $is_verified
 * @property string $varificator_id
 * @property string $verification_time
 * @property integer $had_been_returned
 *
 * The followings are the available model relations:
 * @property IcFundingAccount $accountTo
 * @property IcInstitutionSome $asInstitution
 * @property IcBank $bankFrom
 * @property IcProjectRequisite $requisite
 * @property SwtUsers $sponsor
 * @property SwtUsers $varificator
 */
class FundingUser extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FundingUser the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_funding_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requisite_id, account_from_number, value', 'required'),
			array('bank_from_id, account_to_id, is_verified, had_been_returned', 'numerical', 'integerOnly'=>true),
			array('sponsor_id, requisite_id, as_institution_id, varificator_id', 'length', 'max'=>10),
			array('sponsor_name', 'length', 'max'=>80),
			array('as_institution_name', 'length', 'max'=>100),
			array('account_from_number, account_to_number', 'length', 'max'=>20),
			array('bank_from_name', 'length', 'max'=>255),
			array('value', 'length', 'max'=>14),
			array('unit', 'length', 'max'=>30),
			array('verification_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sponsor_id, sponsor_name, requisite_id, as_institution_id, as_institution_name, account_from_number, bank_from_id, bank_from_name, account_to_id, account_to_number, value, unit, is_verified, varificator_id, verification_time, had_been_returned', 'safe', 'on'=>'search'),
			array('id, sponsor_id, sponsor_name, requisite_id, as_institution_id, as_institution_name, 
				account_from_number, bank_from_id, bank_from_name, account_to_id, account_to_number, 
				value, unit, is_verified, varificator_id, verification_time, had_been_returned', 
				'safe', 'on' => 'monthly_report_search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'account_to' => array(self::BELONGS_TO, 'FundingAccount', 'account_to_id'),
			'as_institution' => array(self::BELONGS_TO, 'InstitutionSome', 'as_institution_id'),
			'bank_from' => array(self::BELONGS_TO, 'Bank', 'bank_from_id'),
			'requisite' => array(self::BELONGS_TO, 'ProjectRequisite', 'requisite_id'),
			'sponsor' => array(self::BELONGS_TO, 'Users', 'sponsor_id'),
			'varificator' => array(self::BELONGS_TO, 'Users', 'varificator_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'sponsor_id' => Yii::t('label', 'Sponsor'),
			'sponsor_name' => Yii::t('label', 'Nama Sponsor'),
			'requisite_id' => Yii::t('label', 'Requisite'),
			'as_institution_id' => Yii::t('label', 'As Institution'),
			'as_institution_name' => Yii::t('label', 'Nama Institusi'),
			'account_from_number' => Yii::t('label', 'Dari No Rek'),
			'bank_from_id' => Yii::t('label', 'Bank From'),
			'bank_from_name' => Yii::t('label', 'Nama Bank'),
			'account_to_id' => Yii::t('label', 'Account To'),
			'account_to_number' => Yii::t('label', 'No Rek Tujuan'),
			'value' => Yii::t('label', 'Jumlah'),
			'unit' => Yii::t('label', 'Satuan'),
			'is_verified' => Yii::t('label', 'Verifikasi'),
			'varificator_id' => Yii::t('label', 'Varificator'),
			'verification_time' => Yii::t('label', 'Waktu Verfikasi'),
			'had_been_returned' => Yii::t('label', 'Sudah Kembali'),
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
		$criteria->compare('sponsor_id',$this->sponsor_id,true);
		$criteria->compare('sponsor_name',$this->sponsor_name,true);
		$criteria->compare('requisite_id',$this->requisite_id,true);
		$criteria->compare('as_institution_id',$this->as_institution_id,true);
		$criteria->compare('as_institution_name',$this->as_institution_name,true);
		$criteria->compare('account_from_number',$this->account_from_number,true);
		$criteria->compare('bank_from_id',$this->bank_from_id);
		$criteria->compare('bank_from_name',$this->bank_from_name,true);
		$criteria->compare('account_to_id',$this->account_to_id);
		$criteria->compare('account_to_number',$this->account_to_number,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('is_verified',$this->is_verified);
		$criteria->compare('varificator_id',$this->varificator_id,true);
		$criteria->compare('verification_time',$this->verification_time,true);
		$criteria->compare('had_been_returned',$this->had_been_returned);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function monthlyReportSearch() {
		$criteria = new CDbCriteria;

		$criteria->compare('sponsor_id',$this->sponsor_id,true);
		$criteria->compare('sponsor_name',$this->sponsor_name,true);
		$criteria->compare('requisite_id',$this->requisite_id,true);
		$criteria->compare('as_institution_id',$this->as_institution_id,true);
		$criteria->compare('as_institution_name',$this->as_institution_name,true);
		$criteria->compare('account_from_number',$this->account_from_number,true);
		$criteria->compare('bank_from_id',$this->bank_from_id);
		$criteria->compare('bank_from_name',$this->bank_from_name,true);
		$criteria->compare('account_to_id',$this->account_to_id);
		$criteria->compare('account_to_number',$this->account_to_number,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('is_verified',$this->is_verified);
		$criteria->compare('varificator_id',$this->varificator_id,true);
		$criteria->compare('verification_time',$this->verification_time,true);
		$criteria->compare('had_been_returned',$this->had_been_returned);
		$criteria->with = array('requisite');

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
			// $this->defaultColumns[] = 'id';
			// $this->defaultColumns[] = 'sponsor_id';
			// $this->defaultColumns[] = 'sponsor_name';
			// $this->defaultColumns[] = 'requisite_id';
			// $this->defaultColumns[] = 'as_institution_id';
			// $this->defaultColumns[] = 'as_institution_name';
			// $this->defaultColumns[] = 'account_from_number';
			// $this->defaultColumns[] = 'bank_from_id';
			// $this->defaultColumns[] = 'bank_from_name';
			// $this->defaultColumns[] = 'account_to_id';
			// $this->defaultColumns[] = 'account_to_number';
			// $this->defaultColumns[] = 'value';
			// $this->defaultColumns[] = 'unit';
			// $this->defaultColumns[] = 'is_verified';
			// $this->defaultColumns[] = 'varificator_id';
			// $this->defaultColumns[] = 'verification_time';
			// $this->defaultColumns[] = 'had_been_returned';
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
			//$this->defaultColumns[] = 'id';
			//$this->defaultColumns[] = 'sponsor_id';
			$this->defaultColumns[] = 'sponsor_name';
			//$this->defaultColumns[] = 'requisite_id';
			//$this->defaultColumns[] = 'as_institution_id';
			$this->defaultColumns[] = 'as_institution_name';
			$this->defaultColumns[] = 'account_from_number';
			//$this->defaultColumns[] = 'bank_from_id';
			$this->defaultColumns[] = 'bank_from_name';
			//$this->defaultColumns[] = 'account_to_id';
			$this->defaultColumns[] = 'account_to_number';
            $this->defaultColumns[] = array(
                'name' => 'account_to_id',
                'value' => '$data->account_to->bank->bank_name',
            );
			//$this->defaultColumns[] = 'value';
			//$this->defaultColumns[] = 'unit';
//			$this->defaultColumns[] = 'is_verified';
            $this->defaultColumns[] = array(
                'name' => 'is_verified',
                'value' => 'Utility::getPublishedToImg($data->is_verified)',
                'htmlOptions' => array(
                    'class' => 'center',
                ),
                'type' => 'raw',
            );
//            $this->defaultColumns[] = array(
//                'name' => 'had_been_returned',
//                'value' => 'Utility::getPublishedToImg($data->had_been_returned)',
//                'htmlOptions' => array(
//                    'class' => 'center',
//                ),
//                'type' => 'raw',
//            );
            $this->defaultColumns[] = array(
                'name' => 'requisite.project.project_name',
                'value' => '$data->requisite->project->project_name',
            );
			//$this->defaultColumns[] = 'varificator_id';
			//$this->defaultColumns[] = 'verification_time';
			//$this->defaultColumns[] = 'had_been_returned';
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

    public static function getStatus($affirmative, $negative) {
        $items = array();
        $items[0] = $negative;
        $items[1] =$affirmative;
        return $items;
    }

    public function getSomeFundingUser($idRequisite){
        $criteria=new CDbCriteria;

        $criteria->compare('requisite_id',$idRequisite);
//        $criteria->compare('is_proposed',1);

        return new CActiveDataProvider($this, array(
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