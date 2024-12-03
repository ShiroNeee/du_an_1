<?php
class ThongKeDonHangController
{
    public function thongkedonhangController()
    {
        $model = new ThongKeModel();
        $data = $model->tongDoanhThuMonth(); // Lấy dữ liệu doanh thu theo tháng
        $data2 = $model->tongDoanhThuDay(); // Lấy dữ liệu doanh thu theo ngày
        
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/thongke/thongkedonhang.php';
        require_once '../admin-page/views/footer.php';
    }
}
