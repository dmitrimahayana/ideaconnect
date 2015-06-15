<?php
/**
 * Should be parent all of module.
 */

Yii::import('ext.Spyc');

class EWebModule extends CWebModule
{
	public $description  = 'Module description';
	public $active       = 0;
	public $defaultHook  = 0;
	/**
	 * @var array collection of module config from module folder
	 */
	public $moduleConfig = array();

	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) {
			$mhandle = Yii::app()->moduleHandle;
			if(!in_array($this->id, $mhandle->getIgnoreModule())) {
				if($mhandle->isModuleActived($this->id))
					return true;
				else
					throw new CHttpException(400,Yii::t('yii','Your request is not valid.'));
			}else
				return true;

		}else
			return false;
	}

	/**
	 * Load module config on module current folder
	 * Child module should have init with parent::init() on top
	 */
	protected function init() {
		$configPath = Yii::getPathOfAlias('modules.'.$this->id).DIRECTORY_SEPARATOR.$this->id.'.yaml';
		if(file_exists($configPath)) {
			$this->moduleConfig = Spyc::YAMLLoad($configPath);
		}
		parent::init();
	}
}
