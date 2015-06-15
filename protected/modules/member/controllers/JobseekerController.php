<?php

class JobseekerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	//public $layout='admin';
	public $defaultAction = 'index';

	/**
	 * Initialize admin template
	 */
	public function init() {
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		$this->layout = $arrThemes['layout'];
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','pdf','printcv','account', 'notifier', 'uploadfoto'),
				'users'=>array('@'),
				'expression'=>'$user->id==4 || $user->id==5'
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
                $status = Users::model()->find(array(
                        'select' => 'status_user',
                        'condition' => 'id = :id' ,
                        'params' => array(':id'=>Yii::app()->user->id_user) 			
                ));
                
                if ($status->status_user == 3 ) { //aproval admin
                        $redirect = Yii::app()->createUrl('member/biodata/wizard');
                }elseif ($status->status_user == 4 ) { //biodata complete
                        $redirect = Yii::app()->createUrl('member/education/wizard');
                }elseif ($status->status_user >= 5 ) { //education not empty
                        if(Yii::app()->user->id == 4){ //if alumni, should filled grade smu
                                $checking = CcnJobseekerEdu::model()->find(array(
                                        'select' => 'degree',
                                        'condition' => 'swt_users_id = :id AND degree= :name',
                                        'params'=> array(':id'=>Yii::app()->user->id_user, ':name'=>'SMA')
                                ));
                                if($checking == null ) {
                                        $redirect = Yii::app()->createUrl('member/education/wizard');
                                }else {
                                       $redirect = null;   
                                }
                        }else
                              $redirect = null;   
                }else
                    $redirect = null;                    
                
                
                if($redirect != null)
                    $this->redirect($redirect);
                else {
                    $this->layout = 'front_jobseeker';
                    $this->render('front_index');
                }
	}

	public function actionView()
	{
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
			$uid = $id;
		} else {
			$uid = Yii::app()->user->id_user;
		}
		
		// get data list biodata
		$biodata=CcnJobseekerBio::model()->find(array(
				'condition'=> 'swt_users_id = :id',
				'params' => array(':id'=> $uid), 
		));
		
		//get data education
		$criteria=new CDbCriteria;
		$criteria->compare('swt_users_id', $uid);
		$education = new CActiveDataProvider('CcnJobseekerEdu', array(
			'criteria'=>$criteria,
		));
		
		//get data experience
		$criteria=new CDbCriteria;
		$criteria->compare('swt_users_id', $uid);
		$experience = new CActiveDataProvider('CcnJobseekerExp', array(
			'criteria'=>$criteria,
		));

		//get data organization
		$criteria=new CDbCriteria;
		$criteria->compare('swt_users_id', $uid);
		$organization = new CActiveDataProvider('CcnJobseekerOrg', array(
			'criteria'=>$criteria,
		));
		
		//get data skill
		$skill=CcnJobseekerSkill::model()->find(array(
				'condition'=> 'swt_users_id = :id',
				'params' => array(':id'=>$uid),		 
		));
		
		//get data training
		$criteria=new CDbCriteria;
		$criteria->compare('swt_users_id', $uid);
		$training = new CActiveDataProvider('CcnJobseekerTraining', array(
			'criteria'=>$criteria,
		));
		
		//get data toefl
		$toefl=CcnJobseekerToefl::model()->find(array(
				'condition'=> 'swt_users_id = :id',
				'params' => array(':id'=>Yii::app()->user->id_user), 
		));
		
		//get data positif
		$positif=CcnJobseekerPositive::model()->find(array(
				'condition'=> 'swt_users_id = :id',
				'params' => array(':id'=>Yii::app()->user->id_user), 
		));

		
		//get data reference
		$reference=CcnJobseekerReference::model()->find(array(
				'condition'=> 'swt_users_id = :id',
				'params' => array(':id'=>Yii::app()->user->id_user), 
		));

		//get data award
		$criteria=new CDbCriteria;
		$criteria->compare('swt_users_id', $uid);
		$award = new CActiveDataProvider('CcnJobseekerAward', array(
			'criteria'=>$criteria,
		));
		
		//get data language
		$criteria=new CDbCriteria;
		$criteria->compare('swt_users_id', $uid);
		$language = new CActiveDataProvider('CcnJobseekerLang', array(
			'criteria'=>$criteria,
		));
		
		$this->render('front_view',array(
			'model'=>$this->loadModel($uid),
			'biodata' => $biodata,
			'education' => $education,
			'organization' => $organization,
			'skill' => $skill,
			'training' => $training,
			'toefl' => $toefl,
			'positif' => $positif,
			'experience' => $experience,
			'reference' => $reference,
			'award' => $award,
			'language' => $language,
		));
		
	}

	public function actionAccount()
	{
		$this->layout = 'front_jobseeker';
		$id = Yii::app()->user->id_user;
		$model=CcnUpdateUserAccount::model()->findByPk($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['CcnUpdateUserAccount'])) {
			$salt = Yii::app()->dbparams->auth_salt;
			$password = $_POST['CcnUpdateUserAccount']['newPassword'];
			$model->attributes = $_POST['CcnUpdateUserAccount'];
			$model->password = md5($salt.$password);
			$model->scenario = 'editAcount';
			
			if($model->save()) {
				Yii::app()->user->setFlash('success', 'Informasi akun berhasil diperbaharui.');
				$this->redirect(array('index'));
			}

		}
		
		$this->render('front_account',array(
			'model'=>$model,
		));
	}

	public function actionNotifier()
	{
		$this->layout = 'front_jobseeker';
		Yii::import('application.modules.vacancy.models.CcnSubscribeVacancyJobseeker');
		Yii::import('application.modules.test.models.CcnSubscribeTestCall');
		$model = ComModules::model()->findAll(array(
			'condition'=>'subscribe_exist = 1 AND subscribe_active = 1',
		));
		$id = Yii::app()->user->id_user;
		$succesVacancy = 0;
		$succesTestCall = 0;
		$successContent = 0;
		
		
		if(isset($_POST['CcnSubscribeVacancyJobseeker'])){
			$cekVacancySubscribe = CcnSubscribeVacancyJobseeker::model()->find(array(
					'condition'=>'swt_users_id = :uid',
					'params'=>array(':uid'=>$id)
				));
			if($_POST['CcnSubscribeVacancyJobseeker']['enableSave'] == 1){
				
				if($cekVacancySubscribe != null){
					$cekVacancySubscribe->attributes=$_POST['CcnSubscribeVacancyJobseeker'];
					if(is_array($cekVacancySubscribe->subc_major))
						$cekVacancySubscribe->subc_major = implode(',', $cekVacancySubscribe->subc_major);	
					$cekVacancySubscribe->swt_users_id = $id;
					if($cekVacancySubscribe->update()){
						$succesVacancy = 1;
					}					
				}else{
					$vacancy = new CcnSubscribeVacancyJobseeker;
					$vacancy->attributes=$_POST['CcnSubscribeVacancyJobseeker'];
					if(is_array($vacancy->subc_major))
						$vacancy->subc_major = implode(',', $vacancy->subc_major);	
					$vacancy->swt_users_id = $id;
					if($vacancy->save()) {
						$succesVacancy = 1;
					}					
				}
			}elseif($_POST['CcnSubscribeVacancyJobseeker']['enableSave'] == 0){
				
				if($cekVacancySubscribe != null){
					$cekVacancySubscribe->delete();
					$succesVacancy = 1;
				}
				
			}
		}
		
		if(isset($_POST['CcnSubscribeTestCall'])){
			$cekSubscribeTest = CcnSubscribeTestCall::model()->find(array(
				'condition'=>'swt_users_id = :uid',
				'params'=>array(':uid'=>$id),
			)); 
			if($_POST['CcnSubscribeTestCall']['enableSave'] == 1){
				
				if($cekSubscribeTest != null){
					$cekSubscribeTest->swt_users_id = $id;
					$cekSubscribeTest->status_test = $_POST['CcnSubscribeTestCall']['subc_major'];
					if($cekSubscribeTest->update()){
						$succesTestCall = 1;
					}					
				}else{
					$testCall = new CcnSubscribeTestCall;
					$testCall->swt_users_id = $id;
					$testCall->status_test = $_POST['CcnSubscribeTestCall']['subc_major'];
					if($testCall->save()) {
						$succesTestCall = 1;
					}					
				}
			}elseif($_POST['CcnSubscribeTestCall']['enableSave'] == 0){
				if($cekSubscribeTest != null){
					$cekSubscribeTest->delete();
					$succesTestCall = 1;
				}
				
			}
		}
		
		if(isset($_POST['CcnSubscribeContent'])){
			$cekSubscribeContent = CcnSubscribeContent::model()->find(array(
				'condition'=>'swt_users_id = :uid',
				'params'=>array(':uid'=>$id),
			)); 
			if($_POST['CcnSubscribeContent']['enableSave'] == 1){
				
				if($cekSubscribeContent != null){
					//echo $_POST['CcnSubscribeContent']['content_category'];
					$cekSubscribeContent->swt_users_id = $id;
					$cekSubscribeContent->content_category = $_POST['CcnSubscribeContent']['content_category'];
					if($cekSubscribeContent->update()){
						$successContent = 1;
					}
				}else{
					$news = new CcnSubscribeContent;
					$news->swt_users_id = $id;
					$news->content_category = $_POST['CcnSubscribeContent']['content_category'];
					if($news->save()) {
						$successContent = 1;
					}
				}
				
			}elseif($_POST['CcnSubscribeContent']['enableSave'] == 0){
				if($cekSubscribeContent != null){
					$cekSubscribeContent->delete();
					$successContent = 1;
				}
				
			}
		}
		
		if($succesVacancy == 1 || $succesTestCall == 1 || $successContent == 1){
			Yii::app()->user->setFlash('success', 'Anda kini telah berlangganan email subscribe');
		}
		
		
		
		$this->render('front_notifier', array(
			'model'=>$model,
			'cekSubscribeVacancy'=>$cekSubscribeVacancy,
			'cekSubscribeTestCall'=>$cekSubscribeTestCall,
			'id'=>$id
		));

	}


	/*// Print CV Online.
	public function actionPrintCV() {
		$uid = Yii::app()->user->id_user;
		//$user = Users::model()->findByPk(Yii::app()->user->id_user);
		$dialog = new PrintCV;
		$this->render('/jobseeker/print_cv', array('model' => $uid, 'dialog' => $dialog));
	}*/
	
	public function actionPrintCV() {
		$id= Yii::app()->user->id_user;
		Yii::import('ext.html2pdf.HTML2PDF');
		Yii::import('ext.html2pdf._mypdf.MyPDF');	// classe mypdf
		Yii::import('ext.html2pdf.parsingHTML');	// classe de parsing HTML
		Yii::import('ext.html2pdf.styleHTML');		// classe de gestion des styles

		$session = new CHttpSession;
		if(!$session->isStarted) {
			$session->open();
		}
		if(isset($_POST['PrintCV'])) {
			$data = $_POST['PrintCV'];
			$ses  = array();
			foreach($data as $key => $val) {
				$ses[$key] = $val;
			}
		}
		
		$session['PrintCV'] = $ses;

		$pilihan = $session['PrintCV'];
		$model = array();
		$pilihan['dataDiri'] = 1;
		$pilihan['pendidikanFormal'] = 1;
		$pilihan['pendidikanNonFormal'] = 1;
		$pilihan['organisasi'] = 1;
		$pilihan['bahasaAsing'] = 1;
		$pilihan['pengalamanKerja'] = 1;
		$pilihan['kelebihanDiri'] = 1;
		$pilihan['rekomendasi'] = 1;

		if($pilihan['dataDiri']==1) {
			$model['dataDiri'] = CcnJobseekerBio::model()->findByAttributes(array('swt_users_id' => $id));
		}		
		
		if($pilihan['pendidikanFormal']==1) {
			$model['pendidikanFormal'] = CcnJobseekerEdu::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}
		
		if($pilihan['pendidikanNonFormal']==1) {
			$model['pendidikanNonFormal'] = CcnJobseekerTraining::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		if($pilihan['organisasi']==1) {
			$model['organisasi'] = CcnJobseekerOrg::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		if($pilihan['bahasaAsing']==1) {
			$model['bahasaAsing'] = CcnJobseekerLang::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		if($pilihan['pengalamanKerja']==1) {
			$model['pengalamanKerja'] = CcnJobseekerExp::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		if($pilihan['kelebihanDiri']==1) {
			$model['kelebihanDiri'] = CcnJobseekerPositive::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		if($pilihan['rekomendasi'] == 1) {
			$model['rekomendasi'] = CcnJobseekerReference::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		// Seleksi pilihan template.
		$template = 'print_cv__001';
		$id = $_POST['template'];
		settype($id, 'integer');
		switch($id) {
			case 2:
				$template = 'print_cv__002';
				break;
			case 3:
				$template = 'print_cv__003';
				break;
		}

		$bahasaCV = null;
		if($_POST['bahasa']=='en') {
			$bahasaCV = 'en';
		}
		
		ob_start();
 		include(Yii::getPathOfAlias('webroot').'/media/cv_template/'.$template.'.php');
		$content = ob_get_clean();
		try
		{
			// initialisation de HTML2PDF
			$html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', array(0, 0, 0, 0));

			// affichage de la page en entier
			$html2pdf->pdf->SetDisplayMode('fullpage');

			// conversion
			$html2pdf->writeHTML($content, isset($_GET['vuehtml']));

			// envoie du PDF
			$html2pdf->Output($template.'.pdf');
		}
		catch(HTML2PDF_exception $e) { echo $e; }
	}
	

	/*// Print CV Online (Template 001).
	public function actionTemp001() {
		Yii::import('ext.html2pdf.HTML2PDF');
		Yii::import('ext.html2pdf._mypdf.MyPDF');	// classe mypdf
		Yii::import('ext.html2pdf.parsingHTML');	// classe de parsing HTML
		Yii::import('ext.html2pdf.styleHTML');		// classe de gestion des styles

		$session = new CHttpSession;
		if(!$session->isStarted) {
			$session->open();
		}
		if(isset($_POST['PrintCV'])) {
			$data = $_POST['PrintCV'];
			$ses  = array();
			foreach($data as $key => $val) {
				$ses[$key] = $val;
			}
		}
		$session['PrintCV'] = $ses;

		$pilihan = $session['PrintCV'];
		$model = array();
		$model['dataDiri'] = null;
		$model['pendidikanFormal'] = null;
		$model['pendidikanNonFormal'] = null;
		$model['organisasi'] = null;
		$model['bahasaAsing'] = null;
		$model['pengalamanKerja'] = null;
		$model['kelebihanDiri'] = null;
		$model['rekomendasi'] = null;

		if($pilihan['dataDiri']==1) {
			$model['dataDiri'] = CcnJobseekerBio::model()->findByAttributes(array('swt_users_id' => Yii::app()->user->id_user));
		}
		//echo $model['dataDiri']->complete_name;
		//echo Yii::app()->user->id_user;
		
		if($pilihan['pendidikanFormal']==1) {
			$model['pendidikanFormal'] = CcnJobseekerEdu::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => Yii::app()->user->id_user)));
		}
		
		if($pilihan['pendidikanNonFormal']==1) {
			$model['pendidikanNonFormal'] = CcnJobseekerTraining::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => Yii::app()->user->id_user)));
		}

		if($pilihan['organisasi']==1) {
			$model['organisasi'] = CcnJobseekerOrg::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => Yii::app()->user->id_user)));
		}

		if($pilihan['bahasaAsing']==1) {
			$model['bahasaAsing'] = CcnJobseekerLang::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => Yii::app()->user->id_user)));
		}

		if($pilihan['pengalamanKerja']==1) {
			$model['pengalamanKerja'] = CcnJobseekerExp::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => Yii::app()->user->id_user)));
		}

		if($pilihan['kelebihanDiri']==1) {
			$model['kelebihanDiri'] = CcnJobseekerPositive::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => Yii::app()->user->id_user)));
		}

		if($pilihan['rekomendasi'] == 1) {
			$model['rekomendasi'] = CcnJobseekerReference::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => Yii::app()->user->id_user)));
		}

		// Seleksi pilihan template.
		$template = 'print_cv__001';
		$id = $_POST['template'];
		settype($id, 'integer');
		switch($id) {
			case 2:
				$template = 'print_cv__002';
				break;
			case 3:
				$template = 'print_cv__003';
				break;
		}

		$bahasaCV = null;
		if($_POST['bahasa']=='en') {
			$bahasaCV = 'en';
		}
		
		ob_start();
 		include(Yii::getPathOfAlias('webroot').'/media/cv_template/'.$template.'.php');
		$content = ob_get_clean();
		try
		{
			// initialisation de HTML2PDF
			$html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', array(0, 0, 0, 0));

			// affichage de la page en entier
			$html2pdf->pdf->SetDisplayMode('fullpage');

			// conversion
			$html2pdf->writeHTML($content, isset($_GET['vuehtml']));

			// envoie du PDF
			$html2pdf->Output($template.'.pdf');
		}
		catch(HTML2PDF_exception $e) { echo $e; }
	}
	*/
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CcnUsers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pcr-users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * 
	 * @Upload Foto
	 */
	public function actionUploadFoto(){
		Yii::import('ext.phpThumb.PhpThumbFactory');
		$user = CcnUsers::model()->findByPk(Yii::app()->user->id_user);
		if($user->users_group_id == 4 OR $user->users_group_id == 5){
			$imagePath = YiiBase::getPathOfAlias('webroot').'/images/member_upload/jobseeker/small/';
			$imagePathMedium = YiiBase::getPathOfAlias('webroot').'/images/member_upload/jobseeker/medium/';
			$imagePathLarge = YiiBase::getPathOfAlias('webroot').'/images/member_upload/jobseeker/large/';
		}elseif($user->users_group_id == 6){
			$imagePath = YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/small/';
			$imagePathMedium = YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/medium/';
			$imagePathLarge = YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/large/';
		}
		
		$namaFile  = CUploadedFile::getInstanceByName('namaFile');
		
		//get type file and file name
		$type      = $namaFile->getExtensionName();
		$file = time().$namaFile->getName();
		
		$options = array('jpegQuality' => 90);
		$saveBanner = $namaFile->saveAs($imagePath.'/'.$file);
		@chmod($imagePath.'/'.$file, 0777);
		
		$thumb1 = PhpThumbFactory::create($imagePath.'/'.$file, $options);
		$thumb2 = PhpThumbFactory::create($imagePath.'/'.$file, $options);
		$thumb3 = PhpThumbFactory::create($imagePath.'/'.$file, $options);
		
		$thumb1->adaptiveResize(150, 300);
		$thumb1->save($imagePathLarge.'/large_'.$file);

		$thumb2->resize(100, 100);
		$thumb2->save($imagePathMedium.'/medium_'.$file);

		$thumb3->resize(62, 62);
		$thumb3->save($imagePath.'/small_'.$file);
		
		//delete old profile image
		if($user->photo != ''){
			//if($user->users_group_id == 4 OR $user->users_group_id == 5){
				@unlink($imagePathLarge.'/'.$user->photo);
				@unlink($imagePathMedium.'/'.$user->photo);
			//}
			@unlink($imagePath.'/'.$user->photo);
		}
		
		//delete original file
		@unlink($imagePath.'/'.$file);
		
		//update database
		$sql = 'UPDATE swt_users SET photo="'.$file.'" WHERE id = '.$user->id.';';
		Yii::app()->db->createCommand($sql)->execute();
		
		
		if($user->users_group_id == 4 OR $user->users_group_id == 5){
			$msg['image'] = Yii::app()->baseUrl.'/images/member_upload/jobseeker/large/large_'.$file;
		}elseif($user->users_group_id == 6){
			$msg['image'] = Yii::app()->baseUrl.'/images/member_upload/employer/large/large_'.$file;
		}
		
		echo CJSON::encode($msg);
	}
	
	
	

}
