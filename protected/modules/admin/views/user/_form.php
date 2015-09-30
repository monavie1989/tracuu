<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
<div class="formSep">
	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'role'); ?>
			<?php echo $form->textField($model,'role',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
			<?php echo $form->error($model,'role'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50,'class' => 'textField')); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>64,'class' => 'passwordField')); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'fullname'); ?>
			<?php echo $form->textField($model,'fullname',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
			<?php echo $form->error($model,'fullname'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'phone'); ?>
			<?php echo $form->textField($model,'phone', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'phone'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class' => 'textField')); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'registered_date'); ?>
			<?php echo $form->textField($model,'registered_date', array('class' => 'datetime textField')); ?>
			<?php echo $form->error($model,'registered_date'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'last_visited_date'); ?>
			<?php echo $form->textField($model,'last_visited_date', array('class' => 'datetime textField')); ?>
			<?php echo $form->error($model,'last_visited_date'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'activekey'); ?>
			<?php echo $form->textField($model,'activekey',array('size'=>32,'maxlength'=>32,'class' => 'textField')); ?>
			<?php echo $form->error($model,'activekey'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'active'); ?>
			<?php echo $form->textField($model,'active', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'active'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->textField($model,'status', array('class' => 'textField')); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>
	</div>

</div><!-- form -->
<div class="form-actions">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật',array('class'=>'btn btn-inverse')); ?>
</div>

<?php $this->endWidget(); ?>
