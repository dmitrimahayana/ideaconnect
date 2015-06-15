<?php

class SiteController extends Controller {

    public function init() {
        if (!Yii::app()->user->isGuest) {
            $groupPage = Yii::app()->user->id == 1 ? 'admin_sweeto' : 'back_office';
            $arrThemes = Utility::getCurrentTemplate($groupPage);
            Yii::app()->theme = $arrThemes['template'];
            $this->layout = $arrThemes['layout'];
        }
    }

	public function actionIndex() {
		$this->render('index');
	}
}