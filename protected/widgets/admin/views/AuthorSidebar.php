<div id="side_accordion" class="accordion">
    <?php
    $menu = array(
        /*array(
            'label' => 'Quản lý Bài viết',
            'id' => 'post_menu',
            'controller' => 'post'
        ),*/
		array(
            'label' => 'Quản lý Bài viết',
            'id' => 'post_menu',
            'type' => 'customize',
            'items' => array(
                array('label' => 'Danh sách', 'url' => array('/admin/post/admin')),
				array('label' => 'Thêm mới', 'url' => array('/admin/post/create')),
				array('label' => 'Sửa Bài viết', 'url' => array('/admin/post/update'), 'itemOptions' => array('class' => 'hidden')),
            )
        ),
    );
    foreach ($menu as $item) {
        $item['type'] = !empty($item['type']) ? $item['type'] : 'normal';
        switch ($item['type']) {
            case 'customize':
                $this->widget('application.classextends.CMenuEx', array(
                    'htmlOptions' => array('class' => 'nav nav-list'),
                    'id' => $item['id'],
                    'labelEx' => $item['label'],
                    'items' => $item['items'],
                ));

                break;

            default:
                $this->widget('application.classextends.CMenuEx', array(
                    'htmlOptions' => array('class' => 'nav nav-list'),
                    'id' => $item['id'],
                    'labelEx' => $item['label'],
                    'items' => array(
                        array('label' => 'Danh sách', 'url' => array('/admin/' . $item['controller'] . '/admin')),
                        array('label' => 'Thêm mới', 'url' => array('/admin/' . $item['controller'] . '/create')),
                        array('label' => 'Sửa', 'url' => array('/admin/' . $item['controller'] . '/update'), 'itemOptions' => array('class' => 'hidden')),
                    ),
                ));
                break;
        }
    }
    ?>
</div>