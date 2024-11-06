<?php
class EditCategoryController
{
    // hiển thị thay phần main
    public function editController()
    {
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/category/categoryedit.php'; // main
        require_once '../admin-page/views/footer.php';
    }
}