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
		$('.search-form-binhpv form').submit(function(){
			$('#post-grid').yiiGridView('update', {
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
            'id' => 'post-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                array(
                    'name' => 'post_title',
                    'htmlOptions' => array(
                        'class' => 'post_title',
                    ),
                ),
                array(
                    'name' => 'category_name',
                    'htmlOptions' => array(
                        'class' => 'span2',
                    ),
                ),
                array(
                    'name' => 'approved_name',
                    'htmlOptions' => array(
                        'class' => 'span2',
                    ),
                ),
                array(
                    'name' => 'post_date',
                    'htmlOptions' => array(
                        'class' => 'span1 center',
                    ),
                ),
                array(
                    'name' => 'post_approved',
                    'htmlOptions' => array(
                        'class' => 'span1 center',
                    ),
                ),
                array(
                    'name' => 'post_status',
                    'htmlOptions' => array(
                        'class' => 'span1 center',
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{update}{delete}'
                ),
            ),
        ));
        ?>
    </div>
</div>