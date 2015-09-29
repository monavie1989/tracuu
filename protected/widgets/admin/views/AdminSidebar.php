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
				array('label' => 'Chuyên mục', 'url' => array('/admin/category/admin')),
				array('label' => 'Thẻ', 'url' => array('/admin/tag/admin')),
				array('label' => 'Sửa Chuyên mục', 'url' => array('/admin/post/update'), 'itemOptions' => array('class' => 'hidden')),
				array('label' => 'Sửa Thẻ', 'url' => array('/admin/post/update'), 'itemOptions' => array('class' => 'hidden')),
            )
        ),
        array(
            'label' => 'Quản lý Thành viên',
            'id' => 'member_menu',
            'type' => 'customize',
            'items' => array(
                array('label' => 'Danh sách', 'url' => array('member/index')),
                array('label' => 'Thêm mới', 'url' => array('member/create')),
            )
        ),
        array(
            'label' => 'Quản lý Quản trị viên',
            'id' => 'moderator_menu',
            'type' => 'customize',
            'items' => array(
                array('label' => 'Danh sách', 'url' => array('manager/index')),
                array('label' => 'Thêm mới', 'url' => array('manager/create')),
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