<?php
/**
 * DefaultController file.
 *
 * @author Agus susilo <smartgdi@gmail.com>
 * @link http://www.swevel.com/
 * @copyright &copy; 2010-2011 Swevel Media
 * @version 1.0
 */

class DefaultController extends SBaseController
{
	public $layout           = 'admin';
	public $defaultAction    = 'adminmanage';
	public $moduleHandle;

	/**
	 * Cache module, update and install to file
	 */
	public function updateModule($deleted=false) {
		$this->moduleHandle->cacheModuleToFile();
		if(!$deleted) {
			$this->moduleHandle->installToFile();
			$this->moduleHandle->installKeTabel();
		}
		$this->moduleHandle->updateModuleFile();
	}

	/**
	 * Display manage modul.
	 */
	public function actionAdminManage() {
		$runtimePath = Yii::app()->runtimePath;
		$this->updateModule();

		// Upload and extract yii module
		if(isset($_FILES['file_name'])) {
			$fileName = CUploadedFile::getInstanceByName('file_name');

			if($fileName->type == 'application/zip' && $fileName->extensionName == 'zip') {
				if($fileName->saveAs($runtimePath.'/'.$fileName->name)) {
					$zip       = new ZipArchive;
					$zipFile   = $zip->open($runtimePath.'/'.$fileName->name);
					$extractTo = explode('.', $fileName->name);

					if($zipFile == true) {
						if($zip->extractTo(Yii::getPathOfAlias('application.modules'))) {
							@chmod(Yii::getPathOfAlias('application.modules').'/'.$extractTo, 0777);
							Yii::app()->user->setFlash('success', 'Module sukses diextract.');
						}

						$zip->close();
					}

				}else
					Yii::app()->user->setFlash('error', 'Gagal menyimpan file.');

			}else
				Yii::app()->user->setFlash('error', 'Hanya file .zip yang dibolehkan.');
		}

		$dataProvider = new CActiveDataProvider('ComModules', array(
			'pagination' => array(
				'pageSize' => 10,
			)
		));
		$this->render('admin_manage', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Initialize module.
	 */
	public function init() {
		Yii::app()->theme = Yii::app()->dbparams->sweeto_theme;
		Utility::applyCurrentTheme($this->module);

		$this->moduleHandle = Yii::app()->moduleHandle;
		$moduleInDir     = $this->moduleHandle->getModulesDirOnDisk();
		$totalModuleInDb = $this->moduleHandle->getTotalModuleFromDb();
		if(Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->homeUrl);
		}
	}

	/**
	 * Install module
	 */
	public function actionInstall() {
		$moduleHandle = Yii::app()->moduleHandle;
		$model = ComModules::model()->find(array(
			'condition' => 'id = :id AND enabled=0',
			'params' => array(
				':id' => trim($_GET['id']),
			),
		));

		if($model !== null) {
			$model->enabled = 1;
			if($model->save(false, array('enabled'))) {
				$module = array();
				$mod = ComModules::model()->findAllByAttributes(array('enabled' => 1));
				foreach($mod as $val) {
					$module[] = $val->name;
				}
				$moduleHandle->updateModuleFile();

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
	public function actionUninstall() {
		$moduleHandle = Yii::app()->moduleHandle;
		$model        = ComModules::model()->findByPk($_GET['id']);

		if($model !== null) {
			$model->enabled = 0;
			if($model->save(false, array('enabled'))) {
				$module = array();
				$mod = ComModules::model()->findAllByAttributes(array('enabled' => 1));
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
	 * Delete module from db and folder module.
	 */
	public function actionDelete() {
		Yii::app()->session['delete_module'] = 1;
		$moduleHandle = Yii::app()->moduleHandle;
		$model        = ComModules::model()->findByPk($_GET['id']);

		if($model !== null) {
			@rmdir(Yii::getPathOfAlias('application.modules')."/{$model->name}");
			if($model->delete()) {
				$moduleHandle->updateModuleFile();
				$this->updateModule(Yii::app()->session['delete_module']);
				Yii::app()->session->remove('delete_module');

				Yii::app()->user->setFlash('success', 'Module sukses diuninstall');

			}else {
				Yii::app()->user->setFlash('error', 'Module gagal diuninstall');
			}

		}else {
			Yii::app()->user->setFlash('error', 'Module tidak ada didatabase.');
		}
		$this->redirect(array('adminmanage'));
	}
}
