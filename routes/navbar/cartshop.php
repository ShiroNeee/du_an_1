<?php

$controller = 'CartShopController';

// giỏ hàng
$router->add('cart-shop', $controller, 'index');
$router->add('update-order-cart', $controller, 'update');
$router->add('payment', $controller, 'PAY');
$router->add('delete-order-cart', $controller, 'destroy_order');

?>