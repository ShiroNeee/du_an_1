<?php
class PageController
{
    public $modelProduct;
    public $modelCategory;
    private $modelOrder;
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->modelProduct = new Product();
        $this->modelCategory = new CategoryManager();
        $this->modelOrder = new Order();
    }


    public function index()
    {

        $categoryId = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

        $latestProductsHome = $this->modelProduct->showProductHome(8);

        $latestCategorysHome = $this->modelCategory->showCategories();

        if ($categoryId) {
            $productsList = $this->modelProduct->getProductsByCategoryId($categoryId);
        } else {
            $productsList = [];
        }
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

        if ($id) {
            $product = $this->modelProduct->getDetail($id);
        } else {

            $product = null;
        }

        require_once '../client-page/views/header.php';
        require_once '../client-page/views/main.php';
        require_once '../client-page/views/footer.php';
    }
    public function addToCart()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
            $ProductID = isset($_POST['ProductID']) ? intval($_POST['ProductID']) : 0;
            $OrderID = isset($_POST['OrderID']) ? intval($_POST['OrderID']) : 0;
            $SizeID = isset($_POST['SizeID']) ? intval($_POST['SizeID']) : 0;
            $Quantity = isset($_POST['Quantity']) ? intval($_POST['Quantity']) : 1;

            if ($id <= 0) {
                $_SESSION['error'] = "Bạn cần đăng nhập để thực hiện thao tác này.";
                header("Location: ?act=login");
                exit();
            }

            $productDetail = $this->modelProduct->getDetail($ProductID);
            if (!$productDetail) {
                $_SESSION['error'] = "Sản phẩm không tồn tại.";
                header("Location: ?act=/");
                exit();
            }
            
            $OrderID = rand(100000, 999999);
            $TotalAmount = $productDetail['Price'] * $Quantity;
            
            $orderData = [
                'OrderID' => $OrderID,
                'ProductID' => $ProductID,
                'UserID' => $id,
                'Quantity' => $Quantity,
                'Size' => $SizeID,
                'TotalAmount' => $TotalAmount,
                'Status' => 0,
                'OrderDate' => date('Y-m-d H:i:s')
            ];
           
            $isOrderAdded = $this->modelOrder->addOrder($orderData);
            
            if ($isOrderAdded) {
                $_SESSION['success'] = "Đơn hàng đã được thêm thành công!";
                header("Location: ?act=cart-shop");
            } else {
                $_SESSION['error'] = "Đã xảy ra lỗi khi thêm đơn hàng.";
                header("Location: ?act=/");
            }
        } else {
            $_SESSION['error'] = "Yêu cầu không hợp lệ.";
            header("Location: ?act=/");
        }
    }


    public function showCategoryProducts($CategoryID)
    {
        // Kiểm tra id hợp lệ
        if (!is_numeric($CategoryID) || intval($CategoryID) <= 0) {
            echo "ID danh mục không hợp lệ.";
            return;
        }
        // Lấy thông tin danh mục
        $categoryInfo = $this->modelCategory->getCategoryById($CategoryID);
        if (!$categoryInfo) {
            echo "Danh mục không tồn tại.";
            return;
        }
        require_once '../client-page/views/header.php';  // Header
        require_once '../client-page/views/category/danhmuc_nam.php';  // Hiển thị sản phẩm
        require_once '../client-page/views/footer.php';  // Footer
    }


    public function handleCategoryRequest()
    {
        
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $CategoryID = $_GET['id'];

            
            $this->showCategoryProducts($CategoryID);
        } else {
            
            header("Location: index.php");
            exit();
        }
    }
    public function search()
    {
        
        if (isset($_POST['search_query']) && !empty($_POST['search_query'])) {
            $searchQuery = $_POST['search_query'];

            
            $searchResults = $this->modelProduct->searchProductsByName($searchQuery);
        } else {
            
            header("Location: index.php");
            exit();
        }
    }
}
