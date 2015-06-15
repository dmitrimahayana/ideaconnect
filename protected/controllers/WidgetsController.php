<?php
/**
 * WidgetsController
 *
 * Handle WidgetsController
 * Copyright (c) 2012, SWEVEL. All rights reserved.
 * version: 0.0.1
 * Reference start
 *
 * TOC :
 *	AdminManage
 *	AdminAdd
 *	AdminEdit
 *	AdminView
 *	AdminDelete
 *  index
 *  view
 *	LoadModel
 *  performAjaxValidation
 *----------------------------------------------------------------------------------------------------------
 */

class WidgetsController extends /*SBaseController*/ Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout = 'admin';
	public $defaultAction = 'adminmanage';

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
			/* array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','adminview','adminadd','adminedit','adminmanage','admindelete'),
				'users'=>array('*'),
			), */
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','adminview','adminadd','adminedit','adminmanage','admindelete'),
				'users'=>array('@'),
				'expression'=>'$user->id==1'
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAdminView($id) {
		$this->render('admin_view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdminAdd() {
		$model=new ComWidgets;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ComWidgets'])) {
			$model->attributes = $_POST['ComWidgets'];
			$model->file_name  = CUploadedFile::getInstance($model, 'file_name');
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'ComWidgets success created.'));
				$this->redirect(array('adminview','id'=>$model->id));
				//$this->redirect(array('adminmanage'));
			}
		}

		$this->render('admin_add',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAdminEdit($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ComWidgets'])) {
			$model->attributes=$_POST['ComWidgets'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'ComWidgets success created.'));
				$this->redirect(array('adminview','id'=>$model->id));
				//$this->redirect(array('adminmanage'));
			}
		}

		$this->render('admin_edit',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionAdminDelete($id) {
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				Yii::app()->user->setFlash('success', Yii::t('', 'ComWidgets success deleted.'));
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('adminmanage'));
			}
		}else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('adminmanage'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdminManage()	{
		$model=new ComWidgets('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ComWidgets']))
			$model->attributes=$_GET['ComWidgets'];

		$this->render('admin_manage',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model=ComWidgets::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='com-widgets-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
