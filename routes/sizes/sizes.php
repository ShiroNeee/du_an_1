<?php

$controller = 'SizesController';
$router->add('sizes-list', $controller, 'index');
$router->add('sizes-add', $controller, 'add');
$router->add('sizes-edit', $controller, 'edit');
$router->add('sizes-delete', $controller, 'delete');
?>