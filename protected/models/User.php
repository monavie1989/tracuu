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
        
        public function renderRoleName($data, $row) {
            $role = UserAuth::model()->find(array('select'=>'title','condition'=>'name=:name','params'=>array(':name'=>$data->role)));
            return $role->title;
        }
        
        public function search()
	{
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id);
            $criteria->compare('role',$this->role,true);                
            $criteria->compare('email',$this->username,true);
            $criteria->compare('username',$this->username,true,'OR');
            $criteria->compare('password',$this->password,true);
            $criteria->compare('registered_date',$this->registered_date,true);
            $criteria->compare('last_visited_date',$this->last_visited_date,true);
            $criteria->compare('activekey',$this->activekey,true);
            $criteria->compare('active',$this->active);
            $criteria->compare('status',$this->status);
            
            $display_role = Yii::app()->params['display_role'];
            $role_type = Yii::app()->user->role_type;
            $cri = new CDbCriteria();
            $cri->select = 'type,name';
            $cri->addInCondition('type', $display_role[$role_type]);
            $role = CHtml::listData(UserAuth::model()->findAll($cri),'name','name');
            //ar_dump(UserAuth::model()->findAll($cri));
            $criteria->addInCondition('role', $role);
                //elseif($type === 'task')
                    //$criteria->addInCondition ('type', array(5,6,7,8));

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
	}
}
