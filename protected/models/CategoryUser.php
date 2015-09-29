<?php

/**
 * This is the model class for table "tbl_category_user".
 *
 * The followings are the available columns in table 'tbl_category_user':
 * @property integer $ID
 * @property integer $category_id
 * @property integer $user_id
 */
class CategoryUser extends CategoryUserBase
{
    /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return CategoryUser the static model class
        */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }  
}