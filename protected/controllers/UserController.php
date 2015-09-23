<?php

class UserController extends Controller
{
        public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			
		);
	}
    
        public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionLogin()
	{
		if (!Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->homeUrl);

		$model = new LoginForm('login');

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];

			if ($model->validate('login') && $model->login()) {
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		//obtains all assigned roles for this user id
		$roleAssigned = Yii::app()->authManager->getRoles(Yii::app()->user->id);

		if (!empty($roleAssigned)) { //checks that there are assigned roles
			$auth = Yii::app()->authManager; //initializes the authManager
			foreach ($roleAssigned as $n => $role) {
				if ($auth->revoke($n, Yii::app()->user->id)) //remove each assigned role for this user
					Yii::app()->authManager->save(); //again always save the result
			}
		}

		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionRegister() {

            $model=new RegisterForm();

            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='register-form-register-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */

            if(isset($_POST['RegisterForm']))
            {
                $model->attributes=$_POST['RegisterForm'];
                if($model->validate())
                {
                    // form inputs are valid, do something here
                    $user = new User();
                    $user->fullname=$model->fullname;
                    $user->username=$model->username;                    
                    $user->password = md5($model->password);
                    $user->email=$model->email;
                    $user->phone=$model->phone;
                    $user->role = 'member';
                    $user->active = 0;
                    $user->activekey = String::randomString('alphabet', 10);
                    $user->registered_date = new CDbExpression('NOW()');
                    //$user->populateRecord($form->attributes);
                    if($user->save()) {
                        $this->render('message',array('message'=>'Tạo mới tài khoản thành công. Chúng tôi sẽ gửi email kích hoạt cho bạn tới địa chỉ <strong>'.$user->email.'</strong>. Vui lòng kiểm tra email của bạn.'));
                        return;
                    } else {
                        var_dump($user->getErrors());
                    };
                }
            }
            $this->render('register',array('model'=>$model));
        }

	// Uncomment the following methods and override them if needed
	/*
	
	*/
}