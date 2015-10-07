<?php

/**
 * This is the model class for table "tbl_comments".
 *
 * The followings are the available columns in table 'tbl_comments':
 * @property string $comment_id
 * @property string $comment_post_id
 * @property string $comment_user_id
 * @property string $comment_author_name
 * @property string $comment_author_email
 * @property string $comment_date
 * @property string $comment_subject
 * @property string $comment_content
 * @property string $comment_type
 * @property string $comment_parent
 */
class Comments extends CommentsBase {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comments the static model class
     */
    public function attributeLabels() {
        return array(
            'comment_id' => 'Bình Luận',
            'comment_post_id' => 'Comment Post',
            'comment_user_id' => 'Comment User',
            'comment_author_name' => 'Comment Author Name',
            'comment_author_email' => 'Comment Author Email',
            'comment_date' => 'Comment Date',
            'comment_subject' => 'Tiêu đề:',
            'comment_content' => 'Nội dung:',
            'comment_type' => 'Comment Type',
            'comment_parent' => 'Comment Parent',
        );
    }

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
