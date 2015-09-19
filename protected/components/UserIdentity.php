<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
 
     public $autoLogin;
     private $_id;
 
     public function __construct($username, $password, $autoLogin) {
         $this->username = $username;
         $this->password = $password;
         $this->autoLogin = $autoLogin;
     }
 
     public function authenticate() {
         $user = User::model()->findByAttributes(array(
             'username' => $this->username
         ));
 
         if ($user === null) {
             $this->errorCode = self::ERROR_USERNAME_INVALID;
         } else {
             // check Auto or Not
             $password = md5($this->password);
 
             if ($user->password !== $password) {
                 $this->errorCode = self::ERROR_PASSWORD_INVALID;
             } else {
                 $this->_id = $user->id;
                 if ($user->last_visited_date === NULL) {
                     $lastLogin = new CDbExpression('NOW()');
                 } else {
                     $lastLogin = $user->last_visited_date;
                 }
 
                 // RBAC
                 $role = $user->role;
                 $role_info = UserAuth::model()->findByAttributes(array('name'=>$role));
                 $auth = Yii::app()->authManager;
                 //foreach ($roles as $role) {
                     if (!$auth->isAssigned($role, $this->_id)) {
                         if ($auth->assign($role, $this->_id)) {
                             Yii::app()->authManager->save();
                         }
                     }
                 //}
                 $this->setState('role_type', $role_info->type);
                 $this->setState('email', $user->email);
                 $this->setState('last_visited_date', $lastLogin);
                 $this->errorCode = self::ERROR_NONE;
             }
         }
         return !$this->errorCode;
     }
 
     public function getId() {
         return $this->_id;
     }        
 }