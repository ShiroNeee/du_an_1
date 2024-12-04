<?php
// Kết nối với Model
class CommentController
{
    public $modelComment;

    public function __construct()
    {

        $this->modelComment = new CommentModel();
    }

    // Hàm hiển thị danh sách kích cỡ
    public function index()
    {
        $comments = $this->modelComment->getAllComments();
        // Yêu cầu hiển thị giao diện
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/comment/commentlist.php';
        require_once '../admin-page/views/header.php';
    }
    public function add()
    {
        // Lấy danh sách sản phẩm và người dùng
        $products = $this->modelComment->getAllProducts();
        $users = $this->modelComment->getAllUsers();
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $ProductID = $_POST['ProductID'];
            $UserID = $_POST['UserID'];
            $Content = $_POST['Content'];
            $OrderID = $_POST['OrderID'];
    
            // Thêm bình luận
            $result = $this->modelComment->addComment($ProductID, $UserID, $Content, $OrderID);
    
            // Thông báo thành công hay thất bại
            if ($result) {
                $_SESSION['message'] = 'Thêm bình luận thành công!';
            } else {
                $_SESSION['message'] = 'Có lỗi xảy ra!';
            }
    
            // Chuyển hướng lại trang thêm bình luận
            header('Location: ?act=comment-list');
            exit();
        }
    
        // Hiển thị view thêm bình luận
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/comment/commentadd.php';
        require_once '../admin-page/views/footer.php';
    }
    
    
    

    // Hiển thị form chỉnh sửa bình luận
    public function edit()
    {
        // Lấy ID từ URL (hoặc có thể lấy từ tham số nào khác, ví dụ $_GET hoặc $_POST)
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            // Nếu không có ID, có thể redirect hoặc thông báo lỗi
            $_SESSION['message'] = "ID bình luận không hợp lệ!";
            header("Location: ?act=comment-list"); // Đảm bảo URL này là chính xác
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $data = [
                'ProductID' => $_POST['ProductID'],
                'UserID' => $_POST['UserID'],
                'Content' => $_POST['Content'],
                'CreatdAt' => date('Y-m-d H:i:s'), // Thời gian hiện tại
                'OrderID' => isset($_POST['OrderID']) ? $_POST['OrderID'] : null
            ];
    
            // Gọi phương thức updateComment từ model
            $result = $this->modelComment->updateComment($id, $data);
    
            // Kiểm tra kết quả và thông báo cho người dùng
            if ($result) {
                $_SESSION['message'] = "Bình luận đã được cập nhật thành công!";
            } else {
                $_SESSION['message'] = "Có lỗi xảy ra trong quá trình cập nhật bình luận.";
            }
    
            // Chuyển hướng về trang danh sách bình luận (hoặc trang phù hợp)
            header("Location: ?act=comment-list"); // Đảm bảo URL này là chính xác trong ứng dụng của bạn
            exit();
        }
    
        // Nếu không phải POST, hiển thị form cập nhật bình luận
        $comment = $this->modelComment->getCommentById($id); // Lấy bình luận theo ID từ Model
    
        // Lấy danh sách sản phẩm và người dùng
        $products = $this->modelComment->getAllProducts(); // Phương thức lấy danh sách sản phẩm
        $users = $this->modelComment->getAllUsers(); // Phương thức lấy danh sách người dùng
    
        // Truyền dữ liệu vào view
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/comment/commentedit.php';
        require_once '../admin-page/views/footer.php';
    }

    // Xử lý xóa bình luận
    public function delete()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($this->modelComment->deleteComment($id)) {
            header('Location: ?act=comment-list');
        } else {
            echo "Xóa bình luận thất bại!";
        }
    }
}
