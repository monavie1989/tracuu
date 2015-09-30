<?php

class ProfileController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'update', 'changepassword'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionIndex() {
        $this->render('index', array(
            'model' => $this->loadModel(Yii::app()->user->id),
            'modelProfile' => Profile::model()->findByPk(Yii::app()->user->id),
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionChangepassword() {
        $model = $this->loadModel(Yii::app()->user->id);
        $model->scenario = 'changepass';
        if (isset($_POST['User'])) {
            $o_password = $_POST['User']['o_password'];
            $model->o_password = md5($o_password);
            $model->n_password = $_POST['User']['n_password'];
            $model->n_password_re = $_POST['User']['n_password_re'];
            $oldpass = $model->password;
            if ($model->validate()) {
                $model->scenario = 'update';
                $model->password = md5($model->n_password);
                $model->save();
                Yii::app()->user->setFlash('msg', 'Change password success.');
                $this->redirect('index');
            } else {
                if (!empty($model->errors)) {
                    $model->o_password = $o_password;
                }
            }
        }

        $this->render('changepassword', array(
            'model' => $model,
        ));
        exit();
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate() {
        $model = Profile::model()->findByPk(Yii::app()->user->id);
        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('msg', 'Change Profile success.');
                $this->redirect('index');
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
        exit();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
