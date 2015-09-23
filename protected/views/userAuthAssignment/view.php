<?php
/* @var $this UserAuthAssignmentController */
/* @var $model UserAuthAssignment */

$this->breadcrumbs=array(
	'User Auth Assignments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserAuthAssignment', 'url'=>array('index')),
	array('label'=>'Create UserAuthAssignment', 'url'=>array('create')),
	array('label'=>'Update UserAuthAssignment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserAuthAssignment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserAuthAssignment', 'url'=>array('admin')),
);
?>

<h1>View UserAuthAssignment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'itemname',
		'userid',
		'bizrule',
		'data',
	),
)); ?>
