<?php
class ProductDetailController
{
    public $modelProduct;

    // Kết nối đến file model
    public function __construct()
    {
        $this->modelProduct = new Product();
    }
    public function productdetailController()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id === null) {
            die("id của sản phẩm kh có");
        }
        $productDetail = $this->modelProduct->getDetail($id);
        require_once '../client-page/views/header.php';
        require_once '../client-page/views/product/productdetail.php';
        require_once '../client-page/views/footer.php';
    }
}