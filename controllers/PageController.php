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
            $SizeID = isset($_POST['SizeID']) ? intval($_POST['SizeID']) : 0;
            $Quantity = isset($_POST['Quantity']) ? intval($_POST['Quantity']) : 1;
            $TotalAmount = isset($_POST['TotalPrice']) ? floatval($_POST['TotalPrice']) : 0;

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
            // Kiểm tra số lượng tồn kho
            $productSizes = $this->modelProduct->getProductSizes($ProductID);
            $availableStock = 0;
            foreach ($productSizes as $size) {
                if ($size['SizeID'] == $SizeID) {
                    $availableStock = $size['StockQuantity'];
                    break;
                }
            }

            // Kiểm tra số lượng trong giỏ hàng trước khi thêm mới
            $existingOrder = $this->modelOrder->getOrderByProductAndSize($id, $ProductID, $SizeID);
            
            if ($existingOrder) {
                
                $orderQuantity = $existingOrder['Quantity'];
                if (($orderQuantity + $Quantity) > $availableStock) {
                    $_SESSION['error'] = "Số lượng trong giỏ hàng đã vượt quá số lượng tồn kho.";
                    header("Location: ?act=detail&id=" . $ProductID);
                    exit();
                }
            } else {
                if ($Quantity > $availableStock) {
                    $_SESSION['error'] = "Số lượng bạn yêu cầu vượt quá số lượng tồn kho.";
                    header("Location: ?act=detail&id=" . $ProductID);
                    exit();
                }
            }
            // Nếu $TotalAmount không được gửi, tính lại từ giá cơ bản và số lượng
            if ($TotalAmount == 0) {
                $TotalAmount = $productDetail['Price'] * $Quantity;
            }
            $orderData = [
                'ProductID' => $ProductID,
                'UserID' => $id,
                'Quantity' => $Quantity,
                'Size' => $SizeID,
                'TotalAmount' => $TotalAmount,
                'Status' => 1,
                'OrderDate' => date('Y-m-d H:i:s')
            ];
            // Thêm hoặc cập nhật giỏ hàng và lấy lại thông tin đơn hàng
            $existingOrder = $this->modelOrder->addOrUpdateOrder($orderData);

            if ($existingOrder) {
                if (isset($existingOrder['OrderID'])) {
                    $_SESSION['success'] = "Cập nhật giỏ hàng thành công! Số lượng mới: " . ($existingOrder['Quantity'] + $Quantity);
                } else {
                    $_SESSION['success'] = "Sản phẩm đã được thêm vào giỏ hàng!";
                }
                header("Location: ?act=cart-shop");
            } else {
                $_SESSION['error'] = "Đã xảy ra lỗi khi thêm hoặc cập nhật giỏ hàng.";
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
