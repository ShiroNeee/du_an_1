<?php

$controller = 'LoginController';

// Đăng nhập (hiển thị form login)
$router->add('login', $controller, 'showLoginForm');
// Xử lý đăng nhập (sau khi submit form)
$router->add('handle-login', $controller, 'handleLogin');

// Đăng xuất
$router->add('logout', $controller, 'logout');
?>