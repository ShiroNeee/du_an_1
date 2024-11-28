<?php
class AdminController
{
    public function index()
    {
        // Lấy tổng số lượng đơn hàng từ session
        $totalOrders = isset($_SESSION['totalOrders']) ? $_SESSION['totalOrders'] : 0;
        $totalQuantity = isset($_SESSION['totalQuantity']) ? $_SESSION['totalQuantity'] : 0;
        $totalQuantityAfterPayment = isset($_SESSION['totalQuantityAfterPayment']) ? $_SESSION['totalQuantityAfterPayment'] : 0;
        $doanhThu = isset($_SESSION['doanhThu']) ? $_SESSION['doanhThu'] : 0;
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/main.php';
        require_once '../admin-page/views/footer.php';
    }
}
