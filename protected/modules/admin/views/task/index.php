<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Quản lý Thành Viên</h3>
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
$('.search-form-binhpv form').submit(function(){
	$('#user-auth-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="search-form-binhpv">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
        <?php $this->widget('application.classextends.CGridViewEx', array(
            'id'=>'user-auth-grid',
            'dataProvider'=>$model->search($type),
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
                ),
            ),
        )); ?>
    </div>
</div>
