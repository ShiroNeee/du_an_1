<?php
class CartShopController
{
    public $modelCategory;
    private $modelOrder;
    public $modelProduct;
    public $modelSizes;
    private $userModel;

    public function __construct()
    {
        $this->modelCategory = new CategoryManager();
        $this->modelOrder = new Order();
        $this->modelProduct = new Product();
        $this->modelSizes = new SizeModel();
        $this->userModel = new User();
    }
    public function index()
    {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: ?act=login");
            exit();
        }
        $UserID = $_SESSION['user']['id'];
        $latestCategorysHome = $this->modelCategory->showCategories();
        $listOrders = $this->modelOrder->getAllOrdersByUser($UserID);
        // $statusorder = $this->modelOrder->getAllStatusorder();
        // $ProductIdOrder = $this->modelOrder->getAllProduct();
        // var_dump($UserID);
        require_once '../client-page/views/header.php';
        require_once '../client-page/navbar/cart_shop.php';
        require_once '../client-page/views/footer.php';
    }
    public function view_Payment_method()
    {
        if (isset($_SESSION['user']['id'])) {
            $userID = $_SESSION['user']['id'];

            // Lấy thông tin chi tiết của người dùng
            $userDetail = $this->userModel->getDetail($userID);
            $latestCategorysHome = $this->modelCategory->showCategories();

            // Lấy ra tên, số lượng , giá đơn hàng
            $listOrders = $this->modelOrder->getAllOrdersByUser($userID);
            // var_dump($listOrders); die;


            require_once '../client-page/views/header.php';
            require_once '../client-page/Payment_method.php';
            require_once '../client-page/views/footer.php';
        } else {
            // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
            header("Location: ?act=login");
            exit();
        }
    }

    public function PAY()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ProductIDs = $_POST['ProductID'] ?? [];
            $UserID = $_SESSION['user']['id'] ?? null;
            $totalAmounts = $_POST['totalAmount'] ?? 0;
            $Quantity = $_POST['Quantity'] ?? [];
            $Sizes = $_POST['SizeID'] ?? [];


            // Kiểm tra thông tin thanh toán
            if (!$UserID || $totalAmounts <= 0 || empty($Quantity) || empty($Sizes)) {
                $_SESSION['error'] = 'Thông tin thanh toán không hợp lệ.';
                header("Location: ?act=cart-shop");
                exit();
            }

            $currentDate = date('Y-m-d H:i:s');
            $paymentSuccess = true;

            // Xử lý từng sản phẩm trong đơn hàng
            foreach ($ProductIDs as $index => $ProductID) {
                $quantity = $Quantity[$index] ?? null;
                $size = $Sizes[$index] ?? null;
                $totalAmount = $totalAmounts[$index] ?? null;

                if (!$ProductID || !$quantity || !$size) {
                    $_SESSION['error'] = "Thông tin sản phẩm không hợp lệ.";
                    $paymentSuccess = false;
                    break;
                }

                // Kiểm tra tồn kho
                $currentStock = $this->modelSizes->getStockQuantity($ProductID, $size);
                $currentStock = $currentStock[0]['StockQuantity'] ?? null;


                $orderDetail = $this->modelOrder->getOrderDetailByProductSize($ProductID, $size);
                if ($orderDetail) {
                    $OrderID = $orderDetail['OrderID'];
                    $new = $currentStock - $quantity;

                    // Kiểm tra nếu số lượng mới vượt quá tồn kho hiện tại
                    if ($new < 0) {
                        $_SESSION['error'] = "Số lượng không đủ cho sản phẩm. Tồn kho hiện tại sản phẩm.";
                        // Điều hướng người dùng về trang giỏ hàng và thoát
                        header("Location: ?act=cart-shop");
                        exit();
                    }

                    // Cập nhật dữ liệu đơn hàng
                    $updateResult = $this->modelOrder->updateData(
                        $OrderID,
                        $UserID,
                        $currentDate,
                        $size,
                        $totalAmount,
                        1,
                        $ProductID,
                        $quantity
                    );

                    // Tính toán tồn kho mới và cập nhật
                    if (!$this->modelSizes->updateStockQuantity($ProductID, $size, $new)) {
                        $_SESSION['error'] = "Lỗi cập nhật tồn kho cho sản phẩm $ProductID, size $size.";
                        $paymentSuccess = false;
                        continue;
                    }

                    if ($updateResult) {

                        $_SESSION['success'] = 'Cập nhật đơn hàng thành công.';
                    } else {
                        $_SESSION['error'] = 'Cập nhật đơn hàng không thành công. Vui lòng thử lại.';
                    }
                } else {
                    $_SESSION['error'] = 'Sản phẩm không tồn tại trong đơn hàng.';
                    $paymentSuccess = false;
                    continue;
                }
            }
            if ($paymentSuccess) {

                $_SESSION['success'] = 'Chọn phương thức thanh toán!';
                // Điều hướng người dùng về giỏ hàng hoặc trang mua hàng
                header("Location: ?act=checkout");
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại.';
                header("Location: ?act=cart-shop");
                exit();
            }
        }
    }
    public function payment_method()
    {
        // Kiểm tra xem phương thức thanh toán là gì
        if (isset($_POST['payment_method'])) {
            // Lấy giá trị totalAmount từ POST
            $sizeModel = new SizeModel();
            $userID = $_SESSION['user']['id'];
            $orderId = $_POST['OrderID'] ?? null;
            $totalAmount = $_POST['totalAmount'] ?? 0;

            // Kiểm tra nếu không có OrderID hoặc totalAmount, trả về lỗi
            if (!$orderId || $totalAmount <= 0) {
                $_SESSION['error'] = "Thông tin đơn hàng không hợp lệ.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            $listOrders = $this->modelOrder->getAllOrdersByUser($userID);

            if (!empty($listOrders)) {

                $updateStockData = [];
                $orderStatusUpdates = [];

                foreach ($listOrders as $order) {
                    $productID = $order['ProductID'];
                    $sizeID = $order['SizeID'];
                    $quantity = $order['Quantity'];

                    $updateStockData[] = [
                        'productID' => $productID,
                        'sizeID' => $sizeID,
                        'quantity' => $quantity
                    ];

                    $orderStatusUpdates[] = $order['OrderID'];
                }

                if ($_POST['payment_method'] == "cancel_payment") {

                    foreach ($updateStockData as $data) {

                        $stockQuantity = $sizeModel->getStockQuantity($data['productID'], $data['sizeID']);

                        if (!empty($stockQuantity) && isset($stockQuantity[0]['StockQuantity'])) {
                            $currentStock = $stockQuantity[0]['StockQuantity'];

                            $newQuantity = $currentStock + $data['quantity'];
                            $sizeModel->updateStockQuantity($data['productID'], $data['sizeID'], $newQuantity);
                        }
                    }

                    foreach ($orderStatusUpdates as $orderID) {
                        $this->modelOrder->deleteOrder($orderID); // Gọi phương thức deleteOrder để xóa đơn hàng
                        // $this->modelOrder->updateOrderStatus($orderID, 1); // 1: Đã hủy
                    }
                    $_SESSION['success'] = "Đơn hàng đã được hủy thành công.";
                    header('Location: ?act=cart-shop');
                    exit();
                } else {
                    foreach ($orderStatusUpdates as $orderID) {
                        $this->modelOrder->updateOrderStatus($orderID, 2); // 2: Đang xử lý
                    }
                }
            } else {
                $_SESSION['error'] = "Không tìm thấy đơn hàng.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            // Xử lý thanh toán ATM MoMo
            if ($_POST['payment_method'] == "atm_momo") {
                // Dữ liệu cần thiết để gọi API MoMo
                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                $orderInfo = "Thanh toán bằng ATM MoMo";
                $orderId = time() . "";
                $redirectUrl = "http://localhost/du_an_1/client-page/?act=checkout"; // Link trả về sau khi thanh toán
                $ipnUrl = "http://localhost/du_an_1/client-page/?act=checkout"; // Link IPN (chuyển trạng thái thanh toán)

                $extraData = "";

                $requestId = time() . "";
                $requestType = "payWithATM";

                // Tạo hash signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $totalAmount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId .
                    "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;

                $signature = hash_hmac("sha256", $rawHash, $secretKey);

                // Dữ liệu gửi đến API MoMo
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $totalAmount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );

                // Gọi API MoMo
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);

                // Sau khi gọi API thành công, chuyển hướng người dùng tới trang thanh toán MoMo
                if ($jsonResult && isset($jsonResult['payUrl'])) {
                    unset($_SESSION['cart']);
                    unset($_SESSION['totalAmount']);
                    header('Location: ' . $jsonResult['payUrl']);
                    exit();
                } else {
                    header('Location: http://localhost/du_an_1/client-page/');
                    exit();
                }
            }
            // Xử lý thanh toán trực tiếp
            else if ($_POST['payment_method'] == "direct_payment") {
                // Xử lý thanh toán trực tiếp tại đây
                unset($_SESSION['cart']);
                unset($_SESSION['totalAmount']);

                // Hiển thị trang cảm ơn
                $latestCategorysHome = $this->modelCategory->showCategories();
                require_once '../client-page/views/header.php';
                require_once '../client-page/thankYou.php';
                require_once '../client-page/views/footer.php';
                exit();
            }
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);


        $result = curl_exec($ch);

        if (curl_errno($ch)) {

            echo 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);
        return $result;
    }

    public function view_my_orders()
    {
        if (isset($_SESSION['user']['id'])) {
            $userID = $_SESSION['user']['id'];

            $latestCategorysHome = $this->modelCategory->showCategories();

            $listOrders = $this->modelOrder->getAllOrdersByUserExcludePending($userID);

            require_once '../client-page/views/header.php';
            require_once '../client-page/view_orders.php';
            require_once '../client-page/views/footer.php';
        } else {
            // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
            header("Location: ?act=login");
            exit();
        }
    }

    public function search()
    {

        if (isset($_POST['search_query']) && !empty($_POST['search_query'])) {
            $searchQuery = $_POST['search_query'];


            $searchResults = $this->modelProduct->searchProductsByName($searchQuery);
        } else {

            header("Location: index.php");
            exit();
        }
    }
    //xoá 
    public function destroy_order()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $UserID = $_SESSION['user']['id'];
            $OrderIDs = $_POST['deleteOrders'] ?? [];

            // Kiểm tra nếu không có đơn hàng nào được chọn
            if (empty($OrderIDs)) {
                $_SESSION['error'] = 'Vui lòng chọn ít nhất một đơn hàng để huỷ.';
                header("Location: ?act=my-orders");
                exit();
            }

            foreach ($OrderIDs as $OrderID) {
                // Lấy chi tiết đơn hàng
                $OrderDetail = $this->modelOrder->getOrderDetail($OrderID, $UserID);

                if ($OrderDetail) {
                    // Kiểm tra trạng thái đơn hàng
                    if ($OrderDetail['Status'] == 3) { // Trạng thái Thành công
                        $_SESSION['error'] = 'Không thể xoá đơn hàng "' . $OrderID . '" vì đã hoàn thành.';
                        header("Location: ?act=cart-shop");
                        exit();
                    }

                    // Thực hiện xoá đơn hàng
                    $deleteOrder = $this->modelOrder->deleteOrder($OrderID);
                    if (!$deleteOrder) {
                        $_SESSION['error'] = 'Không thể xoá đơn hàng "' . $OrderID . '". Vui lòng thử lại.';
                        header("Location: ?act=cart-shop");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'Không tìm thấy đơn hàng với ID "' . $OrderID . '".';
                    header("Location: ?act=cart-shop");
                    exit();
                }
            }

            $_SESSION['success'] = 'Các đơn hàng đã được huỷ thành công!';
            header("Location: ?act=cart-shop");
            exit();
        }
    }
}
