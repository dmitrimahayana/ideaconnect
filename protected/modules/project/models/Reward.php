<?php

/**
 * This is the model class for table "ic_reward".
 *
 * The followings are the available columns in table 'ic_reward':
 * @property string $id
 * @property string $term
 * @property string $reward
 * @property integer $order_number
 * @property string $requisite_id
 *
 * The followings are the available model relations:
 * @property IcProjectRequisite $requisite
 * @property IcRewardChoosen[] $icRewardChoosens
 */
class Reward extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reward the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_reward';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('term, reward, order_number, requisite_id', 'required'),
			array('order_number', 'numerical', 'integerOnly'=>true),
			array('term', 'length', 'max'=>14),
			array('requisite_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, term, reward, order_number, requisite_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'requisite' => array(self::BELONGS_TO, 'ProjectRequisite', 'requisite_id'),
			'reward_choosens' => array(self::HAS_MANY, 'RewardChoosen', 'reward_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'term' => Yii::t('label', 'Syarat Pendanaan (Rp)'),
			'reward' => Yii::t('label', 'Hadiah'),
			'order_number' => Yii::t('label', 'Urutan Hadiah'),
			'requisite_id' => Yii::t('label', 'Requisite'),
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
		$criteria->compare('term',$this->term,true);
		$criteria->compare('reward',$this->reward,true);
		$criteria->compare('order_number',$this->order_number);
		$criteria->compare('requisite_id',$this->requisite_id,true);

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
			$this->defaultColumns[] = 'term';
			$this->defaultColumns[] = 'reward';
			$this->defaultColumns[] = 'order_number';
			$this->defaultColumns[] = 'requisite_id';
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
			$this->defaultColumns[] = 'term';
			$this->defaultColumns[] = 'reward';
			$this->defaultColumns[] = 'order_number';
//			$this->defaultColumns[] = 'requisite_id';
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

    public function getSomeReward($id){
        $criteria=new CDbCriteria;

        $criteria->compare('requisite_id',$id);
        $criteria->order = 'order_number asc';

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