<?php

/**
 * This is the model class for table "tbl_user_auth".
 *
 * The followings are the available columns in table 'tbl_user_auth':
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $bizrule
 * @property string $data
 * @property integer $ordering
 * @property integer $status
 */
class UserAuth extends UserAuthBase
{
    /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return UserAuth the static model class
        */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    protected function afterDelete() {
        // code modify insert here
        foreach (UserAuthDetail::model()->findAllByAttributes(array('userauth_id'=>$this->id)) as $item) {
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