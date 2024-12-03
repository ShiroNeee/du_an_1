<?php
require_once '../controllers/PageController.php';
require_once '../controllers/user/UserController.php';

class DetailController
{
    public $modelProduct;
    public $modelCategory;

    public function __construct()
    {
        $this->modelProduct = new Product();  // Model sản phẩm
        $this->modelCategory = new CategoryManager();  // Model danh mục
    }

    public function detailController()
{
    $randomProducts = $this->modelProduct->getRandomProducts();
    $latestCategorysHome = $this->modelCategory->showCategories();

    // Lấy tham số `id` từ URL
    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;
    
    if ($id) {
        // Lấy chi tiết sản phẩm theo id
        $product = $this->modelProduct->getDetail($id);

        // Lấy danh sách bình luận cho sản phẩm
        $comments = $this->modelProduct->getCommentsByProduct($id);

        // Kiểm tra nếu có yêu cầu POST để thêm bình luận
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
            $content = $_POST['content'];
            $orderId = 1; // Cần xác định OrderID thực tế nếu có

            // Thêm bình luận vào cơ sở dữ liệu
            $this->modelProduct->addComment($id, $content, $orderId);

            // Sau khi thêm bình luận, chuyển hướng lại trang chi tiết sản phẩm để tránh gửi lại form
            header("Location: ?act=detail&id=" . $id);
            exit();
        }

        // Nếu sản phẩm không tồn tại
        if (!$product) {
            echo "Sản phẩm không tồn tại!";
            exit;
        }
    }

    // Truyền dữ liệu vào view
    require_once '../client-page/views/header.php';
    require_once '../client-page/views/category/detail.php';  // View hiển thị chi tiết sản phẩm
    require_once '../client-page/views/footer.php';
}

}
