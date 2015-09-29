<?php
/* @var $this TagController */
/* @var $model Tag */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>'aui registration-form ab-testing'),
)); ?>

	<div class="field-group">
		<?php echo $form->label($model,'tag_id'); ?>
		<?php echo $form->textField($model,'tag_id', array('class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'tag_name'); ?>
		<?php echo $form->textField($model,'tag_name',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'tag_description'); ?>
		<?php echo $form->textArea($model,'tag_description',array('rows'=>6, 'cols'=>50, 'class'=>'text_editor')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'tag_slug'); ?>
		<?php echo $form->textField($model,'tag_slug',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'tag_parent'); ?>
		<?php echo $form->textField($model,'tag_parent', array('class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'tag_order'); ?>
		<?php echo $form->textField($model,'tag_order', array('class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'tag_count'); ?>
		<?php echo $form->textField($model,'tag_count', array('class' => 'textField')); ?>
	</div>

        <div class="buttons-container">
          <div class="buttons">
            <?php echo CHtml::submitButton('Search',array('class'=>'btn button_search_summit')); ?>
          </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->