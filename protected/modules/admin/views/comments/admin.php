<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Quản lý Bình luận</h3>
		<?php
		$this->breadcrumbs=array(
			'Bình luận'=>array('index'),
			'Danh sách',
		);
		Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#comments-grid').yiiGridView('update', {
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
					'id'=>'comments-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
					'comment_id',
		'comment_post_id',
		'comment_user_id',
		'comment_author_name',
		'comment_author_email',
		'comment_date',
		/*
		'comment_subject',
		'comment_content',
		'comment_type',
		'comment_parent',
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