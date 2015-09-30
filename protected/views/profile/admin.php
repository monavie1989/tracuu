<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Quản lý Thông tin Cá Nhân</h3>
		<?php
		$this->breadcrumbs=array(
			'Thông tin Cá Nhân'=>array('index'),
			'Danh sách',
		);
		Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#profile-grid').yiiGridView('update', {
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
					'id'=>'profile-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
					'user_id',
		'fname',
		'lname',
		'gender',
		'birthday',
							array(
								'class' => 'CButtonColumn',
								'template' => '{update}{delete}'
							),
					),
			)); 
		?>
	</div>
</div>