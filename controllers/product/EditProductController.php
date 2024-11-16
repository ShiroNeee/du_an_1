<?php
class EditProductController
{
    // hiển thị thay phần main
    public function editController()
    {
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/product/productedit.php'; // main
        require_once '../admin-page/views/footer.php';
    }
}