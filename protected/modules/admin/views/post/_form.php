<?php
$post_status = Yii::app()->params['post_status'];
$post_category = CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name');
$criteria = new CDbCriteria;
$criteria->compare('role', 'author', true);
$post_author = CHtml::listData(User::model()->findAll($criteria), 'id', 'username');
$criteria = new CDbCriteria;
$criteria->compare('role', 'publisher', true);
$post_approved_user = CHtml::listData(User::model()->findAll($criteria), 'id', 'username');
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'post-form',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>
<div class="formSep">
    <div class="row-fluid">
        <div class="span9">
            <?php echo $form->labelEx($model, 'post_title'); ?>
            <?php echo $form->textField($model, 'post_title', array('class' => 'textField span12')); ?>
            <?php echo $form->error($model, 'post_title'); ?>
            <?php echo $form->labelEx($model, 'post_name'); ?>
            <?php echo $form->textField($model, 'post_name', array('class' => 'textField span12')); ?>
            <?php echo $form->error($model, 'post_name'); ?>
            <div class="row-fluid">
                <?php echo $form->labelEx($model, 'post_content_head'); ?>
                <?php
                $this->widget("application.extensions.ckeditor.CKEditor", array("model" => $model,
                    "attribute" => "post_content_head",
                ));
                ?>
                <?php echo $form->error($model, 'post_content_head'); ?>
            </div>
            <div class="row-fluid">
                <?php echo $form->labelEx($model, 'post_content_body'); ?>
                <?php
                $this->widget("application.extensions.ckeditor.CKEditor", array("model" => $model,
                    "attribute" => "post_content_body",
                ));
                ?>
                <?php echo $form->error($model, 'post_content_body'); ?>
            </div>
            <div class="row-fluid">
                <?php echo $form->labelEx($model, 'post_content_foot'); ?>
                <?php
                $this->widget("application.extensions.ckeditor.CKEditor", array("model" => $model,
                    "attribute" => "post_content_foot",
                ));
                ?>
                <?php echo $form->error($model, 'post_content_foot'); ?>
            </div>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'post_category'); ?>
            <?php echo $form->dropDownList($model, 'post_category', $post_category, array('class' => 'textField')); ?>
            <?php echo $form->error($model, 'post_category'); ?>
            <?php echo $form->labelEx($model, 'post_author'); ?>
            <?php echo $form->dropDownList($model, 'post_author', $post_author, array('class' => 'textField')); ?>
            <?php echo $form->error($model, 'post_author'); ?>
            <?php echo $form->labelEx($model, 'post_approved_user'); ?>
            <?php echo $form->dropDownList($model, 'post_approved_user', $post_approved_user, array('class' => 'textField', 'empty' => 'Người duyệt')); ?>
            <?php echo $form->error($model, 'post_approved_user'); ?>
            <?php echo $form->labelEx($model, 'post_status'); ?>
            <?php echo $form->dropDownList($model, 'post_status', $post_status, array('class' => 'textField')); ?>
            <?php echo $form->error($model, 'post_status'); ?>
            <div class="form-actions">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', array('class' => 'btn btn-inverse')); ?>
            </div>
        </div>
    </div>

</div><!-- form -->

<?php $this->endWidget(); ?>
