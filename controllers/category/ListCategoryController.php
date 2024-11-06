<?php
class ListCategoryController
{
    // hiển thị thay phần main
    public function listController()
    {
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/category/categorylist.php'; // main
        require_once '../admin-page/views/footer.php';
    }
}