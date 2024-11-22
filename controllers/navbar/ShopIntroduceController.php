<?php
class ShopIntroduceController
{
    public $modelCategory;
    // Hiển thị form đăng nhập
    public function __construct()
{
    $this->modelCategory = new CategoryManager();  // Model danh mục
}

    public function shopintroduceController()
    
    {
        $latestCategorysHome = $this->modelCategory->showCategories();
        require_once '../client-page/views/header.php';
        require_once '../client-page/navbar/shop_introduce.php';
        require_once '../client-page/views/footer.php';
    }
}
