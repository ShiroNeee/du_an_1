<?php
class ListProductController
{
    // hiển thị thay phần main
    public function listController()
    {
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/product/productlist.php'; // main
        require_once '../admin-page/views/footer.php';
    }
}