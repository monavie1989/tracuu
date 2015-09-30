<?php

/**
 * This is the model class for table "tbl_post".
 *
 * The followings are the available columns in table 'tbl_post':
 * @property string $post_ID
 * @property integer $post_author
 * @property string $post_date
 * @property string $post_content_head
 * @property string $post_content_body
 * @property string $post_content_foot
 * @property string $post_title
 * @property string $post_status
 * @property string $post_name
 * @property string $post_guild
 * @property integer $post_approved_user
 * @property string $post_approved
 */
class Post extends PostBase
{
    /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Post the static model class
        */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    protected function afterDelete() {
        // code modify insert here
        foreach (PostDetail::model()->findAllByAttributes(array('post_id'=>$this->id)) as $item) {
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