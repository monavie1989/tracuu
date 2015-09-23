<?php
/* @var $this UserAuthAssignmentController */
/* @var $model UserAuthAssignment */

$this->breadcrumbs=array(
	'User Auth Assignments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserAuthAssignment', 'url'=>array('index')),
	array('label'=>'Manage UserAuthAssignment', 'url'=>array('admin')),
);
?>

<h1>Create UserAuthAssignment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>