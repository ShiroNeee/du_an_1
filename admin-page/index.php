<?php
session_start();

include('../models/categori.php');
$dsdm = loadall_category();
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

// Tạo các đường dẫn để thực hiện điều hướng
$act = $_GET['act'] ?? '/';

$router->add('/', 'AdminController', 'index');
require_once '../routes/product/listproduct.php';
require_once '../routes/product/addproduct.php';
require_once '../routes/product/editproduct.php';
require_once '../routes/product/detailproduct.php';
// category
require_once '../routes/category/listcategory.php';
require_once '../routes/category/addcategory.php';
require_once '../routes/category/editcategory.php';

if (isset($_GET['act']) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch ($act) {
        /* Controller danh muc */
        case "listdm":
            $listcategori = loadall_category();
            include "views/category/categorylist.php";
            break;

        case "categoryadd":
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $tenLoai = $_POST['tenloai'];
                insert_dm($tenLoai); // Thêm danh mục
                $thongBao = 'Thêm thành công!';

                // Chuyển hướng về trang danh sách sau khi thêm thành công
                header("Location: index.php?act=listcategory");
                exit; // Dừng thực thi mã sau khi chuyển hướng
            }
            include 'views/category/categoryadd.php'; // Nếu không chuyển hướng, hiển thị lại trang thêm danh mục
            break;
        
        case "suadm":
            if (isset($_POST['capnhat'])) {
                // Lấy dữ liệu từ form
                $CategoryID = $_POST['CategoryID'];
                $CategoryName = $_POST['tenloai'];
        
                // Cập nhật danh mục trong cơ sở dữ liệu với tham số `?`
                $sql = "UPDATE Categories SET CategoryName = ? WHERE CategoryID = ?";
                
                // Gọi pdo_execute với tham số truyền vào
                pdo_execute($sql, $CategoryName, $CategoryID);
        
                // Thông báo thành công
                $thongBao = 'Cập nhật thành công!';
        
                // Chuyển hướng về trang danh sách danh mục
                header("Location: index.php?act=listcategory");
                exit();
            }
            // Hiển thị form sửa danh mục
            include 'views/category/categoryedit.php';
            break;
            case "update":
                if (isset($_POST['capnhat'])) {
                    // Lấy dữ liệu từ form
                    $CategoryID = $_POST['CategoryID'];
                    $CategoryName = $_POST['tenloai'];
            
                    // Thực hiện cập nhật danh mục trong cơ sở dữ liệu
                    $sql = "UPDATE Categories SET CategoryName = ? WHERE CategoryID = ?";
                    
                    // Gọi pdo_execute với các tham số truyền vào
                    pdo_execute($sql, $CategoryName, $CategoryID);
            
                    // Thông báo cập nhật thành công
                    $thongBao = 'Cập nhật thành công!';
            
                    // Chuyển hướng về trang danh sách danh mục
                    header("Location: index.php?act=listcategory");
                    exit();
                }
                // Hiển thị form cập nhật danh mục
                include 'views/category/categoryedit.php';
                break;
                case "xoadm": 
                    if(isset($_GET['id']) && ($_GET['id'])){
                        delete_dm($_GET['id']);
                    }
                    $listDanhMuc = loadall_category();
                    header("Location: index.php?act=listcategory");
                    break;
                
    }
} else {
    include "index.php";
}
// list product
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
            header('Location:index.php');
            exit();
        } else {
            echo "không xóa được sản phẩm";
        }
    }
}