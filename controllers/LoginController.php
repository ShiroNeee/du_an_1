<?php
class LoginController
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['id']) {
            header('Location: ?act=profile');
            exit();
        }
        require_once '../client-page/views/header.php';
        require_once '../client-page/login_form.php';
        require_once '../client-page/views/footer.php';
    }
    // Xử lý đăng nhập
    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $email    = $_POST['email'];
            $password = $_POST['password'];

            // Kiểm tra lỗi
            $errors = [];
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ.';
            }
            if (empty($password)) {
                $errors['password'] = 'Mật khẩu không được để trống.';
            } elseif (strlen($password) < 3) {
                $errors['password'] = 'Mật khẩu phải có ít nhất 3 ký tự.';
            }

            // Nếu có lỗi, lưu lại lỗi vào session và quay lại trang đăng nhập
            if (!empty($errors)) { 
                $_SESSION['error'] = $errors;
                header("Location: ?act=login");
                exit();
            }
            // Kiểm tra thông tin người dùng (giả sử bạn có một hàm kiểm tra đăng nhập trong model)
            require_once __DIR__ . '/../models/users/user.php';
            $userModel = new User();
            $user = $userModel->checkLogin($email, $password);

            if ($user) {
                // Đăng nhập thành công, lưu thông tin người dùng vào session và chuyển hướng
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'roleID' => $user['roleID']
                ];
                $_SESSION['success'] = 'Đăng nhập thành công!';

                if ($user['roleID'] == 1) {
                    header("Location: /du_an_1/admin-page/");
                } else {
                    header("Location: /du_an_1/client-page/");
                }
                exit();
            } else {
                // Nếu thông tin không đúng, thông báo lỗi
                $_SESSION['error']['general'] = 'Email hoặc mật khẩu không đúng.';
                header("Location: ?act=login");
                exit();
            }
        }
    }

    // Xử lý đăng xuất
    public function logout()
    {
        // Xóa session người dùng
        session_unset();
        session_destroy();

        header("Location: /du_an_1/client-page/?act=login");
        exit();
    }
}
