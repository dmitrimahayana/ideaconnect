<?php
class Adminsw370Controller extends /* SBaseController */  Controller
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
                Yii::app()->controller->id;
                
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
				'actions'=>array('index'),
				'users'=>array('@'),
				'expression'=>'$user->id==1'
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
		$this->render('/admin_sw370/index');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model=Block::model()->findByPk((int)$id);
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
		Yii::app()->theme = 'sweeto_classic';
		$this->layout = 'sweeto';

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
				if(Yii::app()->user->id != 1)
					$this->redirect(Yii::app()->createUrl('backoffic3/index'));
				else
					$this->redirect(array('index'));
			}
		}

		// display the login form
		$this->render('/admin_sw370/login', array('model'=>$model));
	}


	// Log admin out
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->dbparams->home_url);
	}

	/**
	 * Redirect admin when has authenticated. so admin doesn't need to login again uhhh
	 *
	 * @return void
	 */
	private function redirectWhenLoggedIn() {
		$action = $this->defaultAction;
		if($this->getAction()->id != '') {
			$action = strtolower(trim($this->getAction()->id));
		}

		if($action == 'login') {
			if(!Yii::app()->user->isGuest) {
				$this->redirect(array('index'));
			}
		}
	}
}
