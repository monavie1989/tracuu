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
class PostBase extends CActiveRecord
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

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_author, post_approved_user', 'numerical', 'integerOnly'=>true),
			array('post_title, post_name, post_guild', 'length', 'max'=>255),
			array('post_status', 'length', 'max'=>20),
			array('post_date, post_content_head, post_content_body, post_content_foot, post_approved', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('post_ID, post_author, post_date, post_content_head, post_content_body, post_content_foot, post_title, post_status, post_name, post_guild, post_approved_user, post_approved', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'post_ID' => 'Post',
			'post_author' => 'Post Author',
			'post_date' => 'Post Date',
			'post_content_head' => 'Post Content Head',
			'post_content_body' => 'Post Content Body',
			'post_content_foot' => 'Post Content Foot',
			'post_title' => 'Post Title',
			'post_status' => 'Post Status',
			'post_name' => 'Post Name',
			'post_guild' => 'Post Guild',
			'post_approved_user' => 'Post Approved User',
			'post_approved' => 'Post Approved',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('post_ID',$this->post_ID,true);
		$criteria->compare('post_author',$this->post_author);
		$criteria->compare('post_date',$this->post_date,true);
		$criteria->compare('post_content_head',$this->post_content_head,true);
		$criteria->compare('post_content_body',$this->post_content_body,true);
		$criteria->compare('post_content_foot',$this->post_content_foot,true);
		$criteria->compare('post_title',$this->post_title,true);
		$criteria->compare('post_status',$this->post_status,true);
		$criteria->compare('post_name',$this->post_name,true);
		$criteria->compare('post_guild',$this->post_guild,true);
		$criteria->compare('post_approved_user',$this->post_approved_user);
		$criteria->compare('post_approved',$this->post_approved,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}