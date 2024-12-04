<?php

$controller = 'CommentController';
$router->add('comment-list', $controller, 'index');
$router->add('comment-add', $controller, 'add');
$router->add('comment-edit', $controller, 'edit');
$router->add('comment-delete', $controller, 'delete');
?>