<?php
/* @var $this UserController */
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
		<?php echo $form->label($model,'role'); ?>
		<?php echo $form->textField($model,'role',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>60,'maxlength'=>255,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone', array('class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'registered_date'); ?>
		<?php echo $form->textField($model,'registered_date', array('class' => 'datetime textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'last_visited_date'); ?>
		<?php echo $form->textField($model,'last_visited_date', array('class' => 'datetime textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'activekey'); ?>
		<?php echo $form->textField($model,'activekey',array('size'=>32,'maxlength'=>32,'class' => 'textField')); ?>
	</div>

	<div class="field-group">
		<?php echo $form->label($model,'active'); ?>
		<?php echo $form->textField($model,'active', array('class' => 'textField')); ?>
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