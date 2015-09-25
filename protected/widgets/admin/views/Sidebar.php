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
            'id' => 'member_menu',
            'controller' => 'member'
        ),
        array(
            'label' => 'Quản lý Quản trị viên',
            'id' => 'manager_menu',
            'controller' => 'manager'
        ),
        array(
            'label' => 'Customize Menu',
            'id' => 'customize_menu',
            'type' => 'customize',
            'items' => array(
                array('label' => 'Menu 1', 'url' => array('menu/menu1')),
                array('label' => 'Menu 2', 'url' => array('menu/menu2')),
                array('label' => 'Menu 3', 'url' => array('menu/menu3')),
                array('label' => 'Menu 4', 'url' => array('menu/menu4')),
            )
        ),
        array(
            'label' => 'Thiết lập',
            'id' => 'baseinfo_menu',
            'controller' => 'baseinfo'
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