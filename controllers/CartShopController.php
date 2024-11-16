<?php
class CartShopController
{
    // Hiển thị form đăng nhập
    public function cartshopController()
    {
        require_once '../client-page/views/header.php';
        require_once '../client-page/cart_shop.php';
        require_once '../client-page/views/footer.php';
    }
}