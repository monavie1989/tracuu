<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Quản lý Thẻ</h3>
		<?php
		$this->breadcrumbs=array(
			'Thẻ'=>array('index'),
			'Danh sách',
		);
		Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#tag-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		});
		");
		?>
		<?php echo CHtml::link('Tìm kiếm','#',array('class'=>'btn search-button')); ?>
		<div class="search-form" style="display:none">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->
		<?php
		$this->widget('application.classextends.CGridViewEx', array(
					'id'=>'tag-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
					'tag_id',
		'tag_name',
		'tag_description',
		'tag_slug',
		'tag_parent',
		'tag_order',
		/*
		'tag_count',
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