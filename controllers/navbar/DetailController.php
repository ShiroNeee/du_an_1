<?php
require_once '../controllers/PageController.php';
require_once '../controllers/user/UserController.php';

class DetailController
{
    private $modelProduct;
    private $modelCategory;
    private $modelSizes;
    private $modelComment;
    private $modelOrder;

    public function __construct()
    {
        $this->modelProduct = new Product();
        $this->modelCategory = new CategoryManager();
        $this->modelSizes = new SizeModel();
        $this->modelComment = new CommentModel();
        $this->modelOrder = new Order();
    }

    public function detailController()
    {
        // Kiểm tra người dùng đã đăng nhập
        $isLoggedIn = isset($_SESSION['user']);
        $userID = $isLoggedIn ? $_SESSION['user']['id'] : null;

        // Lấy danh sách sản phẩm ngẫu nhiên và danh mục mới nhất
        $randomProducts = $this->modelProduct->getRandomProducts();
        $latestCategorysHome = $this->modelCategory->showCategories();

        // Kiểm tra tham số `id` từ URL
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;
        $product = null;
        $productSizes = null;
        $comments = [];

        if ($id) {
            // Lấy chi tiết sản phẩm
            $product = $this->modelProduct->getDetail($id);

            // Lấy thông tin kích cỡ và danh sách bình luận
            if ($product) {
                $productSizes = $this->modelProduct->getProductSizes($id);
                $comments = $this->modelComment->getByProductID($id);
            }
        }

        // Xử lý thêm bình luận
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment']) && $isLoggedIn) {
            $content = trim($_POST['comment']);

            // Kiểm tra từ ngữ nhạy cảm
            $sensitiveWords = ['badword1', 'badword2', 'badword3'];
            foreach ($sensitiveWords as $word) {
                if (stripos($content, $word) !== false) {
                    $_SESSION['error'] = "Bình luận không được chứa từ ngữ không phù hợp.";
                    header("Location: ?act=detail&id=$id");
                    exit();
                }
            }

            // Kiểm tra đơn hàng hoàn thành
            $orders = $this->modelOrder->getCompletedOrdersByProduct($userID, $id);

            if ($orders) {
                $existingComments = $this->modelComment->getCommentsByUserAndProduct($userID, $id);
                $commentedOrderIDs = array_column($existingComments, 'OrderID');

                // Lọc các đơn hàng chưa được bình luận
                $uncommentedOrders = array_filter($orders, function ($order) use ($commentedOrderIDs) {
                    return !in_array($order['OrderID'], $commentedOrderIDs);
                });

                if (!empty($uncommentedOrders)) {
                    $firstUncommentedOrder = reset($uncommentedOrders);

                    try {
                        $this->modelComment->addComment([
                            'ProductID' => $id,
                            'UserID' => $userID,
                            'Content' => $content,
                            'OrderID' => $firstUncommentedOrder['OrderID']
                        ]);
                        header("Location: ?act=detail&id=$id");
                        exit();
                    } catch (Exception $e) {
                        $_SESSION['error'] = "Không thể thêm bình luận: " . $e->getMessage();
                    }
                } else {
                    $_SESSION['error'] = "Mỗi đơn bạn chỉ bình luận được 1 lần.";
                }
            } else {
                $_SESSION['error'] = "Không có đơn hàng hoàn thành cho sản phẩm này.";
            }
        }

        // Truyền dữ liệu vào view
        require_once '../client-page/views/header.php';
        require_once '../client-page/views/category/detail.php';
        require_once '../client-page/views/footer.php';
    }
}
