<div class="mainModalContent">
    <div class="form">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
                ));
        ?>
        <?php echo $form->errorSummary($model); ?>
        <input type="hidden" name="confirm" value="1">
        <table cellspacing ="0" cellpadding="0">
            <tr class="row">
                <td class="col1 w120"><?php echo $form->labelEx($model, 'username'); ?></td>
                <td><?php echo $model->username . $form->hiddenField($model, 'username'); ?></td>
            </tr>
            <tr class="row">
                <td class="col1 w120"><?php echo $form->labelEx($model, 'email'); ?></td>
                <td><?php echo $model->email . $form->hiddenField($model, 'email'); ?></td>
            </tr>
            <tr class="row">
                <td class="col1 w120"><?php echo $form->labelEx($model, 'fname'); ?></td>
                <td><?php echo $model->fname . $form->hiddenField($model, 'fname'); ?></td>
            </tr>
            <tr class="row">
                <td class="col1 w120"><?php echo $form->labelEx($model, 'lname'); ?></td>
                <td><?php echo $model->lname . $form->hiddenField($model, 'lname'); ?></td>
            </tr>
            <tr class="row">
                <td class="col1 w120"><?php echo $form->labelEx($model, 'status'); ?></td>
                <td><?php echo Yii::app()->params['status'][$model->status] . $form->hiddenField($model, 'status'); ?></td>
            </tr>
            <tr class="row">
                <td class="col1 w120"><?php echo $form->labelEx($model, 'password'); ?></td>
                <td><?php echo str_repeat('*', strlen($model->password)) . $form->hiddenField($model, 'password'); ?></td>
            </tr>
            <tr class="row buttons">
                <td colspan="2"><a href="<?php echo Yii::app()->createUrl($this->module->baseModulePath."/profile/update", array('id' => $model->id)); ?>" title="Profile Update" class="modalAjax submitButton">Submit</a></td>
            </tr>
        </table>
        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>
<script>
    $(document).ready(function(){
        $(".submitButton").click(function(){ 
            var title = $(this).attr('title');
            $.post($(this).attr('href'),$("#user-form").serialize(),function(data){
                $('#modalContent').html(data);
                if(title != null && title != '' ){
                    $("#title_modal").text(title);
                }
                refresh = true;
                modalWindow("modalContentContainer");
            });
            return false;
        })
    })
</script>