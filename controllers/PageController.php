<?php
class PageController
{
    public $modelProduct;
    public $modelCategory;
    private $modelOrder;
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User(); // Khởi tạo đối tượng User
        $this->modelProduct = new Product();  // Model sản phẩm
        $this->modelCategory = new CategoryManager();  // Model danh mục
        $this->modelOrder = new Order();
    }

    // Phương thức hiển thị trang chủ với sản phẩm và danh mục
    public function index()
    {
        // Lấy danh sách sản phẩm (12 sản phẩm mới nhất)
        $categoryId = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;
        // Lấy danh sách sản phẩm (12 sản phẩm mới nhất)
        $latestProductsHome = $this->modelProduct->showProductHome(8);
        // Lấy danh sách danh mục
        $latestCategorysHome = $this->modelCategory->showCategories();
        // Nếu có categoryId hợp lệ, lấy sản phẩm theo danh mục
        if ($categoryId) {
            $productsList = $this->modelProduct->getProductsByCategoryId($categoryId);
        } else {
            $productsList = [];  // Nếu không có categoryId, thì không có sản phẩm
        }
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;
        // Nếu có `id`, lấy chi tiết sản phẩm
        if ($id) {
            $product = $this->modelProduct->getDetail($id);
        } else {
            // Nếu không có `id`, có thể hiển thị thông báo lỗi hoặc một sản phẩm mặc định
            $product = null;  // Hoặc có thể lấy một sản phẩm mặc định ở đây
        }
        // Gửi dữ liệu cho view
        require_once '../client-page/views/header.php';  // Header (danh mục)
        require_once '../client-page/views/main.php';  // Hiển thị sản phẩm
        require_once '../client-page/views/footer.php';  // Footer (cấu trúc chung)
    }
    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ProductID = isset($_POST['ProductID']) ? intval($_POST['ProductID']) : 0;
            $OrderID = isset($_POST['OrderID']) ? intval($_POST['OrderID']) : 0; // Lấy OrderID từ POST
            $Quantity = isset($_POST['Quantity']) ? intval($_POST['Quantity']) : 1; // Số lượng mặc định là 1
            $id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;

            if ($id <= 0) {
                $_SESSION['error'] = "Bạn cần đăng nhập để thực hiện thao tác này.";
                header("Location: ?act=login");
                exit();
            }

            // Kiểm tra ID sản phẩm hợp lệ và lấy thông tin sản phẩm
            if ($ProductID > 0) {
                $productDetail = $this->modelProduct->getDetail($ProductID);
                if (!$productDetail) {
                    $_SESSION['error'] = "Sản phẩm không tồn tại.";
                    header("Location: ?act=/");
                    exit();
                }
                // Tạo một OrderID ngẫu nhiên
                $OrderID = rand(100000, 999999);
                // Tạo dữ liệu đơn hàng
                $orderData = [
                    'OrderID' => $OrderID,
                    'ProductID' => $ProductID,
                    'UserID' => $id,
                    'Quantity' => $Quantity,
                    'TotalAmount' => $productDetail['Price'],
                    'Status' => 0,
                    'OrderDate' => date('Y-m-d H:i:s')
                ];
                // Gọi hàm addOrder để thêm dữ liệu vào bảng orders và gán kết quả vào biến
                $isOrderAdded = $this->modelOrder->addOrder($orderData);
                // Kiểm tra kết quả trả về của addOrder
                if ($isOrderAdded) {
                    $_SESSION['success'] = "Đơn hàng đã được thêm thành công!";
                    header("Location: ?act=cart-shop");
                } else {
                    $_SESSION['error'] = "Đã xảy ra lỗi khi thêm đơn hàng.";
                    header("Location: ?act=/");
                }
            } else {
                $_SESSION['error'] = "ID sản phẩm không hợp lệ.";
                header("Location: ?act=/");
            }
        } else {
            $_SESSION['error'] = "Yêu cầu không hợp lệ.";
            header("Location: ?act=/");
        }
    }

    // Phương thức hiển thị sản phẩm theo danh mục
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

    // Phương thức xử lý yêu cầu danh mục
    public function handleCategoryRequest()
    {
        // Kiểm tra xem có tham số id trong URL không
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $CategoryID = $_GET['id'];

            // Gọi phương thức để hiển thị sản phẩm theo danh mục
            $this->showCategoryProducts($CategoryID);
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
