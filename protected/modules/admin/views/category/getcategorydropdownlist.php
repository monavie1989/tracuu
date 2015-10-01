<?php

$common = new Common;
echo CActiveForm::dropDownList($modelUpdate, 'category_parent', $common->getArrayCategories(Category::model()->findAll(), 'category_id', 'category_name'), array('prompt' => '-- Chọn Danh mục --'));
?>