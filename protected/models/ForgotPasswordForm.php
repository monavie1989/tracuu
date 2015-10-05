<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 */
class ForgotPasswordForm extends CFormModel
{
    public $email;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('email', 'required','message'=>'Vui lòng nhập {attribute} của bạn.'),
                array('email', 'validateEmail'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
        );
    }

    public function validateEmail($attribute,$params) {
            $user = User::model()->find(array('select'=>'email','condition'=>'email=:email','params'=>array(':email'=>$this->$attribute)));
            if(empty($user))
                $this->addError ($attribute, 'Email của bạn không tồn tại trong hệ thống');
        }
}