<?php

$controller = 'CategoryController';

$router->add('list-category', $controller, 'index');
$router->add('add-category', $controller, 'addController');
$router->add('create-category', $controller, 'create');
$router->add('edit-category', $controller, 'editController');
$router->add('update-category', $controller, 'update');
$router->add('delete', $controller, 'destroy');
?>