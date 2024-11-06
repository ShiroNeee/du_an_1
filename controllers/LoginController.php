<?php
class LoginController
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        require_once '../client-page/views/header.php';
        require_once '../client-page/login_form.php';
        require_once '../client-page/views/footer.php';
    }
}
