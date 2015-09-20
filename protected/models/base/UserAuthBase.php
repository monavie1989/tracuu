<?php

/**
 * This is the model class for table "tbl_user_auth".
 *
 * The followings are the available columns in table 'tbl_user_auth':
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $bizrule
 * @property string $data
 * @property integer $ordering
 * @property integer $status
 */
class UserAuthBase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserAuth the static model class
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
		return 'tbl_user_auth';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name, title', 'required'),
			array('type, ordering, status', 'numerical', 'integerOnly'=>true),
			array('name, title', 'length', 'max'=>64),
			array('description, bizrule, data', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, name, title, description, bizrule, data, ordering, status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'type' => 'Role Group',
			'name' => 'Name',
			'title' => 'Title',
			'description' => 'Description',
			'bizrule' => 'Bizrule',
			'data' => 'Data',
			'ordering' => 'Ordering',
			'status' => 'Status',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('bizrule',$this->bizrule,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}