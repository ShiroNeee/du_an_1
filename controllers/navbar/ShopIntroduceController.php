<?php
class ShopIntroduceController
{
    public $modelCategory;
    public $modelProduct;
    // Hiển thị form đăng nhập
    public function __construct()
{
    $this->modelCategory = new CategoryManager();  // Model danh mục
    $this->modelProduct = new Product();
}

    public function shopintroduceController()
    
    {
        $latestCategorysHome = $this->modelCategory->showCategories();
        require_once '../client-page/views/header.php';
        require_once '../client-page/navbar/shop_introduce.php';
        require_once '../client-page/views/footer.php';
    }
    public function search()
    {
        // Kiểm tra xem người dùng có nhập từ khóa tìm kiếm hay không
        if (isset($_POST['search_query']) && !empty($_POST['search_query'])) {
            $searchQuery = $_POST['search_query'];

            // Tìm kiếm sản phẩm theo tên trong cơ sở dữ liệu
            $searchResults = $this->modelProduct->searchProductsByName($searchQuery);
        } else {
            // Nếu không có từ khóa tìm kiếm, có thể chuyển hướng về trang chủ hoặc thông báo lỗi
            header("Location: index.php");
            exit();
        }
    }
}
