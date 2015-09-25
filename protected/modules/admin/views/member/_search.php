<?php
/* @var $this MemberController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions'=>array('class'=>'aui registration-form ab-testing'),
)); ?>

	<div class="field-group">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id', array('class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'registered'); ?>
		<?php echo $form->textField($model,'registered', array('class' => 'date textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'lastvisited'); ?>
		<?php echo $form->textField($model,'lastvisited', array('class' => 'datetime textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'activekey'); ?>
		<?php echo $form->textField($model,'activekey',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'role'); ?>
		<?php echo $form->textField($model,'role',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status', array('class' => 'textField')); ?>
	</div>

        <div class="buttons-container">
          <div class="buttons">
            <?php echo CHtml::submitButton('Search',array('class'=>'btn button_search_summit')); ?>
          </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->