<?php

class TaskController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('AjaxAddTask'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserAuth;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserAuth']))
		{
                    $model->attributes=$_POST['UserAuth'];
                    if($model->save()) {
                        Yii::app()->user->setFlash('success','Thêm quyền thành công!');
                        $this->redirect(array('index','id'=>$model->id));
                    }
		}
                
                $task = CHtml::listData(UserAuth::model()->findAll(array('select'=>'name,type','condition'=>'type IN(5)')), 'name', 'type');
                
                $meta = new Metadata();
                $module = $meta->getModules();
                //$final = array_diff_assoc($module_controller_action,$module);
		$this->render('create',array(
                    'model'=>$model,
                    'data'=>$module,
		));
	}
        
        public function actionAjaxAddTask(){
            $name = $_POST['name'];
            $type = $_POST['type'];
            //var_dump($matches);die();
            try {
                UserAuth::model()->addTask($name.'.*', $type);
                $meta = new Metadata();
                $controllers = $meta->getControllers($name);
                foreach($controllers as $controller) {
                    $cname = $name.'.'.strtolower(str_replace('Controller', '', $controller));
                    UserAuth::model()->addTask($cname.'.*', $type+1);
                    UserAuth::model()->addRelationTask($name.'.*', $cname.'.*');
                    $actions = $meta->getActions($controller,$name);
                    foreach ($actions as $action) {
                        $aname = $cname.'.'.strtolower(str_replace('action', '', $action));
                        UserAuth::model()->addTask($aname, $type+2);
                        UserAuth::model()->addRelationTask($cname.'.*', $aname);
                    }
                }
                echo json_encode(array('code'=>1,'message'=>'Thêm thành công'));
                return;
            } catch (CException $e) {
                echo json_encode(array('code'=>0,'message'=>$e->getMessage()));
                return;
            }
        }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserAuth']))
		{
			$model->attributes=$_POST['UserAuth'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            //$type = Yii::app()->request->getParam('type');
            $model=new UserAuth('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['UserAuth']))
                    $model->attributes=$_GET['UserAuth'];

            $this->render('index',array(
                'model'=>$model,
                'type'=>'task',
            ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserAuth the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserAuth::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserAuth $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-auth-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
