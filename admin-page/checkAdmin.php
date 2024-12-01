<?php
// Chỉ cần định nghĩa hàm kiểm tra quyền admin
function checkAdminAccess() {
    if (!isset($_SESSION['user']) ||  ($_SESSION['user']['roleID'] != 1 && $_SESSION['user']['roleID'] != 2)) {
        // Nếu chưa đăng nhập hoặc không phải admin, chuyển hướng về trang 404
        header("Location: /du_an_1/admin-page/views/404.php");
        exit();
    }
    return true; 
}

?>
