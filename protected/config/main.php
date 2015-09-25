<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Tra cứu',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.models.base.*',
        'application.components.*',
        'application.extensions.*',
        'application.vendors.*',
        'application.widgets.*',
        'application.widgets.admin.*',
        'application.widgets.front.*',
        'application.classextends.*',
        'application.extensions.ckeditor.*',
        'application.helpers.*',
    ),
    'modules' => require(dirname(__FILE__) . '/modules.php'),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'class' => 'application.components.WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => 'user/login',
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'tbl_user_auth', //tc_user_auth_item
            'itemChildTable' => 'tbl_user_auth_item_child',
            'assignmentTable' => 'tbl_user_auth_assignment',
            'defaultRoles' => array('guest'),
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/opt/local/bin'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => require(dirname(__FILE__) . '/urlmanager.php'),
        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                array(
                    'class' => 'CWebLogRoute',
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/param.php'),
);
