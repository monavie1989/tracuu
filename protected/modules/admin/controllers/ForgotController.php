<?php
class ForgotController extends Controller {
    public $layout = 'login';

    public function actionIndex() {
        $email = Yii::app()->request->getQuery('email');
        $activekey = Yii::app()->request->getQuery('activekey');
        if (isset($email) && !empty($email) && isset($activekey) && !empty($activekey)) {
		
            $account = User::model()->with('profile')->findByAttributes(array('email' => $email, 'activekey' => $activekey, 'status' => 1));
            if (!empty($account)) {
			
                $newpass = Common::genString();
                $account->password = md5($newpass);
                $account->activekey = '';
                if ($account->save()) {
                    Mail::sendMail(array($account->email), 'user_forgot_password_success.txt', array(
                        'fullname' => $account->profile->fname . ' ' . $account->profile->lname,
                        'username' => $account->username,
                        'password' => $newpass,
                            )
                    );
                }
				Yii::app()->user->setFlash('msg', 'Your account has been reset password successfully.<br>Please check your email to know new password.');
            } else {
                Yii::app()->user->setFlash('msg', 'Reset password false.<br>Email or Activekey not correct.<br>Please check Active Link again.');
            }
			$this->render('index', array('model' => $model));
        } else {
            $model = new User;
            if (isset($_POST['User'])) {
				if(empty($_POST['User']['email'])){
					$model->addError('email', "Email cannot be blank.");
				}else{
					$model = User::model()->with('profile')->findByAttributes(array('email' => $_POST['User']['email']));
					if (empty($model)) {
						$model = new User;
						$model->addError('email', "Email Not Exist !!!");
					} else {
						$model->activekey = Common::genString();
						$model->save();
						Mail::sendMail(array($model->email), 'user_forgot_password.txt', array(
							'fullname' => $model->profile->fname . ' ' . $model->profile->lname,
							'username' => $model->username,
							'activelink' => Yii::app()->getBaseUrl(true) . '/admin/forgot?email=' . $model->email . '&activekey=' . $model->activekey,
								)
						);
						Yii::app()->user->setFlash('msg', 'Please check your e-mail for the confirmation link.');
						$this->refresh();
					}
				}
            }
            $this->render('index', array('model' => $model));
        }
    }

}