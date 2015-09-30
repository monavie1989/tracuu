<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Thêm mới Thành Viên</h3>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>
        <?php echo $form->errorSummary($profile); ?>
        <div>
            <div class="row-fluid">
                <div class="span6 vcard">
                    <ul style="margin:0 !important;">
                        <li class="v-heading"> Account info </li>
                        <?php
                        $class = !empty($model->errors['username']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($model, 'username'); ?>
                            <?php echo $form->textField($model, 'username', array('size' => 50, 'maxlength' => 50, 'class' => 'textField')); ?>
                        </li>
                        <?php
                        $class = !empty($model->errors['username']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($model, 'password'); ?>
                            <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 255, 'class' => 'passwordField')); ?>
                        </li>
                        <?php
                        $class = !empty($model->errors['username']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($model, 'email'); ?>
                            <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255, 'class' => 'textField')); ?>
                        </li>
                    </ul>
                </div>
                <div class="span6 vcard">
                    <ul style="margin:0 !important;">
                        <li class="v-heading"> Profile info </li>
                        <li>
                            <?php echo $form->labelEx($profile, 'fname'); ?>
                            <?php echo $form->textField($profile, 'fname', array('size' => 60, 'maxlength' => 255, 'class' => 'textField')); ?>
                            <?php echo $form->error($profile, 'fname'); ?>
                        </li>
                        <li>
                            <?php echo $form->labelEx($profile, 'lname'); ?>
                            <?php echo $form->textField($profile, 'lname', array('size' => 60, 'maxlength' => 255, 'class' => 'textField')); ?>
                            <?php echo $form->error($profile, 'lname'); ?>
                        </li>
                        <li>
                            <?php echo $form->labelEx($profile, 'gender'); ?>
                            <?php echo CHtmlEx::activeRadioButtonList($profile, 'gender', Yii::app()->params['gender']); ?>
                            <?php echo $form->error($profile, 'gender'); ?>
                        </li>
                        <li>
                            <?php echo $form->labelEx($profile, 'birthday'); ?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $profile,
                                'attribute' => 'birthday',
                                'language' => 'vi',
                                'options' => array(
                                    'dateFormat' => 'yy-mm-dd',
                                    'changeMonth' => true,
                                    'changeYear' => true,
                                    'yearRange' => (date('Y') - 100) . ':' . date('Y'),
                                ),
                                'htmlOptions' => array(
                                    ''
                                ),
                            ));
                            ?>
                            <?php echo $form->error($profile, 'birthday'); ?>
                        </li>
                    </ul>
                </div>
            </div>

        </div><!-- form -->
        <div class="form-actions">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', array('class' => 'btn btn-inverse')); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>