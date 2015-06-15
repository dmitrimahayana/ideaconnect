<?php
/**
 * ModuleManager class file
 *
 * Handle all addon module that added to protected/modules folder
 *
 * @author Agus Susilo <smartgdi@gmail.com>
 * @version 1.5
 * @copyright &copy; 2012 Swevel Media
 */
class ModulemanagerModule extends EWebModule
{
	public function init() {
		parent::init();

		$this->description = 'Module manager';
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'modulemanager.models.*',
			'modulemanager.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			$publicControllers = array(
				//'site',
			);
			
			// pake ini untuk set theme per action di controller..
			// $currentAction = Yii::app()->controller->id.'/'.$action->id;
			if(!in_array(strtolower(Yii::app()->controller->id), $publicControllers) && !Yii::app()->user->isGuest) {
				$groupPage = Yii::app()->user->id == 1 ? 'admin_sweeto' : 'back_office';
				$arrThemes = Utility::getCurrentTemplate($groupPage);
				Yii::app()->theme = $arrThemes['template'];
				$this->layout = $arrThemes['layout'];
			}
			Utility::applyCurrentTheme($this);

			return true;
		}
		else
			return false;
	}
}
