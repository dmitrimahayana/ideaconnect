<?php

class ProjectModule extends CWebModule
{
	public $defaultController = 'site';

	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		
		// import the module-level models and components
		$this->setImport(array(
			'project.models.*',
			'project.components.*',
            'funding.models.*',
            'account.models.*',
            'location.models.*',
		));
	}

	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			
			//list public controller in this module
			$publicControllers = array(
				'site'
			);
			$currentAction = strtolower(Yii::app()->controller->id);
			
			/* if controller action have two auth (public, admin), uncomment this 
			//list public controller action
			$publicControllers = array(
				//'site/action'
			);
			$currentAction = strtolower(Yii::app()->controller->id.'/'.$action->id);
			*/
			
			
			// pake ini untuk set theme per action di controller..
			if(!in_array($currentAction, $publicControllers) && !Yii::app()->user->isGuest) {
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
