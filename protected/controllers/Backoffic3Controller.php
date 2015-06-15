<?php

class Backoffic3Controller extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $defaultAction = 'login';

	/**
	 * Initialize admin template
	 */
	public function init() {
		if(!Yii::app()->user->isGuest) {
			$groupPage = Yii::app()->user->id == 1 ? 'admin_sweeto' : 'back_office';
			$arrThemes = Utility::getCurrentTemplate($groupPage);
			Yii::app()->theme = $arrThemes['template'];
			$this->layout = $arrThemes['layout'];
		}
	}
	
	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login', 'logout'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'AjaxUploadFotoProfile'),
				'users'=>array('@'),
				'expression'=>'$user->id != 4 || $user->id != 5 || $user->id != 6'
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
		if(Yii::app()->user->isGuest) {
			$this->redirect(array('login'));
		}
		$this->render('/back_offic3/index'
		);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)	{
		$model=Block::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='block-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		Yii::app()->theme = 'office_classic';
		$this->layout = 'admin_default';
		
		if(!Yii::app()->user->isGuest) {
			$this->redirect(array('index'));
		}
			
		$model=new AdminLoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['AdminLoginForm'])) {
			$model->attributes=$_POST['AdminLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
				Yii::app()->session['current_login_group_page'] = 'admin';
				/* if(Yii::app()->user->id == 1)
					$this->redirect(Yii::app()->createUrl('adminsw370/index'));
				else	 */			
					$this->redirect(array('index'));
			}
		}
		
		// display the login form
		$this->render('/back_offic3/login', array('model'=>$model));
	}
	
	

	// Log admin out
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(array('site/index'));
	}
	
	// Upload admin picture profile
	public function actionAjaxUploadFotoProfile() {
		Yii::import('ext.phpThumb.PhpThumbFactory');		
		$imagePath = YiiBase::getPathOfAlias('webroot.images.admin.profile').'/';
		$namaFile  = CUploadedFile::getInstanceByName('namaFile');
		$admin     = Users::model()->findByPk($_GET['id']);
		
		$type     = $namaFile->getExtensionName();
		$namaUser = $admin->username;
		$img      = "$imagePath$namaUser.$type";
		$imageName = "$namaUser.$type";
		
		$saveTo   = $img;
		if($type != 'png') {
			$saveTo = "$imagePath$namaUser.png";
		}
		
		$msg          = array();
		$msg['error'] = 0;
		@chmod(YiiBase::getPathOfAlias('webroot.images.admin.profile'), 0777);
		
		// Cek ukuran file max 500 kb
		$ukuranFile       = $namaFile->getSize();
		$ukuranDalamKbyte = 0;		
		$isImageOverSize  = 0;
		if($ukuranFile > 1024) {
			$temp = 0;
			$ukuranDalamKbyte = $ukuranFile/1024;
			if($ukuranDalamKbyte > 500) {
				$temp = $ukuranDalamKbyte;
				$ukuranDalamKbyte = $temp;
				$isImageOverSize = 1;
			}
			
		}else {
			$ukuranDalamKbyte = $ukuranFile;
		}
		
		if($isImageOverSize == 0) {
			if($namaFile->saveAs("$imagePath$namaUser.$type", true)) {
				$imageName = "$namaUser.$type";
				
				if($type != 'png') {
					$imageName = "$namaUser.png";
				}
				$options = array('jpegQuality' => 90);
				
				$thumb = PhpThumbFactory::create($img, $options);
				$thumb->resizeUp = false;
				$thumb->resize(145);
				$thumb->save($saveTo, 'png');
				
				$admin = Users::model()->findByPk(Yii::app()->user->id_user);
				if($admin !== null) {
					if(strtoupper($type) == 'JPG') {
						@unlink($img);
					}
					$admin->photo = $imageName;
					$admin->save(false, array('photo'));
					@chmod($saveTo, 0777);
				}
				
				$key        = md5(uniqid(mt_rand(), true));
				$imgFile    = Yii::app()->request->baseUrl . "/images/admin/profile/$namaUser.png?key=$key";
				$msg['msg'] = $imgFile;
			}
			
		}else {
			$msg['error'] = 1;
			$msg['msg']   = 'Ukuran gambar terlalu besar. Maksimal ukuran 500kb.';
		}
		echo CJSON::encode($msg);
	}
	
	public function actionTes() {
	}
}
