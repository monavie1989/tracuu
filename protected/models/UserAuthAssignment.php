<?php

/**
 * This is the model class for table "tbl_user_auth_assignment".
 *
 * The followings are the available columns in table 'tbl_user_auth_assignment':
 * @property integer $id
 * @property string $itemname
 * @property string $userid
 * @property string $bizrule
 * @property string $data
 */
class UserAuthAssignment extends UserAuthAssignmentBase
{
    /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return UserAuthAssignment the static model class
        */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    protected function afterDelete() {
        // code modify insert here
        foreach (UserAuthAssignmentDetail::model()->findAllByAttributes(array('userauthassignment_id'=>$this->id)) as $item) {
            $item->delete();
        }
        return parent::afterDelete();
    }
    public function beforeSave() {
        // code modify insert here
        if ($this->isNewRecord)
            $this->create_date = new CDbExpression('NOW()');
        else
            $this->modified_date = new CDbExpression('NOW()');
        return parent::beforeSave();
    }
    public function afterFind() {
        // code modify insert here

        return parent::afterFind();
    }
    
    
}