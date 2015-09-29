<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Quản lý Quản trị viên</h3>
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
		$('.search-form form').submit(function(){
			$('#user-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		});
		");
        ?>
        <?php echo CHtml::link('Tìm kiếm', '#', array('class' => 'btn search-button')); ?>
        <div class="search-form" style="display:none">
            <?php
            $this->renderPartial('_search', array(
                'model' => $model,
            ));
            ?>
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