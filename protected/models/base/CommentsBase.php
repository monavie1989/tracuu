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
class CommentsBase extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comments the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_comments';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('comment_author_name, comment_subject, comment_content', 'required'),
            array('comment_post_id, comment_user_id, comment_type, comment_parent', 'length', 'max' => 20),
            array('comment_author_email', 'length', 'max' => 100),
            array('comment_subject', 'length', 'max' => 255),
            array('comment_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('comment_id, comment_post_id, comment_user_id, comment_author_name, comment_author_email, comment_date, comment_subject, comment_content, comment_type, comment_parent', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'comment_id' => 'Comment',
            'comment_post_id' => 'Comment Post',
            'comment_user_id' => 'Comment User',
            'comment_author_name' => 'Comment Author Name',
            'comment_author_email' => 'Comment Author Email',
            'comment_date' => 'Comment Date',
            'comment_subject' => 'Comment Subject',
            'comment_content' => 'Comment Content',
            'comment_type' => 'Comment Type',
            'comment_parent' => 'Comment Parent',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('comment_id', $this->comment_id, true);
        $criteria->compare('comment_post_id', $this->comment_post_id, true);
        $criteria->compare('comment_user_id', $this->comment_user_id, true);
        $criteria->compare('comment_author_name', $this->comment_author_name, true);
        $criteria->compare('comment_author_email', $this->comment_author_email, true);
        $criteria->compare('comment_date', $this->comment_date, true);
        $criteria->compare('comment_subject', $this->comment_subject, true);
        $criteria->compare('comment_content', $this->comment_content, true);
        $criteria->compare('comment_type', $this->comment_type, true);
        $criteria->compare('comment_parent', $this->comment_parent, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
