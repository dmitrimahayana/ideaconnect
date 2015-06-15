<?php

class OfficeMainMenu extends CWidget
{

	public function init() {
	}

	public function run() {
		$this->renderContent();
	}

	protected function renderContent() {
		$controller = strtolower($this->owner->id);
		$action     = strtolower($this->owner->action->id);
		$module     = strtolower($this->getController()->module->id);
		
		$arrMenuAuth = array();
		$menuAuth = MenuAuth::model()->findAllByAttributes(array('swt_users_group_id'=>Yii::app()->user->id), 
		array('select'=>'swt_menu_id'));
		if($menuAuth != null) {
			foreach($menuAuth as $val) {
				$arrMenuAuth[] = $val->swt_menu_id;
			}
		}
		$listMenuId = implode(',', $arrMenuAuth);
	    if(count($listMenuId)>0){
		$menus = Menu::model()->findAll(array(
			'select' => 'id, name, in_use, module, controller, action, attr_url, url, alias_url, com_modules_id, dest_type, icon',
			'condition' => 'id IN ('.$listMenuId.') AND published = 1 AND menu_type = :type AND parent = 0',
			'params' => array(':type' => 'b_main_menu'),
			'order' => 'ordering',
		));
        }
        else {
            $menus=null;
        }
		$this->render('office_main_menu', array(
			'menus' => $menus,
			'controller' => $controller,
			'module' => $module,
			'action' => $action,
			'listMenuId' => $listMenuId,
		));
	}
}
?>
