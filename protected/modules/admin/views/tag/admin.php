<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Quản lý Thẻ</h3>
        <?php
        $this->breadcrumbs = array(
            'Thẻ' => array('index'),
            'Danh sách',
        );
        Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#tag-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		});
		");
        ?>
        <div class="row-fluid">
            <div class="span4">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'tag-form',
                    'enableAjaxValidation' => false,
                ));
                ?>

                <?php echo $form->errorSummary($modelUpdate); ?>
                <div>
                    <div class="row-fluid">
                        <div class="span12 vcard">
                            <ul style="margin:0 !important;">
                                <li class="v-heading"> Thêm mới & Cập nhật Thẻ </li>
                                <?php echo $form->hiddenField($modelUpdate, 'tag_id'); ?>
                                <?php
                                $class = !empty($modelUpdate->errors['tag_name']) ? " f_error" : "";
                                ?>
                                <li class="<?php echo $class; ?>">
                                    <?php echo $form->labelEx($modelUpdate, 'tag_name'); ?>
                                    <?php echo $form->textField($modelUpdate, 'tag_name', array('size' => 50, 'maxlength' => 50, 'class' => 'textField')); ?>
                                </li>
                                <?php
                                $class = !empty($modelUpdate->errors['tag_slug']) ? " f_error" : "";
                                ?>
                                <li class="<?php echo $class; ?>">
                                    <?php echo $form->labelEx($modelUpdate, 'tag_slug'); ?>
                                    <?php echo $form->textField($modelUpdate, 'tag_slug', array('size' => 60, 'maxlength' => 255, 'class' => 'textField')); ?>
                                </li>
                                <li>
                                    <?php echo $form->labelEx($modelUpdate, 'tag_description'); ?>
                                    <?php echo $form->textArea($modelUpdate, 'tag_description', array('rows' => 6, 'cols' => 50, 'class' => 'text_editor')); ?>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div><!-- form -->
                <div class="form-actions">
                    <?php echo CHtml::submitButton($modelUpdate->isNewRecord ? 'Thêm mới' : 'Cập nhật', array('class' => 'btn btn-inverse', 'id' => 'btn_submit')); ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="span8">
                <div class="search-form term_search_form">
                    <?php
                    $this->renderPartial('_search', array(
                        'model' => $model,
                    ));
                    ?>
                </div><!-- search-form -->
                <?php
                $this->widget('application.classextends.CGridViewEx', array(
                    'id' => 'tag-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        array(
                            'name' => 'tag_name',
                            'htmlOptions' => array(
                                'class' => 'tag_name',
                            ),
                        ),
                        array(
                            'name' => 'tag_slug',
                            'htmlOptions' => array(
                                'class' => 'tag_slug',
                            ),
                        ),
                        array(
                            'name' => 'tag_description',
                            'htmlOptions' => array(
                                'class' => 'tag_description',
                            ),
                        ),
                        array(
                            'class' => 'CButtonColumn',
                            'template' => '{update}{delete}',
                            'buttons' => array(
                                'update' => array(
                                    'url' => function() {
                                return 'javascript:void(0)';
                            },
                                    'options' => array(
                                        'onclick' => 'update_category(this)',
                                    ),
                                )
                            ),
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    function update_category(tthis) {
        jThis = $(tthis).parents('tr');
        var tag_id = jThis.find('.checkbox-column input').val();
        var tag_name = jThis.find('.tag_name').text();
        var tag_slug = jThis.find('.tag_slug').text();
        var tag_description = jThis.find('.tag_description').html();
        $("#Tag_tag_id").val(tag_id);
        $("#Tag_tag_name").val(tag_name);
        $("#Tag_tag_slug").val(tag_slug);
        $("#Tag_tag_description").val(tag_description);
        $('#btn_submit').val("Cập nhật");
        return false;
    }
</script>