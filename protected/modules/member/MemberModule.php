<?php

class MemberModule extends EWebModule
{
	public function init()
	{
		parent::init();
		$this->description = '';

		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'member.models.*',
			'member.components.*',
//			'college.models.*',
//			'statistic.models.*',
//			'alumni.models.*',
//			'vacancy.models.CcnJobseekerApply',
//			'vacancy.models.CcnEmployerVacancy',
//			'vacancy.models.CcnFunctionVacancy',
			'member.controllers.AdminController',
			'member.controllers.AdminbackofficeController',
//			'test.models.*',
//			'finance.models.CcnPayment'
		));

	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			$publicControllers = array(
				'register',
				'jobseeker',
				'employer',
				'biodata',
				'education',
				'experience',
				'language',
				'organization',
				'skill',
				'toefl',
				'training',
				'award',
				'positive',
				'reference',
				'award',
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
