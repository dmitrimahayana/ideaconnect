<?php
/* ModulesController* Handle ModulesController* Copyright (c) 2012, SWEVEL. All rights reserved.
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

class ModulesController extends SBaseController /* Controller */
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout = 'admin';
	public $moduleHandle;
	public $defaultAction = 'index';

	/**
	 * Initialize
	 */
 	public function init() {
		if(!Yii::app()->user->isGuest) {
			$groupPage = Yii::app()->user->id == 1 ? 'admin_sweeto' : 'back_office';
			$arrThemes = Utility::getCurrentTemplate($groupPage);
			Yii::app()->theme = $arrThemes['template'];
			$this->layout = $arrThemes['layout'];
		}

		$this->moduleHandle = Yii::app()->moduleHandle;
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
				'actions' => array('index'),
				'users' => array('*'),
			), 
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('adminadd','adminedit','adminmanage','admindelete',
					'admininstall', 'adminuninstall'),
				'users'=>array('@'),
				'expression'=>'$user->id==1 || $user->id==2 '
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
					$zip        = new ZipArchive;
					$zipFile    = $zip->open($runtimePath.'/'.$fileName->name);
					$extractTo  = explode('.', $fileName->name);
					@chmod($runtimePath.'/'.$fileName->name, 0777);

					if($zipFile == true) {
						if($zip->extractTo(Yii::getPathOfAlias('application.modules'))) {
							Utility::chmodr(Yii::getPathOfAlias('application.modules').'/'.$extractTo[0], 0777);
							Yii::app()->user->setFlash('success', 'Module sukses diextract.');
						}
						$zip->close();
						Utility::recursiveDelete($runtimePath.'/'.$fileName->name);
					}

				}else
					Yii::app()->user->setFlash('error', 'Gagal menyimpan file.');

			}else
				Yii::app()->user->setFlash('error', 'Hanya file .zip yang dibolehkan.');
		}

		$this->updateModule();
		$model = new ComModules('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ComModules'])) {
			$model->attributes=$_GET['ComModules'];
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
		$model=new ComModules;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ComModules'])) {
			$model->attributes=$_POST['ComModules'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if($model->save()) {
					echo CJSON::encode(array(
						'type' => 1,
						'id' => 'partial-com-modules',
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Module berhasil ditambahkan.').'</strong></div>',
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

		if(isset($_POST['ComModules'])) {
			$model->attributes=$_POST['ComModules'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if($model->save()) {
					echo CJSON::encode(array(
						'type' => 1,
						'id' => 'partial-com-modules',
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Module berhasil diperbarui.').'</strong></div>',
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
	public function actionAdminDelete($id)
	{
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				$model      = $this->loadModel($id);
				$modulePath = Yii::getPathOfAlias('modules.'.trim($model->name));

				if($this->loadModel($id)->delete()) {
					Yii::app()->moduleHandle->deleteModule($modulePath);
				}

				echo CJSON::encode(array(
					'type' => 1,
					'id' => 'partial-com-modules',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Module berhasil dihapus.').'</strong></div>',
				));
			}

		} else {
			$data = '<form action="'.Yii::app()->controller->createUrl('admindelete',array('id'=>$id)).'" method="post">';
			$data .= '<div class="dialog-header">'.Yii::t('', 'Hapus Module').'</div>';
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
	 * Install module
	 */
	public function actionAdminInstall()
	{
		$moduleHandle = Yii::app()->moduleHandle;
		$model        = ComModules::model()->find(array(
			'condition' => 'id = :id AND enabled=0',
			'params' => array(
				':id' => trim($_GET['id']),
			),
		));

		if($model !== null) {
			$model->enabled = 1;
			if($model->save(false, array('enabled'))) {
				Yii::app()->moduleHandle->installTable($model->name);

				$module = array();
				$mod    = ComModules::model()->findAllByAttributes(array('enabled' => 1));
				foreach($mod as $val) {
					$module[] = $val->name;
				}
				$moduleHandle->updateModuleFile();
				// Register all widgets
				$model->name = trim($model->name);
					ComModules::model()->registerWidget(Yii::getPathOfAlias('application.modules.'.
						$model->name)."/{$model->name}.yaml");

				Yii::app()->user->setFlash('success', 'Module sukses diinstall');

			}else {
				Yii::app()->user->setFlash('error', 'Module gagal diinstall');
			}
		}
		$this->redirect(array('adminmanage'));
	}

	/**
	 * Uninstall module
	 */
	public function actionAdminUninstall()
	{
		$moduleHandle = Yii::app()->moduleHandle;
		$model        = ComModules::model()->findByPk($_GET['id']);

		if($model !== null) {
			$model->enabled = 0;
			if($model->save(false, array('enabled'))) {
				$config    = Yii::app()->moduleHandle->getModuleConfig($model->name);
				$tableName = trim($config['table_name']);
				if(count($config) > 0) {
					if($tableName != '') {
						Yii::app()->db->createCommand("DROP TABLE {$tableName}")->execute();
					}
				}

				$module = array();
				$mod    = ComModules::model()->findAllByAttributes(array('enabled' => 1));
				foreach($mod as $val) {
					$module[] = $val->name;
				}
				$moduleHandle->updateModuleFile();

				Yii::app()->user->setFlash('success', 'Module sukses diuninstall');
			}else {
				Yii::app()->user->setFlash('error', 'Module gagal diuninstall');
			}

		}else {
			Yii::app()->user->setFlash('error', 'Module tidak ada didatabase.');
		}
		$this->redirect(array('adminmanage'));
	}

	/**
	 * Cache module, update and install to file
	 */
	public function updateModule($deleted=false)
	{
		$this->moduleHandle->cacheModuleToFile();
		if(!$deleted) {
			$this->moduleHandle->installToFile();
			$this->moduleHandle->installKeTabel();
		}
		$this->moduleHandle->updateModuleFile();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model=ComModules::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='com-modules-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
