<?php

$controller = 'UserController';

$router->add('list-user', $controller, 'index');
$router->add('edit-user', $controller, 'edit');
$router->add('update-user', $controller, 'update');
$router->add('delete-user', $controller, 'destroy');
?>