<?php

class EmployerController extends Controller
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
		$this->layout = 'front_employer';
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','adddata','account','profile', 'uploadlogo', 'notifier','jobseekerpdf'),
				'users'=>array('@'),
				'expression'=>'$user->id==6'
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
	public function actionIndex()
	{
		$this->render('front_index');
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView() {
		$this->layout = 'front_default';

		if(isset($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			$id = Yii::app()->user->id_user;
		}

		$model = CcnEmployerData::model()->find(array(
			'condition'=>'swt_users_id = :id',
			'params' =>array(':id' => $id)
		));
		$empData = $model->swt_users_id;
		
		$criteria=new CDbCriteria;
		$criteria->order = 'update_date DESC';
		$criteria->compare('publish', 1);
		//$criteria->compare('swt_users_id', $id);
		$criteria->condition = 'date(close_date) > :date AND swt_users_id = :id';
		$criteria->params = array(':date'=>date('Y-m-d'), ':id'=>$id);
		$dataProviderVacancy=new CActiveDataProvider('CcnEmployerVacancy',array(
			'criteria' => $criteria,
			'pagination' => array('pageSize'=>5)
		));
		
		$criteria1 = new CDbCriteria;
		$criteria1->order	 = 'update_date DESC';
		$criteria1->condition = 'close_date < CURDATE()';
		$criteria1->compare('publish', 1);
		$criteria1->compare('swt_users_id', $id);
		
		$dataProviderClosed = new CActiveDataProvider('CcnEmployerVacancy', array(
			'criteria'	=> $criteria1,
			'pagination'=> array('pageSize'=>5)
		));
		
		
		$criteria2=new CDbCriteria;
		$criteria2->order = 'tgl_update DESC';
		$criteria2->compare('swt_users_id', $empData);
		$dataProviderTest=new CActiveDataProvider('CcnTestCall',array(
			'criteria' => $criteria2,
			'pagination' => array('pageSize'=>5)
		));
		
		$this->render('front_view',array(
			'model'=>$model,
			'dataProviderVacancy'=>$dataProviderVacancy,
			'dataProviderClosed' => $dataProviderClosed,
			'dataProviderTest' =>$dataProviderTest,
		));	
	}

	public function actionAccount()
	{
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

	public function actionProfile()
	{
		$id = Yii::app()->user->id_user;
		$model=CcnEmployerData::model()->findByAttributes(array('swt_users_id'=>$id));
		if($model == null) {
			$model=new CcnEmployerData;
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CcnEmployerData']))
		{
			$model->attributes = $_POST['CcnEmployerData'];
			if(!isset($_GET['step'])) {
				$model->scenario = 'step1';
			} else {
				$model->scenario = 'step2';
			}

			if($model->save()) {
				if(!isset($_GET['step'])) {
					Yii::app()->user->setFlash('success', 'Informasi profil berhasil diperbaharui, silahkan melanjutkan melengkapi informasi kontak.');
					$this->redirect(array('profile','step'=>2));
				} else {
					Yii::app()->user->setFlash('success', 'Informasi kontak berhasil diperbarui.');
					$this->redirect(array('index'));
				}
			}
		}
		
		$this->pageTitle = 'Ubah Profil '.$model->name;
		$this->render('front_profile',array(
			'model'=>$model,
		));
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ccn-employer-data-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionUploadLogo() {
		$idEmployer = Yii::app()->user->id_user;
		$dataEmployer = CcnEmployerData::model()->findByAttributes(array('swt_users_id'=>$idEmployer));
		
		
		Yii::import('ext.phpThumb.PhpThumbFactory');
		
		//set image path
		$imagePath = YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/large/';
		$imagePathMedium = YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/medium/';
		$imagePathSmall = YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/small/';
		$namaFile  = CUploadedFile::getInstanceByName('namaFile');
		
		//get type file and file name
		$type      = $namaFile->getExtensionName();
		$file = time().$namaFile->getName();
		
		if($dataEmployer != null) {
			$dataEmployer->company_logo = $file;
			$dataEmployer->update();
		}else {
			$dataEmployer = new CcnEmployerData;
			$dataEmployer->scenario = 'step1';
			//name, company_desc, ccn_employer_industry_id, address, city_id, province_id, country_code, phone_no1
			$dataEmployer->setAttributes(array(
				'swt_users_id'=>Yii::app()->user->id_user,
				'name'=>' ',
				'company_desc'=>' ',
				'ccn_employer_industry_id'=>0,
				'address'=>' ',
				'city_id'=>0,
				'province_id'=>0,
				'country_code'=>'id',
				'phone_no1'=>0,
			));
			$dataEmployer->save();
		}
		
		
		if($dataEmployer != null){
			//delete old image
			@unlink($imagePath.'/large_'.$dataEmployer->company_logo);
			@unlink($imagePathMedium.'/medium_'.$dataEmployer->company_logo);
			@unlink($imagePathSmall.'/small_'.$dataEmployer->company_logo);
		}
	
		$options = array('jpegQuality' => 90);
		
		$saveBanner = $namaFile->saveAs($imagePath.'/'.$file);
		$saveBannerMedium = $namaFile->saveAs($imagePathMedium.'/'.$file);
		$saveBannerSmall = $namaFile->saveAs($imagePathSmall.'/'.$file);
		@chmod($imagePath.'/'.$file, 0777);
		@chmod($imagePathMedium.'/'.$file, 0777);
		@chmod($imagePathSmall.'/'.$file, 0777);
		
		//resize image
		$thumb = PhpThumbFactory::create($imagePath.'/'.$file, $options);
		$thumb->adaptiveResize(120, 120);
		$thumb->save($imagePath.'/large_'.$file);
		$thumb->adaptiveResize(100, 100);
		$thumb->save($imagePathMedium.'/medium_'.$file);
		$thumb->adaptiveResize(80, 80);
		$thumb->save($imagePathSmall.'/small_'.$file);
		
		//delete original image
		@unlink($imagePath.'/'.$file);
		
		//$msg['error'] = 1;
		//$msg['name'] = $file;
		$msg['image'] = Yii::app()->baseUrl.'/images/member_upload/employer/small/small_'.$file;
		
		echo CJSON::encode($msg);
	}
	
	public function actionNotifier(){
		$model = ComModules::model()->findAll(array(
			'condition'=>'subscribe_exist = 1 AND subscribe_active = 1',
		));
		$id = Yii::app()->user->id_user;
		if(isset($_POST['CcnSubscribeVacancyEmloyer'])){
			$cekSubscribeEmployer = CcnSubscribeVacancyEmployer::model()->findByAttributes(array('swt_users_id'=>Yii::app()->user->id_user));
			if($_POST['CcnSubscribeVacancyEmloyer']['enableSave'] == 1){
				
				if($cekSubscribeEmployer != null){
					$cekSubscribeEmployer->setAttributes(array(
						'swt_users_id'=>Yii::app()->user->id_user,
						'subscribe_vacancy_info'=>$_POST['CcnSubscribeVacancyEmloyer']['subscribe_vacancy_info'],
						'subscribe_send_recap'=>$_POST['CcnSubscribeVacancyEmloyer']['subscribe_send_recap'],
					));
					if($cekSubscribeEmployer->update()){
						Yii::app()->user->setFlash('success', 'Anda kini berlangganan email subscribe');
					}
				}else{	
					$modelSubscribeEmployer = new CcnSubscribeVacancyEmployer;
					$modelSubscribeEmployer->setAttributes(array(
						'swt_users_id'=>Yii::app()->user->id_user,
						'subscribe_vacancy_info'=>$_POST['CcnSubscribeVacancyEmloyer']['subscribe_vacancy_info'],
						'subscribe_send_recap'=>$_POST['CcnSubscribeVacancyEmloyer']['subscribe_send_recap'],
					));
					if($modelSubscribeEmployer->save()){
						Yii::app()->user->setFlash('success', 'Anda kini berlangganan email subscribe');
					}
				}
			}elseif($_POST['CcnSubscribeVacancyEmloyer']['enableSave'] == 0){
				if($cekSubscribeEmployer != null) {
					$cekSubscribeEmployer->delete();
					Yii::app()->user->setFlash('success', 'Anda telah berhenti berlangganan email subscribe');
				}
			}
		}
		$this->render('front_notifier', array(
			'model'=>$model,
			'id'=>$id,
		));
	}
	
	// Print CV Online (Template 001).
	public function actionJobseekerPdf($id) {
		$id= $_GET['id'];
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
		$pilihan['toefl'] = 1;

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
		
		if($pilihan['toefl'] == 1) {
			$model['toefl'] = CcnJobseekerToefl::model()->findAll(array(
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
			
			$user = CcnJobseekerBio::model()->findByAttributes(array('swt_users_id'=>$_GET['id']), array('select'=>'complete_name'));
			$i=0;
			$i++;
			// envoie du PDF
			$namefile = ''.$i.'_'.$user->complete_name.'_'.$_GET["vid"].'';
			$html2pdf->Output($namefile.'.pdf');
		}
		catch(HTML2PDF_exception $e) { echo $e; }
	}
	
}
