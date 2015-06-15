<?php

/**
 * This is the model class for table "ic_material".
 *
 * The followings are the available columns in table 'ic_material':
 * @property string $id
 * @property string $requirement
 * @property string $quantity
 * @property string $unit
 * @property string $worth
 * @property string $worth_unit
 * @property string $requisite_id
 * @property string $available
 * @property string $available_worth
 * @property string $delivery_address
 *
 * The followings are the available model relations:
 * @property IcProjectRequisite $requisite
 */
class Material extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Material the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requirement, quantity, unit, worth, requisite_id, available_worth, delivery_address', 'required'),
			array('requirement', 'length', 'max'=>80),
			array('quantity, worth, available, available_worth', 'length', 'max'=>14),
			array('unit, requisite_id', 'length', 'max'=>10),
			array('worth_unit', 'length', 'max'=>30),
			array('delivery_address', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, requirement, quantity, unit, worth, worth_unit, requisite_id, available, available_worth, delivery_address', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'requisite' => array(self::BELONGS_TO, 'IcProjectRequisite', 'requisite_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'requirement' => Yii::t('label', 'Kebutuhan'),
			'quantity' => Yii::t('label', 'Jumlah'),
			'unit' => Yii::t('label', 'Satuan'),
			'worth' => Yii::t('label', 'Nilai'),
			'worth_unit' => Yii::t('label', 'Nilai Satuan'),
			'requisite_id' => Yii::t('label', 'Requisite'),
			'available' => Yii::t('label', 'Tersedia'),
			'available_worth' => Yii::t('label', 'Tersedia Nilai'),
			'delivery_address' => Yii::t('label', 'Alamat Pengiriman'),
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
		$criteria->compare('requirement',$this->requirement,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('worth',$this->worth,true);
		$criteria->compare('worth_unit',$this->worth_unit,true);
		$criteria->compare('requisite_id',$this->requisite_id,true);
		$criteria->compare('available',$this->available,true);
		$criteria->compare('available_worth',$this->available_worth,true);
		$criteria->compare('delivery_address',$this->delivery_address,true);

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
			$this->defaultColumns[] = 'requirement';
			$this->defaultColumns[] = 'quantity';
			$this->defaultColumns[] = 'unit';
			$this->defaultColumns[] = 'worth';
			$this->defaultColumns[] = 'worth_unit';
			$this->defaultColumns[] = 'requisite_id';
			$this->defaultColumns[] = 'available';
			$this->defaultColumns[] = 'available_worth';
			$this->defaultColumns[] = 'delivery_address';
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
			$this->defaultColumns[] = 'requirement';
			$this->defaultColumns[] = 'quantity';
			$this->defaultColumns[] = 'unit';
			$this->defaultColumns[] = 'worth';
			$this->defaultColumns[] = 'worth_unit';
			//$this->defaultColumns[] = 'requisite_id';
			$this->defaultColumns[] = 'available';
			$this->defaultColumns[] = 'available_worth';
			$this->defaultColumns[] = 'delivery_address';
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

    public function getSomeMaterial($id){
        $criteria=new CDbCriteria;
        $criteria->compare('requisite_id',$id);

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