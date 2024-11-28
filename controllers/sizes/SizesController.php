<?php
// Kết nối với Model
class SizesController
{
    public $modelSizes;

    public function __construct()
    {
        // Khởi tạo Model
        $this->modelSizes = new SizeModel();
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
            $stockQuantities = $_POST['stockQuantity'];  // Mảng số lượng tồn kho (có thể nhập nhiều)
    
            // Duyệt qua từng kích cỡ và số tồn kho, thêm vào cơ sở dữ liệu
            foreach ($sizes as $key => $size) {
                $stockQuantity = $stockQuantities[$key];  // Lấy số lượng tồn kho tương ứng với kích cỡ
    
                // Gọi phương thức thêm kích cỡ vào database với số lượng tồn kho
                $result = $this->modelSizes->addSize($productID, $size, $stockQuantity);
    
                if (!$result) {
                    echo "Có lỗi xảy ra khi thêm kích cỡ: " . $size;
                    return;
                }
            }
    
            // Nếu tất cả thành công, chuyển hướng
            header('Location: ?act=sizes-list');
            exit;
        } else {
            // Lấy danh sách sản phẩm từ model
            $products = $this->modelSizes->getAllProducts();
    
            // Hiển thị form thêm kích cỡ
            require_once '../admin-page/views/header.php';
            require_once '../admin-page/views/sizes/sizesadd.php'; // Form thêm kích cỡ
            require_once '../admin-page/views/footer.php';
        }
    }
    
    // Hàm sửa kích cỡ
    public function edit()
{
    // Kiểm tra ID hợp lệ
    if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
        echo "ID không hợp lệ!";
        return;
    }
    
    $sizeID = $_GET['id'];

    // Lấy thông tin kích cỡ
    $size = $this->modelSizes->getSizeById($sizeID);
    
    // Kiểm tra kích cỡ tồn tại không
    if (!$size) {
        echo "Kích cỡ không tồn tại!";
        return;
    }

    // Lấy thông tin sản phẩm liên quan đến kích cỡ này
    $product = $this->modelSizes->getProductById($size['ProductID']); // Giả sử model có phương thức này
    
    // Kiểm tra sản phẩm có tồn tại không
    if (!$product) {
        echo "Sản phẩm không tồn tại!";
        return;
    }

    // Xử lý khi form được submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $productID = $_POST['productID'];
        $size = $_POST['size'];
        $stockQuantity = $_POST['stockQuantity'];

        if (empty($productID) || empty($size) || !is_numeric($stockQuantity)) {
            echo "Dữ liệu đầu vào không hợp lệ!";
            return;
        }

        // Cập nhật kích cỡ
        $result = $this->modelSizes->updateSize($sizeID, $productID, $size, $stockQuantity);

        if ($result) {
            header('Location: ?act=sizes-list');
            exit;
        } else {
            echo "Có lỗi xảy ra khi cập nhật kích cỡ.";
        }
    } else {
        // Truyền thông tin kích cỡ và sản phẩm đến view
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/sizes/sizesedit.php';
        require_once '../admin-page/views/footer.php';
    }
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