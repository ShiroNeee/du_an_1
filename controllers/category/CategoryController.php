<?php
class CategoryController
{
    private $modelCategory;

    public function __construct()
    {
        $this->modelCategory = new CategoryManager(); // Kết nối với class CategoryManager
    }

    // Hiển thị danh sách danh mục
    public function index()
    {
        $listCategories = $this->modelCategory->getAllCategories();
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/category/categorylist.php'; // main
        require_once '../admin-page/views/footer.php';
    }

    // Hiển thị trang thêm danh mục
    public function addController()
    {
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/category/categoryadd.php'; // main
        require_once '../admin-page/views/footer.php';
    }

    // Xử lý thêm mới danh mục
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryName = $_POST['categoryName'];
            $error = [];

            if (empty($categoryName)) {
                $error['categoryName'] = 'Bạn cần nhập tên danh mục';
            }

            if (empty($error)) {
                $this->modelCategory->addCategory($categoryName);
                header("Location: ?act=list-category"); // Điều hướng về trang danh sách danh mục
                $_SESSION['success'] = 'Thêm danh mục sản phẩm thah công';
                exit();
            } else {
                $_SESSION['error'] = $error;
                header("Location: ?act=add-category");
                exit();
            }
        }
    }

    // Hiển thị trang chỉnh sửa danh mục
    public function editController()
    {
        $id = $_GET['id'];
        $categoryDetail = $this->modelCategory->getCategoryDetail($id);
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/category/categoryedit.php'; // main
        require_once '../admin-page/views/footer.php';
    }

    // Xử lý cập nhật danh mục
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $categoryName = $_POST['categoryName'];
            $error = [];

            if (empty($categoryName)) {
                $error['categoryName'] = 'Bạn cần nhập tên danh mục';
            }

            $categoryDetail = $this->modelCategory->getCategoryDetail($id);
            if (empty($error) && $categoryDetail) {
                $this->modelCategory->updateCategory($id, $categoryName);
                unset($_SESSION['error']);
                $_SESSION['success'] = 'Sửa danh mục sản phẩm thah công';
                header("Location: ?act=list-category"); // Điều hướng về trang danh sách danh mục
                exit();
            } else {
                $_SESSION['error'] = $error;
                header("Location: ?act=edit-category&id=$id");
                exit();
            }
        }
    }

    // Xử lý xóa danh mục
    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $categoryDetail = $this->modelCategory->getCategoryDetail($id);
            $deleteCategory = $this->modelCategory->deleteCategory($id);

            if ($deleteCategory) {
                $_SESSION['success'] = 'Xóa danh mục sản phẩm thah công';
                header("Location: ?act=list-category"); // Điều hướng về trang danh sách danh mục
                exit();
            } else {
                $_SESSION['error'] = 'Không thể xóa danh mục. Vui lòng thử lại.';
                header("Location: ?act=list-category");
                exit();
            }
        }
    }
}
