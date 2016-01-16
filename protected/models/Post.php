<?php

/**
 * This is the model class for table "tbl_post".
 *
 * The followings are the available columns in table 'tbl_post':
 * @property string $post_id
 * @property integer $post_author
 * @property string $post_date
 * @property string $post_content_head
 * @property string $post_content_body
 * @property string $post_content_foot
 * @property string $post_title
 * @property integer $post_category
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
    public $post_tag = array();
    public $old_post_tag = array();

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
            'post_id' => 'Post',
            'post_author' => 'Tác giả',
            'author_name' => 'Tác giả',
            'post_date' => 'Ngày tạo',
            'post_content_head' => 'Nội dung',
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

        $criteria->compare('post_id', $this->post_id, true);
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
    
    public function searchByKeyword($keyword = '', $page = 1) {
        $result = Yii::app()->db->createCommand()
                ->select('*, CONCAT(
                    CASE WHEN NOT ISNULL(post_content_head) THEN CONCAT("<div class=\'post_content_head\'>" ,post_content_head,"</div>") ELSE "" END
                    ,CASE WHEN NOT ISNULL(post_content_body) THEN CONCAT("<div class=\'post_content_body\'>",post_content_body,"</div>") ELSE "" END
                    ,CASE WHEN NOT ISNULL(post_content_foot) THEN CONCAT("<div class=\'post_content_foot\'>",post_content_foot,"</div>") ELSE "" END
                ) as post_content
                , MATCH(post_title, post_content_head) AGAINST(\'+'.$keyword.'\' IN NATURAL LANGUAGE MODE) as po')
                ->from('tbl_post')
                ->where('MATCH(post_title, post_content_head) AGAINST(\'+'.$keyword.'\' IN BOOLEAN MODE) OR MATCH(post_title, post_content_head) AGAINST(\'+'.$keyword.'\' IN NATURAL LANGUAGE MODE)')
                ->order('po DESC')
                ->limit((int)Yii::app()->params['defaultPageSize'],($page-1)*(int)Yii::app()->params['defaultPageSize'])
                ->queryAll();
        //$command->limit(2,0)->queryAll();
        return $result;
    }
    
    public function countByKeyword($keyword = '') {
        $sql = 'SELECT COUNT(*) AS postNumber FROM tbl_post WHERE MATCH(post_title, post_content_head) AGAINST(\'+'.$keyword.'\' IN BOOLEAN MODE)';
        $command = Yii::app()->db->createCommand($sql);
        $result = $command->queryRow();
        return $result['postNumber'];
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

    public function afterFind() {
        // code modify insert here
        $this->old_post_tag = $this->post_tag = Yii::app()->db->createCommand()
                ->select('tag_id')
                ->from('tbl_post_tag')
                ->where('post_id=:id', array(':id' => $this->post_id))
                ->queryColumn();
        return parent::afterFind();
    }

    protected function afterDelete() {
        // code modify insert here
        return parent::afterDelete();
    }

    public function beforeSave() {
        // code modify insert here
        $CDbCriteria = new CDbCriteria();
        if ($this->isNewRecord) {
            $this->post_date = new CDbExpression('NOW()');
            if (!empty(Yii::app()->user->role) && Yii::app()->user->role == 'author') {
                $this->post_author = Yii::app()->user->id;
                $this->post_category = Yii::app()->user->category_id;
            }
        } else {
            $CDbCriteria->condition = "post_id != " . $this->post_id;
        }
        $tmp = $post_name = Common::sanitize_title_with_dashes($this->post_title);
        $check_post_name = Post::model()->findByAttributes(array('post_name' => $post_name), $CDbCriteria);
        $i = 1;
        while ($check_post_name) {
            $post_name = $tmp . '-' . $i;
            $check_post_name = Post::model()->findByAttributes(array('post_name' => $post_name));
            $i++;
        }
        $this->post_name = $post_name;
        if ($this->post_status == 'Publish' || $this->post_status == 'Private') {
            if (!empty(Yii::app()->user->role) && Yii::app()->user->role == 'publisher') {
                if (empty($this->post_approved)) {
                    $this->post_approved = new CDbExpression('NOW()');
                }
                if (empty($this->post_approved_user)) {
                    $this->post_approved_user = Yii::app()->user->id;
                }
            }
        } else {
            $this->post_approved = NULL;
            $this->post_approved_user = 0;
        }

        return parent::beforeSave();
    }

    public function afterSave() {
        // code modify insert here
        $add = array_diff($this->post_tag, $this->old_post_tag);
        $del = array_diff($this->old_post_tag, $this->post_tag);
        foreach ($add as $key => $val) {
            $PostTag = new PostTag;
            $PostTag->post_id = $this->post_id;
            $PostTag->tag_id = $val;
            $PostTag->save();
        }
        foreach ($del as $key => $val) {
            PostTag::model()->deleteAllByAttributes(array('post_id' => $this->post_id, 'tag_id' => $val));
        }
        return parent::afterSave();
    }

}
