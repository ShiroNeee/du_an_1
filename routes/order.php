<?php

$controller = 'OrderController';

$router->add('list-order', $controller, 'index');
$router->add('delete-order', $controller, 'destroy');