<?php

/**
 * This is the model class for table "ic_funding_account".
 *
 * The followings are the available columns in table 'ic_funding_account':
 * @property integer $id
 * @property integer $bank_id
 * @property string $account_number
 * @property string $owner_name_alias
 *
 * The followings are the available model relations:
 * @property IcBank $bank
 * @property IcFundingUser[] $icFundingUsers
 */
class FundingAccount extends CActiveRecord
 {
	public $defaultColumns = array();
    public $bankName;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FundingAccount the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_funding_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_number, owner_name_alias', 'required'),
			array('bank_id', 'numerical', 'integerOnly'=>true),
			array('account_number', 'length', 'max'=>20),
			array('owner_name_alias', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, bank_id, account_number, owner_name_alias', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'bank' => array(self::BELONGS_TO, 'Bank', 'bank_id'),
			'ic_funding_users' => array(self::HAS_MANY, 'IcFundingUser', 'account_to_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
            //'bankName' => Yii::t('label','Bank Name'),
			'bank_id' => Yii::t('label', 'Bank'),
			'account_number' => Yii::t('label', 'No Rekening'),
			'owner_name_alias' => Yii::t('label', 'Pemilik'),
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

		$criteria->compare('id',$this->id);
        //$criteria->compare('bank.bankName', $this->bankName, true);
        $criteria->compare('bank_id',$this->bank_id);
		$criteria->compare('account_number',$this->account_number,true);
		$criteria->compare('owner_name_alias',$this->owner_name_alias,true);

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
			//$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'bank_id';
			$this->defaultColumns[] = 'account_number';
			$this->defaultColumns[] = 'owner_name_alias';
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
			//$this->defaultColumns[] = 'bank_id';
            $this->defaultColumns[] = array(
                'name' => 'bankName',
                'value' => '$data->bank->bank_name',
            );
			$this->defaultColumns[] = 'account_number';
			$this->defaultColumns[] = 'owner_name_alias';
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