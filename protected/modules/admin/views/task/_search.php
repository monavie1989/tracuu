<?php
/* @var $this TaskController */
/* @var $model UserAuth */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>'aui'),
)); ?>

    <div class="form-group pull-right">
        <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>64,'placeholder'=>'Tên quyền')); ?>
        <?php echo $form->dropDownList($model,'type',array('5'=>'Module','6'=>'Controller','7'=>'Action'),array('class'=>'select','style'=>'width:100px;','empty'=>'Tất cả')); ?>
        <?php echo CHtml::submitButton('Tìm kiếm',array('class'=>'aui-button aui-button-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->