<?php
class RegisterController
{
    public $modelCategory;

    public function __construct()
    {
        $this->modelCategory = new CategoryManager();  // Model danh mục
    }
    // Hiển thị form đăng ký
    public function registerForm()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['id']) {
            header('Location: ?act=profile');
            exit();
        }
        $latestCategorysHome = $this->modelCategory->showCategories();
        require_once '../client-page/views/header.php';
        require_once '../client-page/register_form.php';
        require_once '../client-page/views/footer.php';
    }
    // Xử lý đăng ký
    public function handleRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $name            = $_POST['name'];
            $email           = $_POST['email'];
            $password        = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $phoneNumber     = $_POST['phoneNumber'];
            $address         = $_POST['address'];
            $roleID          = isset($_POST['roleID']) ? $_POST['roleID'] : '2';
            $image           = isset($_FILES['image']) ? $_FILES['image'] : null;

            // Kiểm tra lỗi
            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Họ tên không được để trống.';
            }
            // Kiểm tra email
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ.';
            }

            // Kiểm tra mật khẩu
            if (empty($password)) {
                $errors['password'] = 'Mật khẩu không được để trống.';
            } elseif (strlen($password) < 3) {
                $errors['password'] = 'Mật khẩu phải có ít nhất 3 ký tự.';
            }

            // Kiểm tra xác nhận mật khẩu
            if (empty($confirmPassword)) {
                $errors['confirm_password'] = 'Xác nhận mật khẩu không được để trống.';
            } elseif ($password !== $confirmPassword) {
                $errors['confirm_password'] = 'Mật khẩu và xác nhận mật khẩu không trùng khớp.';
            }

            // Kiểm tra số điện thoại
            if (empty($phoneNumber)) {
                $errors['phoneNumber'] = 'Số điện thoại không được để trống.';
            } elseif (!preg_match('/^[0-9]{10,11}$/', $phoneNumber)) {
                $errors['phoneNumber'] = 'Số điện thoại không hợp lệ. Vui lòng nhập đúng định dạng.';
            }

            // Kiểm tra địa chỉ
            if (empty($address)) {
                $errors['address'] = 'Địa chỉ không được để trống.';
            }

            // Xử lý upload ảnh
            $imagePath = null;
            if ($image && $image['error'] == 0) {
                $uploadDir = '../admin-page/img/user/';
                // Lấy phần mở rộng của file ảnh
                $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
                // Tạo tên file duy nhất dựa trên uniqid và phần mở rộng
                $fileName = uniqid('user_', true) . '.' . $fileExtension;
                $imagePath = $uploadDir . $fileName;

                // Di chuyển file đến thư mục
                if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
                    $errors['image'] = 'Không thể upload ảnh.';
                    $_SESSION['error'] = $errors;
                    header("Location: ?act=register");
                    exit();
                }
            }
            // Kiểm tra nếu có lỗi
            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
                header("Location: ?act=register");
                exit();
            }

            // Gọi model để đăng ký người dùng
            require_once __DIR__ . '/../models/users/user.php';
            $userModel = new User();

            $isUserAdded = $userModel->postData($name, $email, $password, $phoneNumber, $address, $roleID, $imagePath);

            if ($isUserAdded) {
                // Nếu đăng ký thành công, lưu thông báo thành công vào SESSION
                $_SESSION['success'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
                header("Location: ?act=login");
                exit();
            } else {
                // Thông báo đăng ký thất bại
                $_SESSION['error']['general'] = 'Đăng ký không thành công. Vui lòng thử lại.';
                header("Location: ?act=register");
                exit();
            }
        }
    }
}
