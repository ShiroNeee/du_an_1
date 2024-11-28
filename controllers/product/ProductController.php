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
        $listProducts = $this->modelProduct->getAllProduct();
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/product/productlist.php'; // main
        require_once '../admin-page/views/footer.php';
    }
    //
    // ấn vào thêm
    public function add()
    {
        $statusCategory  = $this->modelProduct->getCategoryList();
        $statusList  = $this->modelProduct->getStatusList();
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/product/productadd.php'; // main
        require_once '../admin-page/views/footer.php';
    }
    // tạo 
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ProductName = $_POST['ProductName'];
            $Description = $_POST['Description'];
            $Price = $_POST['Price'];
            $CategoryID = $_POST['CategoryID'];
            $status = $_POST['status'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;

            $errors = [];
            if (empty($ProductName)) {
                $errors['ProductName'] = 'Tên sản phẩm không được để trống.';
            } elseif (strlen($ProductName) <= 3) {
                $errors['ProductName'] = 'Tên sản phẩm phải tối thiểu 3 kí tự trở lên';
            }
            if (empty($Price)) {
                $errors['Price'] = 'Giá thành sản phẩm không được để trống.';
            } elseif (!is_numeric($Price) || $Price <= 0) {
                $errors['Price'] = 'Giá thành sản phẩm không được âm (dưới 0)';
            }
            if (empty($Description)) {
                $errors['Description'] = 'Mô tả chi tiết sản phẩm không được để trống.';
            } elseif (strlen($Description) <= 12) {
                $errors['Description'] = 'Mô tả chi tiết sản phẩm phải tối thiểu 12 kí tự trở lên';
            }
            if (empty($CategoryID)) {
                $errors['CategoryID'] = 'Vui lòng chọn danh mục sản phẩm';
            }
            // Xử lý upload ảnh
            if (empty($image) || $image['error'] === UPLOAD_ERR_NO_FILE) {
                $errors['image'] = 'Ảnh không được để trống.';
            } elseif ($image['error'] !== UPLOAD_ERR_OK) {
                $errors['image'] = 'Lỗi khi tải ảnh lên';
            } else {
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                $uploadDir = '../admin-page/img/product/';
                $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                if (!in_array($fileExtension, $allowedExtensions)) {
                    $errors['image'] = 'Chỉ được upload ảnh - jpg,jpeg,png';
                } else {
                    $fileName = uniqid('product_', true) . '.' . $fileExtension;
                    $imagePath = $uploadDir . $fileName;

                    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
                        $errors['image'] = 'Ảnh chưa lưu được, vui lòng thử tải lại ảnh';
                    }
                }
            }
            if (empty($errors)) {
                $this->modelProduct->addData($ProductName, $Description, $Price, $CategoryID, $status, $imagePath);
                unset($_SESSION['error']);
                $_SESSION['success'] = 'Sản phẩm đã được thêm thành công.';
                header("Location: ?act=list-product");
                exit();
            } else {
                $_SESSION['error'] = $errors;
                header("Location: ?act=add-product");
                exit();
            }
        }
    }
    // ấn để sửa
    public function edit()
    {
        $id = $_GET['id'];
        //lấy ra thông tin chi tiết của ng dùng theo id
        $productDetail = $this->modelProduct->getDetail($id);
        $statusList  = $this->modelProduct->getStatusList();
        $statusCategory  = $this->modelProduct->getCategoryList();
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/product/productedit.php';
        require_once '../admin-page/views/footer.php';
    }
    // sửa
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $ProductName = $_POST['ProductName'];
            $Description = $_POST['Description'];
            $Price = $_POST['Price'];
            $CategoryID = $_POST['CategoryID'];
            $status = $_POST['status'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
            $errors = [];

            if (empty($ProductName)) {
                $errors['ProductName'] = 'Tên sản phẩm không được để trống.';
            } elseif (strlen($ProductName) <= 6) {
                $errors['ProductName'] = 'Tên sản phẩm phải tối thiểu 6 kí tự trở lên';
            }
            if (empty($Price)) {
                $errors['Price'] = 'Giá thành sản phẩm không được để trống.';
            } elseif (!is_numeric($Price) || $Price <= 0) {
                $errors['Price'] = 'Giá thành sản phẩm không được âm (dưới 0)';
            }
            if (empty($Description)) {
                $errors['Description'] = 'Mô tả chi tiết sản phẩm không được để trống.';
            } elseif (strlen($Description) <= 12) {
                $errors['Description'] = 'Mô tả chi tiết sản phẩm phải tối thiểu 12 kí tự trở lên';
            }
            if (empty($CategoryID)) {
                $errors['CategoryID'] = 'Vui lòng chọn danh mục sản phẩm';
            }
            $productDetail = $this->modelProduct->getDetail($id);
            $imagePath = $productDetail['image'];
            // Xử lý upload ảnh
            if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../admin-page/img/product/';
                $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    $fileName = uniqid('product_', true) . '.' . $fileExtension;
                    $imagePath = $uploadDir . $fileName;
                    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                        if (!empty($productDetail['image']) && file_exists($productDetail['image'])) {
                            unlink($productDetail['image']);
                        }
                    } else {
                        $errors['image'] = 'Ảnh không tải lên được';
                    }
                } else {
                    $errors['image'] = 'Chỉ có thể upload được ảnh';
                }
            } else {
                $imagePath = $productDetail['image'];
            }
            if (empty($errors) && $productDetail) {
                $this->modelProduct->updateDataProduct($id, $ProductName, $Description, $Price, $CategoryID, $status, $imagePath);
                $_SESSION['success'] = 'Sản phẩm đã được cập nhật thành công.';
                header("Location: ?act=list-product");
                exit();
            } else {
                $_SESSION['error'] = $errors;
                header("Location: ?act=edit-product&id=$id");
                exit();
            }
        }
    }
    // Xóa sản phẩm
    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $productDetail = $this->modelProduct->getDetail($id);
            $deleteProduct = $this->modelProduct->deleteData($id);

            if ($deleteProduct) {
                if ($productDetail['image'] && file_exists($productDetail['image'])) {
                    unlink($productDetail['image']);
                }
                $_SESSION['success'] = 'Xóa sản phẩm thanh công xong';
                header("Location: ?act=list-product");
                exit();
            }
        }
    }
}
