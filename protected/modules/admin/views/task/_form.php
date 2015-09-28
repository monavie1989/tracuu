<?php
/* @var $this TaskController */
/* @var $model UserAuth */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-auth-form',
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
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',array(5=>'Module',6=>'Controller',7=>'Action'),array('class'=>'select')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->labelEx($model,'bizrule'); ?>
		<?php echo $form->textField($model,'bizrule',array('size'=>60)); ?>
		<?php echo $form->error($model,'bizrule'); ?>
	</div>

	<div class="buttons-container">
          <div class="buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'aui-button aui-button-primary')); ?>
          </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->