<?php

class UserController extends Controller {

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
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('confirm', 'login', 'register', 'forgotpassword', 'newpassword', 'profile', 'changepassword', 'update'),
                'users' => array('*')
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('profile'),
                'users' => array('@')
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionProfile() {
        $this->layout = "member";
        $this->render('profile', array(
            'model' => $this->loadModel(Yii::app()->user->id),
            'modelProfile' => Profile::model()->findByPk(Yii::app()->user->id),
        ));
    }

    public function actionChangePassword() {
        $this->layout = "member";
        $model = $this->loadModel(Yii::app()->user->id);
        $model->scenario = 'changepass';
        if (isset($_POST['User'])) {
            $o_password = $_POST['User']['o_password'];
            $model->o_password = md5($o_password);
            $model->n_password = $_POST['User']['n_password'];
            $model->n_password_re = $_POST['User']['n_password_re'];
            $oldpass = $model->password;
            if ($model->validate()) {
                $model->scenario = 'update';
                $model->password = md5($model->n_password);
                $model->save();
                Yii::app()->user->setFlash('msg', 'Thay đổi mật khẩu thành công.');
                $this->redirect('profile');
            } else {
                if (!empty($model->errors)) {
                    $model->o_password = $o_password;
                }
            }
        }

        $this->render('changepassword', array(
            'model' => $model,
        ));
    }

    public function actionUpdate() {
        $this->layout = "member";
        $model = Profile::model()->findByPk(Yii::app()->user->id);
        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('msg', 'Change Profile success.');
                $this->redirect('profile');
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionLogin() {
        if (!Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->baseUrl);

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
    public function actionLogout() {
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

        if (!Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->baseUrl);

        $model = new RegisterForm();

        // uncomment the following code to enable ajax-based validation
        /*
          if(isset($_POST['ajax']) && $_POST['ajax']==='register-form-register-form')
          {
          echo CActiveForm::validate($model);
          Yii::app()->end();
          }
         */

        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            if ($model->validate()) {
                // form inputs are valid, do something here
                $user = new User();
                //$user->fullname=$model->fullname;
                $user->username = $model->username;
                $user->password = md5($model->password);
                $user->email = $model->email;
                $user->phone = $model->phone;
                //$user->phone=$model->phone;
                $user->role = 'member';
                $user->status = 0;
                $user->activekey = String::randomString('alphabet', 10);
                $user->registered = new CDbExpression('NOW()');
                //$user->populateRecord($form->attributes);
                if ($user->save()) {
                    $profile = new Profile();
                    $profile->user_id = $user->id;
                    $profile->fname = $model->fname;
                    $profile->lname = $model->lname;
                    $profile->gender = $model->gender;
                    $profile->birthday = date('yyyy-mm-dd', strtotime($model->birthday));

                    if ($profile->save()) {
                        $params = $model->attributes;
                        $params['linkactive'] = Yii::app()->getBaseUrl(true) . '/user/confirm?email=' . $user->email . '&amp;activekey=' . $user->activekey;
                        $email = Mail::sendMail(array($model->email), 'user_regist_send_user.txt', $params);
                        //Yii::app()->user->setFlash('success', 'Thêm thành viên mới thành công.');
                        if ($email == false) {
                            $this->render('message', array('message' => 'Đăng ký tài khoản thành công. Tuy nhiên có lỗi trong quá trình gửi email kích hoạt. Vui lòng liên hệ với ban quản trị để biết thêm chi tiết.'));
                        } else {
                            $this->render('message', array('message' => 'Đăng ký tài khoản thành công. Chúng tôi sẽ gửi email kích hoạt cho bạn tới địa chỉ <strong>' . $user->email . '</strong>. Vui lòng kiểm tra email của bạn.'));
                        }
                        return;
                    }
                } else {
                    var_dump($user->getErrors());
                };
            }
        }
        $this->render('register', array('model' => $model));
    }

    public function actionConfirm() {
        $request = Yii::app()->request;
        $this->pageTitle = 'Kích hoạt tài khoản';
        $email = $request->getParam('email');
        $active_key = $request->getParam('activekey');
        $user = User::model()->findByAttributes(array('email' => $email, 'activekey' => $active_key));
        //var_dump($user);
        if (!empty($user)) {
            if ($user->status == 0) {
                $user->status = 1;
                $user->update();
                //Yii::app()->user->setFlash('success','Kích hoạt tài khoản thành công! Bạn có thể đăng nhập.');
                $this->render('message', array('message' => 'Kích hoạt tài khoản thành công!<br/>Bạn có thể đăng nhập và sử dụng các chức năng của hệ thống'));
            } else {
                $this->render('message', array('message' => 'Tài khoản của bạn đã được kích hoạt! Bạn không cần kích hoạt lại nữa.<br/>Bạn có thể đăng nhập <a href="' . Yii::app()->urlManager->createUrl(Yii::app()->user->loginUrl) . '"/>tại đây</a>.'));
            }
        } else {
            $this->render('message', array('message' => 'Có lỗi xảy ra. Thông tin kích hoạt của bạn không đúng.'));
        }
    }

    public function actionforgotPassword() {

        if (!Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->baseUrl);

        $model = new ForgotPasswordForm();
        if (isset($_POST['ForgotPasswordForm'])) {
            $model->attributes = $_POST['ForgotPasswordForm'];
            if ($model->validate()) {
                $user = User::model()->findByAttributes(array('email' => $model->email));
                $user->activekey = String::randomString('alphabet', 8);
                $user->status = 0;
                if ($user->save()) {
                    $params['linkactive'] = Yii::app()->getBaseUrl(true) . '/user/newpassword?email=' . $user->email . '&amp;activekey=' . $user->activekey;
                    $params['webname'] = Yii::app()->name;
                    $email = Mail::sendMail(array($model->email), 'user_forgot_password.txt', $params);
                    //Yii::app()->user->setFlash('success', 'Thêm thành viên mới thành công.');
                    if ($email == true) {
                        $this->render('message', array('message' => 'Bạn đã gửi yêu cầu lấy lại mật khẩu thành công!<br/>Vui lòng kiểm tra email của bạn để biết thông tin chi tiết.<br/>Xin chân thành cám ơn.'));
                        return;
                    }
                }
            }
        }
        $this->render('forgotpassword', array('model' => $model));
    }

    public function actionnewPassword() {
        if (!Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->baseUrl);

        $this->pageTitle = 'Thay đổi mật khẩu';

        $model = new ChangepassForm();
        $request = Yii::app()->request;
        $email = $request->getParam('email');
        $active_key = $request->getParam('activekey');
        $user = User::model()->findByAttributes(array('email' => $email, 'activekey' => $active_key));
        //echo $id;
        if (!empty($user)) {
            if ($user->status != 1) {
                if (isset($_POST['ChangepassForm'])) {
                    $model->attributes = $_POST['ChangepassForm'];
                    if ($model->validate()) {
                        $command = Yii::app()->db->createCommand();
                        //$sql = 'UPDATE tbl_user SET password=\''.md5($model->password).'\'';
                        if ($command->update('tbl_user', array('password' => md5($model->password), 'status' => 1), 'id=:id', array(':id' => $user->id))) {
                            $this->render('message', array('message' => 'Bạn đã đổi mật khẩu thành công. Bạn có thể đăng nhập <a href="' . Yii::app()->urlManager->createUrl(Yii::app()->user->loginUrl) . '">tại đây</a>.'));
                            return;
                        } else {
                            throw new Exception('Error');
                        }
                    }
                }
            } else {
                $this->render('message', array('message' => 'Yêu cầu thay đổi mật khẩu của bạn đã bị quá hạn.'));
                return;
            }
        } else {
            throw new CHttpException(404, 'Liên kết truy cập không có hiệu lực');
        }
        $this->render('changepass', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    // Uncomment the following methods and override them if needed
    /*

     */
}
