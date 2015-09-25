<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>'aui registration-form ab-testing'),
)); ?>

	<div class="field-group">
		<?php echo $form->label($model,'post_ID'); ?>
		<?php echo $form->textField($model,'post_ID',array('size'=>20,'maxlength'=>20,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_author'); ?>
		<?php echo $form->textField($model,'post_author', array('class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_date'); ?>
		<?php echo $form->textField($model,'post_date', array('class' => 'datetime textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_content_head'); ?>
		<?php echo $form->textArea($model,'post_content_head',array('rows'=>6, 'cols'=>50, 'class'=>'text_editor')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_content_body'); ?>
		<?php echo $form->textArea($model,'post_content_body',array('rows'=>6, 'cols'=>50, 'class'=>'text_editor')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_content_foot'); ?>
		<?php echo $form->textArea($model,'post_content_foot',array('rows'=>6, 'cols'=>50, 'class'=>'text_editor')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_title'); ?>
		<?php echo $form->textField($model,'post_title',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_status'); ?>
		<?php echo $form->textField($model,'post_status',array('size'=>20,'maxlength'=>20,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_name'); ?>
		<?php echo $form->textField($model,'post_name',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_guild'); ?>
		<?php echo $form->textField($model,'post_guild',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_approved_user'); ?>
		<?php echo $form->textField($model,'post_approved_user', array('class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'post_approved'); ?>
		<?php echo $form->textField($model,'post_approved', array('class' => 'date textField')); ?>
	</div>

        <div class="buttons-container">
          <div class="buttons">
            <?php echo CHtml::submitButton('Search',array('class'=>'btn button_search_summit')); ?>
          </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->