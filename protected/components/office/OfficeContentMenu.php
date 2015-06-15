<?php

class OfficeContentMenu extends CWidget
{

	public function run() {
		/*
		$currentAction	= strtolower($this->owner->id.'/'.$this->owner->action->id);
		$controller = strtolower($this->owner->id);
		$action     = strtolower($this->owner->action->id);
		$module     = strtolower($this->getController()->module->id);
		if($module !== null) {
			$controller = $module;
		}
		*/

		$module = strtolower(Yii::app()->controller->module->id);		
		$controller = strtolower(Yii::app()->controller->id);
		$action = strtolower(Yii::app()->controller->action->id);
		$currentAction = $module != null ? $module.'/'.$controller.'/'.$action : $controller.'/'.$action;
		
		$module = $module != null ? $module : '-'; 
		$model = SubMenuAdmin::model()->findAll(array(
			'condition' => 'group_type = :g AND module = :m AND controller = :c AND enabled = 1',
			'params' => array(':g' => 'back_office', ':m'=>$module, ':c'=>$controller),
			'order' => 'ordering'
		));
		
		
		$this->render('office_content_menu', array(
			'model'=>$model,
			'currentAction' => $currentAction, 
			'module' => $module == '-' ? null : $module, 
			'controller' => $controller, 
			'action' => $action
		));	
	}
}
