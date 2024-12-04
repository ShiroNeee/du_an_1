<?php
class ThongKeSoLuongController
{
    public function thongkesoluongController()
    {
        $model = new ThongKeModel();
        
        // Lấy dữ liệu từ model
        $soluong1 = $model->getTotalStockQuantity();  // tất cả số lượng sản phẩm
        $soluong2 = $model->getStockQuantityBySize(); // số lượng sản phẩm theo size

        // Truyền dữ liệu vào view
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/thongke/thongkesoluong.php';
        require_once '../admin-page/views/footer.php';
    }
}
