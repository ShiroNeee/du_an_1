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
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ProductName = $_POST['ProductName'] ?? null;
            $Description = $_POST['Description'] ?? null;
            $Price = $_POST['Price'] ?? null;
            $CategoryID = $_POST['CategoryID'] ?? null;
            $status = $_POST['status'] ?? null;
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
        
            $errors = [];
            $validCategories = [1, 2, 3]; //id danh mục hợp lệ
            $validStatuses = [1, 2];      //id status hợp lệ  
            if (empty($ProductName)) {
                $errors['ProductName'] = 'Tên sản phẩm không được để trống.';
            }
            if (empty($Description)) {
                $errors['Description'] = 'Description không được để trống.';
            }
            if (empty($Price)) {
                $errors['Price'] = 'Giá sản phẩm không được để trống.';
            }
            if (!in_array($CategoryID, $validCategories)) {
                $errors['CategoryID'] = 'Danh mục không hợp lệ.';
            }
            if (!in_array($status, $validStatuses)) {
                $errors['status'] = 'Trạng thái sản phẩm không hợp lệ.';
            }
            // Xử lý upload ảnh
            if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../admin-page/img/user/';
                // Lấy phần mở rộng của file ảnh
                $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
                // Tạo tên file duy nhất dựa trên uniqid và phần mở rộng
                $fileName = uniqid('user_', true) . '.' . $fileExtension;
                $imagePath = $uploadDir . $fileName;
            }
            if (empty($errors)) {
                $this->modelProduct->addData($ProductName,$Description,$Price,$CategoryID,$status,$imagePath);
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
    // sửa sản phẩm
    public function edit()
    {
        $id = $_GET['id'];
        //lấy ra thông tin chi tiết của ng dùng theo id
        $productDetail = $this->modelProduct->getDetail($id);
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/product/productedit.php';
        require_once '../admin-page/views/footer.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $ProductName = $_POST['ProductName'] ?? null;
            $Description = $_POST['Description'] ?? null;
            $Price = $_POST['Price'] ?? null;
            $CategoryID = $_POST['CategoryID'] ?? null;
            $status = $_POST['status'] ?? null;
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
        
            $productDetail = $this->modelProduct->getDetail($id);
            $errors = [];
            $validCategories = [1, 2, 3]; //id danh mục hợp lệ
            $validStatuses = [1, 2];      //id status hợp lệ  
            if (empty($ProductName)) {
                $errors['ProductName'] = 'Tên sản phẩm không được để trống.';
            }
            if (empty($Description)) {
                $errors['Description'] = 'Description không được để trống.';
            }
            if (empty($Price)) {
                $errors['Price'] = 'Giá sản phẩm không được để trống.';
            }
            if (!in_array($CategoryID, $validCategories)) {
                $errors['CategoryID'] = 'Danh mục không hợp lệ.';
            }
            if (!in_array($status, $validStatuses)) {
                $errors['status'] = 'Trạng thái không hợp lệ.';
            }
            // Xử lý upload ảnh
            if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../admin-page/img/user/';
                // Lấy phần mở rộng của file ảnh
                $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
                // Tạo tên file duy nhất dựa trên uniqid và phần mở rộng
                $fileName = uniqid('user_', true) . '.' . $fileExtension;
                $imagePath = $uploadDir . $fileName;

                if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                    // nếu tạo img thành công thì phải xoá ảnh cũ
                    if ($productDetail['image'] && file_exists($productDetail['image'])) {
                        unlink($productDetail['image']);
                    }
                }
            } else {
                $imagePath = $productDetail['image'];
            }
            if (empty($errors)) {
                $this->modelProduct->updateData($id, $ProductName, $Description, $Price, $CategoryID,$status,$imagePath);
                unset($_SESSION['error']);
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
               header("Location: ?act=list-product");
               exit();
           }
       }
   }
}