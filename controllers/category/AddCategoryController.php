<?php
class AddCategoryController
{
    // hiển thị thay phần main
    public function addController()
    {
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/category/categoryadd.php'; // main
        require_once '../admin-page/views/footer.php';
    }
}