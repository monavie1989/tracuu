<?php

return array(
    // uncomment the following to enable the Gii tool

    'gii' => array(
        'class' => 'system.gii.GiiModule',
        'password' => '123',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
        'ipFilters' => array($_SERVER['REMOTE_ADDR']),
    ),
    'admin' => array(
        'defaultController' => 'default',
    ),
        )
?>
