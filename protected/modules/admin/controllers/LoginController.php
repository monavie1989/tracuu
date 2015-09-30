<?php
class LoginController extends Controller {
    public $layout = 'login';
    public function actionIndex() {

        $model = new LoginForm();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login_form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
            else{
                $model->password = '';
            }
        }
        // display the login form
        
        $this->render('index', array('model' => $model));
    }

}