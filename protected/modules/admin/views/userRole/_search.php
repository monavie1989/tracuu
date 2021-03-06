<?php
/* @var $this UserRoleController */
/* @var $model UserAuth */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>'aui'),
)); ?>

    <div class="form-group text-right">
        <?php echo $form->textField($model,'title',array('size'=>30,'maxlength'=>64,'placeholder'=>'Tên nhóm')); ?>
        <?php echo $form->dropDownList($model,'type',  Yii::app()->params['default_role_title'], array('class'=>'select','empty'=>'-- Chọn mục cha --')); ?>        
        <?php echo CHtml::submitButton('Tìm kiếm',array('class'=>'aui-button aui-button-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->