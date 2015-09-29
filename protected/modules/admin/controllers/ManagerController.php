<?php

class ManagerController extends Controller {

    public $controllerLabel = 'Quản trị viên';
    public $defaultAction = 'admin';

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete'),
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;
        $profile = new Profile;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $validate = true;
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['Profile'])) {
                $profile->attributes = $_POST['Profile'];
                if (!$profile->validate())
                    $validate = false;
            }
            if (isset($_POST['User'])) {
                $model->attributes = $_POST['User'];

                $model->registered = date("Y-m-d H:i:s");
                if ($model->validate() && $validate) {
                    $model->password = md5($model->password);
                    if ($model->save()) {
                        $profile->user_id = $model->id;
                        $profile->scenario = "save";
                        if ($profile->save()) {
                            $params = array_merge($model->attributes, $profile->attributes);
                            Mail::sendMail(array($model->email), 'admin_create_manager_send_user.txt', $params);
                            Yii::app()->user->setFlash('success', 'Thêm quản trị viên mới thành công.');
                            $this->redirect(array('admin'));
                        }
                    }
                }
            }
        }
        $this->render('create', array(
            'model' => $model,
            'profile' => $profile
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = User::model()->findByPk($id);
        $profile = Profile::model()->findByPk($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $validate = true;
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['Profile'])) {
                $profile->attributes = $_POST['Profile'];
                if (!$profile->validate())
                    $validate = false;
            }
            if (isset($_POST['User'])) {
                $model->status = $_POST['User']['status'];
                if (!empty($model->status)) {
                    $model->activekey = "";
                }
                if (!empty($_POST['User']['n_password'])) {
                    $model->scenario = 'changepass';
                    $model->o_password = $model->password;
                    $model->n_password = $_POST['User']['n_password'];
                    $model->n_password_re = $_POST['User']['n_password_re'];
                    $oldpass = $model->password;
                }
                if ($model->validate() && $validate) {
                    $model->scenario = 'update';
                    $model->password = md5($model->n_password);
                    if ($model->save()) {
                        $profile->scenario = "save";
                        if ($profile->save()) {
                            $model->n_password = "";
                            $model->n_password_re = "";
                            Yii::app()->user->setFlash('success', 'Cập nhật thông tin thành viên thành công.');
                        }
                    }
                }
            }
        }
        $this->render('update', array(
            'model' => $model,
            'profile' => $profile
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        if (!empty($_POST['action'])) {
            switch ($_POST['action']) {
                case 'delete':
                    if (isset($_POST['items']) && !empty($_POST['items'])) {
                        $items = $_POST['items'];
                        foreach ($model::model()->findAllByPk($items) as $item) {
                            $item->delete();
                        }
                    }
                    break;
                default:
                    break;
            }
        }
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];
        $model->roles = array('moderator','publisher','author');
        $this->render('admin', array(
            'model' => $model,
        ));
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
