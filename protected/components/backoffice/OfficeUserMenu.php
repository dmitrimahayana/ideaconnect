<?php

class OfficeUserMenu extends CWidget
{

	public function init() {
	}

	public function run() {
		$this->renderContent();
	}

	protected function renderContent() {
		$admin = Users::model()->findByPk(Yii::app()->user->id_user);
		$this->render('office_user_menu',array(
			"admin"=>$admin
		));
	}
}
?>
