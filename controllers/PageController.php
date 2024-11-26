<?php
class PageController
{
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
        $categoryId = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;
        // Lấy danh sách sản phẩm (12 sản phẩm mới nhất)
        $latestProductsHome = $this->modelProduct->showProductHome(12);
        // Lấy danh sách danh mục
        $latestCategorysHome = $this->modelCategory->showCategories();
        // Nếu có categoryId hợp lệ, lấy sản phẩm theo danh mục
        if ($categoryId) {
            $productsList = $this->modelProduct->getProductsByCategoryId($categoryId);
        } else {
            $productsList = [];  // Nếu không có categoryId, thì không có sản phẩm
        }
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
        require_once '../client-page/views/header.php';  // Header
        require_once '../client-page/views/category/danhmuc_nam.php';  // Hiển thị sản phẩm
        require_once '../client-page/views/footer.php';  // Footer
    }

    // Phương thức xử lý yêu cầu danh mục
    public function handleCategoryRequest()
    {
        // Kiểm tra xem có tham số id trong URL không
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $categoryId = $_GET['id'];

            // Gọi phương thức để hiển thị sản phẩm theo danh mục
            $this->showCategoryProducts($categoryId);
        } else {
            // Nếu không có id hợp lệ, có thể đưa về trang chủ hoặc thông báo lỗi
            header("Location: index.php");
            exit();
        }
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
