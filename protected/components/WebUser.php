<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
//protected/compoments/UserIdentity.php
class WebUser extends CWebUser
{
    // Store model to not repeat query.
    private static $_model;
    function getUserRole(){
        $user = $this->loadUser(Yii::app()->user->id);
        if ($user == NULL) {
            return FALSE;
        }
        return $user->role;
    }
    // Load user model.
    protected function loadUser($id = NULL)
    {
        if (self::$_model === NULL) {
            if ($id !== NULL)
                self::$_model = User::model()->findByPk($id);
        }
        return self::$_model;
    }
     public function getReturnUrl($defaultUrl = null) {
        $app = Yii::app();
        if (!empty($app->controller->module)) {
            if ($defaultUrl === null) {
                $defaultReturnUrl = Yii::app()->getUrlManager()->showScriptName ? Yii::app()->getRequest()->getScriptUrl() : Yii::app()->getRequest()->getBaseUrl() . '/'.$app->controller->module->id;
            } else {
                $defaultReturnUrl = CHtml::normalizeUrl($defaultUrl);
            }
        } else {
            if ($defaultUrl === null) {
                $defaultReturnUrl = Yii::app()->getUrlManager()->showScriptName ? Yii::app()->getRequest()->getScriptUrl() : Yii::app()->getRequest()->getBaseUrl() . '/';
            } else {
                $defaultReturnUrl = CHtml::normalizeUrl($defaultUrl);
            }
        }
        return $this->getState('_returnUrl', $defaultReturnUrl);
    }
}