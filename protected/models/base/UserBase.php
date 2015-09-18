<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $role
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $registered_date
 * @property string $last_visited_date
 * @property string $activekey
 * @property integer $active
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
			array('role, username, password, email', 'required'),
			array('active, status', 'numerical', 'integerOnly'=>true),
			array('role', 'length', 'max'=>255),
			array('username', 'length', 'max'=>50),
			array('password', 'length', 'max'=>64),
			array('email', 'length', 'max'=>100),
			array('activekey', 'length', 'max'=>32),
			array('registered_date, last_visited_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, role, username, password, email, registered_date, last_visited_date, activekey, active, status', 'safe', 'on'=>'search'),
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
			'role' => 'Role',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'registered_date' => 'Registered Date',
			'last_visited_date' => 'Last Visited Date',
			'activekey' => 'Activekey',
			'active' => 'Active',
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
		$criteria->compare('role',$this->role,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('registered_date',$this->registered_date,true);
		$criteria->compare('last_visited_date',$this->last_visited_date,true);
		$criteria->compare('activekey',$this->activekey,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}