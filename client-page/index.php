<!--
dữ liệu test 
số thẻ : 9704 0000 0000 0018
tên : NGUYEN VAN A
ngày : 03/07
OTP : OTP 
sdt :  
-->
<?php
session_start();
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];


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
require_once '../controllers/user/UserController.php';
// shop_introduce
require_once '../controllers/navbar/ShopIntroduceController.php';
require_once '../controllers/navbar/CartShopController.php';
// danh muc nav
require_once '../controllers/navbar/DanhMucTreEmController.php';
require_once '../controllers/navbar/DanhMucSPMoiController.php';
require_once '../controllers/navbar/DanhMucController.php';
require_once '../controllers/navbar/DetailController.php';
// Order
require_once '../controllers/OrderController.php';
// 
require_once '../controllers/PageController.php';
//
require_once '../controllers/PaymentController.php';
require_once '../models/users/user.php';
//
require_once '../models/category.php';
//
require_once '../models/product/Product.php';
require_once '../models/sizes/sizes.php';
require_once '../models/Order.php';
//
require_once '../models/comment.php';

// Tạo các đường dẫn để thực hiện điều hướng
$act = $_GET['act'] ?? '/';

// $router->add('/', 'PageController', 'index');
$router->add('/', 'PageController', 'index');
// Trong router.php, thêm đường dẫn cho danh mục nam

// Giả sử router.php có mã sau:

require_once '../routes/Page.php';
// Login
require_once '../routes/login.php';
// Register
require_once '../routes/register.php';
//
require_once '../routes/Payment.php';
require_once '../routes/user/user.php';
//shop_introduce
require_once '../routes/navbar/shopintroduce.php';
require_once '../routes/navbar/cartshop.php';
// danh muc nav
require_once '../routes/navbar/danhmuc_treem.php';
require_once '../routes/navbar/danhmuc.php';
require_once '../routes/navbar/detail.php';
require_once '../routes/navbar/danhmuc_spmoi.php';
// order
require_once '../routes/order.php';

$router->dispatch($act);
