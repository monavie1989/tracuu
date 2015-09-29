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
        return parent::afterDelete();
    }
    public function beforeSave() {
        // code modify insert here
        return parent::beforeSave();
    }
    public function afterFind() {
        // code modify insert here

        return parent::afterFind();
    }
    
    public function search($type='role')
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('type',$this->type);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('bizrule',$this->bizrule,true);
        $criteria->compare('data',$this->data,true);
        $criteria->compare('ordering',$this->ordering);
        $criteria->compare('status',$this->status);
        $display_role = Yii::app()->params['display_role'];
        $role_type = Yii::app()->user->role_type;
        //if (!empty($display_role[$role_type]) && is_array($display_role[$role_type])) {
            if($type === 'role')
                $criteria->addInCondition('type', $display_role[$role_type]);
            elseif($type === 'task')
                $criteria->addInCondition ('type', array(5,6,7,8));
        //}
        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
        ));
    }
    
    public function checkTask($name) {
        return $this->findByAttributes(array('name'=>$name));
    }
    
    public function addTask($name, $type) {
        //Nếu task chưa tồn tại trong bảng tbl_user_auth
        if(empty($this->checkTask($name))) {
            $command = Yii::app()->db->createCommand();
            $rs = $command->insert('tbl_user_auth', array('name'=>$name,'type'=>$type,'title'=>$name));
            if($rs)
                return true;
        }
        return false;
    }
    
    public function addRelationTask($parent, $child ) {
        if(!empty($this->checkTask($parent)) && !empty($this->checkTask($child))) {
            //Kiểm tra xem đã tồn tại cặp parent - child chưa
            $checkParentChild = UserAuthItemChild::model()->findByAttributes(array('parent'=>$parent,'child'=>$child));
            if(empty($checkParentChild)) {
                $command = Yii::app()->db->createCommand();
                $rs = $command->insert('tbl_user_auth_item_child', array('parent'=>$parent,'child'=>$child));
                if($rs)
                    return true;
            }
        }
        return false;
    }
    
    public function renderRoleGroup($data,$row) {
        $group = '';
        switch ($data->type) {
            case 0:
                $group = 'Super User';
                break;
            case 1:
                $group = 'Administrator';
                break;
            case 2:
                $group = 'Modertator';
                break;
            case 3:
                $group = 'Publisher & Author';
                break;
            case 4:
                $group = 'Member';
                break;
            case 5:
                $group = 'Module';
                break;
            case 6:
                $group = 'Controller';
                break;
            case 7:
                $group = 'Action';
                break;
            default :
                $group = 'Other';
                break;
        }
        return $group;
    }
    
    public function getParentRole() {
        $group = '';
        switch ($this->type) {
            case 0:
                $group = 'Super User';
                break;
            case 1:
                $group = 'Administrator';
                break;
            case 2:
                $group = 'Modertator';
                break;
            case 3:
                $group = 'Publisher & Author';
                break;
            case 4:
                $group = 'Member';
                break;
            default :
                $group = 'Other';
                break;
        }
        return $group;
    }
}