<?php
class OrderController
{
    private $modelOrder;

    public function __construct()
    {
        $this->modelOrder = new Order(); // Kết nối với class Oder
    }


    public function index()
    {
        // Xác định số lượng kết quả mỗi trang và trang hiện tại
        $limit = 5; // Số đơn hàng mỗi trang
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $limit;

        // Lấy dữ liệu đơn hàng với phân trang
        $listOrders = $this->modelOrder->getAllOrders($limit, $offset);

        // Lấy tổng số đơn hàng để tính toán số trang
        $totalOrders = $this->modelOrder->getTotalOrders();
        $totalPages = ceil($totalOrders / $limit);

        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/Order/order.php'; // main
        require_once '../admin-page/views/footer.php';
    }
    public function edit()
    {
        if (isset($_GET['id'])) {
            $OrderID = $_GET['id'];
            $OrderDetail = $this->modelOrder->getOrderDetail($OrderID);

            $statusorder = $this->modelOrder->getAllStatusorder();
            $ProductIdOrder = $this->modelOrder->getAllProduct();
            // Lấy giá sản phẩm từ bảng ProductIdOrder
            $productPrices = [];
            foreach ($ProductIdOrder as $product) {
                $productPrices[$product['id']] = $product['Price'];
            }
            // Tính tổng tiền ban đầu từ số lượng và giá sản phẩm
            $productID = $OrderDetail[0]['ProductID'];
            $quantity = $OrderDetail[0]['Quantity'];
            $totalAmount = isset($productPrices[$productID]) ? $productPrices[$productID] * $quantity : 0;

            // Cập nhật tổng tiền trong OrderDetail
            $OrderDetail[0]['TotalAmount'] = $totalAmount;

            if (empty($OrderDetail)) {
                $_SESSION['error'] = 'Không tìm thấy đơn hàng.';
                header("Location: ?act=list-order");
                exit();
            }
            // Gọi view để hiển thị form chỉnh sửa
            require_once '../admin-page/views/header.php';
            require_once '../admin-page/views/Order/edit_order.php'; // View chỉnh sửa
            require_once '../admin-page/views/footer.php';
        } else {
            $_SESSION['error'] = 'ID đơn hàng không được cung cấp.';
            header("Location: ?act=list-order");
            exit();
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $OrderID = $_POST['OrderID'];
            $UserID = $_POST['UserID'];
            $OrderDate = date('Y-m-d H:i:s');
            $TotalAmount = $_POST['TotalAmount']; // không cần thiết khi tính tổng lại
            $Status = $_POST['Status'];
            $ProductID = $_POST['ProductID'];
            $Quantity = $_POST['Quantity'];

            // Kiểm tra nếu thiếu ID đơn hàng
            if (!$OrderID || !$UserID) {
                $_SESSION['error'] = 'Dữ liệu không hợp lệ.';
                header("Location: ?act=list-order");
                exit();
            }

            // Kiểm tra nếu số lượng trống
            if (empty($Quantity) || $Quantity <= 0) {
                $_SESSION['error'] = 'Vui lòng nhập số lượng sản phẩm.';
                header("Location: ?act=edit-order&id=$OrderID");
                exit();
            }

            // Lấy giá sản phẩm từ bảng ProductIdOrder
            $ProductIdOrder = $this->modelOrder->getAllProduct();
            $productPrices = [];
            foreach ($ProductIdOrder as $product) {
                $productPrices[$product['id']] = $product['Price'];
            }

            // Tính tổng tiền sau khi thay đổi số lượng
            $totalAmount = isset($productPrices[$ProductID]) ? $productPrices[$ProductID] * $Quantity : 0;

            // Thực hiện cập nhật đơn hàng
            $updateResult = $this->modelOrder->updateData($OrderID, $UserID, $OrderDate, $totalAmount, $Status, $ProductID, $Quantity);

            if ($updateResult) {
                $_SESSION['success'] = 'Cập nhật đơn hàng thành công.';
            } else {
                $_SESSION['error'] = 'Cập nhật đơn hàng không thành công. Vui lòng thử lại.';
            }

            // Chuyển hướng về danh sách đơn hàng
            header("Location: ?act=list-order");
            exit();
        } else {
            $_SESSION['error'] = 'Phương thức yêu cầu không hợp lệ.';
            header("Location: ?act=list-order");
            exit();
        }
    }

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $UserID = $_SESSION['user']['id'];
            $OrderID = $_POST['id'] ?? null;

            if (empty($OrderID)) {
                $_SESSION['error'] = 'ID đơn hàng không hợp lệ.';
                header("Location: ?act=list-order");
                exit();
            }

            // Kiểm tra và lấy chi tiết đơn hàng
            $OrderDetail = $this->modelOrder->getOrderDetail($OrderID, $UserID);
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
