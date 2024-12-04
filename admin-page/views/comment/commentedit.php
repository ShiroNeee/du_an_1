<style>
    .admin-comment-form-container {
        margin: 20px auto;
        max-width: 800px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
    }

    .admin-comment-form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    .admin-comment-form-container .form-group {
        margin-bottom: 15px;
    }

    .admin-comment-form-container label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .admin-comment-form-container input,
    .admin-comment-form-container select,
    .admin-comment-form-container textarea,
    .admin-comment-form-container button {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .admin-comment-form-container button {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .admin-comment-form-container button:hover {
        background-color: #0056b3;
    }
</style>
<div class="admin-comment-form-container">
    <h2>Cập Nhật Bình Luận</h2>
    <form action="?act=comment-edit&id=<?php echo $comment['CommentID']; ?>" method="POST">
        <!-- ID Sản phẩm -->
        <div class="form-group">
            <label for="ProductID">ID Sản phẩm:</label>
            <select name="ProductID" id="ProductID" required>
                <option value="">Chọn sản phẩm</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['id']; ?>" 
                        <?php echo $comment['ProductID'] == $product['id'] ? 'selected' : ''; ?>>
                        <?php echo $product['ProductName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- ID Người dùng -->
        <div class="form-group">
            <label for="UserID">ID Người dùng:</label>
            <select name="UserID" id="UserID" required>
                <option value="">Chọn người dùng</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['id']; ?>"
                        <?php echo $comment['UserID'] == $user['id'] ? 'selected' : ''; ?>>
                        <?php echo $user['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nội dung Bình luận -->
        <div class="form-group">
            <label for="Content">Nội dung:</label>
            <textarea name="Content" id="Content" rows="4" required><?php echo htmlspecialchars($comment['Content']); ?></textarea>
        </div>

        <!-- ID Đơn hàng -->
        <div class="form-group">
            <label for="OrderID">ID Đơn hàng:</label>
            <input type="number" name="OrderID" id="OrderID" value="<?php echo htmlspecialchars($comment['OrderID']); ?>">
        </div>

        <div class="form-group">
            <button type="submit">Cập Nhật Bình Luận</button>
        </div>
    </form>
</div>
