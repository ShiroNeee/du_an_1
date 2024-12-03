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
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // Lấy danh sách kích cỡ từ model
        $sizes = $this->modelSizes->getAllSizes($currentPage);
        $totalPages = $this->modelSizes->getTotalPages();

        // Yêu cầu hiển thị giao diện
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/sizes/sizeslist.php'; // Trang hiển thị danh sách kích cỡ
        require_once '../admin-page/views/footer.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productID = $_POST['productID'];
            $sizes = $_POST['size'];
            $stockQuantities = $_POST['stockQuantity'];

            $_SESSION['message'] = []; // Đảm bảo khởi tạo mảng thông báo

            foreach ($sizes as $key => $size) {
                $stockQuantity = $stockQuantities[$key];

                $result = $this->modelSizes->addSize($productID, $size, $stockQuantity);

                if (!$result) {
                    $_SESSION['message'][] = "Có lỗi xảy ra khi thêm kích cỡ: $size";
                }
            }

            if (empty($_SESSION['message'])) {
                $_SESSION['message'][] = "Thêm kích cỡ thành công!";
            }

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
    public function edit()
    {
        
        if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['message'] = ["ID không hợp lệ!"];
            header('Location: ?act=sizes-list');
            exit;
        }
        $sizeID = $_GET['id'];
        $size = $this->modelSizes->getSizeById($sizeID);
        if (!$size) {
            $_SESSION['message'] = ["Kích cỡ không tồn tại!"];
            header('Location: ?act=sizes-list');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productID = $_POST['productID'];
            $size = $_POST['size'];
            $stockQuantity = $_POST['stockQuantity'];

            if (empty($productID) || empty($size) || !is_numeric($stockQuantity)) {
                $_SESSION['message'] = ["Dữ liệu đầu vào không hợp lệ!"];
                header('Location: ?act=sizes-edit&id=' . $sizeID);
                exit;
            }

            $result = $this->modelSizes->updateSize($sizeID, $productID, $size, $stockQuantity);

            if ($result) {
                $_SESSION['message'] = ["Cập nhật kích cỡ thành công!"];
                header('Location: ?act=sizes-list');
            } else {
                $_SESSION['message'] = ["Có lỗi xảy ra khi cập nhật kích cỡ."];
                header('Location: ?act=sizes-edit&id=' . $sizeID);
            }
            exit;
        } else {
            $product = $this->modelSizes->getProductById($size['ProductID']);
            require_once '../admin-page/views/header.php';
            require_once '../admin-page/views/sizes/sizesedit.php';
            require_once '../admin-page/views/footer.php';
        }
    }


    // Hàm xóa kích cỡ
    public function delete()
    {
        if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['message'] = ["ID không hợp lệ!"];
            header('Location: ?act=sizes-list');
            exit;
        }

        $id = $_GET['id'];
        $size = $this->modelSizes->getSizeById($id);

        if (!$size) {
            $_SESSION['message'] = ["Không tìm thấy kích cỡ với ID này!"];
            header('Location: ?act=sizes-list');
            exit;
        }

        $result = $this->modelSizes->deleteSize($id);

        if ($result) {
            $_SESSION['message'] = ["Xóa kích cỡ thành công!"];
        } else {
            $_SESSION['message'] = ["Có lỗi xảy ra khi xóa kích cỡ."];
        }

        header('Location: ?act=sizes-list');
        exit;
    }
}
