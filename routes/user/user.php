<?php

$controller = 'UserController';

$router->add('list-user', $controller, 'index');
$router->add('add-user', $controller, 'add');
$router->add('create-user', $controller, 'create');
$router->add('profile', $controller, 'profile');
$router->add('update-Profile', $controller, 'updateProfile');
$router->add('edit-user', $controller, 'edit');
$router->add('update-user', $controller, 'update');
$router->add('delete-user', $controller, 'destroy');
?>