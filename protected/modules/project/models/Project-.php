<?php

/**
 * This is the model class for table "ic_project".
 *
 * The followings are the available columns in table 'ic_project':
 * @property string $id
 * @property string $project_name
 * @property string $cover_image
 * @property string $intro_text
 * @property string $tagline
 * @property string $geometry_location
 * @property integer $project_category_id
 * @property integer $project_category_inherit_id
 * @property string $project_category_name
 * @property string $project_category_name_inherit
 * @property string $video_url
 * @property string $background_title
 * @property string $background
 * @property string $description_title
 * @property string $description
 * @property string $goal_title
 * @property string $goal
 * @property string $invitation_title
 * @property string $invitation
 * @property string $charge
 * @property integer $charge_is_percentage
 * @property integer $project_time
 * @property string $created_time
 * @property string $editor_id
 * @property string $edited_time
 * @property integer $is_actived
 * @property integer $is_proposed
 * @property string $inisiator_id
 * @property string $inisiator_name
 * @property integer $is_verified
 * @property string $verificator_id
 * @property string $verification_time
 * @property string $project_started_time
 * @property string $project_ending_time
 * @property integer $is_funded
 * @property string $as_institution_id
 * @property string $as_institution_name
 *
 * The followings are the available model relations:
 * @property IcComment[] $icComments
 * @property IcFaq[] $icFaqs
 * @property IcProgressDetail[] $icProgressDetails
 * @property IcProgressInfo[] $icProgressInfos
 * @property IcInstitutionSome $asInstitution
 * @property SwtUsers $inisiator
 * @property IcProjectCategory $projectCategory
 * @property IcProjectCategory $projectCategoryInherit
 * @property SwtUsers $verificator
 * @property SwtUsers $editor
 * @property IcProjectRequisite[] $icProjectRequisites
 * @property IcReward[] $icRewards
 */
class Project extends CActiveRecord
 {
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ic_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_name, requisite_title, intro_text, tagline, video_url, background_title, background, description_title, description, goal_title, goal, invitation_title, invitation, created_time, edited_time', 'required'),
			array('project_category_id, project_category_inherit_id, charge_is_percentage, project_time, is_actived, is_proposed, is_verified, is_funded', 'numerical', 'integerOnly'=>true),
			array('project_name', 'length', 'max'=>100),
			array('cover_image,requisite_title, intro_text, tagline, background_title, description_title, goal_title, invitation_title, as_institution_name', 'length', 'max'=>255),
			array('project_category_name, project_category_name_inherit, inisiator_name', 'length', 'max'=>80),
			array('charge', 'length', 'max'=>14),
			array('editor_id, inisiator_id, verificator_id, as_institution_id', 'length', 'max'=>10),
			array('geometry_location, verification_time, project_started_time, project_ending_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, project_name,requisite_title, cover_image, intro_text, tagline, geometry_location, project_category_id, project_category_inherit_id, project_category_name, project_category_name_inherit, video_url, background_title, background, description_title, description, goal_title, goal, invitation_title, invitation, charge, charge_is_percentage, project_time, created_time, editor_id, edited_time, is_actived, is_proposed, inisiator_id, inisiator_name, is_verified, verificator_id, verification_time, project_started_time, project_ending_time, is_funded, as_institution_id, as_institution_name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'project_id'),
			'faqs' => array(self::HAS_MANY, 'Faq', 'project_id'),
			'progress_details' => array(self::HAS_MANY, 'ProgressDetail', 'project_id'),
			'progress_infos' => array(self::HAS_MANY, 'ProgressInfo', 'project_id'),
			'as_institution' => array(self::BELONGS_TO, 'InstitutionSome', 'as_institution_id'),
			'inisiator' => array(self::BELONGS_TO, 'Users', 'inisiator_id'),
			'project_category' => array(self::BELONGS_TO, 'ProjectCategory', 'project_category_id'),
			'project_category_inherit' => array(self::BELONGS_TO, 'ProjectCategory', 'project_category_inherit_id'),
			'verificator' => array(self::BELONGS_TO, 'Users', 'verificator_id'),
			'editor' => array(self::BELONGS_TO, 'Users', 'editor_id'),
			'project_requisites' => array(self::HAS_MANY, 'ProjectRequisite', 'project_id'),
			'rewards' => array(self::HAS_MANY, 'Reward', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'project_name' => Yii::t('label', 'Nama Project'),
			'cover_image' => Yii::t('label', 'Gambar'),
			'intro_text' => Yii::t('label', 'Kata Pengantar'),
			'tagline' => Yii::t('label', 'Tagline'),
			'geometry_location' => Yii::t('label', 'Lokasi Geometri'),
			'project_category_id' => Yii::t('label', 'Project Category'),
			'project_category_inherit_id' => Yii::t('label', 'Project Category Inherit'),
			'project_category_name' => Yii::t('label', 'Nama Kategori Project'),
			'project_category_name_inherit' => Yii::t('label', 'Nama Kategori Sub Project'),
			'video_url' => Yii::t('label', 'Video Url'),
			'background_title' => Yii::t('label', 'Judul Background'),
			'background' => Yii::t('label', 'Background'),
			'description_title' => Yii::t('label', 'Judul Deskripsi'),
			'description' => Yii::t('label', 'Deskripsi'),
			'goal_title' => Yii::t('label', 'Judul Tujuan'),
			'goal' => Yii::t('label', 'Tujuan'),
            'requisite_title'=>Yii::t('label', 'Judul Pendanaan'),
			'invitation_title' => Yii::t('label', 'Judul Ajakan'),
			'invitation' => Yii::t('label', 'Ajakan'),
			'charge' => Yii::t('label', 'Biaya'),
			'charge_is_percentage' => Yii::t('label', 'Persentase Biaya'),
			'project_time' => Yii::t('label', 'Waktu Project'),
			'created_time' => Yii::t('label', 'Waktu Dibuat'),
			'editor_id' => Yii::t('label', 'Editor'),
			'edited_time' => Yii::t('label', 'Waktu Edit'),
			'is_actived' => Yii::t('label', 'Sudah Aktif'),
			'is_proposed' => Yii::t('label', 'Sudah Diusulkan'),
			'inisiator_id' => Yii::t('label', 'Inisiator'),
			'inisiator_name' => Yii::t('label', 'Nama Inisiator'),
			'is_verified' => Yii::t('label', 'Sudah Diverifikasi'),
			'verificator_id' => Yii::t('label', 'Verificator'),
			'verification_time' => Yii::t('label', 'Waktu Verifikasi'),
			'project_started_time' => Yii::t('label', 'Waktu Mulai Project'),
			'project_ending_time' => Yii::t('label', 'Waktu Berakhir Project'),
			'is_funded' => Yii::t('label', 'Sudah Didanai'),
			'as_institution_id' => Yii::t('label', 'As Institution'),
			'as_institution_name' => Yii::t('label', 'Nama Institusi'),
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
		$criteria->compare('project_name',$this->project_name,true);
		$criteria->compare('cover_image',$this->cover_image,true);
		$criteria->compare('intro_text',$this->intro_text,true);
		$criteria->compare('tagline',$this->tagline,true);
		$criteria->compare('geometry_location',$this->geometry_location,true);
		$criteria->compare('project_category_id',$this->project_category_id);
		$criteria->compare('project_category_inherit_id',$this->project_category_inherit_id);
		$criteria->compare('project_category_name',$this->project_category_name,true);
		$criteria->compare('project_category_name_inherit',$this->project_category_name_inherit,true);
		$criteria->compare('video_url',$this->video_url,true);
		$criteria->compare('background_title',$this->background_title,true);
		$criteria->compare('background',$this->background,true);
		$criteria->compare('description_title',$this->description_title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('goal_title',$this->goal_title,true);
		$criteria->compare('goal',$this->goal,true);
		$criteria->compare('requisite_title',$this->requisite_title,true);
		$criteria->compare('invitation_title',$this->invitation_title,true);
		$criteria->compare('invitation',$this->invitation,true);
		$criteria->compare('charge',$this->charge,true);
		$criteria->compare('charge_is_percentage',$this->charge_is_percentage);
		$criteria->compare('project_time',$this->project_time);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('editor_id',$this->editor_id,true);
		$criteria->compare('edited_time',$this->edited_time,true);
		$criteria->compare('is_actived',$this->is_actived);
		$criteria->compare('is_proposed',$this->is_proposed);
		$criteria->compare('inisiator_id',$this->inisiator_id,true);
		$criteria->compare('inisiator_name',$this->inisiator_name,true);
		$criteria->compare('is_verified',$this->is_verified);
		$criteria->compare('verificator_id',$this->verificator_id,true);
		$criteria->compare('verification_time',$this->verification_time,true);
		$criteria->compare('project_started_time',$this->project_started_time,true);
		$criteria->compare('project_ending_time',$this->project_ending_time,true);
		$criteria->compare('is_funded',$this->is_funded);
		$criteria->compare('as_institution_id',$this->as_institution_id,true);
		$criteria->compare('as_institution_name',$this->as_institution_name,true);

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
			$this->defaultColumns[] = 'project_name';
			$this->defaultColumns[] = 'cover_image';
			$this->defaultColumns[] = 'intro_text';
			$this->defaultColumns[] = 'tagline';
			$this->defaultColumns[] = 'geometry_location';
			$this->defaultColumns[] = 'project_category_id';
			$this->defaultColumns[] = 'project_category_inherit_id';
			$this->defaultColumns[] = 'project_category_name';
			$this->defaultColumns[] = 'project_category_name_inherit';
			$this->defaultColumns[] = 'video_url';
			$this->defaultColumns[] = 'background_title';
			$this->defaultColumns[] = 'background';
			$this->defaultColumns[] = 'description_title';
			$this->defaultColumns[] = 'description';
			$this->defaultColumns[] = 'goal_title';
			$this->defaultColumns[] = 'goal';
			$this->defaultColumns[] = 'invitation_title';
			$this->defaultColumns[] = 'invitation';
			$this->defaultColumns[] = 'charge';
			$this->defaultColumns[] = 'charge_is_percentage';
			$this->defaultColumns[] = 'project_time';
			$this->defaultColumns[] = 'created_time';
			$this->defaultColumns[] = 'editor_id';
			$this->defaultColumns[] = 'edited_time';
			$this->defaultColumns[] = 'is_actived';
			$this->defaultColumns[] = 'is_proposed';
			$this->defaultColumns[] = 'inisiator_id';
			$this->defaultColumns[] = 'inisiator_name';
			$this->defaultColumns[] = 'is_verified';
			$this->defaultColumns[] = 'verificator_id';
			$this->defaultColumns[] = 'verification_time';
			$this->defaultColumns[] = 'project_started_time';
			$this->defaultColumns[] = 'project_ending_time';
			$this->defaultColumns[] = 'is_funded';
			$this->defaultColumns[] = 'as_institution_id';
			$this->defaultColumns[] = 'as_institution_name';
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
            $this->defaultColumns[] = 'project_name';
            //$this->defaultColumns[] = 'cover_image';
            //$this->defaultColumns[] = 'intro_text';
            //$this->defaultColumns[] = 'tagline';
            //$this->defaultColumns[] = 'geometry_location';
            //$this->defaultColumns[] = 'project_category_id';
            //$this->defaultColumns[] = 'project_category_inherit_id';
            $this->defaultColumns[] = array(
                'header' => 'Nama Kategori',
                'value' => '$data->project_category_name;'
            );
            $this->defaultColumns[] = array(
                'header' => 'Nama Sub Kategori',
                'value' => '$data->project_category_name_inherit;'
            );
            //$this->defaultColumns[] = 'video_url';
            //$this->defaultColumns[] = 'background_title';
            //$this->defaultColumns[] = 'background';
            //$this->defaultColumns[] = 'description_title';
            //$this->defaultColumns[] = 'description';
            //$this->defaultColumns[] = 'goal_title';
            //$this->defaultColumns[] = 'goal';
            //$this->defaultColumns[] = 'invitation_title';
            //$this->defaultColumns[] = 'invitation';
            //$this->defaultColumns[] = 'charge';
            //$this->defaultColumns[] = 'charge_is_percentage';
            //$this->defaultColumns[] = 'project_time';
            $this->defaultColumns[] = 'created_time';
            //$this->defaultColumns[] = 'editor_id';
            $this->defaultColumns[] = 'edited_time';
            //$this->defaultColumns[] = 'is_actived';
            //$this->defaultColumns[] = 'is_proposed';
            //$this->defaultColumns[] = 'inisiator_id';
            $this->defaultColumns[] = 'inisiator_name';
            //$this->defaultColumns[] = 'is_verified';
            //$this->defaultColumns[] = 'verificator_id';
            //$this->defaultColumns[] = 'verification_time';
            //$this->defaultColumns[] = 'project_started_time';
            //$this->defaultColumns[] = 'project_ending_time';
            //$this->defaultColumns[] = 'is_funded';
            //$this->defaultColumns[] = 'as_institution_id';
            $this->defaultColumns[] = 'as_institution_name';
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

    public function getStatusFilter($affirmative, $negative){
        return array('0'=>array('id'=>'0', 'name'=>$negative), '1'=>array('id'=>'1', 'name'=>$affirmative));
    }
    public static function generateVerifiedStatus($status)
    {
        if ($status == 0)
            return "Belum Terverifikasi";
        else
            return "Terverifikasi";
    }

    public static function generateActiveStatus($status)
    {
        if ($status == 0)
            return "Tidak Aktif";
        else
            return "Aktif";
    }

    public static function generateCharge($chargeId){
        $model = ProjectCharge::model()->findByPk($chargeId);
        if($model->is_percentage == 1)
            return CHtml::openTag("span").$model->value."% dari keuntungan".CHtml::closeTag("span");
        else
            return CHtml::openTag("span").intval($model->value)." Rupiah".CHtml::closeTag("span");
    }

    public static function checkVerifiedTime($time)
    {
        if($time == NULL || $time == "" || $time == "0000-00-00 00:00:00")
            return "Belum Tersedia";
        else
            return $time;
    }

    public static function generateFundedStatus($status){
        if($status == 1)
            return "Didanai";
        else
            return "Tida Didanai";
    }

    public static function generateInstitutionStatus($status){
        if($status == 1)
            return "Sebagai Institusi/Group";
        else
            return "Perorangan";
    }

    public static function getStatus($affirmative, $negative) {
        $items = array();
        $items[0] = $negative;
        $items[1] =$affirmative;
        return $items;
    }

    public static function getIdCategory(){
        $criteria = new CDbCriteria();
        //$criteria->compare('parent_id is null');
        $model = ProjectCategory::model()->findAll('parent_id is null');//findAll($criteria);

        $items = array();
        if($model != null) {
            foreach($model as $key => $val) {
                $items[$val->id] = $val->category_name;
            }
            return $items;
        } else {
            return false;
        }
    }

    public static function getIdInheritCategory($id,$ex){
        $criteria = new CDbCriteria();
        $criteria->condition = "parent_id = $id && parent_id != $ex";
        $model = ProjectCategory::model()->findAll($criteria);

        $items = array();
        if($model != null) {
            foreach($model as $key => $val) {
                $items[$val->id] = $val->category_name;
            }
            return $items;
        } else {
            return false;
        }
    }

    public static function getInheritIdCharge(){
        $criteria = new CDbCriteria();
        $criteria->compare('is_actived',1);
        $model = ProjectCharge::model()->findAll($criteria);

        $items = array();
        if($model != null) {
            foreach($model as $key => $val) {
                $items[$val->id] = $val->value;
            }
            return $items;
        } else {
            return false;
        }
    }

    public static function getIdInstitute(){
        $criteria = new CDbCriteria();
        //$criteria->compare('is_actived',1);
        $model = InstitutionSome::model()->findAll($criteria);

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