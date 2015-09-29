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
        <?php echo $form->label($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 50, 'maxlength' => 50, 'class' => 'textField')); ?>
    </div>

    <div class="field-group">
        <?php echo $form->label($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255, 'class' => 'textField')); ?>
    </div>

    <div class="field-group">
        <?php echo $form->label($model, 'role'); ?>
        <?php echo $form->dropDownList($model, 'role', array('moderator' => 'moderator', 'publisher' => 'publisher', 'author' => 'author'), array('prompt' => '-- Quyền --')); ?>
    </div>

    <div class="field-group">
        <?php echo $form->label($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', Yii::app()->params["status"], array('prompt' => '-- Trạng thái --')); ?>
    </div>

    <div class="buttons-container">
        <div class="buttons">
            <?php echo CHtml::submitButton('Search', array('class' => 'btn button_search_summit')); ?>
            <?php echo CHtml::Button('Reset', array('class' => 'btn', 'onclick' => 'document.getElementById("yw0").reset();')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->