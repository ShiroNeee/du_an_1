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
        // chi tietsp
        $productDetail = $this->modelProduct->getDetail($id);
        //sp moi nhat cho là có liên quan
        $latestProductsHome = $this->modelProduct->showProductHome(limit: 4);
        require_once '../client-page/views/header.php';
        require_once '../client-page/views/product/productdetail.php';
        require_once '../client-page/views/footer.php';
    }
}