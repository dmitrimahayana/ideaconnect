<?php

class SiteController extends Controller {

    public function init() {
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		$this->layout = $arrThemes['layout'];
    }

    public function actionIndex() {
		$this->layout = 'front_sidebar';

		$this->pageTitle = '';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_index');
	}

    public function actionView() {
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->createUrl('project');
		$this->layout = 'front_project_sidebar';

		$this->pageTitle = '';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_view');
	}
	
    public function actionProgress() {
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->createUrl('project');
		$this->layout = 'front_project_sidebar';

		$this->pageTitle = '';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_progress');
	}

    public function actionSponsor() {
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->createUrl('project');
		$this->layout = 'front_project_sidebar';

		$this->pageTitle = '';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_sponsor');
	}
	
	 public function actionComment() {
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->createUrl('project');
		$this->layout = 'front_project_sidebar';

		$this->pageTitle = '';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_comment');
	}
	
}