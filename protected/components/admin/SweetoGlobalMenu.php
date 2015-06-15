<?php

class SweetoGlobalMenu extends CWidget
{
	public function init() {
	}

	public function run() {
		$this->renderContent();
	}

	protected function renderContent() {
		$module = strtolower(Yii::app()->controller->module->id);
		$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
		$controller = strtolower(Yii::app()->controller->id);
		$action = strtolower(Yii::app()->controller->action->id);

		$this->render('sweeto_global_menu', array(
			'currentAction' => $currentAction, 
			'controller' => $controller, 
			'action' => $action, 
			'module' => $module
		));
	}
}
?>
