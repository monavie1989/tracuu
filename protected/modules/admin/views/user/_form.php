<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',

        'htmlOptions'=>array('class'=>'aui registration-form ab-testing'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>	

	<div class="field-group">
		<?php echo $form->labelEx($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>50,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'fullname'); ?>
	</div>
        
        <div class="field-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="field-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
        
        <div class="field-group">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
        <?php
            /*
             * @type of Role
             * 0 - Super user
             * 1 - Administrator
             * 2 - Moderator
             * 3 - Publisher & Author
             * 4 - Member
             */
            $role_type = Yii::app()->user->role_type;
            $cb_role = array();
            if($role_type == 0) {
                $cb_role = UserAuth::model()->findAllByAttributes(array('type'=>array(0,1,2,3,4)));
            }
            if($role_type == 1) {
                $cb_role = UserAuth::model()->findAllByAttributes(array('type'=>array(1,2,3,4)));
            }
            if($role_type == 2) {
                $cb_role = UserAuth::model()->findAllByAttributes(array('type'=>3));
            }
        ?>
        
         <div class="field-group">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->dropDownList($model,'role', CHtml::listData($cb_role, 'name', 'title'),array('class'=>'select')); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>
        
	<div class="field-group">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active',array(0=>'Inactive',1=>'Active'),array('class'=>'select')); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="buttons-container">
          <div class="buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'aui-button aui-button-primary')); ?>
          </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->