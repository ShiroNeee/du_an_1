<?php

$controller = 'ProductController';

$router->add('list-product', $controller, 'index');
$router->add('detail-product', $controller, 'detail');
$router->add('add-product', $controller, 'add');
$router->add('create-product', $controller, 'create');
$router->add('edit-product', $controller, 'edit');
$router->add('update-product', $controller, 'update');
$router->add('delete-product', $controller, 'destroy');
?>