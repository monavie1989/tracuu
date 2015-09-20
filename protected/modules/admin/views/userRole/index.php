<?php
/* @var $this UserRoleController */
/* @var $model UserAuth */

$this->breadcrumbs=array(
	'User Auths'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-auth-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Auths</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="aui-group">
    <div class="aui-item" id="commit-list-container" data-changesets-limited="">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'user-auth-grid',
            'dataProvider'=>$model->search(),
            'rowCssClass'=>array('iterable-item'),
            'itemsCssClass'=>'aui aui-table-interactive bb-list iterable pullrequest-list open',
            'columns'=>array(
                'title',
                array(
                    'name'=>'type',
                    'value'=> array($model,'renderRoleGroup')
                ),
                'description',
                /*
                'data',
                'ordering',
                'status',
                */
                array(
                        'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </div>
</div>