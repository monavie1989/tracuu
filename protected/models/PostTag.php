<?php

/**
 * This is the model class for table "tbl_post_tag".
 *
 * The followings are the available columns in table 'tbl_post_tag':
 * @property integer $ID
 * @property integer $post_id
 * @property integer $tag_id
 */
class PostTag extends PostTagBase {

    public static function model($className = __CLASS__) {
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

}
