<?php
/* @var $this TaskController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Auths',
);

$this->menu=array(
	array('label'=>'Create UserAuth', 'url'=>array('create')),
	array('label'=>'Manage UserAuth', 'url'=>array('admin')),
);
?>

<h1>User Auths</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
