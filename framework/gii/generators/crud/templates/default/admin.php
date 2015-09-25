<?php 
	$label=$this->controllerLabel;
?>
<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Quản lý <?php echo $label;?></h3>
		<?php echo "<?php\n"; ?>
		<?php
		echo "\$this->breadcrumbs=array(
			'$label'=>array('index'),
			'Danh sách',
		);\n";
		?>
		Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#<?php echo $this->class2id($this->modelClass); ?>-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		});
		");
		<?php echo "?>\n"; ?>
		<?php echo "<?php echo CHtml::link('Tìm kiếm','#',array('class'=>'btn search-button')); ?>"; ?>

		<div class="search-form" style="display:none">
		<?php echo "<?php \$this->renderPartial('_search',array(
			'model'=>\$model,
		)); ?>\n"; ?>
		</div><!-- search-form -->
		<?php echo "<?php\n"; ?>
		$this->widget('application.classextends.CGridViewEx', array(
					'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
			<?php
			$count=0;
			foreach($this->tableSchema->columns as $column)
			{
					if(++$count==7)
							echo "\t\t/*\n";
					echo "\t\t'".$column->name."',\n";
			}
			if($count>=7)
					echo "\t\t*/\n";
			?>
							array(
								'class' => 'CButtonColumn',
								'template' => '{update}{delete}'
							),
					),
			)); 
		<?php echo "?>\n"; ?>
	</div>
</div>