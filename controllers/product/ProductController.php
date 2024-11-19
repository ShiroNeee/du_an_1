<?php
class ProductController
{
    public $modelProduct;

    // Kết nối đến file model
    public function __construct()
    {
        $this->modelProduct = new Product();
    }

    // hiển thị thay phần main
    public function index()
    {
        $listProducts = $this->modelProduct->getAll();
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/product/productlist.php'; // main
        require_once '../admin-page/views/footer.php';
    }
    public function add()
    {
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/product/productadd.php'; // main
        require_once '../admin-page/views/footer.php';
    }

   // Xóa sản phẩm
   public function destroy()
   {
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $id = $_POST['id'];
           $productDetail = $this->modelProduct->getDetail($id);
           $deleteProduct = $this->modelProduct->deleteData($id);

           if ($deleteProduct) {
               if ($productDetail['hinh_anh'] && file_exists($productDetail['hinh_anh'])) {
                   unlink($productDetail['hinh_anh']);
               }
               header("Location: ?act=list-product");
               exit();
           }
       }
   }

}