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
class Category extends CategoryBase {

    public $category_parent_name;
    public $level = 1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function attributeLabels() {
        return array(
            'category_id' => 'Chuyên mục',
            'category_name' => 'Tên Chuyên mục',
            'category_description' => 'Miêu tả',
            'category_slug' => 'Slug',
            'category_parent' => 'Chuyên mục cha',
            'category_order' => 'Thứ tự',
            'category_count' => 'Số bài viết',
        );
    }

    public function afterFind() {
        // code modify insert here

        return parent::afterFind();
    }

    public static function getCategoryName($category_id) {
        $category = Category::model()->findByPk($category_id);
        if ($category) {
            return $category->category_name;
        }
        return "";
    }

}
