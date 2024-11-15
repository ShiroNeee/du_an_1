<?php
session_start();
// Đây là file chạy chính, 
// là nơi ta require tất cả các file mà hệ thống sử dụng
require_once '../common/env.php'; // Khai báo các biến môi trường
require_once '../common/function.php'; // Khai báo các hàm dùng chung

// Kết nối cơ sở dữ liệu
$conn = connectDB();
require_once './router.php';
$router = new Router();
require_once '../controllers/AdminController.php';
// product
require_once '../controllers/product/ListProductController.php';
require_once '../controllers/product/AddProductController.php';
require_once '../controllers/product/EditProductController.php';
require_once '../controllers/product/DetailProductController.php';
// category
require_once '../controllers/category/CategoryController.php';
// mesage
require_once '../controllers/MessageShopController.php';

// Phải require các file model mà controller sử dụng
require_once '../models/category.php';
// Tạo các đường dẫn để thực hiện điều hướng
$act = $_GET['act'] ?? '/';

$router->add('/', 'AdminController', 'index');
// list product
require_once '../routes/product/listproduct.php';
require_once '../routes/product/addproduct.php';
require_once '../routes/product/editproduct.php';
require_once '../routes/product/detailproduct.php';
// category
require_once '../routes/category/category.php';

// mesage
require_once '../routes/messageshop.php';
// Xử lí router
$router->dispatch($act);