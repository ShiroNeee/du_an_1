<?php
class ThongKeController
{
    public function thongkeController()
    {
        $thongKeModel = new ThongKe();
        $data1 = $thongKeModel->getDoanhThuYear();
        $data2 = $thongKeModel->getDoanhThuMonth();
        $data3 = $thongKeModel->getDoanhThuWeek();
        $data4 = $thongKeModel->getDoanhThuDay();
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/thongke/thongke.php';
        require_once '../admin-page/views/footer.php';
    }
}
