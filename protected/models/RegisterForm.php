<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $role
 * @property string $username
 * @property string $password
 * @property string $fullname
 * @property integer $phone
 * @property string $email
 * @property string $registered_date
 * @property string $last_visited_date
 * @property string $activekey
 * @property integer $active
 * @property integer $status
 */
class RegisterForm extends CFormModel
{
        public $fullname;
        public $username;
        public $password;
        public $password2;
        public $email;
        public $phone;
        public $role;
        public $active;
        public $activekey;
        public $registered_date;

        /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, password2, fullname, phone, email', 'required','message'=>'Trường thông tin {attribute} không được để trống.'),
			array('phone, active', 'numerical', 'integerOnly'=>true,'message'=>'Trường thông tin {attribute} phải là chữ số.'),
                        array('phone', 'length', 'max'=>11,'min'=>10,'tooLong'=>'{attribute} được phép có tối đa {max} ký tự.','tooShort'=>'{attribute} phải có tối thiểu {min} ký tự.'),
			array('role, fullname', 'length', 'max'=>255),
			array('username', 'length', 'max'=>50),
			array('password', 'length', 'max'=>64),
                        array('password2', 'compare', 'compareAttribute'=>'password', 'operator'=>'=','message'=>'{attribute} không đúng.'),
			array('email', 'email', 'message'=>'{attribute} không đúng định dạng.'),
                        array('username','validateUsername'),
                        array('email','validateEmail'),
                        array('phone','validatePhone'),
			array('activekey', 'length', 'max'=>32),
			array('registered_date', 'safe'),
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
			'id' => 'ID',
			'role' => 'Role',
			'username' => 'Username',
			'password' => 'Password',
                        'password2' => 'Confirm Password',
			'fullname' => 'Fullname',
			'phone' => 'Phone',
			'email' => 'Email',
			'registered_date' => 'Registered Date',
			'activekey' => 'Activekey',
			'active' => 'Active',
		);
	}
        
        public function validateUsername($attribute,$params) {
            $user = User::model()->find(array('select'=>'username','condition'=>'username=:username','params'=>array(':username'=>$this->$attribute)));
            if(!empty($user))
                $this->addError ($attribute, 'Tài khoản đã tồn tại');
        }
        
        public function validateEmail($attribute,$params) {
            $user = User::model()->find(array('select'=>'email','condition'=>'email=:email','params'=>array(':email'=>$this->$attribute)));
            if(!empty($user))
                $this->addError ($attribute, 'Email đã được dùng để đăng ký');
        }
        
        public function validatePhone($attribute,$params) {
            $user = User::model()->find(array('select'=>'phone','condition'=>'phone=:phone','params'=>array(':phone'=>$this->$attribute)));
            if(!empty($user))
                $this->addError ($attribute, 'Số điện thoại đã được dùng để đăng ký');
        }
}