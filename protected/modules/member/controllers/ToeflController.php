<?php

class ToeflController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	//public $layout='admin';
	public $defaultAction = 'index';

	/**
	 * Initialize
	 */
	public function init() {
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		//$this->layout = $arrThemes['layout'];
		$this->layout = 'front_jobseeker_cv';
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
				'actions'=>array('index'),
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
	public function actionIndex()
	{
		$model= CcnJobseekerToefl::model()->findByAttributes(array('swt_users_id' => Yii::app()->user->id_user));
		if($model == null) {
			$model=new CcnJobseekerToefl;
		}

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnJobseekerToefl']))
		{
			$model->attributes=$_POST['CcnJobseekerToefl'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
                            if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
				if($model->save()) {
					echo CJSON::encode(array(
						'type' => 0,
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'TOEFL/IELTS berhasil diubah.').'</strong></div>',
					));
				} else {
					print_r($model->getErrors());
				}
                            }
			}
			Yii::app()->end();

		} else {
			$this->render('front_index',array(
				'model'=>$model,
			));

		}

	}
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CcnJobseekerToefl::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ccn-jobseeker-toefl-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
