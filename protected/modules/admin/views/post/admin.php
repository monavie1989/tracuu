<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Quản lý <?php echo $this->controllerLabel; ?></h3>
        <?php
        $this->breadcrumbs = array(
            $this->controllerLabel => array('index'),
            'Danh sách',
        );
        Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#post-grid').yiiGridView('update', {
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
            'id' => 'post-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'post_title',
                'post_author',
                'post_date',
                'post_status',
                'post_approved_user',
                'post_approved',
                /*
                  'post_content_head',
                  'post_content_body',
                  'post_content_foot',
                  'post_name',
                  'post_guild',
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