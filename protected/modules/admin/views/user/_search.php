<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>'aui registration-form ab-testing'),
)); ?>

	<div class="field-group">
            <?php echo $form->label($model,'username'); ?>
            <?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
	</div>
    
        <div class="field-group">
            <?php echo $form->label($model,'role'); ?>
            <?php echo $form->textField($model,'role',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    
	<div class="field-group">
            <?php echo $form->label($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="field-group">
            <?php echo $form->label($model,'active'); ?>
            <?php echo $form->textField($model,'active'); ?>
	</div>

	<div class="buttons-container">
            <div class="buttons">
                <?php echo CHtml::submitButton('Tìm kiếm',array('class'=>'aui-button aui-button-primary')); ?>
            </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->