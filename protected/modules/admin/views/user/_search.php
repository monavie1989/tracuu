<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>'aui'),
)); ?>

    <div class="form-group pull-right">
        <?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>50,'placeholder'=>'Username hoặc Email')); ?>
        <?php echo $form->dropDownList($model, 'role', CHtml::listData(UserAuth::model()->findAll(array('select'=>'type,name,title','condition'=>'type IN ('.implode(',', Yii::app()->params['display_role'][Yii::app()->user->role_type]).')')), 'name', 'title'), array('class'=>'select','style'=>'width:200px;','empty'=>'Tất cả nhóm quyền'))?>
        <?php echo $form->dropDownList($model,'active',array('1'=>'Active','0'=>'Inactive'),array('class'=>'select','empty'=>'Tất cả','style'=>'width:90px;')); ?>
        <?php echo CHtml::submitButton('Tìm kiếm',array('class'=>'aui-button aui-button-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->