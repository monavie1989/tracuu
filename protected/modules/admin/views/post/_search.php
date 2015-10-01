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
    $post_status = Yii::app()->params['post_status'];
    $criteria = new CDbCriteria;
    $criteria->compare('role', 'author', true);
    $post_author = CHtml::listData(User::model()->findAll($criteria), 'id', 'username');
    ?>
    <div class="field-group">
        <?php echo $form->textField($model, 'post_title', array('size' => 50, 'maxlength' => 50, 'class' => 'textField', 'placeholder' => 'Tên bài viết')); ?>
        <?php echo $form->dropDownList($model, 'post_author', $post_author, array('class' => 'textField', 'empty' => 'Tác giả', 'style' => 'width:125px;')); ?>
        <?php echo $form->dropDownList($model, 'post_status', $post_status, array('class' => 'textField', 'empty' => 'Trạng thái', 'style' => 'width:125px;')); ?>
        <?php echo CHtml::submitButton('Tìm kiếm', array('class' => 'btn button_search_summit', 'style' => 'margin-top: -10px; position: relative;')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->