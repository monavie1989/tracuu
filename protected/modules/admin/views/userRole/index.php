<?php
/* @var $this UserRoleController */
/* @var $model UserAuth */

$this->breadcrumbs=array(
	'User Auths'=>array('index'),
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
            'itemsCssClass'=>'aui  aui-table-sortable aui-table-interactive bb-list iterable pullrequest-list open',
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
        )); ?>
    </div>
</div>