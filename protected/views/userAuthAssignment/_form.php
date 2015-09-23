<?php
/* @var $this UserAuthAssignmentController */
/* @var $model UserAuthAssignment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-auth-assignment-form',
        'htmlOptions'=>array('class'=>'aui registration-form ab-testing'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="field-group">
		<?php echo $form->labelEx($model,'itemname'); ?>
		<?php echo $form->textField($model,'itemname',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'itemname'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->labelEx($model,'userid'); ?>
		<?php echo $form->textField($model,'userid',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'userid'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->labelEx($model,'bizrule'); ?>
		<?php echo $form->textArea($model,'bizrule',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'bizrule'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textArea($model,'data',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'data'); ?>
	</div>

	<div class="buttons-container">
          <div class="buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'aui-button aui-button-primary')); ?>
          </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->