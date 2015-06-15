<?php

/**
 * This is the model class for table "ic_messege".
 *
 * The followings are the available columns in table 'ic_messege':
 * @property string $id
 * @property string $subject
 * @property string $messege
 * @property string $from_user_id
 * @property string $from_user_name
 * @property string $to_user_id
 * @property string $to_user_name
 * @property integer $is_read
 * @property string $sent_time
 * @property integer $is_deleted_by_sender
 * @property integer $is_deleted_by_receiver
 *
 * The followings are the available model relations:
 * @property SwtUsers $fromUser
 * @property SwtUsers $toUser
 */
class Messege extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Messege the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_messege';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, messege, sent_time', 'required'),
			array('is_read, is_deleted_by_sender, is_deleted_by_receiver', 'numerical', 'integerOnly'=>true),
			array('subject, messege', 'length', 'max'=>255),
			array('from_user_id, to_user_id', 'length', 'max'=>10),
			array('from_user_name, to_user_name', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, subject, messege, from_user_id, from_user_name, to_user_id, to_user_name, is_read, sent_time, is_deleted_by_sender, is_deleted_by_receiver', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'from_user' => array(self::BELONGS_TO, 'SwtUsers', 'from_user_id'),
			'to_user' => array(self::BELONGS_TO, 'SwtUsers', 'to_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'subject' => Yii::t('label', 'Subject'),
			'messege' => Yii::t('label', 'Messege'),
			'from_user_id' => Yii::t('label', 'From User'),
			'from_user_name' => Yii::t('label', 'From User Name'),
			'to_user_id' => Yii::t('label', 'To User'),
			'to_user_name' => Yii::t('label', 'To User Name'),
			'is_read' => Yii::t('label', 'Is Read'),
			'sent_time' => Yii::t('label', 'Sent Time'),
			'is_deleted_by_sender' => Yii::t('label', 'Is Deleted By Sender'),
			'is_deleted_by_receiver' => Yii::t('label', 'Is Deleted By Receiver'),
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
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('messege',$this->messege,true);
		$criteria->compare('from_user_id',$this->from_user_id,true);
		$criteria->compare('from_user_name',$this->from_user_name,true);
		$criteria->compare('to_user_id',$this->to_user_id,true);
		$criteria->compare('to_user_name',$this->to_user_name,true);
		$criteria->compare('is_read',$this->is_read);
		$criteria->compare('sent_time',$this->sent_time,true);
		$criteria->compare('is_deleted_by_sender',$this->is_deleted_by_sender);
		$criteria->compare('is_deleted_by_receiver',$this->is_deleted_by_receiver);

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
			$this->defaultColumns[] = 'subject';
			$this->defaultColumns[] = 'messege';
			$this->defaultColumns[] = 'from_user_id';
			$this->defaultColumns[] = 'from_user_name';
			$this->defaultColumns[] = 'to_user_id';
			$this->defaultColumns[] = 'to_user_name';
			$this->defaultColumns[] = 'is_read';
			$this->defaultColumns[] = 'sent_time';
			$this->defaultColumns[] = 'is_deleted_by_sender';
			$this->defaultColumns[] = 'is_deleted_by_receiver';
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
			$this->defaultColumns[] = 'subject';
			$this->defaultColumns[] = 'messege';
			//$this->defaultColumns[] = 'from_user_id';
			$this->defaultColumns[] = 'from_user_name';
			//$this->defaultColumns[] = 'to_user_id';
			$this->defaultColumns[] = 'to_user_name';
			//$this->defaultColumns[] = 'is_read';
			$this->defaultColumns[] = 'sent_time';
			//$this->defaultColumns[] = 'is_deleted_by_sender';
			//$this->defaultColumns[] = 'is_deleted_by_receiver';
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

    public function getSomeMessageAdmin(){
        $criteria=new CDbCriteria;
        $criteria->compare('to_user_id',8);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function getSomeData(){
        return Messege::model()->findByPk(13);
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