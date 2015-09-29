<?php

/**
 * This is the model class for table "tbl_category".
 *
 * The followings are the available columns in table 'tbl_category':
 * @property integer $category_id
 * @property string $category_name
 * @property string $category_description
 * @property string $category_slug
 * @property integer $category_parent
 * @property integer $category_order
 * @property integer $category_count
 */
class CategoryBase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return 'tbl_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_parent, category_order, category_count', 'numerical', 'integerOnly'=>true),
			array('category_name, category_slug', 'length', 'max'=>255),
			array('category_description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('category_id, category_name, category_description, category_slug, category_parent, category_order, category_count', 'safe', 'on'=>'search'),
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
			'category_id' => 'Category',
			'category_name' => 'Category Name',
			'category_description' => 'Category Description',
			'category_slug' => 'Category Slug',
			'category_parent' => 'Category Parent',
			'category_order' => 'Category Order',
			'category_count' => 'Category Count',
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

		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('category_name',$this->category_name,true);
		$criteria->compare('category_description',$this->category_description,true);
		$criteria->compare('category_slug',$this->category_slug,true);
		$criteria->compare('category_parent',$this->category_parent);
		$criteria->compare('category_order',$this->category_order);
		$criteria->compare('category_count',$this->category_count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}