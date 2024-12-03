<?php

$controller = 'CartShopController';

// giỏ hàng
$router->add('cart-shop', $controller, 'index');
$router->add('payment', $controller, 'PAY');
$router->add('payment_method', $controller, 'payment_method');
$router->add('checkout', $controller, 'view_Payment_method');
$router->add('my-orders', $controller, 'view_my_orders');
$router->add('delete-order-cart', $controller, 'destroy_order');

?>