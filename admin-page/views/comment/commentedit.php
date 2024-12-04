<h1>Cập Nhật Bình Luận</h1>

<form action="?act=comment-edit&id=<?php echo $comment['CommentID']; ?>" method="POST">
    <!-- ID Sản phẩm -->
  <div>
        <label for="ProductID">ID Sản phẩm:</label>
        <select name="ProductID" id="ProductID" required>
            <option value="">Chọn sản phẩm</option>
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['id']; ?>"><?php echo $product['ProductName']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- ID Người dùng -->
    <div>
        <label for="UserID">ID Người dùng:</label>
        <select name="UserID" id="UserID" required>
            <option value="">Chọn người dùng</option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Nội dung Bình luận -->
    <div>
        <label for="Content">Nội dung:</label>
        <textarea name="Content" id="Content" rows="4" required><?php echo $comment['Content']; ?></textarea>
    </div>

    <!-- ID Đơn hàng (có thể bỏ phần này nếu không cần thiết) -->
    <div>
        <label for="OrderID">ID Đơn hàng:</label>
        <input type="number" name="OrderID" id="OrderID" value="<?php echo $comment['OrderID']; ?>">
    </div>

    <div>
        <button type="submit">Cập Nhật Bình Luận</button>
    </div>
</form>
