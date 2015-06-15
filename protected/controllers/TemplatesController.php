<?php
/* TemplatesController* Handle TemplatesController* Copyright (c) 2012, SWEVEL. All rights reserved.
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
*----------------------------------------------------------------------------------------------------------
*/

class TemplatesController extends SBaseController /* Controller */
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
	/* public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('adminadd','adminedit','adminmanage','admindelete'),
				'users'=>array('@'),
				'expression'=>'$user->id==1'
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	} */

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
	public function actionAdminManage()
	{
		$runtimePath = Yii::app()->runtimePath;

		// Upload and extract yii module
		if(isset($_FILES['file_name'])) {
			$fileName = CUploadedFile::getInstanceByName('file_name');

			if($fileName->type == 'application/zip' && $fileName->extensionName == 'zip') {
				if($fileName->saveAs($runtimePath.'/'.$fileName->name)) {
					$zip       = new ZipArchive;
					$zipFile   = $zip->open($runtimePath.'/'.$fileName->name);
					$extractTo = explode('.', $fileName->name);

					if($zipFile == true) {
						if($zip->extractTo(Yii::getPathOfAlias('webroot.themes'))) {
							@chmod(Yii::getPathOfAlias('webroot.themes').'/'.$extractTo[0]);
							Utility::chmodr(Yii::getPathOfAlias('webroot.themes').'/'.$extractTo[0], 0777);
							Yii::app()->user->setFlash('success', 'Themes sukses diextract.');
						}
						$zip->close();
					}

				}else
					Yii::app()->user->setFlash('error', 'Gagal menyimpan file.');

			}else
				Yii::app()->user->setFlash('error', 'Hanya file .zip yang dibolehkan.');
		}

		Yii::import('modules.thememanager.components.ThemeHandle');
		$themeHandle = ThemeHandle::getInstance();
		$themeHandle->installThemes();

		$model = new Templates('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Templates'])) {
			$model->attributes=$_GET['Templates'];
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
			$render = 'admin_manage';
		} else {
			$render = 'office_manage';
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
	public function actionAdminAdd()
	{
		$model=new Templates;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Templates'])) {
			$model->attributes=$_POST['Templates'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 1,
							'id' => 'partial-templates',
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Alumni berhasil ditambahkan.').'</strong></div>',
						));
					} else {
						print_r($model->getErrors());
					}
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

		if(isset($_POST['Templates'])) {
			$model->attributes=$_POST['Templates'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 1,
							'id' => 'partial-templates',
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Alumni berhasil diperbarui.').'</strong></div>',
						));
					} else {
						print_r($model->getErrors());
					}
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
	public function actionAdminDelete($id)
	{
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				$this->loadModel($id)->delete();

				echo CJSON::encode(array(
					'type' => 1,
					'id' => 'partial-templates',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Tema berhasil dihapus.').'</strong></div>',
				));
			}

		} else {
			$data = '<form action="'.Yii::app()->controller->createUrl('admindelete',array('id'=>$id)).'" method="post">';
			$data .= '<div class="dialog-header">'.Yii::t('', 'Hapus Tema').'</div>';
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
	public function loadModel($id)
	{
		$model=Templates::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='templates-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
