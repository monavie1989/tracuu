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
class Post extends PostBase {

    public $category_name;
    public $author_name;
    public $approved_name;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function attributeLabels() {
        return array(
            'post_ID' => 'Post',
            'post_author' => 'Tác giả',
            'author_name' => 'Tác giả',
            'post_date' => 'Ngày tạo',
            'post_content_head' => 'Nội dung mở đầu',
            'post_content_body' => 'Nội dung chính',
            'post_content_foot' => 'Nội dung kết thúc',
            'post_title' => 'Tiêu đề',
            'post_category' => 'Chuyên mục',
            'category_name' => 'Chuyên mục',
            'post_status' => 'Trạng thái',
            'post_name' => 'Tên',
            'post_guild' => 'Post Guild',
            'post_approved_user' => 'Người duyệt',
            'approved_name' => 'Người duyệt',
            'post_approved' => 'Ngày duyệt',
        );
    }

    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->select = '`t`.*,`c`.`category_name`,`u1`.username as `author_name`, `u2`.username as approved_name';
        $criteria->join = '
            LEFT JOIN tbl_category `c` ON `t`.post_category = `c`.category_id 
            LEFT JOIN tbl_user u1 ON `t`.post_author = u1.id
            LEFT JOIN tbl_user u2 ON `t`.post_approved_user = u2.id';
        $criteria->compare('`c`.category_name', $this->category_name, true);
        $criteria->compare('`u1`.username', $this->author_name, true);
        $criteria->compare('`u2`.username', $this->approved_name, true);

        $criteria->compare('post_ID', $this->post_ID, true);
        $criteria->compare('post_author', $this->post_author);
        $criteria->compare('post_date', $this->post_date, true);
        $criteria->compare('post_content_head', $this->post_content_head, true);
        $criteria->compare('post_content_body', $this->post_content_body, true);
        $criteria->compare('post_content_foot', $this->post_content_foot, true);
        $criteria->compare('post_title', $this->post_title, true);
        $criteria->compare('post_category', $this->post_category);
        $criteria->compare('post_status', $this->post_status, true);
        $criteria->compare('post_name', $this->post_name, true);
        $criteria->compare('post_guild', $this->post_guild, true);
        $criteria->compare('post_approved_user', $this->post_approved_user);
        $criteria->compare('post_approved', $this->post_approved, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => '`t`.post_date DESC',
                'sortVar' => 'Sort_by',
                'attributes' => array(
                    'category_name' => array(
                        'asc' => '`c`.category_name',
                        'desc' => '`c`.category_name DESC',
                    ),
                    'author_name' => array(
                        'asc' => '`u1`.username',
                        'desc' => '`u1`.username DESC',
                    ),
                    'approved_name' => array(
                        'asc' => '`u2`.username',
                        'desc' => '`u2`.username DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }

    public function beforeFind() {
        $criteria = new CDbCriteria;
        $criteria->select = '`t`.*,`c`.`category_name`,`u1`.username as `author_name`, `u2`.username as approved_name';
        $criteria->join = '
            LEFT JOIN tbl_category `c` ON `t`.post_category = `c`.category_id 
            LEFT JOIN tbl_user u1 ON `t`.post_author = u1.id
            LEFT JOIN tbl_user u2 ON `t`.post_approved_user = u2.id';
        $this->dbCriteria->mergeWith($criteria);
        // code modify insert here
        return parent::afterFind();
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
