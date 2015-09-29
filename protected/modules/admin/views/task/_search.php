<?php
/* @var $this TaskController */
/* @var $model UserAuth */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <div class="form-group pull-right">
        <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>64,'placeholder'=>'Tên quyền')); ?>
        <?php echo $form->dropDownList($model,'type',array('5'=>'Module','6'=>'Controller','7'=>'Action'),array('class'=>'select','style'=>'width:100px;','empty'=>'Tất cả')); ?>
        <?php echo CHtml::submitButton('Tìm kiếm',array('class'=>'btn search-button','style'=>'margin-top: -10px; position: relative;')); ?>
        <a href="<?php echo $this->createUrl('create') ?>"><?php echo CHtml::button('Auto scan',array('class'=>'btn search-button','style'=>'margin-top: -10px; position: relative;')); ?></a>
    </div>

<?php $this->endWidget(); ?>