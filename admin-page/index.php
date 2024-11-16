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
require_once '../controllers/category/ListCategoryController.php';
require_once '../controllers/category/AddCategoryController.php';
require_once '../controllers/category/EditCategoryController.php';
// mesage
require_once '../controllers/MessageShopController.php';
// Tạo các đường dẫn để thực hiện điều hướng
$act = $_GET['act'] ?? '/';

$router->add('/', 'AdminController', 'index');
// list product
require_once '../routes/product/listproduct.php';
require_once '../routes/product/addproduct.php';
require_once '../routes/product/editproduct.php';
require_once '../routes/product/detailproduct.php';
// category
require_once '../routes/category/listcategory.php';
require_once '../routes/category/addcategory.php';
require_once '../routes/category/editcategory.php';
// mesage
require_once '../routes/messageshop.php';
$router->dispatch($act);

// xóa product (delete)
if (isset($_GET['act']) && $_GET['act'] === 'deleteproduct' && isset($_GET['id'])) {
    $id_product = $_GET['id'];
    // Kiểm tra nếu id hợp lệ
    if (is_numeric($id_product)) {
        $conn = connectDB();
        $sql_delete_product = "DELETE FROM products WHERE id = :id";
        $stmt_delete_product = $conn->prepare($sql_delete_product);
        $stmt_delete_product->bindParam(':id', $id_product, PDO::PARAM_INT);

        // thực hiện xóa sp
        if ($stmt_delete_product->execute()) {
            echo "<script>alert('Xóa sản phẩm thành công'); window.location.href = 'index.php';</script>";
            header('Location:index.php');
            exit();
        } else {
            echo "không xóa được sản phẩm";
        }
    }
}
// xóa danh mục
if (isset($_GET['act']) && $_GET['act'] === 'deletecategory' && isset($_GET['id'])) {
    $id_category = $_GET['id'];
    // Kiểm tra nếu id hợp lệ
    if (is_numeric($id_category)) {
        $conn = connectDB();
        $sql_delete_category = "DELETE FROM categories WHERE id = :id";
        $stmt_delete_category = $conn->prepare($sql_delete_category);
        $stmt_delete_category->bindParam(':id', $id_category, PDO::PARAM_INT);

        // thực hiện xóa sp
        if ($stmt_delete_category->execute()){
            echo "<script> alert('Xóa danh mục sản phẩm thành công'); window.location.href = 'index.php';</script>";
            exit();
        } else {
            echo "không xóa được danh mục sản phẩm";
        }
    }
}
// er message
