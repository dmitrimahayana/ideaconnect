<?php
/* HooksController* Handle HooksController* Copyright (c) 2012, SWEVEL. All rights reserved.
* version: 0.0.1
* Reference start
*
* TOC :
*	AdminManage
*	AdminAdd
*	AdminEdit
*	AdminView
*	AdminDelete
*   index
*   view
*	LoadModel
*	performAjaxValidation
*
*----------------------------------------------------------------------------------------------------------
*/

class HooksController extends /*SBaseController*/ Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='default';
	public $defaultAction = 'index';

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

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
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			/* array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			), */
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('adminadd','adminedit','adminmanage','admindelete'),
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
	public function actionIndex()
	{
		$this->redirect(array('adminmanage'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdminManage()	{
		$model=new Hooks('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Hooks'])) {
			$model->attributes=$_GET['Hooks'];
		}

		$columnTemp = array();
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn($columnTemp);

		if(isset($_GET['type'])) {
			$message['data'] = $this->renderPartial('admin_manage',array(
				'model'=>$model,			
				'columns' => $columns,
			), true, false);
			echo CJSON::encode($message);

		} else {
			$this->render('admin_manage',array(
				'model'=>$model,			
				'columns' => $columns,
			));
		}
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdminAdd() {
		$model=new Hooks;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Hooks'])) {
			$model->attributes=$_POST['Hooks'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if($model->save()) {
					echo CJSON::encode(array(
						'type' => 3,
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Hooks success created.').'</strong></div>',
						'get' => Yii::app()->controller->createUrl('adminmanage',array('type'=>'ajax'))
					));
				} else {
					print_r($model->getErrors());
				}
			}
			Yii::app()->end();

		} else {
			$message['data'] = $this->renderPartial('admin_add',array(
				'model'=>$model,
			), true, false);

			echo CJSON::encode($message);
		}
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

		if(isset($_POST['Hooks'])) {
			$model->attributes=$_POST['Hooks'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if($model->save()) {
					echo CJSON::encode(array(
						'type' => 3,
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Hooks success updated.').'</strong></div>',
						'get' => Yii::app()->controller->createUrl('adminmanage',array('type'=>'ajax'))
					));
				} else {
					print_r($model->getErrors());
				}
			}
			Yii::app()->end();

		} else {
			$message['data'] = $this->renderPartial('admin_edit',array(
				'model'=>$model,
			), true, false);

			echo CJSON::encode($message);
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionAdminDelete($id) {
		if(Yii::app()->request->isPostRequest) {
			try {
				// we only allow deletion via POST request
				$this->loadModel($id)->delete();
				if(!isset($_GET['ajax'])) {
					Yii::app()->user->setFlash('success', 'Hook sukses dihapus.');
				}else {
					echo '<div class="response-msg success ui-corner-all">Hook sukses dihapus.</div>';
				}

			}catch(CDbException $e) {
				if(!isset($_GET['ajax'])) {
					Yii::app()->user->setFlash('error','Hook gagal dihapus.');
				}else {
					echo '<div class="response-msg error ui-corner-all">Hook gagal dihapus.</div>';
				}
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Hooks success deleted.'));
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('adminmanage'));
			}
		}else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model=Hooks::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='hooks-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
