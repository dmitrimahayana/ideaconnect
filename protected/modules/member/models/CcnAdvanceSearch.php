<?php

/**
 * This is the model class for table "swt_users".
 *
 * The followings are the available columns in table 'swt_users':
 * @property string $id
 * @property integer $users_group_id
 * @property integer $actived
 * @property integer $status_user
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $block
 * @property string $register_date
 * @property string $last_visit_date
 * @property string $activation
 * @property string $activation_date
 * @property integer $is_online
 * @property string $photo
 * @property string $mobile_no
 * @property string $params
 */
class CcnAdvanceSearch extends CActiveRecord
 {
	public $typeMember;
	public $fromJoinDate;
	public $untilJoinDate;
	public $birthPlace;
	public $originAddress;
	public $address;
	public $sex;
	public $status;
	public $degree;
	public $university;
	public $fromOutDate;
	public $untilOutDate;
	public $ipkStart;
	public $ipkEnd;
	public $enterYear;
	public $exitYear;
	public $startApproval;
	public $endApproval;
	public $major;
	public $statusUser;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CcnAdvanceSearch the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'swt_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('typeMember, fromJoinDate, untilJoinDate, birthPlace, originAddress, address, sex, status,
				degree, university, fromOutDate, untilOutDate, ipkStart, ipkEnd, enterYear, exitYear, major, statusUser', 'safe'),
			
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'typeMember' => Yii::t('label', 'Type Member'),
			'fromJoinDate' => Yii::t('label', 'Rentang Tangal Gabung'),
			'untilJoinDate' => Yii::t('label', 'Rentang Tangal Gabung'),
			'birthPlace' => Yii::t('label', 'Tempat Lahir'),
			'originAddress' => Yii::t('label', 'Alamat Asal'),
			'address' => Yii::t('label', 'Alamat Sekarang'),
			'sex' => Yii::t('label', 'Jenis Kelamin'),
			'status' => Yii::t('label', 'Status'),
			'degree' => Yii::t('label', 'Jenjang'),
			'university' => Yii::t('label', 'Universitas'),
			'fromOutDate' => Yii::t('label', 'Tahun Keluar'),
			'untilOutDate' => Yii::t('label', 'Tahun Keluar'),
			'ipkStart' => Yii::t('label', 'IPK'),
			'ipkEnd' => Yii::t('label', 'IPK'),
			'enterYear' => Yii::t('label', 'Tahun Masuk'),
			'exitYear' => Yii::t('label', 'Tahun Masuk'),
			'startApproval' => Yii::t('label', 'Waktu Approval'),
			'endApproval' => Yii::t('label', 'Waktu Approval'),
			'major' => Yii::t('label', 'Jurusan'),
			'statusUser' => Yii::t('label', 'Status User'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchAdvance($typeMember, $fromJoinDate, $untilJoinDate, $birthPlace, $originAddress, $address, 
	$sex, $status, $degree, $university, $fromOutDate, $untilOutDate, $ipkStart, $ipkEnd, $enterYear, $exitYear, $startApproval, $endApproval, $major, $statusUser) {
		$result = array();
		//search type member
		if($typeMember != ''){
			array_push($result, 'users_group_id = '.$typeMember.'');
		}else{
			array_push($result, 'users_group_id IN(4,5)');
		}
		
		//search join date
		if($fromJoinDate != '' && $untilJoinDate != ''){
			$start = date('Y-m-d', strtotime($fromJoinDate));
			$end = date('Y-m-d', strtotime($untilJoinDate));
			array_push($result, '(register_date BETWEEN "'.$start.'" AND "'.$end .'")');
		}
		
		//search tempat lahir
		if($birthPlace != ''){
			array_push($result, 'jobseeker_bio1.birth_place like "%'.$birthPlace.'%"');
		}
		
		//search alamat asal
		if($originAddress != ''){
			array_push($result, 'jobseeker_bio1.origin_address like "%'.$originAddress.'%"');
		}
		
		//search alamat
		if($address != ''){
			array_push($result, 'jobseeker_bio1.address like "%'.$address.'%"');
		}
		
		//search jenia kelamin
		if($sex != ''){
			if(count($sex) > 1){
				array_push($result, 'jobseeker_bio1.sex = "'.$sex[0].'" OR jobseeker_bio1.sex = "'.$sex[1].'"');
			}else{
				array_push($result, 'jobseeker_bio1.sex = "'.$sex[0].'"');
			}
		}
		
		//search status
		if($status != ''){
			if(count($status) == 3) {
				array_push($result, 'jobseeker_bio1.status = "'.$status[0].'" OR jobseeker_bio1.status = "'.$status[1].'" OR jobseeker_bio1.status = "'.$status[2].'"');
			}elseif(count($status) == 2) {
				array_push($result, 'jobseeker_bio1.status = "'.$status[0].'" OR jobseeker_bio1.status = "'.$status[1].'"');
			}else{
				array_push($result, 'jobseeker_bio1.status = "'.$status[0].'"');
			}
		}
		
		//search degree
		if($degree != '') {
			if(count($degree)==3){
				array_push($result, 'jobseeker_edu1.degree = "'.$degree[0].'" OR jobseeker_edu1.degree = "'.$degree[1].'" OR jobseeker_edu1.degree = "'.$degree[2].'"');
			}elseif(count($degree)==2){
				array_push($result, 'jobseeker_edu1.degree = "'.$degree[0].'" OR jobseeker_edu1.degree = "'.$degree[1].'"');
			}else{
				array_push($result, 'jobseeker_edu1.degree = "'.$degree[0].'"');
			}
		}
		
		//search universitas
		if($university != '') {
			$idUniversity = CcnUnivName::model()->findByAttributes(array('name'=>trim($university)));
			if($degree == ''){
				array_push($result, '(jobseeker_edu1.univ_name_id = "'.$idUniversity->id.'") AND last_edu = 1');
			}else{
				array_push($result, '(jobseeker_edu1.univ_name_id = "'.$idUniversity->id.'")');
			}
		}
		
		//search tahun keluar
		if($fromOutDate != '' && $untilOutDate != ''){
			if($degree == ''){
				array_push($result, '(jobseeker_edu1.finish_year BETWEEN "'.$fromOutDate.'" AND "'.$untilOutDate .'") AND last_edu = 1');
			}else{
				array_push($result, '(jobseeker_edu1.finish_year BETWEEN "'.$fromOutDate.'" AND "'.$untilOutDate .'")');
			}
		}
		
		//search range ipk
		if($ipkStart != '' && $ipkEnd != ''){
			if($degree == ''){
				array_push($result, '(jobseeker_edu1.ipk BETWEEN "'.$ipkStart.'" AND "'.$ipkEnd .'") AND last_edu = 1');
			}else{
				array_push($result, '(jobseeker_edu1.ipk BETWEEN "'.$ipkStart.'" AND "'.$ipkEnd .'")');
			}
		}
		
		//search tahun masuk
		if($enterYear != '' && $exitYear != ''){
			if($degree == ''){
				array_push($result, '(jobseeker_edu1.role_year BETWEEN "'.$enterYear.'" AND "'.$exitYear .'") AND last_edu = 1');
			}else{
				array_push($result, '(jobseeker_edu1.role_year BETWEEN "'.$enterYear.'" AND "'.$exitYear .'")');
			}
		}
		
		//search tahun keluar
		if($startApproval != '' && $endApproval != ''){
			$startApproval = date('Y-m-d', strtotime($startApproval));
			$endApproval = date('Y-m-d', strtotime($endApproval));
			array_push($result, '(ccnConfirms1.confirm_date BETWEEN "'.$startApproval.'" AND "'.$endApproval .'")');
		}
		
		//search jurusan
		if($major != '') {
			$idMajor = CcnMajor::model()->findByAttributes(array('name'=>trim($major)));
			if($degree == ''){
				array_push($result, '(jobseeker_edu1.ccn_major_id = "'.$idMajor->id.'") AND last_edu = 1');
			}else{
				array_push($result, '(jobseeker_edu1.ccn_major_id = "'.$idMajor->id.'")');
			}
		}
		
		if($statusUser != '') {
			array_push($result, 'status_user = '.$statusUser.'');
		}
	
		return $result;
	}

}