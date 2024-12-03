<?php
class PaymentController
{
    public $modelCategory;
    private $userModel;
    private $modelOrder;
    public $modelSizes;

    public function __construct()
    {
        $this->userModel = new User();
        $this->modelCategory = new CategoryManager();
        $this->modelOrder = new Order();
        $this->modelSizes = new SizeModel();
    }

    // public function index()
    // {
    //     if (isset($_SESSION['user']['id'])) {
    //         $userID = $_SESSION['user']['id'];

    //         // Lấy thông tin chi tiết của người dùng
    //         $userDetail = $this->userModel->getDetail($userID);
    //         $latestCategorysHome = $this->modelCategory->showCategories();

    //         // Lấy ra tên, số lượng , giá đơn hàng
    //         $listOrders = $this->modelOrder->getAllOrdersByUser($userID);
    //         // var_dump($listOrders);


    //         require_once '../client-page/views/header.php';
    //         require_once '../client-page/Payment_method.php';
    //         require_once '../client-page/views/footer.php';
    //     } else {
    //         // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    //         header("Location: ?act=login");
    //         exit();
    //     }
    // }
    
}
