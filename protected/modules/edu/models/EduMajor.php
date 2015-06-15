<?php

/**
 * This is the model class for table "ic_edu_major".
 *
 * The followings are the available columns in table 'ic_edu_major':
 * @property integer $id
 * @property integer $published
 * @property integer $edu_own_faculty_id
 * @property string $name
 * @property string $own_name
 *
 * The followings are the available model relations:
 * @property IcEduOwnFaculty $eduOwnFaculty
 * @property IcFtGraduate[] $icFtGraduates
 * @property IcFtStudent[] $icFtStudents
 * @property SwtUsers[] $swtUsers
 */
class EduMajor extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EduMajor the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_edu_major';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('published, edu_own_faculty_id', 'numerical', 'integerOnly'=>true),
			array('name, own_name', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, published, edu_own_faculty_id, name, own_name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'edu_own_faculty' => array(self::BELONGS_TO, 'IcEduOwnFaculty', 'edu_own_faculty_id'),
			'ic_ft_graduates' => array(self::HAS_MANY, 'IcFtGraduate', 'major_id'),
			'ic_ft_students' => array(self::HAS_MANY, 'IcFtStudent', 'major_id'),
			'swt_users' => array(self::HAS_MANY, 'SwtUsers', 'major_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'published' => Yii::t('label', 'Published'),
			'edu_own_faculty_id' => Yii::t('label', 'Edu Own Faculty'),
			'name' => Yii::t('label', 'Name'),
			'own_name' => Yii::t('label', 'Own Name'),
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
		$criteria->compare('published',$this->published);
		$criteria->compare('edu_own_faculty_id',$this->edu_own_faculty_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('own_name',$this->own_name,true);

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
			$this->defaultColumns[] = 'published';
			$this->defaultColumns[] = 'edu_own_faculty_id';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'own_name';
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
			$this->defaultColumns[] = 'published';
			$this->defaultColumns[] = 'edu_own_faculty_id';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'own_name';
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

    public static function getCategory() {
        $model = self::model()->findAll();
        $items = array();
        if($model != null) {
            foreach($model as $key => $val) {
                $items[$val->id] = $val->name;
            }
            return $items;
        } else {
            return false;
        }
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