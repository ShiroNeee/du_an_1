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
            $totalAmounts = $_POST['totalAmount'] ?? 0;
            $Quantity = $_POST['Quantity'] ?? [];
            $Sizes = $_POST['SizeID'] ?? [];


            // Kiểm tra thông tin thanh toán
            if (!$UserID || $totalAmounts <= 0 || empty($Quantity) || empty($Sizes)) {
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
                $totalAmount = $totalAmounts[$index] ?? null;


                // Kiểm tra nếu thông tin sản phẩm không đầy đủ
                if (!$ProductID || !$quantity || !$size) {
                    $_SESSION['error'] = "Thông tin sản phẩm không hợp lệ.";
                    $paymentSuccess = false;
                    break;  // Dừng quá trình thanh toán nếu có thông tin thiếu
                }

                // Kiểm tra tồn kho
                $currentStock = $this->modelSizes->getStockQuantity($ProductID);
                $currentStock = $currentStock[0]['StockQuantity'] ?? null;


                $orderDetail = $this->modelOrder->getOrderDetailByProductSize($ProductID, $size);
                if ($orderDetail) {
                    $OrderID = $orderDetail['OrderID'];
                    $new = $currentStock - $quantity;

                    // Kiểm tra nếu số lượng mới vượt quá tồn kho hiện tại
                    if ($new < 0) {
                        $_SESSION['error'] = "Số lượng không đủ cho sản phẩm. Tồn kho hiện tại sản phẩm.";
                        // Điều hướng người dùng về trang giỏ hàng và thoát
                        header("Location: ?act=cart-shop");
                        exit();  // Dừng script để không tiếp tục xử lý
                    }

                    // Cập nhật dữ liệu đơn hàng
                    $updateResult = $this->modelOrder->updateData(
                        $OrderID,
                        $UserID,
                        $currentDate,
                        $size,
                        $totalAmount,
                        1,
                        $ProductID,
                        $quantity
                    );
                    // Tính toán tồn kho mới và cập nhật
                    if (!$this->modelSizes->updateStockQuantity($ProductID, $size, $new)) {
                        $_SESSION['error'] = "Lỗi cập nhật tồn kho cho sản phẩm $ProductID, size $size.";
                        $paymentSuccess = false;
                        continue;
                    }
                    if ($updateResult) {
                        $_SESSION['success'] = 'Cập nhật đơn hàng thành công.';
                    } else {
                        $_SESSION['error'] = 'Cập nhật đơn hàng không thành công. Vui lòng thử lại.';
                    }
                } else {
                    $_SESSION['error'] = 'Sản phẩm không tồn tại trong đơn hàng.';
                    $paymentSuccess = false;
                    continue;
                }

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
