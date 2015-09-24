<?php

$param = array(
    'default_role' => array('superuser', 'administrator', 'moderator', 'publisher', 'author', 'member', 'guest'),
    'default_role_title' => array('Super User', 'Administrator', 'Moderator', 'Publisher & Author', 'Member'),
    'display_role' => array(
        0 => array(0, 1, 2, 3, 4),
        1 => array(1, 2, 3, 4),
        2 => array(3),
    )
);
return CMap::mergeArray(require(dirname(__FILE__) . '/param_local.php'), $param);
