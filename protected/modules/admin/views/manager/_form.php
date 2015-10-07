<div class="row-fluid">
    <div class="span12">
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
                            <?php echo $form->textField($model, 'username', array('size' => 50, 'maxlength' => 50, 'class' => 'textField', 'autocomplete' => 'off')); ?>
                        </li>
                        <?php
                        $class = !empty($model->errors['email']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($model, 'email'); ?>
                            <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255, 'class' => 'textField')); ?>
                        </li>
                        <?php
                        $class = !empty($model->errors['password']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($model, 'password'); ?>
                            <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 255, 'class' => 'passwordField', 'autocomplete' => 'off')); ?>
                        </li>
                        <?php
                        $class = !empty($model->errors['role']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($model, 'role'); ?>
                            <?php echo $form->dropDownList($model, 'role', (Yii::app()->user->role == 'administrator') ? array('moderator' => 'Moderator', 'publisher' => 'Publisher', 'author' => 'Author') : array('publisher' => 'Publisher', 'author' => 'Author')); ?>
                        </li>
                        <?php
                        $class = !empty($model->errors['phone']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($model, 'phone'); ?>
                            <?php echo $form->textField($model, 'phone'); ?>
                        </li>
                        <?php
                        $class = !empty($model->errors['category_id']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($model, 'category_id'); ?>
                            <?php if (in_array(Yii::app()->user->role, array('administrator'))) { ?>
                                <?php echo $form->dropDownList($model, 'category_id', CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name')); ?>
                            <?php } elseif (Yii::app()->user->role === 'moderator') { ?>
                                <?php echo $form->dropDownList($model, 'category_id', CHtml::listData(Yii::app()->db->createCommand('SELECT * FROM tbl_category WHERE category_id =' . Yii::app()->user->category_id)->queryAll(), 'category_id', 'category_name')); ?>
                            <?php } ?>
                        </li>
                        <?php
                        $class = !empty($model->errors['status']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($model, 'status'); ?>
                            <?php echo $form->dropDownList($model, 'status', array(1 => 'Kích hoạt', 0 => 'Ngừng kích hoạt')); ?>
                        </li>
                    </ul>
                </div>
                <div class="span6 vcard">
                    <ul style="margin:0 !important;">
                        <li class="v-heading"> Profile info </li>
                        <li>
                            <?php echo $form->labelEx($profile, 'fname'); ?>
                            <?php echo $form->textField($profile, 'fname', array('size' => 60, 'maxlength' => 255, 'class' => 'textField')); ?>
                        </li>
                        <li>
                            <?php echo $form->labelEx($profile, 'lname'); ?>
                            <?php echo $form->textField($profile, 'lname', array('size' => 60, 'maxlength' => 255, 'class' => 'textField')); ?>
                        </li>
                        <li>
                            <?php echo $form->labelEx($profile, 'gender'); ?>
                            <?php echo CHtmlEx::activeRadioButtonList($profile, 'gender', Yii::app()->params['gender']); ?>
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