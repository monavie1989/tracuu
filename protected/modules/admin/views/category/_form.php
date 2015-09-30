<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
<div class="formSep">
	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'category_name'); ?>
			<?php echo $form->textField($model,'category_name',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
			<?php echo $form->error($model,'category_name'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<?php echo $form->labelEx($model,'category_description'); ?>
			<?php echo $form->textArea($model,'category_description',array('rows'=>6, 'cols'=>50, 'class'=>'text_editor')); ?>
			<?php echo $form->error($model,'category_description'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'category_slug'); ?>
			<?php echo $form->textField($model,'category_slug',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
			<?php echo $form->error($model,'category_slug'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'category_parent'); ?>
			<?php echo $form->textField($model,'category_parent', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'category_parent'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'category_order'); ?>
			<?php echo $form->textField($model,'category_order', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'category_order'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'category_count'); ?>
			<?php echo $form->textField($model,'category_count', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'category_count'); ?>
		</div>
	</div>

</div><!-- form -->
<div class="form-actions">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật',array('class'=>'btn btn-inverse')); ?>
</div>

<?php $this->endWidget(); ?>
