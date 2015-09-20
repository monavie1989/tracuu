<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);
$this->menu=array(
	array('label'=>'<span class="aui-icon aui-icon-small aui-iconfont-add"></span> Thêm mới', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="aui-group">
    <div class="aui-item" id="commit-list-container" data-changesets-limited="">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'user-grid',
            'dataProvider'=>$model->search(),
            'rowCssClass'=>array('iterable-item'),
            'itemsCssClass'=>'aui aui-table-interactive bb-list iterable pullrequest-list open',
            'columns'=>array(
                'username',
                array(
                    'name'=>'role',
                    'header'=>'Nhóm quyền',
                    'value'=>array($model,'renderRoleName')
                ),
                'email',
                'registered_date',
                array(
                    'name'=>'last_visited_date',
                    'value'=>function($data,$row){
                        return $data->last_visited_date?$data->last_visited_date:'Chưa đăng nhập';
                    }
                ),
                /*
                'last_visited_date',
                'activekey',
                'active',
                'status',
                */
                array(
                        'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </div>
</div>