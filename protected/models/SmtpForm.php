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
class SmtpForm extends CFormModel
{
        public $smtp_host;
        public $smtp_secure;
        public $smtp_port;
        public $smtp_auth;
        public $smtp_username;
        public $smtp_password;
        public $smtp_from_name;

        /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    array('smtp_host, smtp_secure, smtp_port, smtp_auth', 'required','message'=>'Trường thông tin {attribute} không được để trống.'),
                    array('smtp_username,smtp_password,smtp_from_name', 'safe'),
                    //array('smtp_username',),
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
			'smtp_host' => 'SMTP Host',
			'smtp_secure' => 'SMTP Secure',
			'smtp_port' => 'SMTP Port',
			'smtp_auth' => 'SMTP Authencation',
                        'smtp_username' => 'SMTP Username',
			'smtp_password' => 'SMTP Password',
			'smtp_from_name' => 'SMTP From Name',
		);
	}
}