<?php
session_start();

// Đây là file chạy chính, 
// là nơi ta require tất cả các file mà hệ thống sử dụng
require_once './common/env.php'; // Khai báo các biến môi trường
require_once './common/function.php'; // Khai báo các hàm dùng chung

// connectDB();
require_once './views/header.php';
require_once './views/main.php';
require_once './views/footer.php';
// Phải require các file controller mà ta muốn sử dụng
require_once './router.php';
$router = new Router();

// Phải require các file model mà controller sử dụng

// Tạo các đường dẫn để thực hiện điều hướng
$act = $_GET['act'] ?? '/';

// Định nghĩa các route

// Dẫn tới controller tương ứng
$router->dispatch($act);
