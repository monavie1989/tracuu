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
class User extends UserBase
{
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
