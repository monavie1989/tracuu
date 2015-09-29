<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Cập nhật Thành Viên</h3>
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
                        <li class="v-heading">
                            Account info
                        </li>
                        <li>
                            <span class="item-key"><?php echo CActiveForm::labelEx($model, 'username'); ?></span>
                            <div class="vcard-item"><?php echo $model->username; ?></div>
                        </li>
                        <li>
                            <span class="item-key"><?php echo CActiveForm::labelEx($model, 'email'); ?></span>
                            <div class="vcard-item"><?php echo $model->email; ?></div>
                        </li>
                        <li>
                            <span class="item-key"><?php echo CActiveForm::labelEx($model, 'registered'); ?></span>
                            <div class="vcard-item"><?php echo $model->registered; ?></div>
                        </li>
                        <li>
                            <span class="item-key"><?php echo CActiveForm::labelEx($model, 'lastvisited'); ?></span>
                            <div class="vcard-item"><?php echo $model->lastvisited; ?></div>
                        </li>
                        <li>
                            <span class="item-key"><?php echo CActiveForm::labelEx($model, 'status'); ?></span>
                            <div class="vcard-item">
                                <?php echo $form->dropDownList($model, 'status', Yii::app()->params["status"], array('class' => 'selectField')); ?>
                            </div>
                        </li>
                        <li class="v-heading">
                            Change Password
                        </li>
                        <?php
                        $class = !empty($model->errors['n_password']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <span class="item-key"><?php echo CActiveForm::labelEx($model, 'n_password'); ?></span>
                            <div class="vcard-item">
                                <?php echo $form->passwordField($model, 'n_password', array('class' => 'input-xlarge')); ?>
                            </div>
                        </li>
                        <?php
                        $class = !empty($model->errors['n_password_re']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <span class="item-key"><?php echo CActiveForm::labelEx($model, 'n_password_re'); ?></span>
                            <div class="vcard-item">
                                <?php echo $form->passwordField($model, 'n_password_re', array('class' => 'input-xlarge')); ?>
                            </div>
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