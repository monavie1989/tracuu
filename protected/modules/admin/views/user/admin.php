<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Quản lý Thành Viên</h3>
        <?php
        $this->breadcrumbs = array(
            'Thành Viên' => array('index'),
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
                'id',
                'role',
                'username',
                'password',
                'fullname',
                'phone',
                /*
                  'email',
                  'registered_date',
                  'last_visited_date',
                  'activekey',
                  'active',
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