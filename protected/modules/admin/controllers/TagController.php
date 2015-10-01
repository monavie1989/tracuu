<?php

class TagController extends Controller {

    public $controllerLabel = 'Thẻ';
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
                'actions' => array('admin', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
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
        $model = new Tag('search');
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
        if (isset($_GET['Tag']))
            $model->attributes = $_GET['Tag'];

        $modelUpdate = new Tag;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Tag'])) {
            if (!empty($_POST['Tag']['tag_id'])) {
                $modelUpdate = Tag::model()->findByPk($_POST['Tag']['tag_id']);
            }
            $modelUpdate->attributes = $_POST['Tag'];
            if ($modelUpdate->isNewRecord) {
                $msg = "Thêm mới " . $this->controllerLabel . " thành công.";
            } else {
                $msg = "Cập nhật " . $this->controllerLabel . " thành công.";
            }
            if ($modelUpdate->save()) {
                Yii::app()->user->setFlash('success', $msg);
                $modelUpdate = new Tag;
            }
        }
        $this->render('admin', array(
            'model' => $model,
            'modelUpdate' => $modelUpdate
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Tag the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Tag::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Tag $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tag-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
