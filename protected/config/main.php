<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
            'application.models.*',
            'application.models.base.*',
            'application.components.*',
            'application.extensions.*',
	),

	'modules' => require(dirname(__FILE__) . '/modules.php'),

	// application components
	'components'=>array(

            'user'=>array(
                    // enable cookie-based authentication
                    'allowAutoLogin'=>true,
                    'loginUrl'=>'user/login',
            ),
            'authManager'=>array(
                    'class' => 'CDbAuthManager',
                    'connectionID' => 'db',
                    'itemTable' => 'tbl_user_auth', //tc_user_auth_item
                    'itemChildTable' => 'tbl_user_auth_item_child',
                    'assignmentTable' => 'tbl_user_auth_assignment',
                    'defaultRoles' => array('guest'),
            ),

            // uncomment the following to enable URLs in path-format
            'urlManager'=>array(
                    'urlFormat'=>'path',
                    'showScriptName' => false, //remove index.php in url
                    'rules'=>array(
                            '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                            '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                            '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                    ),
            ),

            // database settings are configured in database.php
            'db'=>require(dirname(__FILE__).'/database.php'),

            'errorHandler'=>array(
                    // use 'site/error' action to display errors
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
                            
                            array(
                                    'class'=>'CWebLogRoute',
                            ),
                    ),
            ),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>  require(dirname(__FILE__).'/param.php'),
);
