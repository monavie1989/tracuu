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
class UserBase extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, phone, email', 'required'),
            array('category_id, status', 'numerical', 'integerOnly'=>true),
            array('username', 'length', 'max'=>50),
            array('password, email, activekey, role', 'length', 'max'=>255),
            array('phone', 'length', 'max'=>12),
            array('registered, lastvisited', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, phone, email, registered, lastvisited, activekey, category_id, role, status', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'phone' => 'Phone',
            'email' => 'Email',
            'registered' => 'Registered',
            'lastvisited' => 'Lastvisited',
            'activekey' => 'Activekey',
            'category_id' => 'Category',
            'role' => 'Role',
            'status' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('registered',$this->registered,true);
        $criteria->compare('lastvisited',$this->lastvisited,true);
        $criteria->compare('activekey',$this->activekey,true);
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('role',$this->role,true);
        $criteria->compare('status',$this->status);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 