<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
                            'roles'=>array('admin.user.index'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
                            'actions'=>array('delete'),
                            'roles'=>array('admin.user.delete')
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
                            'actions'=>array('changepass','profile'),
                            'users'=>array('@')
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
	public function actionProfile()
	{
            $id = Yii::app()->request->getParam('id');
            if(empty($id)) {
                $id = Yii::app()->user->id;
            } 
            $this->render('profile',array(
                    'model'=>$this->loadModel($id),
            ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            $model=new User;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['User']))
            {
                $attributes=$_POST['User'];
                $assign_role = array(
                    0 => array(0,1,2,3,4),
                    1 => array(1,2,3,4),
                    2 => array(3),
                    3 => array(),
                    4 => array(),
                );
                //var_dump($attributes);die();
                $model->username = $attributes['username'];
                $model->password = $attributes['password'];
                $model->email = $attributes['email'];
                $model->role = $attributes['role'];
                $model->active = $attributes['active'];
                $role= UserAuth::model()->find('name=:name',array(':name'=>$model->role));
                if(!Yii::app()->user->isGuest) {
                    if(in_array($role->type, $assign_role[Yii::app()->user->role_type]) === FALSE) {
                        Yii::app()->user->setFlash('error','Bạn không có quyền tạo tài khoản thuộc nhóm người dùng này');
                        $this->redirect(array('index'));
                    }
                        //throw new CException('Bạn không có quyền tạo tài khoản thuộc nhóm người dùng này');
                } else {
                    $model->role = 'member';
                }
                $model->password = md5($model->password);
                $model->activekey = String::randomString('alphabet', 10);
                $model->registered_date = new CDbExpression('NOW()');
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }
            $this->pageTitle = 'Thêm tài khoản mới';
            $this->render('create',array(
                    'model'=>$model,
            ));
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

		if(isset($_POST['User']))
                {
                    $attributes=$_POST['User'];
                    $assign_role = array(
                        0 => array(0,1,2,3,4),
                        1 => array(1,2,3,4),
                        2 => array(3),
                        3 => array(),
                        4 => array(),
                    );
                    //var_dump($attributes);die();
                    $model->username = $attributes['username'];
                    $model->password = $attributes['password'];
                    $model->email = $attributes['email'];
                    $model->role = $attributes['role'];
                    $model->active = $attributes['active'];
                    $role= UserAuth::model()->find('name=:name',array(':name'=>$model->role));
                    if(!Yii::app()->user->isGuest) {
                        if(in_array($role->type, $assign_role[Yii::app()->user->role_type]) === FALSE) {
                            Yii::app()->user->setFlash('error','Bạn không có quyền tạo tài khoản thuộc nhóm người dùng này');
                            $this->redirect(array('index'));
                        }
                            //throw new CException('Bạn không có quyền tạo tài khoản thuộc nhóm người dùng này');
                    } else {
                        $model->role = 'member';
                    }
                    $model->password = md5($model->password);
                    //$model->activekey = String::randomString('alphabet', 10);
                    //$model->registered_date = new CDbExpression('NOW()');
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
            $model = $this->loadModel($id);
            try{                
                $model->delete();
                if(!isset($_GET['ajax']))
                    Yii::app()->user->setFlash('success','Normal - Deleted Successfully');
                else
                    echo 'Xóa tài khoản <strong>'.$model->username.'</strong> thành công!';
            }catch(CDbException $e){
                if(!isset($_GET['ajax']))
                    Yii::app()->user->setFlash('error','Normal - error message');
                else
                    echo 'Có lỗi xảy ra. Xóa tài khoản <strong>'.$model->username.'</strong> không thành công!'; //for ajax
            }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $model=new User('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['User']))
                    $model->attributes=$_GET['User'];
            $this->pageTitle = 'Danh sách người dùng';
            $this->render('index',array(
                    'model'=>$model,
            ));
	}
        
        public function actionChangepass()
	{
            $model=new ChangepassForm();
            $id = Yii::app()->request->getParam('id');
            if(empty($id)) {
                $id = Yii::app()->user->id;
            }
            $model->id = $id;
            //echo $id;
            if(isset($_POST['ChangepassForm']))
            {
                $model->attributes = $_POST['ChangepassForm'];
                if($model->validate()) {
                    $command = Yii::app()->db->createCommand();
                    $sql = 'UPDATE tbl_user SET password=\''.md5($model->password).'\'';
                    if($command->update('tbl_user', array('password'=>md5($model->password)), 'id=:id',  array(':id'=>$id))) {
                        Yii::app()->user->setFlash('success','Cập nhật mật khẩu thành công');
                        if(Yii::app()->request->getParam('id'))
                            $this->redirect('index');
                        else
                            $this->redirect('profile');
                    } else {
                        throw new Exception('Error');
                    }
                }
            }
            $this->render('changepass',array(
                'model'=>$model,
            ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
