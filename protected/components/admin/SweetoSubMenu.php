<?php

class SweetoSubMenu extends CWidget
{
	public function init() {
	}

	public function run() {
		$this->renderContent();
	}

	protected function renderContent() {
		/*
		$currentAction	= strtolower($this->owner->id.'/'.$this->owner->action->id);
		$controller		= strtolower($this->owner->id);
		$action			= strtolower($this->owner->action->id);
		$module			= strtolower($this->getController()->module->id);
		if($module !== null) {
			$controller = $module;
		}
		*/
		$module = strtolower(Yii::app()->controller->module->id);
		$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
		$controller = strtolower(Yii::app()->controller->id);
		$action = strtolower(Yii::app()->controller->action->id);

		if (in_array($controller, array('users','usersgroup','srbac'))) {
			$this->render('sweeto_sub_user', array(
				'currentAction' => $currentAction, 
				'controller' => $controller, 
				'action' => $action
			));

		} elseif (in_array($controller, array('menutypes','menu', 'submenuadmin'))) {
			//back office menu type
			$menuTypeBackOffice = MenuTypes::model()->findAll(array(
				'select' => 'id, menu_type, title',
				'condition' => "group_type = 'back_office'",
				'order' => 'title ASC',			
			));
			
			//public menu type
			$menuTypePublic = MenuTypes::model()->findAll(array(
				'select' => 'id, menu_type, title',
				'condition' => 'group_type = "public"',
				'order' => 'id ASC',			
			));

			$this->render('sweeto_sub_menus', array(
				'menuTypeBackOffice' => $menuTypeBackOffice, 
				'menuTypePublic' => $menuTypePublic, 
				'currentAction' => $currentAction, 
				'controller' => $controller, 
				'action' => $action
			));

		} elseif (in_array($controller, array('content','contentcategories','contentsection', 'contactdetail', 'contentfrontpage'))) {
			$this->render('sweeto_sub_content', array(
				'currentAction' => $currentAction, 
				'controller' => $controller, 
				'action' => $action
			));

		} elseif (in_array($controller, array('modules','hooks','widgets','extensions'))) {
			$this->render('sweeto_sub_module', array(
				'currentAction' => $currentAction, 
				'controller' => $controller, 
				'action' => $action
			));

		} elseif (in_array($controller, array('languages','msgtranslation','templates','globaloptions','weboption'))) {
			$this->render('sweeto_sub_setting', array(
				'currentAction' => $currentAction, 
				'controller' => $controller, 
				'action' => $action
			));

		} else {
			$this->render('sweeto_sub_menu', array('currentAction' => $currentAction, 'controller' => $controller, 'action' => $action));
		}
	}
}
?>
