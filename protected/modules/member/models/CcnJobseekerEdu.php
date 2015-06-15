<?php

/**
 * This is the model class for table "ccn_jobseeker_edu".
 *
 * The followings are the available columns in table 'ccn_jobseeker_edu':
 * @property string $id
 * @property string $swt_users_id
 * @property string $name_non_univ
 * @property string $univ_name_id
 * @property integer $role_date
 * @property integer $finish_date
 * @property string $ccn_major_id
 * @property string $submajor
 * @property string $degree
 * @property string $thesis_title
 * @property string $ipk
 * @property string $acreditation
 * @property integer $city_id
 * @property string $country_code
 * @property integer $last_edu
 * @property integer $role_month
 * @property integer $role_year
 * @property integer $finish_month
 * @property integer $finish_year
 *
 * The followings are the available model relations:
 * @property SwtUsers $swtUsers
 * @property CcnCity $city
 * @property CcnCountry $countryCode
 * @property CcnUnivName $univName
 * @property CcnMajor $ccnMajor
 */
class CcnJobseekerEdu extends CActiveRecord
{
	public $defaultColumns = array();
	public $name;
	//public $major;
	public $entry_date;
	public $graduated_date;
	public $province_id;
	public $other_collage;
	public $suggest_major;
	public $suggestCollege;
	public $statistic_edu_signal = false;
	public $statistic_member_signal = false;
	public $univ_name;
	public $total;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnJobseekerEdu the static model class
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
		return 'ccn_jobseeker_edu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('swt_users_id, univ_name_id, role_date, finish_date, major, degree, thesis_title, ipk, city_id, country_code, role_month, role_year, finish_month, finish_year, entry_date, graduated_date', 'required'),
			array('role_date, finish_date, city_id, last_edu, role_month, role_year, finish_month, finish_year, other_collage', 'numerical', 'integerOnly'=>true,
				'message' => '{attribute} harus berupa angka'),
			//array('finish_year,role_year', 'checkDifYear'),
			array('swt_users_id', 'length', 'max'=>11),
			array('name_non_univ', 'length', 'max'=>70),
			array('suggest_major', 'length', 'max'=>50),
			array('univ_name_id, ccn_major_id', 'length', 'max'=>10),
			array('submajor, suggestCollege', 'length', 'max'=>150),
			array('acreditation, country_code', 'length', 'max'=>2),
			array('degree, thesis_title', 'length', 'max'=>255),
			array('ipk', 'length', 'max'=>4),
			array('statistic_edu_signal, statistic_member_signal', 'boolean'),
			array('ipk', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, swt_users_id, name_non_univ, univ_name_id, role_date, finish_date, ccn_major_id, submajor, degree, thesis_title, ipk, acreditation, 
			city_id, country_code, last_edu, role_month, role_year, finish_month, finish_year, suggest_major, name, univ_name', 'safe', 'on'=>'search'),
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
			'users' => array(self::BELONGS_TO, 'CcnUsers', 'swt_users_id'),
			'city' => array(self::BELONGS_TO, 'CcnCity', 'city_id'),
			'country' => array(self::BELONGS_TO, 'ZoneCountry', 'country_code'),
			'university' => array(self::BELONGS_TO, 'CcnUnivName', 'univ_name_id'),
			'major' => array(self::BELONGS_TO, 'CcnMajor', 'ccn_major_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'swt_users_id' => Yii::t('label','Nama Jobseeker'),
			'name_non_univ' => Yii::t('label','Universitas'),
			'univ_name_id' => Yii::t('label','Universitas'),
			'role_date' => Yii::t('label','Tanggal Masuk'),
			'finish_date' => Yii::t('label','Tanggal Lulus'),
			'ccn_major_id' => Yii::t('label','Jurusan'),
			'major' => Yii::t('label','Jurusan'),
			'submajor' => Yii::t('label','Konsentrasi'),
			'degree' => Yii::t('label','Jenjang'),
			'thesis_title' => Yii::t('label','Judul Skripsi'),
			'ipk' => Yii::t('label','IPK'),
			'acreditation' => Yii::t('label','Akreditasi'),
			'province_id' => Yii::t('label','Provinsi'),
			'city_id' => Yii::t('label','Kota/Kabupaten'),
			'city.name' => Yii::t('label','Kota/Kabupaten'),
			'country_code' => Yii::t('label','Negara'),
			'country.name' => Yii::t('label','Negara'),
			'last_edu' => Yii::t('label','Last Edu'),
			'role_month' => Yii::t('label','Bulan Masuk'),
			'role_year' => Yii::t('label','Tahun Masuk'),
			'finish_month' => Yii::t('label','Bulan Lulus'),
			'finish_year' => Yii::t('label','Tahun Lulus'),
			'entry_date' =>Yii::t('label', 'Tanggal Masuk'),
			'graduated_date' =>Yii::t('label', 'Tanggal Lulus'),
			'other_collage' =>Yii::t('label', 'Sarankan Universitas'),
			'suggest_major'	=> Yii::t('label', 'Jurusan yang Disarankan'),
			'name'	=> Yii::t('label', 'Nama'),
			'univ_name'	=> Yii::t('label', 'Universitas/Sekolah'),
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
		$criteria->compare('swt_users_id',$this->swt_users_id,true);
		$criteria->compare('name_non_univ',$this->name_non_univ,true);
		$criteria->compare('univ_name_id',$this->univ_name_id,true);
		$criteria->compare('role_date',$this->role_date);
		$criteria->compare('finish_date',$this->finish_date);
		$criteria->compare('ccn_major_id',$this->ccn_major_id,true);
		$criteria->compare('submajor',$this->submajor,true);
		$criteria->compare('degree',$this->degree,true);
		$criteria->compare('thesis_title',$this->thesis_title,true);
		$criteria->compare('ipk',$this->ipk,true);
		$criteria->compare('acreditation',$this->acreditation,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('last_edu',$this->last_edu);
		$criteria->compare('role_month',$this->role_month);
		$criteria->compare('role_year',$this->role_year);
		$criteria->compare('finish_month',$this->finish_month);
		$criteria->compare('finish_year',$this->finish_year);

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
			$this->defaultColumns[] = 'swt_users_id';
			$this->defaultColumns[] = 'name_non_univ';
			$this->defaultColumns[] = 'univ_name_id';
			$this->defaultColumns[] = 'role_date';
			$this->defaultColumns[] = 'finish_date';
			$this->defaultColumns[] = 'ccn_major_id';
			$this->defaultColumns[] = 'submajor';
			$this->defaultColumns[] = 'degree';
			$this->defaultColumns[] = 'thesis_title';
			$this->defaultColumns[] = 'ipk';
			$this->defaultColumns[] = 'acreditation';
			$this->defaultColumns[] = 'city_id';
			$this->defaultColumns[] = 'country_code';
			$this->defaultColumns[] = 'last_edu';
			$this->defaultColumns[] = 'role_month';
			$this->defaultColumns[] = 'role_year';
			$this->defaultColumns[] = 'finish_month';
			$this->defaultColumns[] = 'finish_year';
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
			$this->defaultColumns[] = 'swt_users_id';
			$this->defaultColumns[] = 'name_non_univ';
			$this->defaultColumns[] = 'univ_name_id';
			$this->defaultColumns[] = 'role_date';
			$this->defaultColumns[] = 'finish_date';
			$this->defaultColumns[] = 'ccn_major_id';
			$this->defaultColumns[] = 'submajor';
			$this->defaultColumns[] = 'degree';
			$this->defaultColumns[] = 'thesis_title';
			$this->defaultColumns[] = 'ipk';
			$this->defaultColumns[] = 'acreditation';
			$this->defaultColumns[] = 'city_id';
			$this->defaultColumns[] = 'country_code';
			$this->defaultColumns[] = 'last_edu';
			$this->defaultColumns[] = 'role_month';
			$this->defaultColumns[] = 'role_year';
			$this->defaultColumns[] = 'finish_month';
			$this->defaultColumns[] = 'finish_year';
		}
		parent::afterConstruct();
	}
	

	/** 
	* get data array education
	 */	
	public function getArrEducationStep() {
		return array(
			1 => 'SD',
			2 => 'SLTP',
			3 => 'SMA',
			4 => 'Diploma 1',
			5 => 'Diploma 2',
			6 => 'Diploma 3',
			7 => 'Diploma 4',
			8 => 'Sarjana/S1',
			9 => 'Magister/S2',
			10 => 'Doctor/S3',
			);
	}
	
	/** 
	* get data array education
	 */	
	public function getEducationStep($id) {
		$arrEdu = self::getArrEducationStep();
		return $arrEdu[$id];
	}
	
	protected function beforeValidate()
	{
		if(parent::beforeValidate()) {
			$this->role_date= date('d',strtotime($this->entry_date));
			$this->role_month = date('m',strtotime($this->entry_date));
			$this->role_year = date('Y',strtotime($this->entry_date));
			$this->finish_date = date('d',strtotime($this->graduated_date));
			$this->finish_month = date('m',strtotime($this->graduated_date));
			$this->finish_year = date('Y',strtotime($this->graduated_date));
			
			if ($this->ccn_major_id == '' || $this->ccn_major_id == 1) {
				$this->ccn_major_id = 1;
				$this->suggest_major = ucwords(strtolower($this->major));
			}

			if(in_array($this->degree, array('SD','SMP','SMA'))) {
				$this->univ_name_id = '1';
				$this->ccn_major_id = '1';
				$this->major = '-';
				$this->thesis_title = '-';
				$this->acreditation = '-';
				
				if(in_array($this->degree, array('SD','SMP'))) {
					$this->submajor = '-';
				}
				
				if($this->name_non_univ == '') {
					$this->addError('name_non_univ', Yii::t('', 'Nama sekolah tidak boleh kosong'));
				}
				
				if($this->ipk == '') {
					$this->addError('ipk', Yii::t('', 'Nem tidak boleh kosong'));
				}
				
				$this->name_non_univ = strtoupper($this->name_non_univ);
			} else {
				if($this->other_collage == '1'){
					if($this->name_non_univ == '') {
						$this->addError('name_non_univ', Yii::t('', 'Universitas tidak boleh kosong'));
					}
					
					$this->univ_name_id = '1';
					$this->name_non_univ = strtoupper($this->name_non_univ);
				}
			}
			
			if($this->finish_year < $this->role_year) {
				$this->addError('graduated_date', 'Tahun masuk lebih besar dari tahun keluar');
			}elseif ($this->finish_year > date('Y')) {
				$this->addError('graduated_date', 'Tahun keluar lebih besar dari tahun sekarang');
			}
			if($this->isNewRecord) {
				$this->swt_users_id = Yii::app()->user->id_user;
                                //avoid duplicate edu
                                if($this->univ_name_id != null && !in_array($this->degree, array('SD','SMP','SMA'))) {
                                    $edu = self::model()->find(array(
                                        'condition'=>'swt_users_id = :j AND univ_name_id = :u AND degree = :d',
                                        'params'=>array(':j'=>Yii::app()->user->id_user, ':u'=>$this->univ_name_id, ':d'=>$this->degree)
                                    ));
                                    if($edu != null)
                                        $this->addError ('univ_name_id', Yii::t('notification', 'Data yang Anda masukkan sudah ada sebelumnya'));                

                                }
			}
		}
		return true;
	}
	
	/**
	 * after save attributes
	 */
	protected function afterSave() {
		parent::afterSave();		
		/*$lastEdu = self::model()->find(array(
			'condition'=> 'swt_users_id = :id',
			'params'=>array(':id'=>$this->swt_users_id),
			'order'=>'role_year DESC',
		));
		
		if($lastEdu != null){
			self::model()->updateAll(array(
				'last_edu' => 0,	
			),array(
				'condition'=> 'swt_users_id = :id',
				'params'=>array(':id'=>$this->swt_users_id),
			));
			$lastEdu->last_edu = 1;
			$lastEdu->save(false,array('last_edu'));
		}*/

		/*$lastEdu = self::model()->find(array(
			'condition'=> 'swt_users_id = :id',
			'params'=>array(':id'=>$this->swt_users_id),
			'order'=>'role_year DESC',
		));
		$education = self::model()->findAll(array(
			'condition'=> 'swt_users_id = :id',
			'params'=>array(':id'=>$this->swt_users_id),
			'order'=>'role_year DESC',
		));
		
		foreach($education as $val) {
			$update = self::model()->findByPk($val->id);
			//file_put_contents('tes.txt', array($lastEdu->id.',',$val->id));
			if($val->id == $lastEdu->id) {
				$update->last_edu = '1';
			} else {
				$update->last_edu = '0';
			}
			$update->save(false,array('last_edu'));
		}*/
		
		//update status user
                $model = CcnUsers::model()->findByPk($this->swt_users_id);
		if($this->isNewRecord) {			
			if($model->users_group_id == 4){
				/*cek jenjang sma untuk alumni*/
				$checking = self::model()->find(array(
						'select' => 'degree',
						'condition' => 'swt_users_id = :id and degree = :name',
						'params'=> array(':id'=>$this->swt_users_id, ':name'=> 'SMA' )
					));
				if ($checking != null){
					$model->status_user = 5;
					$model->save(false, array('status_user'));
				}
			}else {
                            $model->status_user = 5;
                            $model->save(false, array('status_user'));
                        }
			
		}else { //update education
                    if($model->status_user === 4) { //if status before biodata, convert to 5 (education)
                       if($model->users_group_id == 4){ //alumni
				/*cek jenjang sma untuk alumni*/
				$checking = self::model()->find(array(
						'select' => 'degree',
						'condition' => 'swt_users_id = :id and degree = :name',
						'params'=> array(':id'=>$this->swt_users_id, ':name'=> 'SMA' )
					));
				if ($checking != null){
					$model->status_user = 5;
					$model->save(false, array('status_user'));
				}	
			}else {
                            $model->status_user = 5;
                            $model->save(false, array('status_user'));
                        }
                    }
                }
		
		if($this->statistic_edu_signal) {
			$statistik = CcnStatisticMemberUnivercity::model()->find(array(
				'condition'=>'user_group_id = :gid and univercity = :fid and month = :m and year = :y ',
				'params' => array(
					':gid'=> Yii::app()->user->id,
					':fid'=> $this->univ_name_id,
					':m'=> date("m"),
					':y'=> date("Y")
				), 
			));
			if($statistik != null){
				$statistik->total = $statistik->total+1;
				$statistik->update();
			}else{
				$statistik = new CcnStatisticMemberUnivercity;
				$statistik->user_group_id = Yii::app()->user->id;
				$statistik->univercity = $this->univ_name_id;
				$statistik->month = date("m");
				$statistik->year = date("Y");
				$statistik->total = '1';
				$statistik->save();
			}
		}
		
		if($this->statistic_member_signal) {
			$stat_member = CcnStatisticMember::model()->find(array(
					'condition' =>' type_id = :gid and status_user = :st_user and  months = :m and years = :y',
					'params' => array(
							':gid'=>Yii::app()->user->id,
							':st_user'=>5,
							':m'=> date("m"),
							':y'=> date("Y")
						), 
				));
			//if($this->isNewRecord) {
				
				if($stat_member != null){
					$stat_member->total = $stat_member->total+1;
					$stat_member->update();
				}else{
					$stat_member = new CcnStatisticMember;
					$stat_member->type_id = Yii::app()->user->id;
					$stat_member->status_user = 5;
					$stat_member->months = date("m");
					$stat_member->years = date("Y");
					$stat_member->total = 1;
					$stat_member->save();
				}
		}
		
	}
	
	/**
	 * @check finish year (can not > year now) 
	 */	
	/*protected function checkDifYear($attribute,$params) {
		if($this->finish_year <= $this->role_year) {
			$this->addError($attribute, 'Tahun masuk lebih besar dari tahun keluar');
		}elseif ($this->finish_year >= date('Y')) {
			$this->addError($attribute, 'Tahun keluar lebih besar');
		}
		
	}*/
	
	protected function beforeSave()
	{
		if(parent::beforeSave()){
			$universitas=new CcnUnivName;
			$universitas->name = strtoupper($this->name_non_univ);
			$universitas->approved = '0';
			$universitas->save();
		}
	
		return true;
	}
   
}