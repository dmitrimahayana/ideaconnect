<?php

/**
 * This is the model class for table "ic_badge_some".
 *
 * The followings are the available columns in table 'ic_badge_some':
 * @property string $id
 * @property integer $badge_id
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property IcBadge $badge
 * @property SwtUsers $user
 */
class BadgeSome extends CActiveRecord
 {
	public $defaultColumns = array();
    public $name;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BadgeSome the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_badge_some';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('badge_id, user_id', 'required'),
			array('badge_id', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, badge_id, user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'badge' => array(self::BELONGS_TO, 'Badge', 'badge_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'badge_id' => Yii::t('label', 'Badge'),
			'user_id' => Yii::t('label', 'User'),
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
		$criteria->compare('badge_id',$this->badge_id);
		$criteria->compare('user_id',$this->user_id,true);

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
			$this->defaultColumns[] = 'badge_id';
			$this->defaultColumns[] = 'user_id';
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
//			$this->defaultColumns[] = 'badge_id';
            $this->defaultColumns[] = array(
                'name' => 'badge_id',
                'value' => '$data->badge->badge',
            );
            $this->defaultColumns[] = array(
                'name' => 'user_id',
                'value' => '$data->user->username',
            );
            $this->defaultColumns[] = array(
                'name' => 'name',
                'value' => '$data->user->name',
            );
//			$this->defaultColumns[] = 'user_id';
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

    public function getIdUserJson($term){
        $criteria=new CDbCriteria();
        //$criteria->select="id_materi";
//        $criteria->compare('id_materi', $term,TRUE);
        $criteria->condition='username like "%'.$term.'%" or name like "%'.$term.'%"';
        $dataprovider=new CActiveDataProvider(
            get_class(Users::model()),array(
                'criteria'=>$criteria,
//                'pagination'=>false
            )
        );
        $topic=$dataprovider->getData();

        $returnArray=array();
        foreach ($topic as $key):
            $returnArray[]=array('label'=>$key->name, /*'id'=>$key->id_materi,*/ 'value'=>$key->id);
        endforeach;

        return CJSON::encode($returnArray);
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