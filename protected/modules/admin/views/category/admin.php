<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Quản lý Chuyên mục</h3>
        <?php
        $this->breadcrumbs = array(
            'Chuyên mục' => array('index'),
            'Danh sách',
        );
        Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#category-grid').yiiGridView('update', {
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
                    'id' => 'category-form',
                    'enableAjaxValidation' => false,
                ));
                ?>

                <?php echo $form->errorSummary($modelUpdate); ?>
                <div>
                    <div class="row-fluid">
                        <div class="span12 vcard">
                            <ul style="margin:0 !important;">
                                <li class="v-heading"> Thêm mới & Cập nhật Chuyên mục </li>
                                <?php echo $form->hiddenField($modelUpdate, 'category_id'); ?>
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
                                    $common = new Common;
                                    if ($modelUpdate->isNewRecord) {
                                        echo $form->dropDownList($modelUpdate, 'category_parent', $common->getArrayCategories(Category::model()->findAll(), 'category_id', 'category_name'), array('prompt' => '-- Chọn Danh mục --'));
                                    } else {
                                        echo $form->dropDownList($modelUpdate, 'category_parent', $common->getArrayCategories(Category::model()->findAll('`t`.category_id != ' . $modelUpdate->category_id), 'category_id', 'category_name'), array('prompt' => '-- Chọn Danh mục --'));
                                    }
                                    ?>
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
                $this->widget('application.classextends.CGridViewCategoryEx', array(
                    'id' => 'category-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        array(
                            'name' => 'category_name',
                            'type' => 'raw',
                            'htmlOptions' => array(
                                'class' => 'category_name',
                            ),
                            'value' => 'str_repeat(\'— \', $data->level-1)."<span>".$data->category_name."</span>"'
                        ),
                        array(
                            'name' => 'category_slug',
                            'htmlOptions' => array(
                                'class' => 'category_slug',
                            ),
                        ),
                        array(
                            'name' => 'category_description',
                            'htmlOptions' => array(
                                'class' => 'category_description',
                            ),
                        ),
                        array(
                            'name' => 'category_order',
                            'htmlOptions' => array(
                                'class' => 'category_order',
                            ),
                        ),
                        array(
                            'name' => 'category_count',
                            'htmlOptions' => array(
                                'class' => 'category_count',
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
        var category_id = jThis.find('.checkbox-column input').val();
        var category_name = jThis.find('.category_name').text();
        var category_slug = jThis.find('.category_slug').text();
        var category_description = jThis.find('.category_description').html();
        var category_order = jThis.find('.category_order').text();
        $("#Category_category_id").val(category_id);
        $("#Category_category_name").val(category_name);
        $("#Category_category_slug").val(category_slug);
        $("#Category_category_description").val(category_description);
        $("#Category_category_order").val(category_order);
        $('#btn_submit').val("Cập nhật");
        return false;
    }
</script>