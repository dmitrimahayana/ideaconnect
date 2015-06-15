<?php
/* GroupadminController* Handle GroupadminController* Copyright (c) 2012, SWEVEL. All rights reserved.
* version: 0.0.1
* Reference start
*
* TOC :
*	Index
*	View
*	AdminManage
*	AdminAdd
*	AdminEdit
*	AdminView
*	AdminDelete
*	LoadModel
*	performAjaxValidation
*
* ----------------------------------------------------------------------------------------------------------
*/

class GroupadminController extends SBaseController /* Controller */
 {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $defaultAction = 'index';

	/**
	 * Initialize admin page theme
	 */
	public function init() {
		if(!Yii::app()->user->isGuest) {
			$groupPage = Yii::app()->user->id == 1 ? 'admin_sweeto' : 'back_office';
			$arrThemes = Utility::getCurrentTemplate($groupPage);
			Yii::app()->theme = $arrThemes['template'];
			$this->layout = $arrThemes['layout'];
		}
		/* $arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		$this->layout = $arrThemes['layout']; */
	}	

	/**
	 * @return array action filters
	 */
	/* public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	} */

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/* public function accessRules() {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('adminmanage','adminadd','adminedit','admindelete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	} */
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() {

		$this->redirect(array('adminmanage'));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdminManage() {
		$model=new CcnGroupAdmin('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CcnGroupAdmin'])) {
			$model->attributes=$_GET['CcnGroupAdmin'];
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
			$message['data'] = $this->renderPartial('/group_admin/admin_manage',array(
				'model'=>$model,
				'columns' => $columns,
			), true, false);
			echo CJSON::encode($message);

		} else {
			$this->render('/group_admin/admin_manage',array(
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
		$model=new CcnGroupAdmin;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnGroupAdmin'])) {
			$model->attributes=$_POST['CcnGroupAdmin'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				//if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					//echo 'save';
					if($model->save()) {
						Yii::app()->user->setFlash('success', Yii::t('', 'Grup Admin berhasil ditambahkan.'));
						$this->redirect(array('adminmanage'));
					}
				//}
			}
		}
		
		$this->render('/group_admin/admin_add',array(
				'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAdminEdit($id) {
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnGroupAdmin'])) {
			$model->attributes=$_POST['CcnGroupAdmin'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('', 'Grup Admin berhasil diperbarui.'));
					$this->redirect(array('adminmanage'));
				}
			}
			//Yii::app()->end();

		}
		$this->render('/group_admin/admin_edit',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionAdminDelete($id) {
		$model = $this->loadModel($id);
		$name = $model->name;
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				$model->delete();

				echo CJSON::encode(array(
					'type' => 1,
					'id' => 'partial-ccn-group-admin',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Grup admin berhasil dihapus.').'</strong></div>',
				));
			}

		}else {
			$data = '<form action="'.Yii::app()->controller->createUrl('admindelete',array('id'=>$id)).'" method="post">';
			$data .= '<div class="dialog-header">'.Yii::t('', 'Hapus Grup Admin').'</div>';
			$data .= '<div class="dialog-content">';
			if($id == '2') {
				$data .= Yii::t('', 'Maaf, Group '.$name.' tidak bisa dihapus.');		
			} else {
				$data .= Yii::t('', 'Apakah anda yakin ingin menghapus item ini?');			
			}			
			$data .= '</div>';
			$data .= '<div class="dialog-submit">';
			$data .= '<input type="submit" value="'.Yii::t('', 'Hapus').'" />';
			$data .= '<input id="closed" type="button" value="'.Yii::t('', 'Keluar').'" />';
			$data .= '</div>';
			$data .= '</form>';

			$result['data'] = $data;
			echo CJSON::encode($result);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model=CcnGroupAdmin::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='ccn-group-admin-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
