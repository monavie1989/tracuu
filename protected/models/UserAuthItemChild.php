<?php

/**
 * This is the model class for table "tbl_user_auth_item_child".
 *
 * The followings are the available columns in table 'tbl_user_auth_item_child':
 * @property integer $id
 * @property string $parent
 * @property string $child
 */
class UserAuthItemChild extends UserAuthItemChildBase
{
    /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return UserAuthItemChild the static model class
        */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    protected function afterDelete() {
        // code modify insert here
        foreach (UserAuthItemChildDetail::model()->findAllByAttributes(array('userauthitemchild_id'=>$this->id)) as $item) {
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