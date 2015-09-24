<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->fullname,
);

$this->menu=array(
    array('label'=>'Danh sách người dùng', 'url'=>array('index')),
    array('label'=>'Thêm mới người dùng', 'url'=>array('create')),
    array('label'=>'Cập nhật thông tin', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Xóa người dùng', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                'fullname',
		'username',
                'role',
		'email',
		'registered_date',
		'last_visited_date',
		'active',
	),
)); ?>
