<?php
require_once '../models/product/Product.php';
require_once '../models/category.php';

class PageController
{
//     public $modelProduct;
//     public $modelCategory;

//     public function __construct()
//     {
//         $this->modelProduct = new Product();  // Model sản phẩm
//         $this->modelCategory = new CategoryManager();  // Model danh mục
//     }

//     // Phương thức hiển thị trang chủ với sản phẩm và danh mục
//     public function index()
//     {
//         // Lấy danh sách sản phẩm (12 sản phẩm mới nhất)
//         $latestProductsHome = $this->modelProduct->showProductHome(12);

//         // Lấy danh sách danh mục
//         $latestCategorysHome = $this->modelCategory->showCategories();

//         // Gửi dữ liệu cho view
//         require_once '../client-page/views/header.php';  // Header (danh mục)
//         require_once '../client-page/views/main.php';  // Hiển thị sản phẩm
//         require_once '../client-page/views/footer.php';  // Footer (cấu trúc chung)
//     }

//     // Phương thức hiển thị sản phẩm theo danh mục
//     public function showCategoryProducts($categoryId)
//     {
//         // Lấy thông tin danh mục
//         $categoryList = $this->modelProduct->getProductsByCategoryId($categoryId);

//         // Lấy sản phẩm theo danh mục
//         $productsList = $this->modelProduct->getProductsByCategoryId($categoryId);

//         // Gửi dữ liệu cho view
//         require_once '../client-page/views/header.php';
//     }
public $modelProduct;
public $modelCategory;

public function __construct()
{
    $this->modelProduct = new Product();  // Model sản phẩm
    $this->modelCategory = new CategoryManager();  // Model danh mục
}

// Phương thức hiển thị trang chủ với sản phẩm và danh mục
public function index()
{
    // Lấy danh sách sản phẩm (12 sản phẩm mới nhất)
    $latestProductsHome = $this->modelProduct->showProductHome(12);

    // Lấy danh sách danh mục
    $latestCategorysHome = $this->modelCategory->showCategories();

    // Gửi dữ liệu cho view
    require_once '../client-page/views/header.php';  // Header (danh mục)
    require_once '../client-page/views/main.php';  // Hiển thị sản phẩm
    require_once '../client-page/views/footer.php';  // Footer (cấu trúc chung)
}

// Phương thức hiển thị sản phẩm theo danh mục
public function showCategoryProducts($categoryId)
{
    // Kiểm tra id hợp lệ
    if (!is_numeric($categoryId) || intval($categoryId) <= 0) {
        echo "ID danh mục không hợp lệ.";
        return;
    }

    // Lấy thông tin danh mục
    $categoryInfo = $this->modelCategory->getCategoryById($categoryId);
    if (!$categoryInfo) {
        echo "Danh mục không tồn tại.";
        return;
    }

    // Lấy sản phẩm theo danh mục
    $productsList = $this->modelProduct->getProductsByCategoryId($categoryId);

    // Gửi dữ liệu cho view
    require_once '../client-page/views/header.php';  // Header
    require_once '../client-page/views/category_products.php';  // Hiển thị sản phẩm theo danh mục
    require_once '../client-page/views/footer.php';  // Footer
    require_once '../client-page/views/shop_introduce.php';
}
}
?>
