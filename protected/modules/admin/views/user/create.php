<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Quản lý người dùng'=>array('index'),
	'Tạo người dùng mới',
);

$this->menu=array(
	array('label'=>'Danh sách người dùng', 'url'=>array('index')),
);
?>

<h1>Create User</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>