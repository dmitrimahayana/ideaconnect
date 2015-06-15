<?php
return array(
	'modules'=>array(
		'srbac'=>array(
			'userclass'            => 'UsersGroup', //default: User
			'userid'               => 'id', //default: userid
			'username'             => 'name', //default:username
			'delimeter'            => '-', //default:-
			'debug'                => false, //default :false
			'pageSize'             => 15, // default : 15
			'superUser'            => 'role_admin_sweeto', //default: Authorizer
			'css'                  => 'srbac.css', //default: srbac.css
			//'layout'             => 'application.views.layouts.main', //default: application.views.layouts.main,
			'notAuthorizedView'    => 'srbac.views.authitem.unauthorized', // default:
			'alwaysAllowed'        => array(),
			'userActions'          => array('Show','View','List'), //default: array()
			'listBoxNumberOfLines' => 15, //default : 10
			'imagesPath'           => 'srbac.images', // default: srbac.images
			'imagesPack'           => 'noia', //default: noia
			'iconText'             => true, // default : false
			'header'               => 'srbac.views.authitem.header', //default : srbac.views.authitem.header,
			//must be an existing alias
			'footer'               => 'srbac.views.authitem.footer', //default: srbac.views.authitem.footer,
			//must be an existing alias
			'showHeader'           => true, // default: false
			'showFooter'           => true, // default: false
			'alwaysAllowedPath'    => 'application.modules.srbac.components',
		),
		'statistic',
		/* 'cms'=>array(
			// this layout will be set by default if no layout set for page
			'defaultLayout'=>'cms', // this layout will be set by default if no layout set for page
		), */

		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'     => 'system.gii.GiiModule',
			'password'  => '12345',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1','::1'),
		),

		// P3 Widgets
		/*
		'p3widgets' => array(
			'class' => 'application.modules.p3widgets.P3WidgetsModule',
			'params' => array(
				'widgets' => array(
					'CWidget' => 'Basic Widget',
					//'ext.yiiext.widgets.carousel.ECarouselWidget'	=> 'Carousel',
					'ext.yiiext.widgets.fancybox.EFancyBoxWidget'	=> 'Fancy Box',
					'ext.yiiext.widgets.cycle.ECycleWidget'			=> 'Cycle',//
				)
			)
		),
		*/
		'modulemanager',
		'thememanager'
	)
);
