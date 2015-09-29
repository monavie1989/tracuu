<?php

/**
 * This is the model class for table "tbl_tag".
 *
 * The followings are the available columns in table 'tbl_tag':
 * @property integer $tag_id
 * @property string $tag_name
 * @property string $tag_description
 * @property string $tag_slug
 * @property integer $tag_parent
 * @property integer $tag_order
 * @property integer $tag_count
 */
class Tag extends TagBase
{
    /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Tag the static model class
        */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    protected function afterDelete() {
        // code modify insert here
        foreach (TagDetail::model()->findAllByAttributes(array('tag_id'=>$this->id)) as $item) {
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