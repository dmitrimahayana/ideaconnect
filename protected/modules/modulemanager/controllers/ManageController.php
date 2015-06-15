<?php
/**
 * DefaultController file.
 *
 * @author Agus susilo <smartgdi@gmail.com>
 * @link http://www.swevel.com/
 * @copyright Copyright &copy; 2010-2011 Swevel Media
 * @version 1.0
 */
 
class ManageController extends SBaseController
{
	public $defaultAction = 'adminmanage';
	public $moduleHandle;
	
	/**
	 * Display manage modul.
	 */
	public function actionAdminManage() {
		echo 'test';
		$dataProvider = new CActiveDataProvider('Modules', array(
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
		$theme = Yii::app()->theme->name;
		Yii::app()->theme = $theme;
		
		$this->moduleHandle = Yii::app()->moduleHandle;
		$moduleInDir     = $this->moduleHandle->getModulesDirOnDisk();
		$totalModuleInDb = $this->moduleHandle->getTotalModuleFromDb();
		
		$this->moduleHandle->cacheModuleToFile();
		$this->moduleHandle->installToFile();
		$this->moduleHandle->installKeTabel();
		$this->moduleHandle->updateModuleFile();
		
		$themePath = Yii::getPathOfAlias('webroot.themes.'.$theme.'.views.layouts');
		$this->module->setLayoutPath($themePath);
		$this->layout = 'admin';
	}
	
	/**
	 * Install module
	 */
	public function actionInstall() {
		$moduleHandle = Yii::app()->moduleHandle;
		$model = Modules::model()->find(array(
			'condition' => 'id = :id AND enabled=0',
			'params' => array(
				':id' => trim($_GET['id']),
			),
		));
		
		if($model !== null) {
			$model->enabled = 1;
			if($model->save(false, array('enabled'))) {
				$module = array();
				$mod = Modules::model()->findAllByAttributes(array('enabled' => 1));
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
	 * Install module
	 */
	public function actionUninstall() {
		$moduleHandle = Yii::app()->moduleHandle;
		$model = Modules::model()->findByPk($_GET['id']);
				
		if($model !== null) {
			$model->enabled = 0;
			if($model->save(false, array('enabled'))) {
				$module = array();
				$mod = Modules::model()->findAllByAttributes(array('enabled' => 1));
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
}
