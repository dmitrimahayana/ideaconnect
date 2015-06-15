<?php

class SweetoAdminUser extends CWidget
{

	public function init() {
	}

	public function run() {
		$this->renderContent();
	}

	protected function renderContent() {
		$admin = Users::model()->findByPk(Yii::app()->user->id_user);
		$this->render('sweeto_admin_user',array("admin"=>$admin));
	}
}
?>
