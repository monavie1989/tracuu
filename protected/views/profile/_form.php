<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
<div class="formSep">
	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'user_id'); ?>
			<?php echo $form->textField($model,'user_id', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'user_id'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'fname'); ?>
			<?php echo $form->textField($model,'fname',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
			<?php echo $form->error($model,'fname'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'lname'); ?>
			<?php echo $form->textField($model,'lname',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
			<?php echo $form->error($model,'lname'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'gender'); ?>
			<?php echo $form->textField($model,'gender', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'gender'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'birthday'); ?>
			<?php echo $form->textField($model,'birthday', array('class' => 'date textField')); ?>
			<?php echo $form->error($model,'birthday'); ?>
		</div>
	</div>

</div><!-- form -->
<div class="form-actions">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật',array('class'=>'btn btn-inverse')); ?>
</div>

<?php $this->endWidget(); ?>
