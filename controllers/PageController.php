<?php
require_once '../models/product/Product.php';
class PageController
{
    public $modelProduct;
     // Kết nối đến file model
     public function __construct()
     {
         $this->modelProduct = new Product();
     }
    // cái này để hiển thị muốn thay đổi thì thay mỗi phần main bằng một file khác để hiển thị đúng phần của nó còn đâu giữ header và footer
    public function index()
    {
        $latestProductsHome = $this->modelProduct->showProductHome(5);
        require_once '../client-page/views/header.php';
        require_once '../client-page/views/main.php';
        require_once '../client-page/views/footer.php'; 
    }
}