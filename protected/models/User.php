<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $registered
 * @property string $lastvisited
 * @property string $activekey
 * @property string $role
 * @property integer $status
 */
class User extends UserBase {

    public $o_password;
    public $n_password;
    public $n_password_re;
    public $roles = false;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserBase the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
            'o_password' => 'Mật khẩu cũ',
            'n_password' => 'Mật khẩu mới',
            'n_password_re' => 'Xác nhận Mật khẩu mới',
            'email' => 'Email',
            'registered' => 'Ngày đăng ký',
            'lastvisited' => 'Lần đăng nhập cuối',
            'activekey' => 'Mã kích hoạt',
            'role' => 'Quyền',
            'status' => 'Trạng thái',
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('o_password, n_password, n_password_re', 'required', 'on' => 'changepass'),
            array('n_password_re', 'compare', 'compareAttribute' => 'n_password', 'on' => 'changepass'),
            array('o_password', 'compare', 'compareAttribute' => 'password', 'on' => 'changepass'),
            array('username, password, email', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('username', 'length', 'max' => 50),
            array('password', 'length', 'max' => 64),
            array('email, activekey, role', 'length', 'max' => 255),
            array('registered, lastvisited', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, email, registered, lastvisited, activekey, role, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'profile' => array(self::BELONGS_TO, 'Profile', 'id'),
        );
    }
    
    public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
                $criteria->compare('email',$this->username,true,'OR');
		$criteria->compare('password',$this->password,true);
		$criteria->compare('registered',$this->registered,true);
		$criteria->compare('lastvisited',$this->lastvisited,true);
		$criteria->compare('activekey',$this->activekey,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('status',$this->status);
        $criteria->compare('lastvisited', $this->lastvisited, true);
        $criteria->compare('activekey', $this->activekey, true);
        if (!empty($this->role)) {
            $criteria->compare('role', $this->role, true);
        } elseif (!empty($this->roles)) {
            $criteria->addInCondition('role', $this->roles);
        }
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
