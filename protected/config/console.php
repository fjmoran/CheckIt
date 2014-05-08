<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'class' => 'WebUser',
			/*'allowAutoLogin'=>true,*/
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=checkit',
			'emulatePrepare' => true,
			'username' => 'checkit',
			'password' => '0e0r0t0y',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),

	'modules'=>array(
		'user'=>array(
			# encrypting method (php hash function)
			'hash' => 'md5',

			# send activation email
			'sendActivationMail' => true,

			# allow access for non-activated users
			'loginNotActiv' => false,

			# activate user on registration (only sendActivationMail = false)
			'activeAfterRegister' => false,

			# automatically login from registration
			'autoLogin' => true,

			# registration path
			'registrationUrl' => array('/user/registration'),

			# recovery password path
			'recoveryUrl' => array('/user/recovery'),

			# login form path
			'loginUrl' => array('/user/login'),

			# page after login
			'returnUrl' => array('/user/profile'),

			# page after logout
			'returnLogoutUrl' => array('/user/login'),
		),
	),
);