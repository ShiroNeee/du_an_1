<?php
class AddProductController
{
    // hiển thị thay phần main
    public function addController()
    {
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/product/productadd.php'; // main
        require_once '../admin-page/views/footer.php';
    }
}