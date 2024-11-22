<?php

$controller = 'ProductController';

$router->add('list-product', $controller, 'index');
$router->add('detail-product', $controller, 'detail');
// ấn vào trang add
$router->add('add-product', $controller, 'add');
// tạo sp
$router->add('create-product', $controller, 'create');
// ấn vào edit
$router->add('edit-product', $controller, 'edit');
// sửa sp
$router->add('update-product', $controller, 'update');
$router->add('delete-product', $controller, 'destroy');
?>