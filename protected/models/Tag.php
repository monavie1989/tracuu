<?php

/**
 * This is the model class for table "tbl_tag".
 *
 * The followings are the available columns in table 'tbl_tag':
 * @property integer $tag_id
 * @property string $tag_name
 * @property string $tag_description
 * @property string $tag_slug
 * @property integer $tag_count
 */
class Tag extends TagBase
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
    public function attributeLabels()
	{
		return array(
			'tag_id' => 'Thẻ',
			'tag_name' => 'Thẻ',
			'tag_description' => 'Miêu tả',
			'tag_slug' => 'Slug',
			'tag_count' => 'Số bài viết',
		);
	}
    public function afterFind() {
        // code modify insert here

        return parent::afterFind();
    }
    
    
}