<?php
/* ContentsectionController* Handle ContentsectionController* Copyright (c) 2012, SWEVEL. All rights reserved.
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

class ContentsectionController extends /*SBaseController*/ Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout = 'admin';
	public $defaultAction = 'index';

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
		/* 	array('allow',  // allow all users to perform 'index' and 'view' actions
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
	public function actionIndex() {
		$this->redirect(array('adminmanage'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdminManage()	{
		$model=new ContentSection('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ContentSection'])) {
			$model->attributes=$_GET['ContentSection'];
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

		if(Yii::app()->user->id == 1) {
			$render = '/content_section/admin_manage';
		} else {
			$render = '/content_section/office_manage';
		}

		if(isset($_GET['type'])) {
			$message['data'] = $this->renderPartial($render,array(
				'model'=>$model,			
				'columns' => $columns,
			), true, false);
			echo CJSON::encode($message);

		} else {
			$this->render($render,array(
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
		$model=new ContentSection;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ContentSection'])) {
			$model->attributes=$_POST['ContentSection'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Konten section berhasil ditambahkan.'));
				$this->redirect(array('adminmanage'));				
			}
		}

		$this->render('/content_section/admin_add',array(
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

		if(isset($_POST['ContentSection'])) {
			$model->attributes=$_POST['ContentSection'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Konten section berhasil diperbarui.'));
				$this->redirect(array('adminmanage'));
			}
		}

		$this->render('/content_section/admin_edit',array(
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
			if(isset($id)) {
				$this->loadModel($id)->delete();

				echo CJSON::encode(array(
					'type' => 1,
					'id' => 'partial-content-section',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Konten section berhasil dihapus.').'</strong></div>',
				));
			}

		} else {
			$data = '<form action="'.Yii::app()->controller->createUrl('admindelete',array('id'=>$id)).'" method="post">';
			$data .= '<div class="dialog-header">'.Yii::t('', 'Hapus Content Section').'</div>';
			$data .= '<div class="dialog-content">';
			$data .= Yii::t('', 'Apakah anda yakin ingin menghapus item ini?');
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
		$model=ContentSection::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='content-section-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}