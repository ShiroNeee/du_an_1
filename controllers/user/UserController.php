<?php

class UserController
{
    private $userModel;

    // Khởi tạo model User
    public function __construct()
    {
        $this->userModel = new User(); // Khởi tạo đối tượng User
    }

    // Hàm xử lý việc hiển thị danh sách người dùng
    public function index()
    {
        // Lấy danh sách người dùng từ model
        $listUsers = $this->userModel->getAll();

        // Hiển thị danh sách người dùng lên trang web
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/user/userList.php';
        require_once '../admin-page/views/footer.php';
    }
    // Profile
    public function profile()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];

            // Lấy thông tin chi tiết của người dùng
            $userDetail = $this->userModel->getDetail($id);

            // Hiển thị trang chỉnh sửa thông tin cá nhân
            require_once '../client-page/views/header.php';
            require_once '../client-page/views/proFile/proFile.php';
            require_once '../client-page/views/footer.php';
        } else {
            // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
            header("Location: ?act=login");
            exit();
        }
    }
    public function edit()
    {
        $id = $_GET['id'];
        //lấy ra thông tin chi tiết của ng dùng theo id
        $userDetail = $this->userModel->getDetail($id);
        require_once '../admin-page/views/header.php';
        require_once '../admin-page/views/user/editUser.php';
        require_once '../admin-page/views/footer.php';
    }
    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin từ form
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $phoneNumber = $_POST['phoneNumber'];
            $address = $_POST['address'];
            $roleID = $_SESSION['user']['roleID'];  // Lấy roleID từ session của người dùng, nếu có
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;

            // Kiểm tra người dùng đã đăng nhập và lấy role
            if ($roleID != 1 && $roleID != 2) {
                if ($id != $_SESSION['user']['id']) {
                    header("Location: ?act=profile"); // Nếu không phải của mình, chuyển hướng về trang cá nhân
                    exit();
                }
            }
            $userDetail = $this->userModel->getDetail($id);
            // Kiểm tra và xử lý lỗi (như tên, email, mật khẩu...)
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
            if (!empty($password)) {
                // Kiểm tra mật khẩu mới
                if (strlen($password) < 3) {
                    $errors['password'] = 'Mật khẩu phải có ít nhất 3 ký tự.';
                }
                // Kiểm tra xác nhận mật khẩu
                if ($password !== $confirmPassword) {
                    $errors['confirm_password'] = 'Mật khẩu và xác nhận mật khẩu không trùng khớp.';
                }
                // Mã hóa mật khẩu
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            } else {
                // Nếu không thay đổi mật khẩu, giữ mật khẩu cũ
                $hashedPassword = $userDetail['password'];
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
            if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../admin-page/img/user/';
                // Lấy phần mở rộng của file ảnh
                $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
                // Tạo tên file duy nhất dựa trên uniqid và phần mở rộng
                $fileName = uniqid('user_', true) . '.' . $fileExtension;
                $imagePath = $uploadDir . $fileName;

                if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                    // nếu tạo img thành công thì phải xoá ảnh cũ
                    if ($userDetail['image'] && file_exists($userDetail['image'])) {
                        unlink($userDetail['image']);
                    }
                }
            } else {
                $imagePath = $userDetail['image'];
            }

            // Nếu không có lỗi, tiến hành cập nhật thông tin
            if (empty($errors)) {
                // Cập nhật dữ liệu người dùng
                $this->userModel->updateData($id, $name, $email, $hashedPassword, $phoneNumber, $address, $roleID, $imagePath);

                $_SESSION['success'] = 'Cập nhật thông tin thành công!';
                header("Location: ?act=profile");
                exit();
            } else {
                $_SESSION['error'] = $errors;
                header("Location: ?act=profile");
                exit();
            }
        }
    }


    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $phoneNumber = $_POST['phoneNumber'];
            $address = $_POST['address'];
            $roleID = $_POST['roleID'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;

            $userDetail = $this->userModel->getDetail($id);
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
            if (!empty($password)) {
                // Kiểm tra mật khẩu mới
                if (strlen($password) < 3) {
                    $errors['password'] = 'Mật khẩu phải có ít nhất 3 ký tự.';
                }
                // Kiểm tra xác nhận mật khẩu
                if ($password !== $confirmPassword) {
                    $errors['confirm_password'] = 'Mật khẩu và xác nhận mật khẩu không trùng khớp.';
                }
                // Mã hóa mật khẩu
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            } else {
                // Nếu không thay đổi mật khẩu, giữ mật khẩu cũ
                $hashedPassword = $userDetail['password'];
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

            // Kiểm tra vai trò
            if (empty($roleID)) {
                $errors['roleID'] = 'Vai trò không được để trống.';
            } elseif ($roleID != '1' && $roleID != '2') {
                $errors['roleID'] = 'Vai trò không hợp lệ.';
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
                    if ($userDetail['image'] && file_exists($userDetail['image'])) {
                        unlink($userDetail['image']);
                    }
                }
            } else {
                $imagePath = $userDetail['image'];
            }

            if (empty($errors)) {
                $this->userModel->updateData($id, $name, $email, $hashedPassword, $phoneNumber, $address, $roleID, $imagePath);
                unset($_SESSION['error']);
                header("Location: ?act=list-user");
                exit();
            } else {
                $_SESSION['error'] = $errors;
                header("Location: ?act=edit-user&id=$id");
                exit();
            }
        }
    }

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            // lấy ra thông tin của ng xoá
            $userDetail = $this->userModel->getDetail($id);
            // Xoá ng dung
            $deleteUser = $this->userModel->deleteData($id);
            if ($deleteUser) {
                // Nếu xoá thành công thì sẽ xoá
                if ($userDetail['image'] && file_exists($userDetail['image'])) {
                    unlink($userDetail['image']);
                }
                header("Location: ?act=list-user");
                exit();
            }
        }
    }
}
