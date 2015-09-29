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
            <div class="span5">
                AAAAAAAAAAAAAAa
            </div>
            <div class="span7">
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
                                'class' => 'title_category',
                            ),
                            'value' => 'str_repeat(\'— \', $data->level-1)."<span>".$data->category_name."</span>"'
                        ),
                        'category_description',
                        'category_order',
                        /*
                          'category_count',
                         */
                        array(
                            'class' => 'CButtonColumn',
                            'template' => '{update}{delete}'
                        ),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>