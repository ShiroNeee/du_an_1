<?php
class RegisterController
{
    // Hiển thị form đăng ký
    public function registerForm()
    {
        require_once '../client-page/views/header.php';
        require_once '../client-page/register_form.php';
        require_once '../client-page/views/footer.php';
    }
}
