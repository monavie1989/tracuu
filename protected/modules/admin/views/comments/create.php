<div class="row-fluid">
    <div class="span12">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'comments-form',
            'enableAjaxValidation' => false,
        ));
        ?>

        <?php echo $form->errorSummary($model); ?>
        <div class="formSep">
            <?php echo $form->hiddenField($model, 'comment_post_id'); ?>
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'comment_subject'); ?>
                    <?php echo $form->textField($model, 'comment_subject', array('maxlength' => 255, 'autocomplete' => "off", 'class' => 'textField span12')); ?>
                    <?php echo $form->error($model, 'comment_subject'); ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'comment_content'); ?>
                    <?php echo $form->textArea($model, 'comment_content', array('rows' => 6, 'class' => 'text_editor span12')); ?>
                    <?php echo $form->error($model, 'comment_content'); ?>
                </div>
            </div>


        </div><!-- form -->
        <div class="form-actions">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', array('class' => 'btn btn-inverse')); ?>
        </div>

        <?php $this->endWidget(); ?>
        <script>
            $("#comments-form").submit(function() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo Yii::app()->createUrl('/admin/comments/create'); ?>",
                    data: $("#comments-form").serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        $("#cboxLoadedContent").html(data);
                        $.colorbox.resize();
                    }
                });

                return false; // avoid to execute the actual submit of the form.
            });
        </script>
    </div>
</div>