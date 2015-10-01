<div class="row-fluid">
    <div class="span12">
        <div class="heading">
            <h3>Quản lý Quản trị viên</h3><a href="<?php echo Yii::app()->createUrl('admin/manager/create'); ?>" class="pull-right"><?php echo CHtml::submitButton('Thêm mới',array('class'=>'btn btn-primary','style'=>'top: 0; right:0; position: absolute;')); ?></a>
        </div>
		<?php
		$this->breadcrumbs=array(
			'Quản trị viên'=>array('index'),
			'Danh sách',
		);
		Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form-binhpv form').submit(function(){
			$('#user-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		});
		");
        ?>
        <div class="search-form-binhpv" style="position: absolute; right: 0;z-index: 1000;">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->
        <?php
        $this->widget('application.classextends.CGridViewEx', array(
            'id' => 'user-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'username',
                'email',
		'role',
                'registered',
                'lastvisited',
                array(
                    'name' => 'status',
                    'value' => 'Yii::app()->params["status"][$data->status]',
                    'htmlOptions' => array(
                        'class' => 'status',
                    )
                ),
                /*
                  'password',
                  'activekey',
                 */
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{update}{delete}'
                ),
            ),
        ));
        ?>
    </div>
</div>