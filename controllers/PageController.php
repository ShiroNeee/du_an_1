<?php
class PageController
{
    // cái này để hiển thị muốn thay đổi thì thay mỗi phần main bằng một file khác để hiển thị đúng phần của nó còn đâu giữ header và footer
    public function index()
    {
        require_once '../client-page/views/header.php';
        require_once '../client-page/views/main.php';
        require_once '../client-page/views/footer.php'; 
    }
}