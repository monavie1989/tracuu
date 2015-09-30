<?php

class LogoutController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl'
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // Allow superusers to access Administrator
                'actions' => array('index'),
                'users' => array('@'),
            ),
            array('deny', // Deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->user->loginUrl);
    }

}