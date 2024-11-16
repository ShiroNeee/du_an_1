<?php
class DetailProductController
{
    // hiển thị thay phần main
    public function detailController()
    {
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/product/productdetail.php'; // main
        require_once '../admin-page/views/footer.php';
    }
}