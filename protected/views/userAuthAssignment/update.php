<?php
/* @var $this UserAuthAssignmentController */
/* @var $model UserAuthAssignment */

$this->breadcrumbs=array(
	'User Auth Assignments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserAuthAssignment', 'url'=>array('index')),
	array('label'=>'Create UserAuthAssignment', 'url'=>array('create')),
	array('label'=>'View UserAuthAssignment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserAuthAssignment', 'url'=>array('admin')),
);
?>

<h1>Update UserAuthAssignment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>