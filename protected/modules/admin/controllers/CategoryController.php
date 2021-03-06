<?php

class CategoryController extends Controller {

    public $controllerLabel = 'Chuyên mục';
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
                'actions' => array('admin', 'delete', 'getcategorydropdownlist'),
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
        $model = new Category('search');
        if (!empty($_POST['action'])) {
            switch ($_POST['action']) {
                case 'delete':
                    if (isset($_POST['items']) && !empty($_POST['items'])) {
                        $items = $_POST['items'];
                        foreach ($model::model()->findAllByPk($items) as $item) {
                            $update_parent = Category::model()->updateAll(array('category_parent' => $item->category_parent), 'category_parent = ' . $item->category_id);
                            $item->delete();
                        }
                    }
                    break;
                default:
                    break;
            }
        }
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Category']))
            $model->attributes = $_GET['Category'];

        $modelUpdate = new Category;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            if (!empty($_POST['Category']['category_id'])) {
                $modelUpdate = Category::model()->findByPk($_POST['Category']['category_id']);
            }
            $modelUpdate->attributes = $_POST['Category'];
            if ($modelUpdate->isNewRecord) {
                $msg = "Thêm mới Chuyên mục thành công.";
            } else {
                $msg = "Cập nhật Chuyên mục thành công.";
            }
            if ($modelUpdate->save()) {
                Yii::app()->user->setFlash('success', $msg);
                $modelUpdate = new Category;
            }
        }
        $this->render('admin', array(
            'model' => $model,
            'modelUpdate' => $modelUpdate
        ));
    }

    public function actionGetCategoryDropDownList() {
        $modelUpdate = new Category;
        if(!empty($_GET['category_selected'])){
            $modelUpdate->category_parent = $_GET['category_selected'];
        }
        
        $this->renderPartial('getcategorydropdownlist', array(
            'modelUpdate' => $modelUpdate
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Category the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Category $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
