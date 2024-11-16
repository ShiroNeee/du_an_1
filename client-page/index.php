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
require_once '../controllers/PageController.php';
require_once '../controllers/LoginController.php';
require_once '../controllers/RegisterController.php';
// shop_introduce
require_once '../controllers/ShopIntroduceController.php';
require_once '../controllers/CartShopController.php';
require_once '../controllers/ProductMoreController.php';
// danh muc nav
require_once '../controllers/navbar/DanhMucTreEmController.php';
require_once '../controllers/navbar/DanhMucSPMoiController.php';
require_once '../controllers/navbar/DanhMucNamController.php';
require_once '../controllers/navbar/DanhMucNuController.php';
// Tạo các đường dẫn để thực hiện điều hướng
$act = $_GET['act'] ?? '/';

$router->add('/', 'PageController', 'index');
// Login
require_once '../routes/login.php';
// Register
require '../routes/register.php';
//shop_introduce
require_once '../routes/shopintroduce.php';
require_once '../routes/cartshop.php';
require_once '../routes/productmore.php';
// danh muc nav
require_once '../routes/navbar/danhmuc_treem.php';
require_once '../routes/navbar/danhmuc_nam.php';
require_once '../routes/navbar/danhmuc_nu.php';
require_once '../routes/navbar/danhmuc_spmoi.php';

$router->dispatch($act);