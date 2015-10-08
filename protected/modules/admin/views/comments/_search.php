<?php
/* @var $this CommentsController */
/* @var $model Comments */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>'aui registration-form ab-testing'),
)); ?>

	<div class="field-group">
		<?php echo $form->label($model,'comment_id'); ?>
		<?php echo $form->textField($model,'comment_id',array('size'=>20,'maxlength'=>20,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'comment_post_id'); ?>
		<?php echo $form->textField($model,'comment_post_id',array('size'=>20,'maxlength'=>20,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'comment_user_id'); ?>
		<?php echo $form->textField($model,'comment_user_id',array('size'=>20,'maxlength'=>20,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'comment_author_name'); ?>
		<?php echo $form->textArea($model,'comment_author_name',array('rows'=>6, 'cols'=>50, 'class'=>'text_editor')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'comment_author_email'); ?>
		<?php echo $form->textField($model,'comment_author_email',array('size'=>60,'maxlength'=>100,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'comment_date'); ?>
		<?php echo $form->textField($model,'comment_date', array('class' => 'datetime textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'comment_subject'); ?>
		<?php echo $form->textField($model,'comment_subject',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'comment_content'); ?>
		<?php echo $form->textArea($model,'comment_content',array('rows'=>6, 'cols'=>50, 'class'=>'text_editor')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'comment_type'); ?>
		<?php echo $form->textField($model,'comment_type',array('size'=>20,'maxlength'=>20,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'comment_parent'); ?>
		<?php echo $form->textField($model,'comment_parent',array('size'=>20,'maxlength'=>20,'class' => 'textField')); ?>
	</div>

        <div class="buttons-container">
          <div class="buttons">
            <?php echo CHtml::submitButton('Search',array('class'=>'btn button_search_summit')); ?>
          </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->