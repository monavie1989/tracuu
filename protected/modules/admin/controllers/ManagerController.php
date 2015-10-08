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
                'actions' => array('create', 'update', 'index', 'delete'),
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
        $model = new User('register');
        $profile = new Profile('register');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $validate = true;
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['Profile'])) {
                $profile->attributes = $_POST['Profile'];
                $profile->user_id = 0;
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
                            $this->redirect(array('index'));
                        }
                    }
                }
            }
        }
        $this->render('create', array(
            'model' => $model,
            'profile' => $profile,
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
            $roles = array(
                'administrator' => array('moderator', 'publisher', 'author', 'member'),
                'moderator' => array('publisher', 'author')
            );
            if (isset($_POST['Profile'])) {
                $profile->attributes = $_POST['Profile'];
                if (!$profile->validate()) {
                    $validate = false;
                }
            }
            if (isset($_POST['User'])) {
                $oldpass = $model->password;
                $model->password = $_POST['User']['password'];
                $model->phone = $_POST['User']['phone'];
                $model->role = $_POST['User']['role'];
                $model->status = $_POST['User']['status'];
                $model->category_id = $_POST['User']['category_id'];
                if (!empty($model->status)) {
                    $model->activekey = "";
                }
                if ($model->validate() && $validate) {
                    $model->scenario = 'update';
                    if ($oldpass != $model->password) {
                        $model->password = md5($model->password);
                    }
                    if (!in_array($model->role, $roles[Yii::app()->user->role])) {
                        Yii::app()->user->setFlash('error', 'Bạn không có quyền chọn thêm thành viên thuộc nhóm <strong>' . $model->role . '</strong>.');
                        $this->redirect('index');
                    }
                    if ($model->save()) {
                        $profile->scenario = "save";
                        if ($profile->save()) {
                            $model->n_password = "";
                            $model->n_password_re = "";
                            Yii::app()->user->setFlash('success', 'Cập nhật thông tin thành viên thành công.');
                            $this->redirect('index');
                        } else {
                            Yii::app()->user->setFlash('error', 'Có lỗi xảy ra.');
                            $this->refresh();
                        }
                    }
                }
            }
        }
        $this->render('update', array(
            'model' => $model,
            'profile' => $profile,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $roles = array(
            'administrator' => array('moderator', 'publisher', 'author', 'member'),
            'moderator' => array('publisher', 'author')
        );
        if (!in_array($model->role, $roles[Yii::app()->user->role])) {
            Yii::app()->user->setFlash('error', 'Bạn không có quyền xóa người dùng thuộc nhóm <strong>' . $model->role . '</strong>.');
            $this->refresh();
        }
        if ($model->delete()) {
            Profile::model()->deleteAllByAttributes(array('user_id' => $id));
            CategoryUser::model()->deleteAllByAttributes(array('user_id' => $id));
        }
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
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
        $role = Yii::app()->user->role;
        if ($role === 'administrator')
            $model->roles = array('moderator', 'publisher', 'author');
        if ($role === 'moderator') {
            $model->roles = array('publisher', 'author');
        }
        if (!empty(Yii::app()->user->category_id)) {
            $model->category_id = Yii::app()->user->category_id;
        }
        $this->render('index', array(
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
