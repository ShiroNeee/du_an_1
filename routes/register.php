<?php

$controller = 'RegisterController';

// Đăng ký (hiển thị form login)
$router->add('register', $controller, 'registerForm');
// Xử lý đăng ký (sau khi submit form)
$router->add('handle-register', $controller, 'handleRegister');

?>