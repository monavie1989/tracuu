<?php
$post_status = Yii::app()->params['post_status'];
$post_category = CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name');
$post_tag = CHtml::listData(Tag::model()->findAll(), 'tag_id', 'tag_name');
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
            <div class="ui-sortable row-fluid">
                <div id="w_sort05" class="w-box">    
                    <div class="w-box-header">
                        Quản lý
                    </div>
                    <div class="w-box-content cnt_a">
                        <div class="sepH_b">
                            <?php echo $form->labelEx($model, 'post_author'); ?>
                            <?php echo $form->dropDownList($model, 'post_author', $post_author, array('class' => 'dropDownList')); ?>
                        </div>
                        <div class="sepH_b">
                            <?php echo $form->labelEx($model, 'post_approved_user'); ?>
                            <?php echo $form->dropDownList($model, 'post_approved_user', $post_author, array('class' => 'dropDownList', 'empty' => 'Người duyệt')); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui-sortable row-fluid">
                <div id="w_sort05" class="w-box">    
                    <div class="w-box-header">
                        Chuyên Mục
                    </div>
                    <div class="w-box-content cnt_a">
                        <?php echo $form->checkBoxList($model, 'post_category', $post_category, array('class' => 'checkBoxList')); ?>
                    </div>
                </div>
            </div>
            <div class="ui-sortable row-fluid">
                <div id="w_sort05" class="w-box">    
                    <div class="w-box-header">
                        Thẻ
                    </div>
                    <div class="w-box-content cnt_a">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            // $codeList contains key=>label pairs, typically from CHtml::listData
                            'name' => 'post_tag_auto',
                            'options' => array(
                                'minLength' => '2',
                                'select' => 'js:function(event, ui) {
                                        $(".tagchecklist").append(\'<span><a tabindex="0" class="ntdelbutton" onclick="removetag(this)">X</a>&nbsp;<span>\'+ui.item.label+\'</span></span>\');
                                        this.value = "";
                                        var input = $("#Post_post_tag").val();
                                        if(input.trim().length > 0){
                                            var output = input.split(", ");
                                        }else{
                                            var output = [];
                                        }
                                        output.pushUnique(ui.item.label);
                                        $("#Post_post_tag").val(output.join(", "));
                                        return false;
                                    }',
//                                    'search' => 'js:function( event, ui ) {
//                                        var input = this.value;
//                                        var output = input.split(/[,]+/).pop();
//                                        if(output.trim().length >= 2){
//                                            console.log(output);
//                                            return output;
//                                        }
//                                        return false;
//                                    }',
                            ),
                            'source' => array_map(function($key, $value) {
                                return array('label' => $value, 'value' => $value);
                            }, array_keys($post_tag), $post_tag),
                        ));
                        ?>
                        <script>
                            function removetag(tthis) {
                                var input = $("#Post_post_tag").val();
                                if (input.trim().length > 0) {
                                    var output = input.split(", ");
                                } else {
                                    var output = [];
                                }
                                var tag = $(tthis).parent('span').children('span').text();
                                output.remove(tag);
                                console.log(tag);
                                console.log(output);
                                $("#Post_post_tag").val(output.join(", "));
                                $(tthis).parent('span').remove();
                                return false;
                            }
                        </script>
                        <?php echo $form->textArea($model, 'post_tag', array('class' => 'textArea hidden')); ?>
                        <div class="tagchecklist"></div>
                    </div>
                </div>
            </div>
            <div class="ui-sortable row-fluid">
                <div id="w_sort05" class="w-box">    
                    <div class="w-box-header">
                        Publish
                    </div>
                    <div class="w-box-content cnt_a">
                        <div class="sepH_b">
                            <?php echo $form->labelEx($model, 'post_status'); ?>
                            <?php echo $form->dropDownList($model, 'post_status', $post_status, array('class' => 'dropDownList')); ?>
                        </div>
                        <div class="sepH_b">
                            <?php echo $form->labelEx($model, 'post_date'); ?>
                            <?php
                            Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                            $this->widget('CJuiDateTimePicker', array(
                                'model' => $model, //Model object
                                'attribute' => 'post_date', //attribute name
                                'mode' => 'datetime', //use "time","date" or "datetime" (default)
                                'language' => 'vi',
                                'options' => array(
                                    'dateFormat' => 'yy-mm-dd',
                                    'timeFormat' => 'H:i:s',
                                ) // jquery plugin options
                            ));
                            ?>
                        </div>
                        <div class="clearfix">
                            <?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', array('class' => 'btn btn-inverse')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- form -->

<?php $this->endWidget(); ?>
