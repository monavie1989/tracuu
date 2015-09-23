<?php
/* @var $this UserAuthAssignmentController */
/* @var $model UserAuthAssignment */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>''),
)); ?>

	<div class="field-group">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'itemname'); ?>
		<?php echo $form->textField($model,'itemname',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'userid'); ?>
		<?php echo $form->textField($model,'userid',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'bizrule'); ?>
		<?php echo $form->textArea($model,'bizrule',array('rows'=>6, 'cols'=>50)); ?>
	</div>

        <div class="buttons-container">
          <div class="buttons">
            <?php echo CHtml::submitButton('Search',array('class'=>'aui-button aui-button-primary')); ?>
          </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->