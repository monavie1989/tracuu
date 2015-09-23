<?php
/* @var $this UserAuthAssignmentController */
/* @var $model UserAuthAssignment */

$this->breadcrumbs=array(
	'User Auth Assignments'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserAuthAssignment', 'url'=>array('index')),
	array('label'=>'Create UserAuthAssignment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-auth-assignment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Auth Assignments</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="aui-group">
    <div class="aui-item" id="commit-list-container" data-changesets-limited="">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'user-auth-assignment-grid',
                'dataProvider'=>$model->search(),
                'rowCssClass'=>array('iterable-item'),
                'itemsCssClass'=>'aui aui-table-interactive bb-list iterable pullrequest-list open',
                'columns'=>array(
        		'id',
		'itemname',
		'userid',
		'bizrule',
		'data',
                        array(
                                'class'=>'CButtonColumn',
                        ),
                ),
        )); ?>
    </div>
</div>
