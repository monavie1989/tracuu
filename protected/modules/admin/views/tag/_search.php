<?php
/* @var $this TagController */
/* @var $model Tag */
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
    <?php echo $form->textField($model, 'tag_name', array('size' => 60, 'maxlength' => 255, 'class' => 'textField')); ?>
    <?php echo CHtml::submitButton('Search', array('class' => 'btn button_search_summit')); ?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->