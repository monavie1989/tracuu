<div id="side_accordion" class="accordion">
    <?php
    $menu = array(
        array(
            'label' => 'Quản lý Bài viết',
            'id' => 'post_menu',
            'controller' => 'post'
        ),
        array(
            'label' => 'Quản lý Thành viên',
            'id' => 'user_menu',
            'controller' => 'user'
        ),
        array(
            'label' => 'Thiết lập',
            'id' => 'baseinfo_menu',
            'controller' => 'baseinfo'
        ),
    );
    foreach ($menu as $item) {
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
    }
    ?>
</div>