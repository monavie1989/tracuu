<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 */
class ChangepassForm extends CFormModel
{
    public $password;
    public $password2;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('password', 'length', 'max'=>64),
                array('password2', 'compare', 'compareAttribute'=>'password', 'operator'=>'=','message'=>'{attribute} không đúng.'),
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
            'password' => 'Mật khẩu mới',
            'password2' => 'Xác nhận mật khẩu mới',
        );
    }
}