<?php

/**
 * This is the model class for table "ccn_jobseeker_exp".
 *
 * The followings are the available columns in table 'ccn_jobseeker_exp':
 * @property string $id
 * @property string $role_date
 * @property string $exit_date
 * @property string $company_name
 * @property string $position
 * @property string $job_desc
 * @property string $last_salary
 * @property string $title
 * @property string $function
 * @property string $industry
 * @property integer $still_work
 * @property integer $last_exp
 * @property integer $job_type
 * @property string $swt_users_id
 *
 * The followings are the available model relations:
 * @property SwtUsers $swtUsers
 */
class CcnJobseekerExp extends CActiveRecord
{
	public $defaultColumns = array();
	public $statistic_exp_ind_signal = false;
	public $statistic_exp_function_signal = false;
	public $statistic_exp_major_finish_year_signal = false;
	public $statistic_exp_major_role_year_signal = false;
        public $exp_ind_change = false; //for update exp (statistic)
        public $exp_function_change = false; //for update exp (statistic)
        public $exp_ind_old; //for update exp (statistic)
        public $exp_function_old; //for update exp (statistic)

        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnJobseekerExp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ccn_jobseeker_exp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_date, exit_date, company_name, position, swt_users_id, industry, function, title', 'required'),
			array('company_scale, still_work, last_exp, job_type, exp_ind_old, exp_function_old', 'numerical', 'integerOnly'=>true,
				'message' => '{attribute} harus berupa angka'),
			//array('role_date, exit_date', 'length', 'max'=>7),
			array('company_name, position', 'length', 'max'=>70),
			array('last_salary', 'length', 'max'=>60),
			array('title, function, industry', 'length', 'max'=>50),
			array('swt_users_id', 'length', 'max'=>11),
			array('statistic_exp_ind_signal, statistic_exp_function_signal,statistic_exp_major_finish_year_signal,
                            statistic_exp_major_role_year_signal, exp_ind_change, exp_function_change', 'boolean'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, role_date, exit_date, company_name, position, job_desc, last_salary, title, function, industry, still_work, last_exp, job_type, swt_users_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swtUsers' => array(self::BELONGS_TO, 'SwtUsers', 'swt_users_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'role_date' => Yii::t('label','Tanggal Masuk'),
			'exit_date' => Yii::t('label','Tanggal Keluar'),
			'company_name' => Yii::t('label','Nama Perusahaan'),
			'position' => Yii::t('label','Posisi'),
			'job_desc' => Yii::t('label','Deskripsi Pekerjaan'),
			'last_salary' => Yii::t('label','Gaji '),
			'title' => Yii::t('label','Level'),
			'function' => Yii::t('label','Tipe Pekerjaan'),
			'industry' => Yii::t('label','Industri'),
			'company_scale' => Yii::t('label','Skala Perusahaan'),
			'still_work' => Yii::t('label','Masih Bekerja'),
			'last_exp' => Yii::t('label','Pengalaman Terakhir'),
			'job_type' => Yii::t('label','Status Pekerjaan'),
			'swt_users_id' => Yii::t('label','Swt Users'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('role_date',$this->role_date,true);
		$criteria->compare('exit_date',$this->exit_date,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('job_desc',$this->job_desc,true);
		$criteria->compare('last_salary',$this->last_salary,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('function',$this->function,true);
		$criteria->compare('industry',$this->industry,true);
		$criteria->compare('company_scale',$this->company_scale,true);
		$criteria->compare('still_work',$this->still_work);
		$criteria->compare('last_exp',$this->last_exp);
		$criteria->compare('job_type',$this->job_type);
		$criteria->compare('swt_users_id',$this->swt_users_id,true);

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
			$this->defaultColumns[] = 'role_date';
			$this->defaultColumns[] = 'exit_date';
			$this->defaultColumns[] = 'company_name';
			$this->defaultColumns[] = 'position';
			$this->defaultColumns[] = 'job_desc';
			$this->defaultColumns[] = 'last_salary';
			$this->defaultColumns[] = 'title';
			$this->defaultColumns[] = 'function';
			$this->defaultColumns[] = 'industry';
			$this->defaultColumns[] = 'company_scale';
			$this->defaultColumns[] = 'still_work';
			$this->defaultColumns[] = 'last_exp';
			$this->defaultColumns[] = 'job_type';
			$this->defaultColumns[] = 'swt_users_id';
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
			$this->defaultColumns[] = 'role_date';
			$this->defaultColumns[] = 'exit_date';
			$this->defaultColumns[] = 'company_name';
			$this->defaultColumns[] = 'position';
			$this->defaultColumns[] = 'job_desc';
			$this->defaultColumns[] = 'last_salary';
			$this->defaultColumns[] = 'title';
			$this->defaultColumns[] = 'function';
			$this->defaultColumns[] = 'industry';
			$this->defaultColumns[] = 'company_scale';
			$this->defaultColumns[] = 'still_work';
			$this->defaultColumns[] = 'last_exp';
			$this->defaultColumns[] = 'job_type';
			$this->defaultColumns[] = 'swt_users_id';
		}
		parent::afterConstruct();
	}

	protected function beforeValidate()
	{
		if(parent::beforeValidate()) {
			$this->last_exp = '1';
			if($this->still_work == '1') {
				$this->exit_date = '-';
			}else{
				$start = substr($this->role_date,3);
				$finish = substr($this->exit_date,3);
				if ($start > date('Y')) {
					$this->addError('role_date', 'Tahun masuk lebih besar dari tahun sekarang');
				}elseif($finish < $start) {
					$this->addError('role_date', 'Tahun masuk lebih besar dari tahun keluar');
				}elseif ($finish > date('Y')) {
					$this->addError('exit_date', 'Tahun keluar lebih besar dari tahun sekarang');
				}
			}

			if($this->isNewRecord) {
				$this->swt_users_id = Yii::app()->user->id_user;
			}
		}
		return true;
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				
			}
		}
		return true;
	}
	
		
	/**
	 * after save
	 */
	protected function afterSave() {
		
		/* $lastExp = self::model()->find(array(
			'condition'=> 'swt_users_id = :id',
			'params'=>array(':id'=>$this->swt_users_id),
			'order'=>'exit_date DESC',
		));
		$experience = self::model()->findAll(array(
			'condition'=> 'swt_users_id = :id',
			'params'=>array(':id'=>$this->swt_users_id),
			'order'=>'exit_date DESC',
		));

		foreach($experience as $val) {
			$update = self::model()->findByPk($val->id);
			if($val->id == $lastExp->id) {
				$update->last_exp = '1';
			} else {
				$update->last_exp = '0';
			}
			$update->update();
		} */
		parent::afterSave();
		//still error
		
		/**
		* signal for update statistic industry experience
		*/
		if($this->statistic_exp_ind_signal) {
            if($this->isNewRecord) {
                $statistik_industry = CcnStatisticExpIndustry::model()->find(array(
                    'condition'=>'industry_id = :ind_id',
                    'params' => array(':ind_id'=> $this->industry), 
                ));
                if($statistik_industry != null){
                    $statistik_industry->total = $statistik_industry->total+1;
                    $statistik_industry->update();
                }else{
                    $statistik_industry = new CcnStatisticExpIndustry;
                    $statistik_industry->industry_id = $this->industry;
                    $statistik_industry->total = '1';
                    $statistik_industry->save();
                }
            }else {
                if($this->exp_ind_change) {
                    //update old
                    $statistik_industry = CcnStatisticExpIndustry::model()->find(array(
                            'condition'=>'industry_id = :ind_id',
                            'params' => array(':ind_id'=> $this->exp_ind_old), 
                    ));
                    if($statistik_industry != null){
                            $statistik_industry->total = $statistik_industry->total - 1;
                            $statistik_industry->update();
                    }

                    //insert new
                    $statistik_industry = CcnStatisticExpIndustry::model()->find(array(
                            'condition'=>'industry_id = :ind_id',
                            'params' => array(':ind_id'=> $this->industry), 
                    ));
                    if($statistik_industry != null){
                            $statistik_industry->total = $statistik_industry->total + 1;
                            $statistik_industry->update();
                    }else{
                            $statistik_industry = new CcnStatisticExpIndustry;
                            $statistik_industry->industry_id = $this->industry;
                            $statistik_industry->total = 1;
                            $statistik_industry->save();
                    }

                }

            }
			
		}
		
		/**
		* signal for update statistic function experience
		*/
		if($this->statistic_exp_function_signal) {
            if($this->isNewRecord) {
                $statistik_function = CcnStatisticExpFunction::model()->find(array(
                    'condition'=>'function_id = :fid',
                    'params' => array(':fid'=> $this->function), 
                ));
                if($statistik_function != null){
                    $statistik_function->total = $statistik_function->total+1;
                    $statistik_function->update();
                }else{
                    $statistik_function = new CcnStatisticExpFunction;
                    $statistik_function->function_id = $this->function;
                    $statistik_function->total = '1';
                    $statistik_function->save();
                }
            }else {
                 if($this->exp_function_change) {
                    //update old
                    $statistik_function = CcnStatisticExpFunction::model()->find(array(
                            'condition'=>'function_id = :fid',
                            'params' => array(':fid'=> $this->exp_function_old), 
                    ));
                    if($statistik_function != null){
                            $statistik_function->total = $statistik_function->total - 1;
                            $statistik_function->update();
                    }

                    //insert new
                    $statistik_function = CcnStatisticExpFunction::model()->find(array(
                            'condition'=>'function_id = :fid',
                            'params' => array(':fid'=> $this->function), 
                    ));
                    if($statistik_function != null){
                        $statistik_function->total = $statistik_function->total + 1;
                        $statistik_function->update();
                    }else{
                        $statistik_function = new CcnStatisticExpFunction;
                        $statistik_function->function_id = $this->function;
                        $statistik_function->total = '1';
                        $statistik_function->save();
                    }

                }
            }
			
			
		}
		
		/**
		* signal for update statistic major and finish year experience
		*/
		if($this->statistic_exp_major_finish_year_signal) {
			$alumni = CcnAlumni::model()->find(array(
				'condition'=> 'swt_users_id = :uid',
				'params'=>array(':uid'=>Yii::app()->user->id_user)
			));
						
			$statistik_finish = CcnStatisticExpMajorFinishYear::model()->find(array(
				'condition'=>'major_id = :mid and year = :y',
				'params' => array(
						':mid'=> $alumni->ccn_major_id, 
						':y'=>$alumni->finish_year
					), 
			));
			if($statistik_finish != null){
				$statistik_finish->total = $statistik_finish->total+1;
				$statistik_finish->update();
			}else{
				$statistik_finish = new CcnStatisticExpMajorFinishYear;
				$statistik_finish->major_id = $alumni->ccn_major_id;
				$statistik_finish->year = $alumni->finish_year;
				$statistik_finish->total = '1';
				$statistik_finish->save();
			}
			
		}
		
		/**
		* signal for update statistic major and role year experience
		*/
		if($this->statistic_exp_major_role_year_signal) {
			$alumni = CcnAlumni::model()->find(array(
				'condition'=> 'swt_users_id = :uid',
				'params'=>array(':uid'=>Yii::app()->user->id_user)
			));
						
			$statistik_role = CcnStatisticExpMajorRoleYear::model()->find(array(
				'condition'=>'major_id = :mid and year = :y',
				'params' => array(
						':mid'=> $alumni->ccn_major_id, 
						':y'=>$alumni->role_year
					), 
			));
			if($statistik_role != null){
				$statistik_role->total = $statistik_role->total+1;
				$statistik_role->update();
			}else{
				$statistik_role = new CcnStatisticExpMajorRoleYear;
				$statistik_role->major_id = $alumni->ccn_major_id;
				$statistik_role->year = $alumni->role_year;
				$statistik_role->total = '1';
				$statistik_role->save();
			}
			
		}
	
	}
    
    /**
	 * after delete
	 */
    protected function afterDelete() {
        parent::afterDelete();
        /**
		* signal for update statistic industry experience
		*/
		if($this->statistic_exp_ind_signal) {
            //update old
            $statistik_industry = CcnStatisticExpIndustry::model()->find(array(
                    'condition'=>'industry_id = :ind_id',
                    'params' => array(':ind_id'=> $this->exp_ind_old), 
            ));
            if($statistik_industry != null){
                    $statistik_industry->total = $statistik_industry->total - 1;
                    $statistik_industry->update();
            }			
		}
		
		/**
		* signal for update statistic function experience
		*/
		if($this->statistic_exp_function_signal) {            
            //update old
            $statistik_function = CcnStatisticExpFunction::model()->find(array(
                    'condition'=>'function_id = :fid',
                    'params' => array(':fid'=> $this->exp_function_old), 
            ));
            if($statistik_function != null){
                    $statistik_function->total = $statistik_function->total - 1;
                    $statistik_function->update();
            }			
		}
		
		/**
		* signal for update statistic major and finish year experience
		*/
		if($this->statistic_exp_major_finish_year_signal) {
			$alumni = CcnAlumni::model()->find(array(
				'condition'=> 'swt_users_id = :uid',
				'params'=>array(':uid'=>Yii::app()->user->id_user)
			));
						
			$statistik_finish = CcnStatisticExpMajorFinishYear::model()->find(array(
				'condition'=>'major_id = :mid and year = :y',
				'params' => array(
						':mid'=> $alumni->ccn_major_id, 
						':y'=>$alumni->finish_year
					), 
			));
			if($statistik_finish != null){
				$statistik_finish->total = $statistik_finish->total -1;
				$statistik_finish->update();
			}
			
		}
		
		/**
		* signal for update statistic major and role year experience
		*/
		if($this->statistic_exp_major_role_year_signal) {
			$alumni = CcnAlumni::model()->find(array(
				'condition'=> 'swt_users_id = :uid',
				'params'=>array(':uid'=>Yii::app()->user->id_user)
			));
						
			$statistik_role = CcnStatisticExpMajorRoleYear::model()->find(array(
				'condition'=>'major_id = :mid and year = :y',
				'params' => array(
						':mid'=> $alumni->ccn_major_id, 
						':y'=>$alumni->role_year
					), 
			));
			if($statistik_role != null){
				$statistik_role->total = $statistik_role->total - 1;
				$statistik_role->update();
			}
		}
        
    }


    /** 
	* get data array company scale
	 */	
	public static function getArrCompanyScale() {
		return array(
			1 => 'Lokal',
			2 => 'Nasional',
			3 => 'Multinasional',
			);
	}
	
	/** 
	* get data company scale
	 */	
	public static function getCompanyScale($id) {
		$arrCScale = self::getArrCompanyScale();
		return $arrCScale[$id];
	}
	
	/** 
	* get data array title
	 */	
	public static function getArrTitle() {
		return array(
			1	=> 'Direktur',
			2	=> 'Manager',
			3	=> 'Supervisor',
			4	=> 'Staff',
			5	=> 'Entry',
			);
	}
	
	/** 
	* get data title
	 */	
	public static function getTitle($id) {
		$arrTitle = self::getArrTitle();
		return $arrTitle[$id];
	}

}