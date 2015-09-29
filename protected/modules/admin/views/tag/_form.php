<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tag-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
<div class="formSep">
	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'tag_name'); ?>
			<?php echo $form->textField($model,'tag_name',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
			<?php echo $form->error($model,'tag_name'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<?php echo $form->labelEx($model,'tag_description'); ?>
			<?php echo $form->textArea($model,'tag_description',array('rows'=>6, 'cols'=>50, 'class'=>'text_editor')); ?>
			<?php echo $form->error($model,'tag_description'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'tag_slug'); ?>
			<?php echo $form->textField($model,'tag_slug',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
			<?php echo $form->error($model,'tag_slug'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'tag_parent'); ?>
			<?php echo $form->textField($model,'tag_parent', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'tag_parent'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'tag_order'); ?>
			<?php echo $form->textField($model,'tag_order', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'tag_order'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'tag_count'); ?>
			<?php echo $form->textField($model,'tag_count', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'tag_count'); ?>
		</div>
	</div>

</div><!-- form -->
<div class="form-actions">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật',array('class'=>'btn btn-inverse')); ?>
</div>

<?php $this->endWidget(); ?>
