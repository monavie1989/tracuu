<?php
/* @var $this TaskController */
/* @var $model UserAuth */

$this->breadcrumbs=array(
	'Quản lý quyền'=>array('index'),
	'Danh sách quyền',
);

$this->menu=array(
	array('label'=>'<span class="aui-icon aui-icon-small aui-iconfont-add"></span> Thêm mới', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$('#user-auth-grid').yiiGridView('update', {
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
            'id'=>'user-auth-grid',
            'dataProvider'=>$model->search($type),
            'rowCssClass'=>array('iterable-item'),
            'itemsCssClass'=>'aui aui-table-sortable aui-table-interactive',
            'enableHistory'=>FALSE,
            'columns'=>array(
                array(
                    'name'=>'title',
                    'header'=>'Tên nhóm',
                ),
                array(
                    'name'=>'type',
                    'header'=>'Nhóm cha',
                    'value'=> array($model,'renderRoleGroup'),
                ),
                array(
                    'name'=>'description',
                    'header'=>'Mô tả',
                ),
                /*
                'data',
                'ordering',
                'status',
                */
                array(
                    'class'=>'CButtonColumn',
                    'htmlOptions'=>array('style'=>'width:100px;text-align:right;'),
                    'afterDelete'=>'function(link,success,data){
                        if(success) {
                            AJS.flag({
                                type: \'success\',
                                title: \'Delete Successful.\',
                                persistent: false,
                                body: data
                            });
                        } else {
                            AJS.flag({
                                type: \'error\',
                                title: \'Delete not successful.\',
                                persistent: false,
                                body: JSON.stringify(data,[\'responseText\', \'statusText\'],\'<br/>\')
                            });
                            return false;
                        }
                    }',
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
