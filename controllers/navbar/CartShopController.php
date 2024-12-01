<?php
class CartShopController
{
    public $modelCategory;
    private $modelOrder;
    public $modelProduct;
    public $modelSizes;

    public function __construct()
    {
        $this->modelCategory = new CategoryManager();  // Model danh mục
        $this->modelOrder = new Order(); // Kết nối với class Oder
        $this->modelProduct = new Product();
        $this->modelSizes = new SizeModel();
    }
    public function index()
    {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: ?act=login");
            exit();
        }
        $UserID = $_SESSION['user']['id'];
        $latestCategorysHome = $this->modelCategory->showCategories();
        $listOrders = $this->modelOrder->getAllOrdersByUser($UserID);
        // $statusorder = $this->modelOrder->getAllStatusorder();
        // $ProductIdOrder = $this->modelOrder->getAllProduct();
        var_dump($UserID);
        require_once '../client-page/views/header.php';
        require_once '../client-page/navbar/cart_shop.php';
        require_once '../client-page/views/footer.php';
    }

    public function PAY()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ProductIDs = $_POST['ProductID'] ?? [];
            $UserID = $_SESSION['user']['id'] ?? null;
            $totalAmount = $_POST['totalAmount'] ?? 0;
            $Quantity = $_POST['Quantity'] ?? [];
            $OrderIDs = $_POST['OrderID'] ?? [];
            $Sizes = $_POST['SizeID'] ?? [];

            // Kiểm tra thông tin thanh toán
            if (!$UserID || $totalAmount <= 0 || empty($OrderIDs) || empty($Quantity) || empty($Sizes)) {
                $_SESSION['error'] = 'Thông tin thanh toán không hợp lệ.';
                header("Location: ?act=cart-shop");
                exit();
            }

            $currentDate = date('Y-m-d H:i:s');
            $paymentSuccess = true;

            // Xử lý từng sản phẩm trong đơn hàng
            foreach ($ProductIDs as $index => $ProductID) {
                $quantity = $Quantity[$index] ?? null;
                $size = $Sizes[$index] ?? null;
                $orderID = $OrderIDs[$index] ?? null;
                
                
                // Kiểm tra nếu thông tin sản phẩm không đầy đủ
                if (!$ProductID || !$quantity || !$size || !$orderID) {
                    $_SESSION['error'] = "Thông tin sản phẩm không hợp lệ.";
                    $paymentSuccess = false;
                    break;  // Dừng quá trình thanh toán nếu có thông tin thiếu
                }

                // Kiểm tra tồn kho
                $currentStock = $this->modelSizes->getStockQuantity($ProductID);
                $currentStock = $currentStock[0]['StockQuantity'] ?? null;
                if ($currentStock === null || $currentStock < $quantity) {
                    $_SESSION['error'] = "Số lượng không đủ cho sản phẩm $ProductID.";
                    $paymentSuccess = false;
                    continue;  // Tiếp tục với sản phẩm tiếp theo
                }

                $productDetail = $this->modelProduct->getDetail($ProductID);
                $price = $productDetail['Price'] ?? null;
                $new = $currentStock - $quantity;
                
                if ($price !== null) {
                    // Tính tổng tiền = giá sản phẩm * số lượng
                    $totalAmount = $price * $quantity;
                    // Dữ liệu đơn hàng
                    $orderData = [
                        'OrderID' => $orderID,
                        'ProductID' => $ProductID,
                        'UserID' => $UserID,
                        'Quantity' => $new,
                        'Size' => $size,
                        'TotalAmount' => $totalAmount,
                        'Status' => 0,
                        'OrderDate' => $currentDate
                    ];
                    // Tính toán tồn kho mới và cập nhật
                    if (!$this->modelSizes->updateStockQuantity($ProductID, $new)) {
                        $_SESSION['error'] = "Lỗi cập nhật tồn kho cho sản phẩm $ProductID.";
                        $paymentSuccess = false;
                        continue;  // Tiếp tục với sản phẩm tiếp theo
                    }
                    // Thêm đơn hàng vào cơ sở dữ liệu
                    if (!$this->modelOrder->addOrder($orderData)) {
                        $_SESSION['error'] = "Đã xảy ra lỗi khi tạo đơn hàng cho sản phẩm $ProductID.";
                        $paymentSuccess = false;
                        continue;  // Tiếp tục với sản phẩm tiếp theo
                    }
                }

                // Kiểm tra kết quả của quá trình thanh toán
                if ($paymentSuccess) {
                    $_SESSION['success'] = 'Thanh toán thành công. Cảm ơn bạn đã mua hàng!';
                } else {
                    $_SESSION['error'] = 'Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại.';
                }

                // Điều hướng người dùng về giỏ hàng hoặc trang mua hàng
                header("Location: ?act=cart-shop");
                exit();
            }
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
    //xoá 
    public function destroy_order()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $UserID = $_SESSION['user']['id'];
            $OrderIDs = $_POST['deleteOrders'] ?? [];

            foreach ($OrderIDs as $OrderID) {
                $OrderDetail = $this->modelOrder->getOrderDetail($OrderID, $UserID);

                if ($OrderDetail) {
                    $deleteOrder = $this->modelOrder->deleteOrder($OrderID);
                    if (!$deleteOrder) {
                        $_SESSION['error'] = 'Không thể xoá một số đơn hàng. Vui lòng thử lại.';
                        header("Location: ?act=cart-shop");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'Không tìm thấy đơn hàng với ID ' . $OrderID;
                    header("Location: ?act=cart-shop");
                    exit();
                }
            }

            $_SESSION['success'] = 'Các đơn hàng đã được huỷ thành công!';

            header("Location: ?act=cart-shop");
            exit();
        }
    }
}
