<?php
session_start();

// Kiểm tra quyền truy cập admin
require_once './checkAdmin.php'; 
if (!checkAdminAccess()) {
    exit(); // Dừng lại ngay nếu không phải admin
}

// Đây là file chạy chính
// là nơi ta require tất cả các file mà hệ thống sử dụng
require_once '../common/env.php'; // Khai báo các biến môi trường
require_once '../common/function.php'; // Khai báo các hàm dùng chung

// Kết nối cơ sở dữ liệu
$conn = connectDB();
require_once './router.php';
$router = new Router();
require_once '../controllers/AdminController.php';
// product
require_once '../controllers/product/ProductController.php';
// category
require_once '../controllers/category/CategoryController.php';
//user
require_once '../controllers/user/UserController.php';
// logout
require_once '../controllers/LoginController.php';
// mesage
require_once '../controllers/MessageShopController.php';
// Phải require các file model mà controller sử dụng
require_once '../models/category.php';
require_once '../models/users/user.php';
require_once '../models/product/product.php';
// Tạo các đường dẫn để thực hiện điều hướng
$act = $_GET['act'] ?? '/';

$router->add('/', 'AdminController', 'index');
// category
require_once '../routes/category/category.php';
//product
require_once '../routes/product/product.php';
// mesage
require_once '../routes/messageshop.php';

// user
require_once '../routes/user/user.php';
// logout
require_once '../routes/logout.php';
// Xử lí router
$router->dispatch($act);