<?php
class CartShopController
{
    public $modelCategory;
    private $modelOrder;

    public function __construct()
    {
        $this->modelCategory = new CategoryManager();  // Model danh mục
        $this->modelOrder = new Order(); // Kết nối với class Oder
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
        // $OrderID = !empty($listOrders) ? $listOrders[0]['OrderID'] : null;
        require_once '../client-page/views/header.php';
        require_once '../client-page/navbar/cart_shop.php';
        require_once '../client-page/views/footer.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $OrderID = $_POST['OrderID'];
            $UserID = $_POST['UserID'];
            $OrderDate = date('Y-m-d H:i:s');
            $Status = $_POST['Status'];
            $ProductID = $_POST['ProductID'];
            $Quantity = $_POST['Quantity'];

            $errors = [];
            // Kiểm tra nếu số lượng trống hoặc không hợp lệ
            if (empty($Quantity) || $Quantity <= 0) {
                $errors['Quantity'] = 'Số lượng sản phẩm phải lớn hơn 0.';
            }
            // Kiểm tra nếu thiếu ID đơn hàng
            if (!$OrderID || !$UserID) {
                $errors['OrderID'] = 'Dữ liệu không hợp lệ.';
            }
            // Nếu có lỗi, không thực hiện cập nhật và thông báo lỗi
            if (!empty($errors)) {
                $_SESSION['error'] = implode('<br>', $errors); // Nối các lỗi thành một chuỗi với <br> để hiển thị trên nhiều dòng
                header("Location: ?act=cart-shop");
                exit();
            }
            // Lấy giá sản phẩm từ bảng ProductIdOrder
            $ProductIdOrder = $this->modelOrder->getAllProduct();
            $productPrices = [];
            foreach ($ProductIdOrder as $product) {
                $productPrices[$product['id']] = $product['Price'];
            }

            if (
                isset($productPrices[$ProductID])
                && is_numeric($productPrices[$ProductID])
                && is_numeric($Quantity)
                && $productPrices[$ProductID] > 0  // Kiểm tra nếu giá sản phẩm là số dương
                && $Quantity > 0 // Kiểm tra nếu số lượng là số dương
            ) {
                $totalAmount = $productPrices[$ProductID] * $Quantity;
            } else {
                $totalAmount = 0;  // Nếu không hợp lệ, gán 0 cho tổng tiền
            }
            // Thực hiện cập nhật đơn hàng
            $updateResult = $this->modelOrder->updateData($OrderID, $UserID, $OrderDate, $totalAmount, $Status, $ProductID, $Quantity);

            if ($updateResult) {
                $_SESSION['success'] = 'Cập nhật đơn hàng thành công.';
            } else {
                $_SESSION['error'] = 'Cập nhật đơn hàng không thành công. Vui lòng thử lại.';
            }

            // Chuyển hướng về trang giỏ hàng
            header("Location: ?act=cart-shop");
            exit();
        }
    }
    public function PAY()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ session và POST
            $UserID = $_SESSION['user']['id'] ?? null;
            $totalAmount = $_POST['totalAmount'] ?? 0;

            if (!$UserID || $totalAmount <= 0) {
                $_SESSION['error'] = 'Thông tin thanh toán không hợp lệ.';
                header("Location: ?act=cart-shop");
                exit();
            }

            // Lấy danh sách các đơn hàng của user
            $listOrders = $this->modelOrder->getAllOrdersByUser($UserID);

            if (empty($listOrders)) {
                $_SESSION['error'] = 'Không có đơn hàng nào để thanh toán.';
                header("Location: ?act=cart-shop");
                exit();
            }

            // Cập nhật trạng thái từng đơn hàng
            $paymentSuccess = true; // Giả định thanh toán thành công

            foreach ($listOrders as $order) {
                $orderID = $order['OrderID'];
                $newStatus = 1;

                // Cập nhật trạng thái thanh toán trong cơ sở dữ liệu
                $updateStatusResult = $this->modelOrder->updateOrderStatus($orderID, $newStatus);

                if (!$updateStatusResult) {
                    $_SESSION['error'] .= "Lỗi cập nhật trạng thái cho đơn hàng ID: $orderID. ";
                    $paymentSuccess = false;
                }
            }

            // Kiểm tra kết quả và thông báo
            if ($paymentSuccess) {
                $_SESSION['success'] = 'Thanh toán thành công. Cảm ơn bạn đã mua hàng!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại.';
            }

            header("Location: ?act=cart-shop");
            exit();
        }
    }

    //xoá 
    public function destroy_order()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $UserID = $_SESSION['user']['id'];
            $OrderID = $_POST['id'] ?? null;

            if (empty($OrderID)) {
                $_SESSION['error'] = 'ID đơn hàng không hợp lệ.';
                header("Location: ?act=cart-shop");
                exit();
            }

            // Kiểm tra và lấy chi tiết đơn hàng
            $OrderDetail = $this->modelOrder->getOrderDetail($OrderID, $UserID);
            // Xóa đơn hàng (bao gồm chi tiết nếu có)
            if ($OrderDetail) {
                $deleteOrder = $this->modelOrder->deleteOrder($OrderID);

                if ($deleteOrder) {
                    $_SESSION['success'] = 'Xóa đơn hàng thành công.';
                } else {
                    $_SESSION['error'] = 'Không thể xóa đơn hàng. Vui lòng thử lại.';
                }
            } else {
                $_SESSION['error'] = 'Không tìm thấy đơn hàng cần xóa.';
            }
            // Điều hướng về danh sách đơn hàng
            header("Location: ?act=cart-shop");
            exit();
        }
    }
}
