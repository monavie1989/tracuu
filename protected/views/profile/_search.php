<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>'aui registration-form ab-testing'),
)); ?>

	<div class="field-group">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id', array('class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender', array('class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday', array('class' => 'date textField')); ?>
	</div>

        <div class="buttons-container">
          <div class="buttons">
            <?php echo CHtml::submitButton('Search',array('class'=>'btn button_search_summit')); ?>
          </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->