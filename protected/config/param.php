<?php

$param = array(
    'smtp' => require(dirname(__FILE__) . '/smtp.php'),
    'default_role' => array('superuser', 'administrator', 'moderator', 'publisher', 'author', 'member', 'guest'),
    'default_role_title' => array('Super User', 'Administrator', 'Moderator', 'Publisher & Author', 'Member'),
    'defaultPageSize' => 10,
    'adminEmail' => 'quyet@magingam.com',
    'status' => array('0' => 'Không hoạt động', '1' => 'Hoạt động'),
    'gender' => array('Male', 'Female'),
    'display_role' => array(
        0 => array(0, 1, 2, 3, 4),
        1 => array(1, 2, 3, 4),
        2 => array(3),
    ),
    'roles' => array('administrator','moderator','publisher','author','member')
);
return CMap::mergeArray(require(dirname(__FILE__) . '/param_local.php'), $param);
