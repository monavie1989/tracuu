<?php

class ActiveController extends Controller {

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
                'actions' => array('index'),
                'users' => array('*')
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $msg = '';
        if (!empty($_GET['email']) && !empty($_GET['activekey'])) {
            $user = User::model()->findByAttributes(array(
                'activekey' => $_GET['activekey'],
                'status' => 0
            ));
            if (!empty($user)) {
                if (md5($user->email) == $_GET['email']) {
                    $user->activekey = "";
                    $user->status = 1;
                    if ($user->save()) {
                        $msg = "Kích hoạt tài khoản thành công.<br>
                        Bạn có thể đăng nhập và sử dụng các chức năng của hệ thống";
                    } else {
                        $msg = "Kích hoạt tài khoản thất bại.<br>
                        Vui lòng liên hệ với ban quản trị để nhận được sự giúp đỡ. Cảm ơn";
                    }
                } else {
                    $msg = "Email không chính xác, vui lòng kiểm tra lại.<br>
                    Nếu bạn cần sự giúp đỡ vui lòng liên hệ với ban quản trị. Cảm ơn";
                }
            } else {
                $msg = "Mã Active không đúng, vui lòng kiểm tra lại.<br>
                Nếu bạn cần sự giúp đỡ vui lòng liên hệ với ban quản trị. Cảm ơn";
            }
        } else {
            $msg = "Dữ liệu kích hoạt tài khoản không hợp lệ vui lòng kiểm tra lại.<br>
                Nếu bạn cần sự giúp đỡ vui lòng liên hệ với ban quản trị. Cảm ơn";
        }
        $this->render('index', array('message' => $msg));
    }

}
