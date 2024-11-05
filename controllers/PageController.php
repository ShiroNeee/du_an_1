<?php
class PageController
{
    public function index()
    {
        require_once '../client-page/views/header.php';
        require_once '../client-page/views/main.php';
        require_once '../client-page/views/footer.php'; 
    }
}