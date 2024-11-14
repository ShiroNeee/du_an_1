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

//thêm product - xử lí dữ liệu (post)
if($_SERVER['REQUEST_METHOD']==='POST'){
    // lấy dữ liệu form
    $name_product          =$_POST['name_product'];
    $price_product         =$_POST['price_product'];
    $description_product   =$_POST['description_product'];
    $color_product         =$_POST['color_product'];
    $size_product          =$_POST['size_product'];
    $category_product      =$_POST['category_product'];
    // img
    $file_image=$_FILES['image_product'];
    if(!empty($file_image)){
        $image_product=time(). '_' . $file_image['name'];
        $target_file_image= '"/image/"' . $image_product;
        // move_uploaded_file($file_image['tmp_name'], $target_file_image);  
    }
    // add product (đúng tt thì mới k bị đổ nhầm dữ liệu)
    $sql_add_product="INSERT INTO products(name,price,id_color,id_size,description,image,id_category) VALUES ('$name_product','$price_product','$color_product','$size_product','$description_product','$image_product','$category_product')";
    $stmt_add_product=$conn->prepare($sql_add_product);
    $stmt_add_product->execute();
    // thêm dc nma chuyển sang list thì đang fix..
}