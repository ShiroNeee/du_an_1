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
            $validCategories = [1, 2, 3]; //id danh mục hợp lệ
            $validStatuses = [0, 1];      //id status hợp lệ  
            if (empty($ProductName)) {
                $errors['ProductName'] = 'Tên sản phẩm không được để trống.';
            } elseif (strlen($ProductName) <= 6) {
                $errors['ProductName'] = 'Tên sản phẩm phải tối thiểu 6 kí tự trở lên';
            }
            if (empty($Description)) {
                $errors['Description'] = 'Mô tả chi tiết sản phẩm không được để trống.';
            } elseif (strlen($Description) <= 10) {
                $errors['Description'] = 'Mô tả chi tiết sản phẩm phải tối thiểu 12 kí tự trở lên';
            }
            if (empty($Price)) {
                $errors['Price'] = 'Giá thành sản phẩm không được để trống.';
            } elseif (!is_numeric($Price) || $Price <= 0) {
                $errors['Price'] = 'Giá thành sản phẩm không được âm (dưới 0)';
            }
            if (!in_array($CategoryID, $validCategories)) {
                $errors['CategoryID'] = 'Vui lòng chọn danh mục sản phẩm';
            }
            if (!in_array($status, $validStatuses)) {
                $errors['status'] = 'Chưa có trạng thái sản phẩm sản phẩm';
            }
            // Xử lý upload ảnh
            if (!empty($image) && $image['error'] === UPLOAD_ERR_OK) {
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                $uploadDir = '../admin-page/img/product/';
                $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                if (!in_array($fileExtension, $allowedExtensions)) {
                    $errors['image'] = 'Các tệp có thể upload - jpg, jpeg, png';
                } else {
                    $fileName = uniqid('product_', true) . '.' . $fileExtension;
                    $imagePath = $uploadDir . $fileName;
                    move_uploaded_file($image['tmp_name'], $imagePath);
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

            $validCategories = [1, 2, 3]; //id danh mục hợp lệ
            $validStatuses = [0, 1];      //id status hợp lệ  
            if (empty($ProductName)) {
                $errors['ProductName'] = 'Tên sản phẩm không được để trống.';
            } elseif (strlen($ProductName) <= 6) {
                $errors['ProductName'] = 'Tên sản phẩm phải tối thiểu 6 kí tự trở lên';
            }
            if (empty($Description)) {
                $errors['Description'] = 'Mô tả chi tiết sản phẩm không được để trống.';
            } elseif (strlen($Description) <= 10) {
                $errors['Description'] = 'Mô tả chi tiết sản phẩm phải tối thiểu 12 kí tự trở lên';
            }
            if (empty($Price)) {
                $errors['Price'] = 'Giá thành sản phẩm không được để trống.';
            } elseif (!is_numeric($Price) || $Price <= 0) {
                $errors['Price'] = 'Giá thành sản phẩm không được âm (dưới 0)';
            }
            if (!in_array($CategoryID, $validCategories)) {
                $errors['CategoryID'] = 'Vui lòng chọn danh mục sản phẩm';
            }
            if (!in_array($status, $validStatuses)) {
                $errors['status'] = 'Chưa có trạng thái sản phẩm sản phẩm';
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
                if ($productDetail['hinh_anh'] && file_exists($productDetail['hinh_anh'])) {
                    unlink($productDetail['hinh_anh']);
                }
                $_SESSION['success'] = 'Xóa sản phẩm thanh công xong';
                header("Location: ?act=list-product");
                exit();
            }
        }
    }
}
