<?php
/* @var $this RegisterFormController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepass-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
        'htmlOptions'=>array('class'=>'aui'),
	'enableAjaxValidation'=>false,
)); ?>        
    <div class="field-group">
        <?php echo $form->hiddenField($model,'id'); ?>
    </div>    
    
    <div class="field-group">
        <?php echo $form->labelEx($model,'current_password'); ?>
        <?php echo $form->textField($model,'current_password'); ?>
            <?php echo $form->error($model,'current_password'); ?>
    </div>

    <div class="field-group">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->textField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="field-group">
        <?php echo $form->labelEx($model,'password2'); ?>
        <?php echo $form->textField($model,'password2'); ?>
        <?php echo $form->error($model,'password2'); ?>
    </div>

    <div class="field-group buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->