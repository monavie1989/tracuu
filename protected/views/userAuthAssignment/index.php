<?php
/* @var $this UserAuthAssignmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Auth Assignments',
);

$this->menu=array(
	array('label'=>'Create UserAuthAssignment', 'url'=>array('create')),
	array('label'=>'Manage UserAuthAssignment', 'url'=>array('admin')),
);
?>

<h1>User Auth Assignments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
