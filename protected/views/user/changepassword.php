<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Thay đổi mật khẩu</h3>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'changepassword-form',
            'htmlOptions' => array(
                'clsas' => 'form-horizontal'
            ),
            'enableClientValidation' => false,
            'enableAjaxValidation' => false,
            'clientOptions' => array(
                'inputContainer' => 'div',
                'validateOnSubmit' => false,
            ),
            'errorMessageCssClass' => 'error',
        ));
        ?>
        <div class="row-fluid">
            <div class="span8">
                <div class="control-group formSep">
                    <div class="controls">
                        <?php
                        $class = !empty($model->errors['o_password']) ? " f_error" : "";
                        ?>
                        <div class="sepH_b input-prepend<?php echo $class; ?>">
                            <span class="help-block"><?php echo $model->getAttributeLabel('o_password'); ?></span>
                            <?php echo $form->passwordField($model, 'o_password', array('class' => 'input-xlarge')); ?>
                            <?php echo $form->error($model, 'o_password'); ?>
                        </div>
                        <?php
                        $class = !empty($model->errors['n_password']) ? " f_error" : "";
                        ?>
                        <div class="sepH_b input-prepend<?php echo $class; ?>">
                            <span class="help-block"><?php echo $model->getAttributeLabel('n_password'); ?></span>
                            <?php echo $form->passwordField($model, 'n_password', array('class' => 'input-xlarge')); ?>
                            <?php echo $form->error($model, 'n_password'); ?>
                        </div>
                        <?php
                        $class = !empty($model->errors['n_password_re']) ? " f_error" : "";
                        ?>
                        <div class="sepH_b input-prepend<?php echo $class; ?>">
                            <span class="help-block"><?php echo $model->getAttributeLabel('n_password_re'); ?></span>
                            <?php echo $form->passwordField($model, 'n_password_re', array('class' => 'input-xlarge')); ?>
                            <?php echo $form->error($model, 'n_password_re'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-gebo">Change Password</button>
        <?php $this->endWidget(); ?>
    </div>
</div>