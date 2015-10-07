<?php

class CommentsController extends Controller {

    public $controllerLabel = 'Bình luận';
    public $defaultAction = 'admin';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
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
                'actions' => array('create', 'update', 'admin', 'delete', 'index'),
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
        $model = new Comments;
        $model->comment_post_id = !empty($_GET['post_id']) ? $_GET['post_id'] : 0;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Comments'])) {
            $model->attributes = $_POST['Comments'];
            $model->comment_user_id = Yii::app()->user->id;
            $model->comment_author_name = Yii::app()->user->username;
            $model->comment_author_email = Yii::app()->user->email;
            $model->comment_date = DATE('Y-m-d H:i:s');
            if ($model->save()) {
                $this->renderPartial('message', array(
                    'message' => "Thêm nhận xét thành công",
                    'model' => $model
                ));
                exit();
            }
        }

        $this->renderPartial('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Comments'])) {
            $model->attributes = $_POST['Comments'];
            if ($model->save()) {
                $this->renderPartial('message', array(
                    'message' => "Cập nhật nhận xét thành công",
                    'model' => $model
                ));
                exit();
            }
        }

        $this->renderPartial('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $delete_model = $model = $this->loadModel($id);
        $delete_model->delete();
        $this->renderPartial('message', array(
            'message' => "Xóa nhận xét thành công",
            'model' => $model
        ));
        exit();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Comments('search');
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
        if (isset($_GET['Comments']))
            $model->attributes = $_GET['Comments'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Comments', array(
            'criteria' => array(
                'condition' => 'comment_post_id=' . $_REQUEST['post_id'],
                'order' => 'comment_date DESC',
            ),
        ));
        $this->renderPartial('index', array(
            'dataProvider' => $dataProvider->getData(),
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Comments the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Comments::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Comments $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comments-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
