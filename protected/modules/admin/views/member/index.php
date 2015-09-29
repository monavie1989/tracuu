<div class="row-fluid">
    <div class="span12">
        <div class="heading">
            <h3>Quản lý Thành Viên</h3><a href="<?php echo Yii::app()->createUrl('member/create'); ?>" class="pull-right"><?php echo CHtml::submitButton('Thêm mới',array('class'=>'btn btn-primary','style'=>'top: 0; right:0; position: absolute;')); ?></a>
        </div>
        <?php
        $this->breadcrumbs = array(
            'Thành Viên' => array('index'),
            'Danh sách',
        );
        Yii::app()->clientScript->registerScript('search', "
		$('.search-form-binhpv form').submit(function(){
			$('#user-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		});
		");
		?>
		<div class="search-form-binhpv" style="">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->
		<?php
		$this->widget('application.classextends.CGridViewEx', array(
                    'id'=>'user-grid',
                    'dataProvider'=>$model->search(),
                    'filter'=>$model,
                    'columns'=>array(
                        'id',
                        'username',
                        'password',
                        'email',
                        'registered',
                        'lastvisited',
                    /*
                    'activekey',
                    'role',
                    'status',
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