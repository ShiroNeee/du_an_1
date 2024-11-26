<?php
class OrderController
{
    private $modelOrder;

    public function __construct()
    {
        $this->modelOrder = new Order(); // Kết nối với class Oder
    }

    // Hiển thị danh sách danh mục
    public function index()
    {
        $listOrders = $this->modelOrder->getAllOrders();
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/Order/order.php'; // main
        require_once '../admin-page/views/footer.php';
    }

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $OrderID = $_POST['id'] ?? null;

            if (empty($OrderID)) {
                $_SESSION['error'] = 'ID đơn hàng không hợp lệ.';
                header("Location: ?act=list-order");
                exit();
            }

            // Kiểm tra và lấy chi tiết đơn hàng
            $OrderDetail = $this->modelOrder->getAllOrderDetail($OrderID);

            // Xóa đơn hàng (bao gồm chi tiết nếu có)
            $deleteOrder = $this->modelOrder->deleteOrder($OrderID);

            if ($deleteOrder) {
                $_SESSION['success'] = 'Xóa đơn hàng thành công.';
            } else {
                $_SESSION['error'] = 'Không thể xóa đơn hàng. Vui lòng thử lại.';
            }

            // Điều hướng về danh sách đơn hàng
            header("Location: ?act=list-order");
            exit();
        }
    }
}
