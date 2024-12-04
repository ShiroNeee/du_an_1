<?php
class ThongKeDonHangController
{
    public function thongkedonhangController()
    {
        $model = new ThongKeModel();
        $data1 = $model->tongDoanhThuYear(); // Lấy dữ liệu doanh thu theo năm
        $data2 = $model->tongDoanhThuMonth(); // Lấy dữ liệu doanh thu theo tháng
        $data3 = $model->tongDoanhThuWeek(); // Lấy dữ liệu doanh thu theo tuần
        $data4 = $model->tongDoanhThuDay(); // Lấy dữ liệu doanh thu theo ngày
        
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/thongke/thongkedonhang.php';
        require_once '../admin-page/views/footer.php';
    }
}
