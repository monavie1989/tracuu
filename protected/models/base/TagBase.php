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
class TagBase extends CActiveRecord
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

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag_parent, tag_order, tag_count', 'numerical', 'integerOnly'=>true),
			array('tag_name, tag_slug', 'length', 'max'=>255),
			array('tag_description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tag_id, tag_name, tag_description, tag_slug, tag_parent, tag_order, tag_count', 'safe', 'on'=>'search'),
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
			'tag_id' => 'Tag',
			'tag_name' => 'Tag Name',
			'tag_description' => 'Tag Description',
			'tag_slug' => 'Tag Slug',
			'tag_parent' => 'Tag Parent',
			'tag_order' => 'Tag Order',
			'tag_count' => 'Tag Count',
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

		$criteria->compare('tag_id',$this->tag_id);
		$criteria->compare('tag_name',$this->tag_name,true);
		$criteria->compare('tag_description',$this->tag_description,true);
		$criteria->compare('tag_slug',$this->tag_slug,true);
		$criteria->compare('tag_parent',$this->tag_parent);
		$criteria->compare('tag_order',$this->tag_order);
		$criteria->compare('tag_count',$this->tag_count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}