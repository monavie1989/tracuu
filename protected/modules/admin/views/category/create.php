<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Thêm mới & Cập nhật Chuyên mục</h3>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'category-form',
            'enableAjaxValidation' => false,
        ));
        ?>

        <?php echo $form->errorSummary($modelUpdate); ?>
        <div>
            <div class="row-fluid">
                <div class="span6 vcard">
                    <ul style="margin:0 !important;">
                        <li class="v-heading"> Account info </li>
                        <?php
                        $class = !empty($modelUpdate->errors['category_name']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($modelUpdate, 'category_name'); ?>
                            <?php echo $form->textField($modelUpdate, 'category_name', array('size' => 50, 'maxlength' => 50, 'class' => 'textField')); ?>
                        </li>
                        <?php
                        $class = !empty($modelUpdate->errors['category_slug']) ? " f_error" : "";
                        ?>
                        <li class="<?php echo $class; ?>">
                            <?php echo $form->labelEx($modelUpdate, 'category_slug'); ?>
                            <?php echo $form->textField($modelUpdate, 'category_slug', array('size' => 60, 'maxlength' => 255, 'class' => 'textField')); ?>
                        </li>
                        <li>
                            <?php echo $form->labelEx($modelUpdate, 'category_description'); ?>
                            <?php echo $form->textArea($modelUpdate, 'category_description', array('rows' => 6, 'cols' => 50, 'class' => 'text_editor')); ?>
                        </li>
                        <li>
                            <?php echo $form->labelEx($modelUpdate, 'category_parent'); ?>
                            <?php
//                            $common = new Common;
                            if ($modelUpdate->isNewRecord) {
                                echo $form->dropDownList($modelUpdate, 'category_parent', Common::getArrayCategories(NewsCategory::model()->findAll(), 'category_id', 'category_name'), array('prompt' => '-- Chọn Danh mục --'));
                            } else {
                                echo $form->dropDownList($modelUpdate, 'category_parent', Common::getArrayCategories(NewsCategory::model()->findAll('`t`.category_id != ' . $modelUpdate->category_id), 'category_id', 'category_name'), array('prompt' => '-- Chọn Danh mục --'));
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- form -->
        <div class="form-actions">
            <?php echo CHtml::submitButton($modelUpdate->isNewRecord ? 'Thêm mới' : 'Cập nhật', array('class' => 'btn btn-inverse')); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>