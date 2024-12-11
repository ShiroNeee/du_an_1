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

        $limit = 5;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $limit;

        $listOrders = $this->modelOrder->getAllOrders($limit, $offset);

        $totalQuantityAfterPayment = $this->modelOrder->getTotalQuantityAfterPayment();
        $doanhThu = $this->modelOrder->doanhThu();
        // Lấy tổng số đơn hàng để tính toán số trang
        $totalOrders = $this->modelOrder->getTotalOrders();
        $totalPages = ceil($totalOrders / $limit);

        // Truyền tổng số đơn hàng tới trang AdminController
        $_SESSION['totalOrders'] = $totalOrders; // Lưu vào session
        $_SESSION['totalQuantityAfterPayment'] = $totalQuantityAfterPayment;
        $_SESSION['totalQuantity'] = $this->modelOrder->getTotalQuantity(); // Tổng số lượng đơn hàng
        $_SESSION['doanhThu'] = $this->modelOrder->doanhThu();

        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/Order/order.php'; // main
        require_once '../admin-page/views/footer.php';
    }
    public function edit()
    {
        if (isset($_GET['id'])) {
            $OrderID = $_GET['id'];
            $OrderDetail = $this->modelOrder->getOrderDetail($OrderID);
            $ProductID = $OrderDetail[0]['ProductID'];
            $totalAmounts = $_POST['totalAmount'] ?? 0;
            $siezs = $this->modelOrder->getAllSizesByProductID($ProductID);
            $statusorder = $this->modelOrder->getAllStatusorder();
            $ProductIdOrder = $this->modelOrder->getAllProduct();
            // Lấy giá sản phẩm từ bảng ProductIdOrder
            $productPrices = [];
            foreach ($ProductIdOrder as $product) {
                $productPrices[$product['id']] = $product['Price'];
                $productID[$product['id']] = $product['id'];
            }
            // Tính tổng tiền ban đầu từ số lượng và giá sản phẩm
            $productID = $OrderDetail[0]['ProductID'];
            $quantity = $OrderDetail[0]['Quantity'];
            // Cập nhật tổng tiền trong OrderDetail
            $OrderDetail[0]['totalAmount'] = $totalAmounts;

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
            $Size = $_POST['Size'];
            $Status = $_POST['Status'];
            $ProductID = $_POST['ProductID'];
            $Quantity = $_POST['Quantity'];
            $totalAmounts = $_POST['totalAmount'] ?? 0;

            if (!$OrderID || !$UserID) {
                $_SESSION['error'] = 'Dữ liệu không hợp lệ.';
                header("Location: ?act=list-order");
                exit();
            }

            $currentOrder = $this->modelOrder->getOrderDetail($OrderID);
            if (!$currentOrder || !isset($currentOrder[0])) {
                $_SESSION['error'] = 'Đơn hàng không tồn tại.';
                header("Location: ?act=list-order");
                exit();
            }
            $currentOrder = $currentOrder[0];
            $currentStatus = $currentOrder['Status'];
            $Status = (int) $Status;

            // Chặn cập nhật nếu trạng thái là "Hoàn thành" (0)
            if ($currentStatus == 0 && $Status != 0) {
                $_SESSION['error'] = 'Đơn hàng đã hoàn thành. Không thể cập nhật.';
                header("Location: ?act=edit-order&id=$OrderID");
                exit();
            }

            if ($Status < $currentStatus && $Status != 0) {
                $_SESSION['error'] = 'Không thể cập nhật trạng thái ngược. Vui lòng kiểm tra lại.';
                header("Location: ?act=edit-order&id=$OrderID");
                exit();
            }

            if (
                ($currentStatus == 2 && $Status != 3) ||
                ($currentStatus == 3 && $Status != 0)
            ) {
                $_SESSION['error'] = 'Không thể cập nhật trạng thái này. Vui lòng kiểm tra lại.';
                header("Location: ?act=edit-order&id=$OrderID");
                exit();
            }

            if (empty($Quantity) || $Quantity <= 0) {
                $_SESSION['error'] = 'Vui lòng nhập số lượng sản phẩm.';
                header("Location: ?act=edit-order&id=$OrderID");
                exit();
            }

            if ($Quantity != $currentOrder['Quantity'] || $Quantity < $currentOrder['Quantity']) {

                $TotalAmount = ($currentOrder['TotalAmount'] / $currentOrder['Quantity']) * $Quantity;
            } else {
                $TotalAmount = $currentOrder['TotalAmount'];
            }

            $updateResult = $this->modelOrder->updateData($OrderID, $UserID, $OrderDate, $Size, $TotalAmount, $Status, $ProductID, $Quantity);
            if ($updateResult) {
                $_SESSION['success'] = 'Cập nhật đơn hàng thành công.';
            } else {
                $_SESSION['error'] = 'Cập nhật đơn hàng không thành công. Vui lòng thử lại.';
            }

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
