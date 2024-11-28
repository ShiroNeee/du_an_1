<?php

$controller = 'OrderController';

$router->add('list-order', $controller, 'index');
$router->add('edit-order', $controller, 'edit');
$router->add('update-order', $controller, 'update');
$router->add('delete-order', $controller, 'destroy');