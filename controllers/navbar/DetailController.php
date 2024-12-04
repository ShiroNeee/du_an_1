<?php
require_once '../controllers/PageController.php';
require_once '../controllers/user/UserController.php';

class DetailController
{
    public $modelProduct;
    public $modelCategory;
<<<<<<< HEAD

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

=======
    public $modelSizes;
    public $modelComment;
    private $modelOrder;

    public function __construct()
    {
        $this->modelProduct = new Product();
        $this->modelOrder = new Order();
        $this->modelCategory = new CategoryManager();
        $this->modelSizes = new SizeModel();
        $this->modelComment = new CommentModel();
    }

    public function detailController()
    {
        // Kiểm tra người dùng đã đăng nhập
        $isLoggedIn = isset($_SESSION['user']);
        $userID = $isLoggedIn ? $_SESSION['user']['id'] : null;

        $randomProducts = $this->modelProduct->getRandomProducts();
        // Lấy danh sách danh mục
        $latestCategorysHome = $this->modelCategory->showCategories();
        // Kiểm tra có tham số `id` trong URL không và lấy sản phẩm tương ứng
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;
        // Lấy thông tin sản phẩm nếu có `id`
        $product = null;
        $productSizes = null;
        $comments = [];
        if ($id) {
            // Lấy chi tiết sản phẩm
            $product = $this->modelProduct->getDetail($id);

            // Lấy thông tin kích cỡ và số lượng tồn kho của sản phẩm
            if ($product) {
                $productSizes = $this->modelProduct->getProductSizes($id);
                $comments = $this->modelComment->getByProductID($id);
            }
        }

        // Xử lý thêm bình luận
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment']) && $isLoggedIn) {
            $content = trim($_POST['comment']);

            // Danh sách từ ngữ nhạy cảm
            $sensitiveWords = ['badword1', 'badword2', 'badword3']; // Thêm các từ ngữ nhạy cảm vào đây
            foreach ($sensitiveWords as $word) {
                if (stripos($content, $word) !== false) {
                    $_SESSION['error'] = "Bình luận không được chứa từ ngữ không phù hợp.";
                    break;
                }
            }

            // Lấy tất cả các đơn hàng đã hoàn thành cho sản phẩm này
            $orders = $this->modelOrder->getCompletedOrdersByProduct($userID, $id);

            if ($orders) {
                // Lấy tất cả bình luận đã có cho sản phẩm và người dùng này
                $existingComments = $this->modelComment->getCommentsByUserAndProduct($userID, $id);

                // Biến để kiểm tra có bất kỳ đơn hàng nào chưa có bình luận
                $canComment = false;
                $commentedOrderIDs = array_map(function ($comment) {
                    return $comment['OrderID'];  // Lấy tất cả các OrderID đã có bình luận
                }, $existingComments);

                // Kiểm tra các đơn hàng chưa có bình luận
                $uncommentedOrders = array_filter($orders, function ($order) use ($commentedOrderIDs) {
                    return !in_array($order['OrderID'], $commentedOrderIDs);
                });

                if (!empty($uncommentedOrders)) {
                    // Nếu có ít nhất 1 đơn hàng chưa có bình luận, cho phép bình luận
                    $canComment = true;
                    $firstUncommentedOrder = reset($uncommentedOrders);  // Lấy đơn hàng đầu tiên chưa có bình luận

                    // Tiến hành thêm bình luận cho đơn hàng đầu tiên
                    try {
                        $this->modelComment->addComment([
                            'ProductID' => $id,
                            'UserID' => $userID,
                            'Content' => $content,
                            'OrderID' => $firstUncommentedOrder['OrderID']  // Thêm bình luận cho đơn hàng đầu tiên chưa có bình luận
                        ]);
                        header("Location: ?act=detail&id=$id");
                        exit;
                    } catch (Exception $e) {
                        $_SESSION['error'] = "Bạn không thể bình luận: " . $e->getMessage();
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
        require_once '../client-page/views/category/detail.php';  // View sản phẩm
        require_once '../client-page/views/footer.php';
    }
>>>>>>> origin
}
