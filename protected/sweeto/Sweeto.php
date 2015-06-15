<?php
/**
 * Sweeto class file
 *
 * Bootstrap application
 * in this class you set default controller to be executed first time
 *
 * @author Agus susilo <smartgdi@gmail.com>
 * @create date August 6, 2012 15:02 WIB
 * @updated August 6, 2012 15:02 WIB
 * @version 1.0
 * @copyright &copy; 2012 Swevel Media
 */

class Sweeto extends CApplicationComponent
{
	/**
	 * Initialize
	 *
	 * load some custom components here, for example
	 * theme, url manager, or config from database Alhamdulillah :)
	 */
	public function init() {
		$theme = $this->getDefaultTheme();
		if(isset($_GET['theme'])) {
			$theme = trim($_GET['theme']);
		}
		Yii::app()->theme = $theme;

		$rules = array(
			'adminsweeto' => 'adminsw370/login',
			'<controller:\w+>/view/<id:\d+>/<t:[\w\-]+>'		=> '<controller>/view',
			'<controller:\w+>/adminmanage'						=> '<controller>/adminmanage',
			'<controller:\w+>/adminadd'							=> '<controller>/adminadd',
			'<controller:\w+>/adminview/<id:\d+>'				=> '<controller>/adminview',
			'<controller:\w+>/adminedit/<id:\d+>'				=> '<controller>/adminedit',
			'<controller:\w+>/admindelete/<id:\d+>'				=> '<controller>/admindelete',
			
			//'<action>/<t:[\w\-]+>'			=> 'site/<action>',
			'<action:(contact|about)>/<t:[\w\-]+>' => 'site/<action>',
			'<action:(login)>' => 'site/login',
			'<action:(logout)>' => 'site/logout',
			'page/<view>'										=> array('site/page'),
			
			'content/<sid:\d+>/archive/<y:\d+>/<m:\d+>'	=> 'content/index',
			'content/<sid:\d+>/archive/<y:\d+>'	=> 'content/index',
			'content/all/<sid:\d+>/<t:[\w\-]+>'					=> 'content/index',
			'content/<cid:\d+>/<t:[\w\-]+>'						=> 'content/index',
			//'content/cid/<cid:\d+>/<t:[\w\-]+>'				=> 'content/adminadd',
			'vacancy/<t:[\w\-]+>'								=> 'vacancy/site/index',
			'test/<t:[\w\-]+>'								=> 'test/site/index',
			//'<controller:\w+>/<t>'							=>'<controller>/index',
			
			//'<controller:\w+>/<action:\w+>/<id:\d+>/<t:[\w\-]+>'	=> '<controller>/<action>',
			//'<controller:\w+>/<action:\w+>/<t>'					=>'<controller>/<action>',
			'modulemanager'											=> 'modulemanager',
			'thememanager'											=> 'thememanager',
			//'<controller:\w+>'									=> '<controller>/index',
			
			'<module:\w+>/<controller:\w+>/view/<id:\d+>/<t:[\w\-]+>'	=> '<module>/<controller>/view',
			'<module:\w+>/<controller:\w+>/adminmanage'				=> '<module>/<controller>/adminmanage',
			'<module:\w+>/<controller:\w+>/adminadd'				=> '<module>/<controller>/adminadd',
			'<module:\w+>/<controller:\w+>/adminedit/<id:\d+>'		=> '<module>/<controller>/adminedit',
			'<module:\w+>/<controller:\w+>/adminview/<id:\d+>'		=> '<module>/<controller>/adminview',
			'<module:\w+>/<controller:\w+>/admindelete/<id:\d+>'	=> '<module>/<controller>/admindelete',
			
			'<module:\w+>/<controller:\w+>/<action:\w+>/<t:[\w\-]+>'				=> '<module>/<controller>/<action>',
			'<module:\w+>/confirm/<t:[\w\-]+>'				=> '<module>/confirm/index',			
		);

		/**
		 * Set default controller for homepage, it can be controller, action or module
		 * example:
		 * controller: 'site'
		 * controller from module: 'pcr/default'.
		 */
		$rootRoute = Yii::app()->dbparams->default_site_controller;
		if(isset($rootRoute) && $rootRoute != '') {
			Yii::app()->defaultController = trim($rootRoute);
			$rules[''] = trim($rootRoute);

		}else
			$rules[''] = 'site/index';

		$module = ComModules::model()->findAllByAttributes(array('enabled' => 1), array(
			'select' => 'name',
		));

		/**
		 * Split rules into 2 part and then insert url from tabel between them.
		 * and then merge all array back to $rules.
		 */
		$moduleRules  = array();
		$sliceRules   = $this->getRulePos($rules);
		if($module !== null) {
			foreach($module as $key => $val) {
				$moduleRules[$val->name] = $val->name;
			}
		}
		$rules = array_merge($sliceRules['before'], $moduleRules, $sliceRules['after']);

		Yii::app()->setComponents(array(
			'urlManager' => array(
				'urlFormat' => 'path',
				'showScriptName' => false,
				'rules' => $rules,
			),
		));

		Yii::setPathOfAlias('modules', Yii::app()->basePath.DIRECTORY_SEPARATOR.'modules');
	}

	/**
	 * Get default theme from database
	 *
	 * @return string theme name
	 */
	public function getDefaultTheme() {
		$theme = Templates::model()->find(array(
			'condition' => 'default_theme= :theme AND group_page= :group_page',
			'params'    => array(':group_page' => 'public', ':theme' => '1'),
			'select'    => 'template',
			)
		);

		if($theme !== null)
			return $theme->template;
		else
			return null;
	}

	/**
	 * Load config from module
	 * such as db, module config etc.
	 */
	public function loadConfigFromModule() {
		Yii::import('ext.Spyc');
	}

	/**
	 * Split rules into two part
	 *
	 * @param array $rules
	 * @return array
	 */
	public function getRulePos($rules) {
		$result = 1;
		$before = array();
		$after  = array();

		foreach($rules as $key => $val) {
			if($key == '<controller:\w+>')
				break;
			$result++;
		}

		$i = 1;
		foreach($rules as $key => $val) {
			if($i < $result) {
				$before[$key] = $val;
			}elseif($i >= $pos) {
				$after[$key]  = $val;
			}
			$i++;
		}

		return array('after' => $after, 'before' => $before);
	}
}
