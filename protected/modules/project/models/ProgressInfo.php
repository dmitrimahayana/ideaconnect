<?php

/**
 * This is the model class for table "ic_progress_info".
 *
 * The followings are the available columns in table 'ic_progress_info':
 * @property string $id
 * @property string $title
 * @property string $detail
 * @property string $created_time
 * @property string $updated_time
 * @property string $project_id
 * @property integer $show_public
 * @property integer $show_member
 * @property integer $show_sponsor
 *
 * The followings are the available model relations:
 * @property IcProject $project
 */
class ProgressInfo extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProgressInfo the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_progress_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, detail, created_time, updated_time, project_id, show_public, show_member, show_sponsor', 'required'),
			array('show_public, show_member, show_sponsor', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('project_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, detail, created_time, updated_time, project_id, show_public, show_member, show_sponsor', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'project' => array(self::BELONGS_TO, 'IcProject', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'title' => Yii::t('label', 'Judul'),
			'detail' => Yii::t('label', 'Detail'),
			'created_time' => Yii::t('label', 'Waktu dibuat'),
			'updated_time' => Yii::t('label', 'Waktu update'),
			'project_id' => Yii::t('label', 'Project'),
			'show_public' => Yii::t('label', 'Umum'),
			'show_member' => Yii::t('label', 'Anggota'),
			'show_sponsor' => Yii::t('label', 'Sponsor'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('show_public',$this->show_public);
		$criteria->compare('show_member',$this->show_member);
		$criteria->compare('show_sponsor',$this->show_sponsor);

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
			$this->defaultColumns[] = 'title';
			$this->defaultColumns[] = 'detail';
			$this->defaultColumns[] = 'created_time';
			$this->defaultColumns[] = 'updated_time';
			$this->defaultColumns[] = 'project_id';
			$this->defaultColumns[] = 'show_public';
			$this->defaultColumns[] = 'show_member';
			$this->defaultColumns[] = 'show_sponsor';
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
			$this->defaultColumns[] = 'title';
			$this->defaultColumns[] = 'detail';
			$this->defaultColumns[] = 'created_time';
			$this->defaultColumns[] = 'updated_time';
			//$this->defaultColumns[] = 'project_id';
//			$this->defaultColumns[] = 'show_public';
            $this->defaultColumns[] = array(
            'name' => 'show_public',
                'value' => 'Utility::getPublishedToImg($data->show_public)',
                'htmlOptions' => array(
                'class' => 'center',
            ),
                'type' => 'raw',
            );
//			$this->defaultColumns[] = 'show_member';
            $this->defaultColumns[] = array(
                'name' => 'show_member',
                'value' => 'Utility::getPublishedToImg($data->show_member)',
                'htmlOptions' => array(
                    'class' => 'center',
                ),
                'type' => 'raw',
            );
//			$this->defaultColumns[] = 'show_sponsor';
            $this->defaultColumns[] = array(
                'name' => 'show_sponsor',
                'value' => 'Utility::getPublishedToImg($data->show_sponsor)',
                'htmlOptions' => array(
                    'class' => 'center',
                ),
                'type' => 'raw',
            );
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

    public function getSomeProgressByProject($id){
        $criteria=new CDbCriteria;

        $criteria->compare('project_id',$id);

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