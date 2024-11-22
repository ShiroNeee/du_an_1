<?php
class DanhMucNamController
{
    public $modelProduct;
    public $modelCategory;
    public function __construct()
{
    $this->modelProduct = new Product();  // Model sản phẩm
    $this->modelCategory = new CategoryManager();  // Model danh mục
}
    public function danhmucnamController()
    {
        $latestProductsHome = $this->modelProduct->showProductHome(12);

        // Lấy danh sách danh mục
        $latestCategorysHome = $this->modelCategory->showCategories();
        require_once '../client-page/views/header.php';
        require_once '../client-page/views/category/danhmuc_nam.php';
        require_once '../client-page/views/footer.php';
    }
}