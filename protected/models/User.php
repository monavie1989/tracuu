<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $phone
 * @property string $email
 * @property string $registered
 * @property string $lastvisited
 * @property string $activekey
 * @property integer $category_id
 * @property string $role
 * @property integer $status
 */
class User extends UserBase {

    public $o_password;
    public $n_password;
    public $n_password_re;
    public $roles = false;
    public $category_name;

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
            'phone' => 'Số điện thoại',
            'category_id' => 'Chuyên mục',
            'category_name' => 'Chuyên mục',
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
            array('n_password_re', 'compare', 'compareAttribute' => 'n_password', 'on' => 'changepass', 'message' => '{attribute} không đúng.'),
            array('o_password', 'compare', 'compareAttribute' => 'password', 'on' => 'changepass', 'message' => '{attribute} không đúng.'),
            array('username, password, phone, email', 'required'),
            array('phone', 'validatePhone'),
            array('category_id, status', 'numerical', 'integerOnly' => true),
            array('username', 'length', 'max' => 50),
            array('password, email, activekey, role', 'length', 'max' => 255),
            array('phone', 'length', 'max' => 12),
            array('registered, lastvisited', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, phone, email, registered, lastvisited, activekey, category_id, role, status', 'safe', 'on' => 'search'),
        );
    }

    public function validatePhone($attribute, $params) {
        if ($this->isNewRecord) {
            $user = User::model()->find(array('select' => 'phone', 'condition' => 'phone=:phone', 'params' => array(':phone' => $this->$attribute)));
        } else {
            $user = User::model()->find(array('select' => 'phone', 'condition' => 'phone=:phone and id != ' . $this->id, 'params' => array(':phone' => $this->$attribute)));
        }
        if (!empty($user))
            $this->addError($attribute, 'Số điện thoại đã được dùng để đăng ký');
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'profile' => array(self::BELONGS_TO, 'Profile', 'id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
        );
    }

    public function validateUsername($attribute, $params) {
        $user = User::model()->find(array('select' => 'username', 'condition' => 'username=:username', 'params' => array(':username' => $this->$attribute)));
        if (!empty($user))
            $this->addError($attribute, 'Tài khoản đã tồn tại');
    }

    public function validateEmail($attribute, $params) {
        $user = User::model()->find(array('select' => 'email', 'condition' => 'email=:email', 'params' => array(':email' => $this->$attribute)));
        if (!empty($user))
            $this->addError($attribute, 'Email đã được dùng để đăng ký');
    }

    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->select = '`t`.*,`c`.`category_name`';
        $criteria->join = '
            LEFT JOIN tbl_category `c` ON `t`.category_id = `c`.category_id';
        $criteria->compare('`c`.category_name', $this->category_name, true);
        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('registered',$this->registered,true);
        $criteria->compare('lastvisited',$this->lastvisited,true);
        $criteria->compare('activekey',$this->activekey,true);
        $criteria->compare('t.category_id',$this->category_id);
        $criteria->compare('role',$this->role,true);
        $criteria->compare('status',$this->status);
        if (!empty($this->role)) {
            $criteria->compare('role', $this->role, true);
        } elseif (!empty($this->roles)) {
            $criteria->addInCondition('role', $this->roles);
        }
        $criteria->compare('status', $this->status);
//        if(Yii::app()->user->role === 'moderator') {
//            $command = Yii::app()->db->createCommand('SELECT id FROM tbl_user WHERE
//                id NOT IN (SELECT DISTINCT user_id FROM tbl_category_user)
//                OR id IN (SELECT user_id FROM tbl_category_user WHERE category_id IN (SELECT category_id FROM tbl_category_user WHERE user_id = '.Yii::app()->user->id.'))');
//            //$result = $command->queryAll();
//            //var_dump(CHtml::listData($command->queryAll(), 'id', 'id'));
//            $criteria->addInCondition('id', CHtml::listData($command->queryAll(), 'id', 'id'));
//        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => '`t`.registered DESC',
                'sortVar' => 'Sort_by',
                'attributes' => array(
                    'category_name' => array(
                        'asc' => '`c`.category_name',
                        'desc' => '`c`.category_name DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }

}
