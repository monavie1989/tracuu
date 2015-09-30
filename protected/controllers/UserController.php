<?php

class UserController extends Controller
{
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
                            'actions'=>array('confirm','login','register'),
                            'users'=>array('*')
			),
			array('deny',  // deny all users
                            'users'=>array('*'),
			),
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
                        $smtp = Options::model()->getSmtpOptions();
                        foreach ($smtp as $item)
                            $data[$item['option_name']] = $item['option_value'];
                        //var_dump($data);die();
                        
                        $email = new Mailer();
                        $email->CharSet = 'UTF-8';
                        //$email->SMTPDebug  = 2;  
                        $email->isSMTP();                                      // Set mailer to use SMTP
                        $email->Host = $data['SMTP_HOST'];  // Specify main and backup SMTP servers
                        $email->SMTPAuth = boolval($data['SMTP_AUTH']);                               // Enable SMTP authentication
                        $email->Username = $data['SMTP_USERNAME'];                 // SMTP username
                        $email->Password = $data['SMTP_PASSWORD'];                           // SMTP password
                        $email->SMTPSecure = $data['SMTP_SECURE'];                            // Enable TLS encryption, `ssl` also accepted
                        $email->Port = (int)$data['SMTP_PORT'];                                    // TCP port to connect to

                        $email->setFrom($data['SMTP_USERNAME'], $data['SMTP_FROM_NAME']);
                        $email->addAddress($user->email, $user->fullname);
                        $email->addReplyTo($data['SMTP_USERNAME'], $data['SMTP_USERNAME']);

                        $email->isHTML(true);                                  // Set email format to HTML

                        $email->Subject = 'Tiêu đề tiếng việt';
                        $email->Body    = '<p>Xin ch&agrave;o bạn <strong>'.$user->fullname.'</strong>!</p>
                            <p>Ch&uacute;c mừng bạn đ&atilde; đăng k&yacute; t&agrave;i khoản th&agrave;nh c&ocirc;ng tại website '.Yii::app()->getBaseUrl(true).'. Xin vui l&ograve;ng truy cập v&agrave;o link dưới đ&acirc;y để k&iacute;ch hoạt t&agrave;i khoản của bạn.</p>
                            <p><a href="'.Yii::app()->getBaseUrl(true).'/user/confirm?email='.$user->email.'&amp;active_key='.$user->activekey.'">'.Yii::app()->getBaseUrl(true).'/user/confirm?email='.$user->email.'&amp;active_key='.$user->activekey.'</a></p>
                            <p>Xin ch&acirc;n th&agrave;nh c&aacute;m ơn.</p>';

                        if(!$email->send()) {
                                $this->render('message',array('message'=>'Tạo mới tài khoản thành công. Tuy nhiên có lỗi trong quá trình gửi email kích hoạt. Vui lòng liên hệ với ban quản trị để biết thêm chi tiết.'));
                        } else {
                            $this->render('message',array('message'=>'Tạo mới tài khoản thành công. Chúng tôi sẽ gửi email kích hoạt cho bạn tới địa chỉ <strong>'.$user->email.'</strong>. Vui lòng kiểm tra email của bạn.'));
                        }
                        return;
                    } else {
                        var_dump($user->getErrors());
                    };
                }
            }
            $this->render('register',array('model'=>$model));
        }
        
        public function actionConfirm() {
            $request = Yii::app()->request;
            $email = $request->getParam('email');
            $active_key = $request->getParam('active_key');
            $user = User::model()->findByAttributes(array('email'=>$email,'activekey'=>$active_key));
            //var_dump($user);
            if(!empty($user)) {
                if($user->active == 0) {
                    $user->active = 1;
                    $user->update();
                    //Yii::app()->user->setFlash('success','Kích hoạt tài khoản thành công! Bạn có thể đăng nhập.');
                    $this->render('message',array('message'=>'Kích hoạt tài khoản thành công!'));
                } else {
                    $this->render('message',array('message'=>'Tài khoản của bạn đã được kích hoạt! Bạn không cần kích hoạt lại nữa. Bạn có thể đăng nhập.'));
                }
            } else {
                $this->render('message',array('message'=>'Có lỗi xảy ra. Thông tin kích hoạt của bạn không đúng.'));
            }
        }

	// Uncomment the following methods and override them if needed
	/*
	
	*/
}