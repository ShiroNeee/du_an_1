<?php
class CartShopController
{
    public $modelProduct;
    public $modelCategory;

    public function __construct()
    {
        $this->modelProduct = new Product();  // Model sản phẩm
        $this->modelCategory = new CategoryManager();  // Model danh mục
    }
    // Hiển thị form đăng nhập
    public function cartshopController()
    {
        // Lấy danh sách danh mục
        $latestCategorysHome = $this->modelCategory->showCategories();
        require_once '../client-page/views/header.php';
        require_once '../client-page/navbar/cart_shop.php';
        require_once '../client-page/views/footer.php';
    }
}