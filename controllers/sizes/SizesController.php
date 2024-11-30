<?php
// Kết nối với Model
class SizesController
{
    public $modelSizes;
    public $modelProduct;

    public function __construct()
    {
        // Khởi tạo Model
        $this->modelSizes = new SizeModel();
        $this->modelProduct = new Product();
    }

    // Hàm hiển thị danh sách kích cỡ
    public function index()
    {
        // Lấy danh sách kích cỡ từ model
        $sizes = $this->modelSizes->getAllSizes();
        
        // Yêu cầu hiển thị giao diện
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/sizes/sizeslist.php'; // Trang hiển thị danh sách kích cỡ
        require_once '../admin-page/views/footer.php';
    }

    public function add()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $productID = $_POST['productID'];  // Lấy ID của sản phẩm
        $sizes = $_POST['size'];           // Mảng kích cỡ
        $stockQuantities = $_POST['stockQuantity'];  // Mảng số lượng tồn kho
        $prices = $_POST['price'];         // Mảng giá

        // Duyệt qua từng kích cỡ, số tồn kho, và giá
        foreach ($sizes as $key => $size) {
            $stockQuantity = $stockQuantities[$key];
            $price = $prices[$key];

            // Thêm kích cỡ với giá
            $result = $this->modelSizes->addSize($productID, $size, $stockQuantity, $price);

            if (!$result) {
                echo "Có lỗi xảy ra khi thêm kích cỡ: " . $size;
                return;
            }
        }

        // Chuyển hướng sau khi thêm thành công
        header('Location: ?act=sizes-list');
        exit;
    } else {
        $products = $this->modelSizes->getAllProducts();
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/sizes/sizesadd.php';
        require_once '../admin-page/views/footer.php';
    }
}

    
    // Hàm sửa kích cỡ
    public function edit() {
        // Kiểm tra nếu có id của kích cỡ
        if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
            echo "ID không hợp lệ!";
            return;
        }

        $sizeID = $_GET['id'];
        $size = $this->modelSizes->getSizeById($sizeID);
        if (!$size) {
            echo "Kích cỡ không tồn tại!";
            return;
        }

        // Lấy thông tin sản phẩm liên quan
        $product = $this->modelProduct->getProductById($size['ProductID']);
        $productName = $product['ProductName'];
        $currentPrice = $product['Price'];

        // Nếu form đã được gửi
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productID = $_POST['productID'];
            $sizes = $_POST['size'];
            $stockQuantities = $_POST['stockQuantity'];
            $prices = $_POST['price'];

            $_SESSION['error'] = [];

            // Kiểm tra tính hợp lệ của số lượng tồn kho
            foreach ($stockQuantities as $quantity) {
                if ($quantity <= 0) {
                    $_SESSION['error'][] = "Số lượng tồn kho phải là số dương!";
                }
            }

            if (empty($_SESSION['error'])) {
                // Cập nhật kích cỡ vào database
                foreach ($sizes as $key => $sizeValue) {
                    $this->modelSizes->updateSize($sizeID, $productID, $sizeValue, $stockQuantities[$key], $prices[$key]);
                }

                // Chuyển hướng sau khi cập nhật thành công
                header('Location: ?act=sizes-list');
                exit;
            }
        }

        // Truyền dữ liệu vào view
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/sizes/sizesedit.php';
        require_once '../admin-page/views/footer.php';
    }



    // Hàm xóa kích cỡ
    public function delete()
{
    // Kiểm tra xem id có tồn tại trong URL không
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id']; // Dùng id thay vì sizeID
    } else {
        echo "Không có ID sản phẩm hoặc kích cỡ cần xóa.";
        return;
    }

    // Kiểm tra xem id có hợp lệ không (là số nguyên)
    if (!is_numeric($id)) {
        echo "ID không hợp lệ!";
        return;
    }

    // Kiểm tra xem sản phẩm/kích cỡ có tồn tại trong cơ sở dữ liệu không
    $size = $this->modelSizes->getSizeById($id); // Lấy thông tin theo id
    if (!$size) {
        echo "Không tìm thấy sản phẩm/kích cỡ với ID này!";
        return;
    }

    // Xóa sản phẩm/kích cỡ khỏi cơ sở dữ liệu
    $result = $this->modelSizes->deleteSize($id); // Xóa theo id

    // Kiểm tra kết quả và chuyển hướng về trang quản lý
    if ($result) {
        header('Location: ?act=sizes-list');
        exit;
    } else {
        echo "Có lỗi xảy ra khi xóa.";
    }
}
 
}
?>