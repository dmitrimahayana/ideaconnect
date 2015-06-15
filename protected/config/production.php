<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Idea Connect',
	'theme' => 'light',
	'language' => 'id',

//	'defaultController' => 'home',

	// Language setting
	'behaviors' => array('AppConfigBehavior'),

	// preloading 'log' component
	'preload'=>array('log', 'sweeto'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.admin.*',
		'application.components.backoffice.*',
		'application.components.public.*',
		'application.components.office.*',
		'application.components.system.*',

		// Platform model
		'application.models.swt.*',
		'application.modules.modulemanager.models.*',
		'application.modules.srbac.models.*',

		// Extra model and components
		'application.modules.srbac.controllers.SBaseController',
	),

/* 	'controllerMap' => array(
		'usersgroup' => 'application.controllers.platform.UsersgroupController',
		'users' => 'application.controllers.platform.UsersController',
	),  */

	// application components
	'components' => array(
		'sweeto' => array(
			'class' => 'application.sweeto.Sweeto',
		),

		'clientScript' => array(
			'coreScriptPosition' => CClientScript::POS_END,
		),
		// Smarty Renderers
		/*
		'viewRenderer'=>array(
			'class'=>'application.extensions.renderers.smarty.ESmartyViewRenderer',
			'fileExtension' => '.tpl',
		),
		*/
		'moduleHandle' => array(
			'class'=>'application.modules.modulemanager.components.ModuleHandle'
		),
		// SRBAC
		'authManager'=>array(
			'class'=>'application.modules.srbac.components.SDbAuthManager',
			'connectionID'=>'db',
			'itemTable'=>'swt_srbac_items',
			'assignmentTable'=>'swt_srbac_assignments',
			'itemChildTable'=>'swt_srbac_itemchildren',
        ),

		// DbParams/ Options
		'dbparams'=>array(
			'class' => 'application.extensions.dbparam.XDbParam',
			'connectionID' => 'db'
		),

		'user'=>array(
			// enable cookie-based authentication
			//'class' => 'EWebUser',
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
				'' => 'site/index',
				//'<controller:\w+>/<action:\w+>'=>'<controller>/contact',
				'<controller:\w+>/<id:\d+>/<title>'=>'<controller>/view',
				//'<controller:\w+>/<title>'=>'<controller>/index',
				'<controller:\w+>/<action:\w+>/<title>'=>'<controller>/<action>',
				//'<controller:\w+>/<action:\w+>/<title>'=>'<controller>/<action>',
				'<controller:\w+>' => '<controller>/index',
			),
		),
		*/

		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=201207_db_sweeto',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'tablePrefix'=>'',
			'charset' => 'utf8',
		),
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=yiicms',
			'emulatePrepare' => true,
			'username' => 'yiicms',
			'password' => '#makanmakan',
			'tablePrefix'=>'',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			//'class'=>'application.modules.cms.components.CmsHandler',
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	/*
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'primaryLang' => 'id',
		'translateLangs' => array(
			'en' => 'en',
			'id' => 'id',
			'fr' => 'fr',
		),
	),
	*/
);
