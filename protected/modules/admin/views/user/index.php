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
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="search-form">
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
            'itemsCssClass'=>'aui aui-table-sortable aui-table-interactive',
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
                    'viewButtonUrl'=>'$this->grid->controller->createUrl("/admin/user/profile", array("id"=>$data->id))',
                    'htmlOptions'=>array('style'=>'width:100px;text-align:right;'),
                ),
            ),
            'pagerCssClass'=>'paging pull-right',
            'pager'=>array(
                'header' => false,
                'internalPageCssClass'=>'',
                'firstPageCssClass'=>'',
                'firstPageLabel'=>'<<',
                'lastPageCssClass'=>'',
                'lastPageLabel'=>'>>',
                'nextPageCssClass'=>'next',
                'nextPageLabel'=>'>',
                'prevPageLabel'=>'<',
                'previousPageCssClass'=>'previous',
                'selectedPageCssClass'=>'active',
                'htmlOptions'=>array('class'=>'pagination'),
            )
        )); ?>
    </div>
</div>