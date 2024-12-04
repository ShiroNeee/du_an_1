<?php
// Kiểm tra và xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productID = $_POST['ProductID'];
    $userID = $_POST['UserID'];
    $content = $_POST['Content'];
    $orderID = $_POST['OrderID'];

    $_SESSION['error'] = [];

    // Kiểm tra nội dung bình luận không được trống
    if (empty($content)) {
        $_SESSION['error'][] = "Nội dung bình luận không được để trống!";
    }

    // Kiểm tra ID sản phẩm và ID người dùng
    if (empty($productID) || empty($userID)) {
        $_SESSION['error'][] = "Vui lòng chọn sản phẩm và người dùng!";
    }

    // Kiểm tra ID đơn hàng
    if (empty($orderID)) {
        $_SESSION['error'][] = "Vui lòng nhập ID đơn hàng!";
    }

    if (empty($_SESSION['error'])) {
        // Lưu bình luận vào database (thực hiện thêm dữ liệu vào database)
        // Ví dụ: $result = $this->modelComment->addComment($productID, $userID, $content, $orderID);
        
        $_SESSION['message'] = "Bình luận đã được thêm thành công!";
        header("Location: ?act=comment-list"); // Chuyển hướng sau khi thêm thành công
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Bình Luận</title>
    <style>
        .showErrorMessage {
            background-color: #f8d7da;
            color: red;
            border: 1px solid #f5c2c7;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            width: 90%;
        }

        .showErrorMessage ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .showErrorMessage li {
            margin-bottom: 5px;
        }

        .admin-product-form-container {
            margin: 20px auto;
            max-width: 800px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .admin-product-form-container h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .admin-product-form-container .form-group {
            margin-bottom: 15px;
        }

        .admin-product-form-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .admin-product-form-container input,
        .admin-product-form-container select,
        .admin-product-form-container textarea,
        .admin-product-form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .admin-product-form-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .admin-product-form-container button:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <div class="admin-product-form-container">
        <!-- Hiển thị thông báo lỗi -->
        <?php if (!empty($_SESSION['error']) && is_array($_SESSION['error'])): ?>
            <div class="showErrorMessage">
                <ul>
                    <?php foreach ($_SESSION['error'] as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Hiển thị thông báo thành công -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="showErrorMessage">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <h3>Thêm Bình Luận</h3>

        <form action="?act=comment-add" method="POST">
            <!-- ID Sản phẩm -->
            <div class="form-group">
                <label for="ProductID">Chọn Sản Phẩm:</label>
                <select name="ProductID" id="ProductID" required>
                    <option value="">Chọn sản phẩm</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo $product['id']; ?>"><?php echo $product['ProductName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- ID Người dùng -->
            <div class="form-group">
                <label for="UserID">Chọn Người Dùng:</label>
                <select name="UserID" id="UserID" required>
                    <option value="">Chọn người dùng</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Nội dung bình luận -->
            <div class="form-group">
                <label for="Content">Nội dung:</label>
                <textarea name="Content" id="Content" rows="4" required></textarea>
            </div>

            <!-- ID Đơn hàng -->
            <div class="form-group">
                <label for="OrderID">ID Đơn hàng:</label>
                <input type="number" name="OrderID" id="OrderID" required>
            </div>

            <div>
                <button type="submit">Thêm Bình Luận</button>
            </div>
        </form>
    </div>
</body>

</html>
