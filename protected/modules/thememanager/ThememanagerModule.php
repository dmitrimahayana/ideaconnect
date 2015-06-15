<?php

class ThememanagerModule extends EWebModule
{
	public function init()
	{
		$this->description = 'thememanager description';
		$this->publishAssets();
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'thememanager.models.*',
			'thememanager.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			$publicControllers = array(
				//'site',
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
	
	/**
	 * Publish assets
	 */
	private function publishAssets() {
		$baseScriptUrl = Yii::app()->getAssetManager()->publish(
		Yii::getPathOfAlias('application.modules.'.$this->id.'.assets')).'/jfancybox';

		$jsFancybox  = $baseScriptUrl.'/jquery.fancybox.pack.js?v=2.0.1';
		$cssFancybox = $baseScriptUrl.'/jquery.fancybox.css?v=2.0.1';
		
		// Optionaly include easing and/or mousewheel plugins
		$jsEase  = $baseScriptUrl.'/jquery.easing-1.3.pack.js';
		$jsMouse = $baseScriptUrl.'/jquery.mousewheel-3.0.6.pack.js';
		
		$cssThumb = $baseScriptUrl.'/helpers/jquery.fancybox-thumbs.css?v=2.0.1';
		$jsThumb  = $baseScriptUrl.'/helpers/jquery.fancybox-thumbs.js?v=2.0.1';
		
		$cs = Yii::app()->getClientScript();
		$cs->coreScriptPosition = CClientScript::POS_END;
		$cs->registerCoreScript('jquery');
		
		$cs->registerScriptFile($jsEase, CClientScript::POS_END);
		$cs->registerScriptFile($jsMouse, CClientScript::POS_END);
		
		$cs->registerScriptFile($jsFancybox, CClientScript::POS_END);
		$cs->registerCssFile($cssFancybox, 'screen');
	}
}
