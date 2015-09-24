
<?php
$this->breadcrumbs=array(
	'SMTP Options',
);
$form = $this->beginWidget('CActiveForm',array(
    'id'=>'smtp-form',
    'htmlOptions'=>array('class'=>'aui'),
    'enableAjaxValidation'=>false,    
));
?>
    <div class="field-group">
        <?php echo $form->labelEx($model,'smtp_host'); ?>
        <?php echo $form->textField($model,'smtp_host'); ?>
        <?php echo $form->error($model,'smtp_host'); ?>
    </div>

    <div class="field-group">
        <?php echo $form->labelEx($model,'smtp_secure'); ?>
        <?php echo $form->dropDownList($model,'smtp_secure', array('tsl'=>'TSL','ssl'=>'SSL'),array('class'=>'select','empty'=>'None')); ?>
        <?php echo $form->error($model,'smtp_secure'); ?>
    </div>

    <div class="field-group">
        <?php echo $form->labelEx($model,'smtp_port'); ?>
        <?php echo $form->textField($model,'smtp_port'); ?>
        <?php echo $form->error($model,'smtp_port'); ?>
    </div>

    <div class="field-group">
        <?php echo $form->labelEx($model,'smtp_auth'); ?>
        <?php echo $form->dropDownList($model,'smtp_auth', array('true'=>'Yes','false'=>'No'),array('class'=>'select')); ?>
        <?php echo $form->error($model,'smtp_auth'); ?>
    </div>

    <div class="field-group">
        <?php echo $form->labelEx($model,'smtp_username'); ?>
        <?php echo $form->textField($model,'smtp_username'); ?>
        <?php echo $form->error($model,'smtp_username'); ?>
    </div>

    <div class="field-group">
        <?php echo $form->labelEx($model,'smtp_password'); ?>
        <?php echo $form->passwordField($model,'smtp_password'); ?>
        <?php echo $form->error($model,'smtp_password'); ?>
    </div>

    <div class="field-group">
        <?php echo $form->labelEx($model,'smtp_from_name'); ?>
        <?php echo $form->textField($model,'smtp_from_name'); ?>
        <?php echo $form->error($model,'smtp_from_name'); ?>
    </div>

    <div class="field-group">
            <?php echo CHtml::submitButton('Submit',array('class'=>'aui-button aui-button-primary')); ?>
    </div>

<?php $this->endWidget(); ?>