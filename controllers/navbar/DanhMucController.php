<?php
class DanhMucController
{
    public $modelProduct;
    public $modelCategory;
    public function __construct()
{
    $this->modelProduct = new Product();  // Model sản phẩm
    $this->modelCategory = new CategoryManager();  // Model danh mục
}
public function danhmucController() {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $categoryId = $_GET['id'];
        // Gọi model để lấy dữ liệu danh mục
        $categoryInfo = $this->modelCategory->getCategoryById($categoryId);
        // Lấy danh sách danh mục
        $latestCategorysHome = $this->modelCategory->showCategories();
        $productsList = $this->modelProduct->getProductsByCategoryId($categoryId);
        // Gửi dữ liệu đến view
        require_once '../client-page/views/header.php';
        require_once '../client-page/views/category/danhmuc.php';
        require_once '../client-page/views/footer.php';
    } else {
        echo "ID danh mục không hợp lệ.";
    }
}

}