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
// category
require_once '../controllers/category/ListCategoryController.php';
require_once '../controllers/category/AddCategoryController.php';
require_once '../controllers/category/EditCategoryController.php';

// Tạo các đường dẫn để thực hiện điều hướng
$act = $_GET['act'] ?? '/';

$router->add('/', 'AdminController', 'index');
require_once '../routes/product/listproduct.php';
require_once '../routes/product/addproduct.php';
require_once '../routes/product/editproduct.php';
// category
require_once '../routes/category/listcategory.php';
require_once '../routes/category/addcategory.php';
require_once '../routes/category/editcategory.php';
// list product
$router->dispatch($act);