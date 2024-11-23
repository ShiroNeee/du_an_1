<?php
class MessageShopController
{
    public $modelProduct;
    public $modelCategory;

    public function __construct()
    {
        $this->modelProduct = new Product();  // Model sản phẩm
        $this->modelCategory = new CategoryManager();  // Model danh mục
    }
    public function messageshopController()
    {
        $latestProductsHome = $this->modelProduct->showProductHome(12);

    // Lấy danh sách danh mục
    $latestCategorysHome = $this->modelCategory->showCategories();
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/messageshop.php';
        require_once '../admin-page/views/footer.php';
    }
}