<?php
/* @var $this ManagerController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'htmlOptions' => array('class' => 'aui registration-form ab-testing'),
    ));
    ?>
    <div class="field-group">
        <?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50,'class' => 'textField','placeholder'=>'Username hoặc Email')); ?>
        <?php echo $form->dropDownList($model,'role', array('moderator'=>'Moderator','publisher'=>'Chuyên viên cao cấp','author'=>'Chuyên viên viết bài'),array('class' => 'textField','empty'=>'Tất cả','style'=>'width:162px;')); ?>
        <?php echo $form->dropDownList($model,'status', array(1=>'Kích hoạt',0=>'Ngừng kích hoạt'),array('class' => 'textField','empty'=>'Tất cả','style'=>'width:125px;')); ?>
        <?php echo CHtml::submitButton('Tìm kiếm',array('class'=>'btn button_search_summit','style'=>'margin-top: -10px; position: relative;')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->