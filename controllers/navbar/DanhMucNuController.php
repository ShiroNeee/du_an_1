<?php
require_once '../controllers/PageController.php';

class DanhMucNuController
{
    public $modelProduct;
    public $modelCategory;
    public $modelSizes;

    public function __construct()
    {
        $this->modelProduct = new Product();  // Model sản phẩm
        $this->modelCategory = new CategoryManager();  // Model danh mục
        $this->modelSizes = new SizeModel(); // Model kích cỡ
    }

    public function danhmucnuController()
    {
        // Lấy danh sách danh mục
        $latestCategorysHome = $this->modelCategory->showCategories();

        // Kiểm tra có tham số `id` trong URL không và lấy sản phẩm tương ứng
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

        // Lấy thông tin sản phẩm nếu có `id`
        $product = null;
        $productSizes = null;

        if ($id) {
            // Lấy chi tiết sản phẩm
            $product = $this->modelProduct->getDetail($id);

            // Lấy thông tin kích cỡ và số lượng tồn kho của sản phẩm
            if ($product) {
                $productSizes = $this->modelProduct->getProductSizes($id);
            }
        }

        // Truyền dữ liệu vào view
        require_once '../client-page/views/header.php';
        require_once '../client-page/views/category/danhmuc_nu.php';  // View sản phẩm
        require_once '../client-page/views/footer.php';
    }
}
