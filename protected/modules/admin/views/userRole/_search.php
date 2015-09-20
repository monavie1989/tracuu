<?php
/* @var $this UserRoleController */
/* @var $model UserAuth */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>'aui registration-form ab-testing'),
)); ?>

	<div class="field-group">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>38,'maxlength'=>64)); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>38,'maxlength'=>64)); ?>
	</div>

	<div class="buttons-container">
            <div class="buttons">
                <?php echo CHtml::submitButton('Tìm kiếm',array('class'=>'aui-button aui-button-primary')); ?>
            </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->