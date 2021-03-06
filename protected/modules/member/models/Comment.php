<?php

/**
 * This is the model class for table "ic_comment".
 *
 * The followings are the available columns in table 'ic_comment':
 * @property string $id
 * @property string $content
 * @property string $parent_id
 * @property string $project_id
 * @property string $commentator_id
 * @property string $created_time
 * @property integer $is_published
 *
 * The followings are the available model relations:
 * @property SwtUsers $commentator
 * @property Comment $parent
 * @property Comment[] $icComments
 * @property IcProject $project
 */
class Comment extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, project_id, commentator_id, created_time', 'required'),
			array('is_published', 'numerical', 'integerOnly'=>true),
			array('parent_id, project_id, commentator_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content, parent_id, project_id, commentator_id, created_time, is_published', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'commentator' => array(self::BELONGS_TO, 'SwtUsers', 'commentator_id'),
			'parent' => array(self::BELONGS_TO, 'Comment', 'parent_id'),
			'ic_comments' => array(self::HAS_MANY, 'Comment', 'parent_id'),
			'project' => array(self::BELONGS_TO, 'IcProject', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'content' => Yii::t('label', 'Content'),
			'parent_id' => Yii::t('label', 'Parent'),
			'project_id' => Yii::t('label', 'Project'),
			'commentator_id' => Yii::t('label', 'Commentator'),
			'created_time' => Yii::t('label', 'Created Time'),
			'is_published' => Yii::t('label', 'Is Published'),
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('commentator_id',$this->commentator_id,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('is_published',$this->is_published);

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
			$this->defaultColumns[] = 'content';
			$this->defaultColumns[] = 'parent_id';
			$this->defaultColumns[] = 'project_id';
			$this->defaultColumns[] = 'commentator_id';
			$this->defaultColumns[] = 'created_time';
			$this->defaultColumns[] = 'is_published';
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
			$this->defaultColumns[] = 'content';
			$this->defaultColumns[] = 'parent_id';
			$this->defaultColumns[] = 'project_id';
			$this->defaultColumns[] = 'commentator_id';
			$this->defaultColumns[] = 'created_time';
			$this->defaultColumns[] = 'is_published';
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