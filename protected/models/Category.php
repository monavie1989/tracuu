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

    protected function afterDelete() {
        // code modify insert here
        foreach (CategoryDetail::model()->findAllByAttributes(array('category_id' => $this->id)) as $item) {
            $item->delete();
        }
        return parent::afterDelete();
    }

    public function beforeSave() {
        // code modify insert here
        if ($this->isNewRecord)
            $this->create_date = new CDbExpression('NOW()');
        else
            $this->modified_date = new CDbExpression('NOW()');
        return parent::beforeSave();
    }

    public function afterFind() {
        // code modify insert here

        return parent::afterFind();
    }

}
