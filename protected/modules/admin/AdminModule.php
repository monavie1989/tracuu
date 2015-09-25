<?php

class AdminModule extends CWebModule {

    public $layout;
    public $layoutPath;
    public $debug = false;
    public $baseModulePath = 'admin';

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->layoutPath = Yii::getPathOfAlias('admin.views.layouts');
        $this->layout = 'main';
        Yii::app()->setHomeUrl(array('/admin/default/index'));
        Yii::app()->name = "Backend";
        Yii::app()->setComponents(array(
            'user' => array(
                'loginUrl' => Yii::app()->createUrl('admin/login'),
            ),
            'errorHandler' => array(
                'errorAction' => '/admin/default/error',
            ),
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}
