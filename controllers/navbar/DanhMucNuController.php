<?php
require_once '../controllers/PageController.php';
class DanhMucNuController
{
    public $modelProduct;
    public $modelCategory;
    public function __construct()
{
    $this->modelProduct = new Product();  // Model sản phẩm
    $this->modelCategory = new CategoryManager();  // Model danh mục
}
    public function danhmucnuController()
    {

            $latestCategorysHome = $this->modelCategory->showCategories();
            $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

    // Lấy danh sách các danh mục
    $latestCategorysHome = $this->modelCategory->showCategories();

    // Nếu có `id`, lấy chi tiết sản phẩm
    if ($id) {
        $product = $this->modelProduct->getDetail($id);
    } else {
        // Nếu không có `id`, có thể hiển thị thông báo lỗi hoặc một sản phẩm mặc định
        $product = null;  // Hoặc có thể lấy một sản phẩm mặc định ở đây
    }
            // Gửi dữ liệu đến view
            require_once '../client-page/views/header.php';
            require_once '../client-page/views/category/danhmuc_nu.php';
            require_once '../client-page/views/footer.php';
    }
}