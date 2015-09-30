<?php

/**
 * This is the model class for table "tbl_profile".
 *
 * The followings are the available columns in table 'tbl_profile':
 * @property integer $user_id
 * @property string $fname
 * @property string $lname
 * @property integer $gender
 * @property string $birthday
 */
class Profile extends ProfileBase {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProfileBase the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function rules() {
        return array_merge(parent::rules(),array(            
            array('phone', 'validatePhone','on'=>'register'),
        ));
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => 'User',
            'fname' => 'Họ',
            'lname' => 'Tên',
            'gender' => 'Giới tính',
            'birthday' => 'Ngày sinh',
        );
    }
    
    public function validatePhone($attribute,$params) {
        $user = Profile::model()->find(array('select'=>'phone','condition'=>'phone=:phone','params'=>array(':phone'=>$this->$attribute)));
        if(!empty($user))
            $this->addError ($attribute, 'Số điện thoại đã được dùng để đăng ký');
    }

}
